<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Carbon\Carbon;
use Cesi\Core\app\App\Helpers\CesiCoreHelper;
use Cesi\Core\app\Models\CesiUser;
use Cesi\Core\app\Models\CoreTask;
use Cesi\Core\app\Models\TaskStatus;
use Cesi\Core\libs\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoreMyTaskController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->setModel(CoreTask::class);
        $this->setEntityNameStrings(trans('cesi::core.mytask.name_singular'), trans('cesi::core.mytask.name_plural'));
        $this->setRoute(cesi_url('core.mytask'));
        $this->setRouterAlias('admin.core.mytask');
        $this->setResourceAlias('cesi::core.admin.mytask');
        $this->setPermissionName('admin.core.mytask');

        $this->setDefaultOrderColumn('fecha_inicio');
        $this->setDefaultOrderDirection('desc');

        $this->initFilters();

        parent::setup();
    }

    public function initFilters()
    {
        $this->addFilter([
            'name'  => 'fltPrioridad',
            'label' => trans('cesi::core.task.filters.prioridad'),
            'type'  => 'select2',
            'datos' => CesiCoreHelper::getSelectTaskPrioridad(),
            'style' => 'width:190px;',
            'placeholder' => trans('cesi::core.task.filters.prioridad_select'),
            'queryName' => 'core_taskmanager.prioridad',
        ], false, function($myQuery, $value) {
            $valor = intval($value);
            if ($valor==0) {
                // nothing todo
            } else {
                $myQuery->where('core_taskmanager.prioridad', '=', $valor);
            }
        });

        $this->addFilter([
            'name'  => 'fltStatus',
            'label' => trans('cesi::core.task.filters.status'),
            'type'  => 'select2',
            'model' => TaskStatus::class,
            'style' => 'width:180px;',
            'ajax'  => route('admin.core.taskstatus.getdataajax'),
            'placeholder' => trans('cesi::core.taskstatus.select'),
            'queryName' => 'core_taskmanager.status_id',
        ]);

        $tmpUser = cesi_auth()->user();

        $this->addFilter([
            'name'  => 'fltUser',
            'label' => trans('cesi::core.task.filters.asigned_user'),
            'type'  => 'hidden',
            'queryName' => 'core_taskmanager.user_id',
        ], $tmpUser->id);
    }

    public function initButtons()
    {
        parent::initButtons();

        if ($this->tienePermiso('update')) {
            $this->removeButton('update', 'line');
            $this->addButton('line', 'update', 'view', 'cesi::crud.buttons.updatemodal', 'beginning');
        }

        if ($this->tienePermiso('create')) {
            $this->removeButton('create', 'top');
            $this->addButton('top', 'create', 'view', 'cesi::crud.buttons.createmodal', 'beginning');
        }
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
                'label' => trans('cesi::core.task.fields.name'),
                'type'  => 'text',
                'responsivePriority' => '1',
            ], [
                'name'  => 'status_id',
                'width' => '150px',
                'label' => trans('cesi::core.task.fields.status'),
                'type'  => 'model_function',
                'function_name' => 'DspStatus',
                'orderable' => false,
            ], [
                'name'  => 'prioridad',
                'label' => trans('cesi::core.task.fields.prioridad'),
                'type'  => 'model_function',
                'function_name' => 'DspPrioridad',
                'orderable' => false,
            ], [
                'name'  => 'asignedusername',
                'label' => trans('cesi::core.task.fields.asigned_user'),
                'type'  => 'text',
            ], [
                'name'  => 'fecha_inicio',
                'width' => '70px',
                'label' => trans('cesi::core.task.fields.fecha_inicio'),
                'type'  => 'fecha',
            ], [
                'name'  => 'fecha_final',
                'width' => '70px',
                'label' => trans('cesi::core.task.fields.fecha_final'),
                'type'  => 'fecha',
            ], [
                'name'  => 'progreso',
                'width' => '100px',
                'label' => trans('cesi::core.task.fields.progreso'),
                'type'  => 'progress',
            ]
        ]);
    }

    public function getBaseQuery()
    {
        return $this->getModel()::query()
            ->leftjoin('users', 'users.id', '=', 'core_taskmanager.user_id')
            ->select('core_taskmanager.*',
                'users.name as asignedusername'
            )
            ;
    }

    public function getQuery()
    {
        if ($this->query == null) {
            if ($this->getOperation() == 'list') {
                $this->query = $this->getBaseQuery();
            } else {
                return parent::getQuery();
            }
        }

        return $this->query;
    }

    /**
     * Asigna/formatea los datos justo antes de validar.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function getValuesToSave(Request $request)
    {
        $values = parent::getValuesToSave($request);

        $values['progreso'] = CesiCoreHelper::removeNumberFormat($request->input('progreso', 0));

        return $values;
    }

    /**
     * Asigna/formatea los datos justo antes de guardar-los
     *
     * @param \Illuminate\Http\Request $request
     * @param $values
     * @param null $id
     * @return mixed
     */
    public function alterValuesToSave(\Illuminate\Http\Request $request, $values, $id = null) {

        // Convertir fechas en fecha de mySQL
        if (array_key_exists('fecha_inicio', $values)) {
            if (!empty($values['fecha_inicio'])) {
                $values['fecha_inicio'] = Carbon::parse($values['fecha_inicio'])->format('Y-m-d');
            }
        }

        if (array_key_exists('fecha_final', $values)) {
            if (!empty($values['fecha_final'])) {
                $values['fecha_final'] = Carbon::parse($values['fecha_final'])->format('Y-m-d');
            } else {
                $values['fecha_final'] = null;
            }
        } else {
            $values['fecha_final'] = null;
        }

        return $values;
    }
}
