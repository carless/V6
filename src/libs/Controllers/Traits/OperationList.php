<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Illuminate\Http\Request;

trait OperationList
{
    /**
     * Display all rows in the database for this entity.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $this->hasAccessOrFail('list');
        $this->setOperation('list');
        if ($this->tienePermiso('list')) {
            $this->data = array();
            $this->data['title'] = $this->getTitle() ?? mb_ucfirst($this->entity_name_plural);
            $this->data['routerAlias']  = $this->getRouterAlias();
            $this->data['contentClass'] = $this->getListContentClass();
            $this->data['heading'] = $this->getHeading() ?? $this->entity_name_plural;
            $this->data['subheading'] = '';
            $this->data['permissionName']   = $this->getPermissionName();
            $this->data['buttons_top'] = $this->getButtons()->where('stack', 'top');
            $this->data['columns'] = $this->getColumns();
            $this->data['columnOrderNum'] = $this->getColumnNumericIndex($this->getDefaultOrderColumn());
            $this->data['columnOrderName'] = $this->getDefaultOrderColumn();
            $this->data['columnOrderDire'] = $this->getDefaultOrderDirection();
            $this->data['filtros']      = $this->getfilters();

            // load the view from /resources/views/vendor/Cesi/crud/ if it exists, otherwise load the one in the package
            return view($this->getListView(), $this->data);
        } else {
            return view('cesi::errors.401');
        }
    }

    public function getdata()
    {
        // $this->hasAccessOrFail('list');
        $this->setOperation('list');

        $totalRows      = $this->getModel()::count();
        $filteredRows   = $this->count();
        $startIndex     = $this->getRequest()->input('start') ?: 0;

        $entries = $this->getList();

        return $this->getEntriesAsJsonForDatatables($entries, $totalRows, $filteredRows, $startIndex);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getdataajax(Request $request)
    {
        if ($this->tienePermiso('list')) {
            $this->setOperation('list');
            $records = $this->getList();

            $formatted_tags = [];
            foreach ($records as $record) {
                $formatted_tags[] = $this->ajaxFormatResult($record);
            }
            return response()->json($formatted_tags);

        } else {
            return response()->view('cesi::errors.401', [], 401);
        }
    }

    public function ajaxFormatResult($record)
    {
        return ['id' => $record->id, 'text' => $record->name];
    }

}
