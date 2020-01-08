<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

trait Filtros
{
    public $filters = [];

    public function filtersEnabled()
    {
        return ! is_array($this->filters);
    }

    public function filtersDisabled()
    {
        return is_array($this->filters);
    }

    public function enableFilters()
    {
        if ($this->filtersDisabled()) {
            $this->filters = new FiltersCollection;
        }
    }

    public function disableFilters()
    {
        $this->filters = [];
    }

    public function clearFilters()
    {
        $this->filters = new FiltersCollection;
    }

    public function getfilters()
    {
        return $this->filters;
    }

    public function removeFilter($name)
    {
        $this->filters = $this->filters->reject(function ($filter) use ($name) {
            return $filter->name == $name;
        });
    }

    public function removeAllFilters()
    {
        $this->filters = collect([]);
    }

    /**
     * Add a filter to the CRUD table view.
     *
     * @param array $options Name, type, label, etc.
     * @param bool $values
     * @param bool $filter_logic Query modification (filtering) logic when filter is active.
     * @param bool $fallback_logic Query modification (filtering) logic when filter is not active.
     */
    public function addFilter($options, $values = false, $filter_logic = false, $fallback_logic = false)
    {
        // if a closure was passed as "values"
        if (is_callable($values)) {
            // get its results
            $values = $values();
        }

        // enable the filters functionality
        $this->enableFilters();

        // check if another filter with the same name exists
        if (! isset($options['name'])) {
            abort(500, 'All your filters need names.');
        }
        if ($this->filters->contains('name', $options['name'])) {
            abort(500, "Sorry, you can't have two filters with the same name.");
        }

        // add a new filter to the interface
        $filter = new CrudFilter($options, $values, $filter_logic, $fallback_logic);
        $this->filters->push($filter);
    }    
}

class FiltersCollection extends Collection
{
    public function removeFilter($name)
    {
    }

    // public function count()
    // {
    //     dd($this);
    // }
}

class CrudFilter
{
    public $name; // the name of the filtered variable (db column name)
    public $type = 'select'; // the name of the filter view that will be loaded
    public $label;
    public $placeholder;
    public $values;
    public $options;
    public $logic;
    public $fallbackLogic;    
    public $currentValue;
    public $view;
    public $queryName;
    public $queryOperation;

    public function __construct($options, $values, $filter_logic, $fallbackLogic)
    {
        $this->name     = $options['name'];
        $this->type     = $options['type'];
        $this->label    = $options['label'];

        if (!isset($options['placeholder'])) {
            $this->placeholder = '';
        } else {
            $this->placeholder = $options['placeholder'];
        }

        if (!isset($options['queryName'])) {
            $this->queryName = $this->name;
        } else {
            $this->queryName = $options['queryName'];
            unset($options['queryName']);
        }

        if (!isset($options['queryOperation'])) {
            $this->queryOperation = '=';
        } else {
            $this->queryOperation = $options['queryOperation'];
            unset($options['queryOperation']);
        }

        if (!isset($options['view'])) {
            $this->view = 'cesi::crud.filters.'.$this->type;
        } else {
            $this->view = $options['view'];
        }

        $this->values   = $values;
        $this->options  = $options;

        $this->logic = $filter_logic;
        $this->fallbackLogic = $fallbackLogic;

        if (Request::has('filter.'.$this->name)) {
            $this->currentValue = Request::input('filter.'.$this->name);
        }
    }

    public function isActive()
    {
        if (Request::has($this->name)) {
            return true;
        }

        return false;
    }

    /**
     * @param $myQuery \Illuminate\Database\Eloquent\Builder
     */
    public function applyFilter($myQuery)
    {
        if (!is_null($this->currentValue)) {
            if (is_callable($this->logic)) {
                ($this->logic)($myQuery, $this->currentValue);
            } else {
                $myQuery->where($this->queryName, $this->queryOperation, $this->currentValue);
            }
        }
    }
}