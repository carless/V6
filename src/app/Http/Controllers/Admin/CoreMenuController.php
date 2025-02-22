<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Cesi\Core\app\Models\CoreMenu;
use Cesi\Core\libs\Controllers\CrudController;

class CoreMenuController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->setModel(CoreMenu::class);
        $this->setEntityNameStrings(trans('cesi::core.menus.name_singular'), trans('cesi::core.menus.name_plural'));
        $this->setRoute(cesi_url('core.menu'));
        $this->setRouterAlias('admin.core.menu');
        $this->setResourceAlias('cesi::core.admin.menus');
        $this->setPermissionName('admin.core.menu');

        $this->setDefaultOrderColumn('lft');
        $this->setDefaultOrderDirection('asc');

        parent::setup();
    }

    public function initColumns()
    {
        $this->setColumns([
            [
                'name'  => 'id',
                'label' => trans('cesi::core.menus.fields.id'),
                'type'  => 'text',
                'width' => '30px',
                'visible' => false,
                'orderable' => false,
            ], [
                'name'  => 'name',
                'label' => trans('cesi::core.menus.fields.name'),
                'type'  => 'model_function',
                'function_name' => 'DspTreeName',
                'orderable' => false,
            ], [
                'name'  => 'type',
                'label' => trans('cesi::core.menus.fields.type'),
                'type'  => 'text',
                'orderable' => false,
            ], [
                'name'  => 'link',
                'label' => trans('cesi::core.menus.fields.link'),
                'type'  => 'text',
                'orderable' => false,
            ], [
                'name'  => 'level',
                'label' => trans('cesi::core.menus.fields.level'),
                'type'  => 'text',
                'orderable' => false,
            ], [
                'name'  => 'lft',
                'label' => trans('cesi::core.menus.fields.lft'),
                'type'  => 'text',
                'orderable' => false,
            ], [
                'name'  => 'rgt',
                'label' => trans('cesi::core.menus.fields.rgt'),
                'type'  => 'text',
                'orderable' => false,
            ], [
                'name'  => 'move',
                'label' => trans('cesi::core.menus.fields.move'),
                'type'  => 'model_function',
                'function_name' => 'DspMove',
                'width' => '60px',
                'orderable' => false,
            ],
        ]);
    }

    public function ajaxFormatResult($record)
    {
        return ['id' => $record->id, 'text' => $record->DspTreeNameRaw()];
    }

    public function moveup($id)
    {
        if ($this->tienePermiso('update')) {
            $record = $this->getModel()::findOrFail($id);
            $record->up();
        }
        return redirect(route($this->getRouterAlias().'.list'));
    }

    public function movedown($id)
    {
        if ($this->tienePermiso('update')) {
            $record = $this->getModel()::findOrFail($id);
            $record->down();
        }
        return redirect(route($this->getRouterAlias().'.list'));
    }
}