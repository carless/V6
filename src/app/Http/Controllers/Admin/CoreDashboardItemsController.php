<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Cesi\Core\libs\Controllers\CrudController;
use Cesi\Core\app\Models\CoreDashboard;
use Cesi\Core\app\Models\CoreDashboardItem;

class CoreDashboardItemsController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->setModel(CoreDashboardItem::class);
        $this->setEntityNameStrings(trans('cesi::core.dashboarditems.name_singular'), trans('cesi::core.dashboarditems.name_plural'));
        $this->setRoute(cesi_url('core.dashboarditems'));
        $this->setRouterAlias('admin.core.dashboarditems');
        $this->setResourceAlias('cesi::core.admin.dashboarditems');
        $this->setPermissionName('admin.core.dashboarditems');

        $this->setDefaultOrderColumn('sorting');
        $this->setDefaultOrderDirection('asc');

        $this->initFilters();

        parent::setup();
    }

    public function initFilters()
    {
        $this->addFilter([
            'name'          => 'fltDashboard',
            'label'         => 'Dashboard',
            'type'          => 'select2',
            'model'         => \Cesi\Core\app\Models\CoreDashboard::class,
            'style'         => 'width:200px;',
            'ajax'          => route('admin.core.coredashboard.getdataajax'),
            'placeholder'   => '- Seleccionar -',
            'queryName'     => 'core_dashboard_items.dashboard_id',
        ]);
    }

    public function initColumns()
    {
        // Columns.
        $this->setColumns([
            [
                'name'  => 'id',
                'label' => trans('cesi::core.dashboarditems.fields.id'),
                'type'  => 'text',
                'width' => '30px',
                'visible' => false,
                'orderable' => false,
            ], [
                'name'  => 'name',
                'label' => trans('cesi::core.dashboarditems.fields.name'),
                'type'  => 'text',
                'responsivePriority' => '1',
            ], [
                'name'  => 'tipo',
                'label' => trans('cesi::core.dashboarditems.fields.tipo'),
                'type'  => 'text',
                'responsivePriority' => '2',
            ], [
                'name'  => 'area',
                'label' => trans('cesi::core.dashboarditems.fields.area'),
                'type'  => 'text',
                'responsivePriority' => '3',
            ], [
                'name'  => 'dashboardname',
                'label' => trans('cesi::core.dashboarditems.fields.dashboard'),
                'type'  => 'text',
                'responsivePriority' => '4',
            ], [
                'name'  => 'sorting',
                'label' => trans('cesi::core.dashboarditems.fields.orden'),
                'type'  => 'text',
                'width' => '50px',
                'responsivePriority' => '5',
            ], [
                'name'  => 'move',
                'label' => trans('cesi::core.dashboarditems.fields.move'),
                'type'  => 'model_function',
                'function_name' => 'DspMove',
                'width' => '60px',
                'orderable' => false,
            ],
        ]);
    }

    public function getBaseQuery()
    {
        return $this->getModel()::query()
            ->leftjoin('core_dashboard', 'core_dashboard.id', '=', 'core_dashboard_items.dashboard_id')
            ->select('core_dashboard_items.*', 'core_dashboard.name as dashboardname')
            ;
    }

    public function getQuery()
    {
        if ($this->getOperation() == 'list') {
            return $this->getModel()::query()
                ->leftjoin('core_dashboard', 'core_dashboard.id', '=', 'core_dashboard_items.dashboard_id')
                ->select('core_dashboard_items.*', 'core_dashboard.name as dashboardname')
            ;
        } else {
            return parent::getQuery();
        }
    }

    public function moveup($id)
    {
        if ($this->tienePermiso('update')) {
            $record = $this->getModel()::findOrFail($id);
            $record->moveOrderUp();
        }
        return redirect(route($this->getRouterAlias().'.list'));
    }

    public function movedown($id)
    {
        if ($this->tienePermiso('update')) {
            $record = $this->getModel()::findOrFail($id);
            $record->moveOrderDown();
        }
        return redirect(route($this->getRouterAlias().'.list'));
    }
}