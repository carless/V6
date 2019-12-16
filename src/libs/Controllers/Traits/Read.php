<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Illuminate\Support\Facades\Route;

trait Read
{
    protected $default_page_length = false;
    protected $default_order_column = false;
    protected $default_order_direction = false;

    /**
     * Set the number of rows that should be show on the table page (list view).
     */
    public function setDefaultPageLength($value)
    {
        $this->default_page_length = $value;
    }

    /**
     * Get the number of rows that should be show on the table page (list view).
     */
    public function getDefaultPageLength()
    {
        // return the custom value for this crud panel, if set using setPageLength()
        if ($this->default_page_length) {
            return $this->default_page_length;
        }

        // otherwise return the default value in the config file
        if (config('cesi.core.crud.default_page_length')) {
            return config('cesi.core.crud.default_page_length');
        }

        return 25;
    }

    public function setDefaultOrderColumn($value)
    {
        $this->default_order_column = $value;
    }

    public function getDefaultOrderColumn()
    {
        if ($this->default_order_column) {
            return $this->default_order_column;
        }

        return 'id';
    }

    public function setDefaultOrderDirection($value)
    {
        $this->default_order_direction = $value;
    }

    public function getDefaultOrderDirection()
    {
        if ($this->default_order_direction) {
            return $this->default_order_direction;
        }

        return 'ASC';
    }

    /**
     * Find and retrieve the id of the current entry.
     *
     * @return int|bool The id in the db or false.
     */
    public function getCurrentEntryId()
    {
        if ($this->entry) {
            return $this->entry->getKey();
        }

        $params = Route::current()->parameters();

        return  // use the entity name to get the current entry
            // this makes sure the ID is corrent even for nested resources
            $this->request->input($this->entity_name) ??
            // otherwise use the next to last parameter
            array_values($params)[count($params) - 1] ??
            // otherwise return false
            false;
    }

    /**
     * Find and retrieve the current entry.
     *
     * @return \Illuminate\Database\Eloquent\Model|bool The row in the db or false.
     */
    public function getCurrentEntry()
    {
        $id = $this->getCurrentEntryId();

        if (!$id) {
            return false;
        }

        return $this->getEntry($id);
    }

    /**
     * Find and retrieve an entry in the database or fail.
     *
     * @param int The id of the row in the db to fetch.
     *
     * @return \Illuminate\Database\Eloquent\Model The row in the db.
     */
    public function getEntry($id)
    {
        if (!$this->entry) {
            $this->entry = $this->getModel()->findOrFail($id);
            // TODO FAKES??  $this->entry = $this->entry->withFakes();
        }

        return $this->entry;
    }

    /**
     * Add conditions to the CRUD query for a particular search term.
     *
     * @param  [string] $searchTerm Whatever string the user types in the search bar.
     * @return
     */
    public function applySearchTerm($searchTerm)
    {
        return $this->getQuery()->where(function ($query) use ($searchTerm) {
            foreach ($this->getColumns() as $column) {
                if (!isset($column['type'])) {
                    abort(400, 'Missing column type when trying to apply search term.');
                }

                $this->applySearchLogicForColumn($query, $column, $searchTerm);
            }
        });
    }

    /**
     * Apply the search logic for each CRUD column.
     */
    public function applySearchLogicForColumn($query, $column, $searchTerm)
    {
        // if there's a particular search logic defined, apply that one
        if (isset($column['searchLogic'])) {
            $searchLogic = $column['searchLogic'];

            if (is_callable($searchLogic)) {
                return $searchLogic($query, $column, $searchTerm);
            }

            if ($searchLogic == false) {
                return;
            }
        }

        // sensible fallback search logic, if none was explicitly given
        if ($column['tableColumn']) {
            switch ($column['type']) {
                case 'email':
                case 'date':
                case 'datetime':
                case 'text':
                    if (isset($column['entity'])) {
                        $query->orWhere($column['entity'] .'.'. $column['name'], 'like', '%' . $searchTerm . '%');
                    } else {
                        $query->orWhere($column['name'], 'like', '%' . $searchTerm . '%');
                    }
                    break;

                case 'select':
                case 'select_multiple':
                    $query->orWhereHas($column['entity'], function ($q) use ($column, $searchTerm) {
                        $q->where($column['attribute'], 'like', '%'.$searchTerm.'%');
                    });
                    break;

                default:
                    return;
                    break;
            }
        }
    }
}