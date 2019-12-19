<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Illuminate\Support\Facades\View;

trait Listado
{
    protected $showCheckAll = false;

    /**
     * @return Boolean
     */
    public function getShowCheckAll(): bool
    {
        return $this->showCheckAll;
    }

    /**
     * @param boolean $mostrar
     */
    public function setShowCheckAll(bool $mostrar)
    {
        $this->showCheckAll = $mostrar;
    }

    /**
     * Get all entries from the database.
     *
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getList()
    {
        // $this->autoEagerLoadRelationshipColumns();

        // if a search term was present
        if ($this->getRequest()->input('search.value')) {
            // filter the results accordingly
            $this->applySearchTerm($this->getRequest()->input('search.value'));
        }

        // if a search term was present
        if ($this->getRequest()->input('buscar')) {
            // filter the results accordingly
            $this->applySearchTerm($this->getRequest()->input('buscar'));
        }

        // start the results according to the datatables pagination
        if ($this->getRequest()->input('length')) {
            $this->setDefaultPageLength($this->getRequest()->input('length'));
        }

        // dd($this->getRequest());

        if ($this->getRequest()->input('order')) {
            $numeroColumna = $this->getRequest()->get('order')['0']['column'];

            if ($this->getShowCheckAll()) {
                $numeroColumna--;
            }
            $col = $this->findColumnById($numeroColumna);
            $this->setDefaultOrderColumn($col['name']);

            $direction = $this->getRequest()->get('order')['0']['dir'];
            $this->setDefaultOrderDirection($direction);
        }

        // if ($this->getRequest()->input('order.0.dir')) {
        //    $this->setDefaultOrderDirection($this->getRequest()->input('order.0.dir'));
        // }

        if ($this->getRequest()->input('order_column')) {
            $this->setDefaultOrderColumn($this->getRequest()->input('order_column'));
        }

        if ($this->getRequest()->input('order_dir')) {
            $this->setDefaultOrderDirection($this->getRequest()->input('order_dir'));
        }

        $limit  = $this->getRequest()->input('length');
        $start  = $this->getRequest()->input('start');

        // $tmpTotalRows = $this->query->get();
        // $this->setTotalRows(count($tmpTotalRows));
        // $entries = $this->getQuery()
        $entries = $this->getBaseQuery()
            ->offset($start)
            ->limit($limit)
            ->orderBy($this->getDefaultOrderColumn(), $this->getDefaultOrderDirection())
            ->get();

        // $entries = $this->getQuery()->get();

        // add the fake columns for each entry
        // foreach ($entries as $key => $entry) {
        //    $entry->addFakes($this->getFakeColumnsAsArray());
        // }

        return $entries;
    }


    /**
     * Created the array to be fed to the data table.
     *
     * @param array    $entries Eloquent results.
     * @param int      $totalRows
     * @param int      $filteredRows
     * @param bool|int $startIndex
     *
     * @return array
     */
    public function getEntriesAsJsonForDatatables($entries, $totalRows, $filteredRows, $startIndex = false)
    {
        $rows = [];

        foreach ($entries as $row) {
            $rows[] = $this->getRowViews($row, $startIndex === false ? false : ++$startIndex);
        }

        return [
            'draw'            => (isset($this->request['draw']) ? (int) $this->request['draw'] : 0),
            'recordsTotal'    => $totalRows,
            'recordsFiltered' => $filteredRows,
            'data'            => $rows,
            'query'           => $this->getQuery()->getQuery()->toSql(),
        ];
    }

    /**
     * Get the HTML of the cells in a table row, for a certain DB entry.
     *
     * @param  \Illuminate\Database\Eloquent\Model $entry     A db entry of the current entity;
     * @param  bool|int                            $rowNumber The number shown to the user as row number (index);
     *
     * @return array                Array of HTML cell contents.
     */
    public function getRowViews($entry, $rowNumber = false)
    {
        $row_items = [];

        foreach ($this->columns as $key => $column) {
            $row_items[$key] = $this->getCellView($column, $entry, $rowNumber);
        }

        $row_items['actions'] = '';

        if ($this->getButtons()->where('stack', 'line')->count()) {
            $btnActions = $this->getButtons()->where('stack', 'line');
            foreach ($btnActions as $button) {
                $htmlButtons = "";

                if ($button->type == 'model_function') {
                    // TODO
                } elseif ($button->type == 'view') {
                    $htmlButtons = View::make($button->content)
                        ->with('routerAlias', $this->getRouterAlias())
                        ->with('entry', $entry)
                        ->with('row_number', $rowNumber)
                        ->render();
                }

                $row_items['actions'] .= $htmlButtons;
            }
        }

        /*
        // add the buttons as the last column
        if ($this->getButtons()->where('stack', 'line')->count()) {
            $row_items['actions'] = View::make('cesi::crud.button_stack', ['stack' => 'line'])
                ->with('crud', $this)
                ->with('entry', $entry)
                ->with('row_number', $rowNumber)
                ->render();
        }
        */

        // add the details_row button to the first column
        /*
        if ($this->details_row) {
            $details_row_button = \View::make('crud::columns.details_row_button')
                ->with('crud', $this)
                ->with('entry', $entry)
                ->with('row_number', $rowNumber)
                ->render();
            $row_items[0] = $details_row_button.$row_items[0];
        }
        */

        return $row_items;
    }

    /**
     * Get the name of the view to load for the cell.
     *
     * @param array $column
     *
     * @return string
     */
    private function getCellViewName($column)
    {
        // return custom column if view_namespace attribute is set
        if (isset($column['view_namespace']) && isset($column['type'])) {
            return $column['view_namespace'].'.'.$column['type'];
        }

        if (isset($column['type'])) {
            // if the column has been overwritten return that one
            if (view()->exists('vendor.cesi.crud.columns.'.$column['type'])) {
                return 'vendor.cesi.crud.columns.'.$column['type'];
            }

            // return the column from the package
            return 'cesi::crud.columns.'.$column['type'];
        }

        // fallback to text column
        return 'cesi::crud.columns.text';
    }

    /**
     * Get the HTML of a cell, using the column types.
     *
     * @param  array                               $column
     * @param  \Illuminate\Database\Eloquent\Model $entry     A db entry of the current entity;
     * @param  bool|int                            $rowNumber The number shown to the user as row number (index);
     *
     * @return string
     */
    public function getCellView($column, $entry, $rowNumber = false)
    {
        return $this->renderCellView($this->getCellViewName($column), $column, $entry, $rowNumber);
    }

    /**
     * Render the given view.
     *
     * @param string   $view
     * @param array    $column
     * @param object   $entry
     * @param bool|int $rowNumber The number shown to the user as row number (index)
     *
     * @return string
     */
    private function renderCellView($view, $column, $entry, $rowNumber = false)
    {
        if (! view()->exists($view)) {
            $view = 'cesi::crud.columns.text'; // fallback to text column
        }

        return View::make($view)
            ->with('crud', $this)
            ->with('column', $column)
            ->with('entry', $entry)
            ->with('rowNumber', $rowNumber)
            ->render();
    }
}