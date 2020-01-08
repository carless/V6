<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Cesi\Core\libs\Controllers\CrudController;
use Cesi\Core\app\Models\CoreDashboard;

class CoreDashboardController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->setModel(CoreDashboard::class);
        $this->setEntityNameStrings(trans('cesi::core.dashboard.name_singular'), trans('cesi::core.dashboard.name_plural'));
        $this->setRoute(cesi_url('core.dashboard'));
        $this->setRouterAlias('admin.core.coredashboard');
        $this->setResourceAlias('cesi::core.admin.dashboard');
        $this->setPermissionName('admin.core.coredashboard');

        $this->setDefaultOrderColumn('name');
        $this->setDefaultOrderDirection('asc');

        parent::setup();
    }

    public function initColumns()
    {
        // Columns.
        $this->setColumns([
            [
                'name'  => 'id',
                'label' => trans('cesi::core.dashboard.fields.id'),
                'type'  => 'text',
                'width' => '30px',
                'visible' => false,
                'orderable' => false,
            ], [
                'name'  => 'name',
                'label' => trans('cesi::core.dashboard.fields.name'),
                'type'  => 'text',
            ]
        ]);
    }
}