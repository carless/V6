<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Cesi\Core\app\Models\TaskStatus;
use Cesi\Core\libs\Controllers\CrudController;
use Illuminate\Http\Request;

class TaskStatusController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->setModel(TaskStatus::class);
        $this->setEntityNameStrings(trans('cesi::core.taskstatus.name_singular'), trans('cesi::core.taskstatus.name_plural'));
        $this->setRoute(cesi_url('core.taskstatus'));
        $this->setRouterAlias('admin.core.taskstatus');
        $this->setResourceAlias('cesi::core.admin.taskstatus');
        $this->setPermissionName('admin.core.taskstatus');

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
                'label' => trans('cesi::core.taskstatus.fields.id'),
                'type'  => 'text',
                'width' => '30px',
                'visible' => false,
                'orderable' => false,
            ], [
                'name'  => 'name',
                'label' => trans('cesi::core.taskstatus.fields.name'),
                'type'  => 'text',
                'responsivePriority' => '1',
            ], [
                'name'  => 'classname',
                'label' => trans('cesi::core.taskstatus.fields.classname'),
                'type'  => 'text',
                'responsivePriority' => '1',
            ]
        ]);
    }

    /**
     * Used to validate store.
     *
     * @return array
     */
    public function StoreValidationData()
    {
        return [
            'rules' => [
                'name' => 'required|max:255',
            ],
            'messages' => [
                'name.required'     => trans('cesi::core.taskstatus.validations.name_required'),
                'name.max'          => trans('cesi::core.taskstatus.validations.name_max'),
            ],
            'attributes' => [],
        ];
    }

    /**
     * Used to validate update.
     *
     * @param $record
     * @return array
     */
    public function UpdateValidationData($record)
    {
        return [
            'rules' => [
                'name' => 'required|max:255',
            ],
            'messages' => [
                'name.required'     => trans('cesi::core.taskstatus.validations.name_required'),
                'name.max'          => trans('cesi::core.taskstatus.validations.name_max'),
            ],
            'attributes' => [],
        ];
    }

    /**
     * Asigna/formatea los datos justo antes de guardar-los
     *
     * @param \Illuminate\Http\Request $request
     * @param $values
     * @param null $id
     * @return mixed
     */
    /*
    public function alterValuesToSave(Request $request, $values, $id = null) {

        if (!array_key_exists('activo', $values)) {
            $values['activo'] = 0;
        }

        return $values;
    }
    */
}
