<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Carbon\Carbon;
use Cesi\Core\app\App\Helpers\CesiCoreHelper;
use Cesi\Core\app\Models\CorePreimpresos;
use Cesi\Core\libs\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CorePreimpresosController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->setModel(CorePreimpresos::class);
        $this->setEntityNameStrings(trans('cesi::core.preimpresos.name_singular'), trans('cesi::core.preimpresos.name_plural'));
        $this->setRoute(cesi_url('core.preimpresos'));
        $this->setRouterAlias('admin.core.preimpresos');
        $this->setResourceAlias('cesi::core.admin.preimpresos');
        $this->setPermissionName('admin.core.preimpresos');

        $this->setDefaultOrderColumn('name');
        $this->setDefaultOrderDirection('asc');

        $this->initFilters();

        parent::setup();
    }

    public function initFilters() {

        $this->addFilter([
            'name'  => 'fltStatus',
            'label' => trans('cesi::core.preimpresos.fields.status'),
            'type'  => 'select2',
            'datos' => [
                '0' => '-Todos-',
                '1' => 'Activo',
                '2' => 'Desactivado',
            ],
            'style' => 'width:190px;',
            'placeholder' => trans('cesi::core.preimpresos.fields.activo'),
            'queryName' => 'core_preimpresos.activo',
        ], false, function($myQuery, $value) {
            $valor = intval($value);
            if ($valor==0) {
                // nothing todo
            } else if ($valor==1) {
                $myQuery->where('core_preimpresos.activo', '=', 1);
            } else if ($valor==2) {
                $myQuery->where('core_preimpresos.activo', '=', 0);
            }
        });

        $this->addFilter([
            'name'  => 'flttipo',
            'label' => trans('cesi::core.task.filters.prioridad'),
            'type'  => 'select2',
            'datos' => CesiCoreHelper::getTiposPreImpresos(),
            'style' => 'width:190px;',
            'placeholder' => trans('cesi::core.preimpresos.filters.tipo'),
            'queryName' => 'core_preimpresos.tipo',
        ], false, function($myQuery, $value) {
            $valor = intval($value);
            if ($valor==0) {
                // nothing todo
            } else {
                $myQuery->where('core_preimpresos.tipo', '=', $valor);
            }
        });
    }

    public function initColumns()
    {
        // Columns.
        $this->setColumns([
            [
                'name'  => 'id',
                'label' => trans('cesi::core.preimpresos.fields.id'),
                'type'  => 'text',
                'width' => '30px',
                'visible' => false,
                'orderable' => false,
            ], [
                'name'  => 'name',
                'label' => trans('cesi::core.preimpresos.fields.name'),
                'type'  => 'text',
                'responsivePriority' => '1',
            ], [
                'name'  => 'slug',
                'label' => trans('cesi::core.preimpresos.fields.slug'),
                'type'  => 'text',
                'responsivePriority' => '2',
            ], [
                'name'  => 'papel',
                'label' => trans('cesi::core.preimpresos.fields.papel'),
                'type'  => 'text',
                'responsivePriority' => '3',
                'width' => '60px',
            ], [
                'name'  => 'orientacion',
                'label' => trans('cesi::core.preimpresos.fields.orientacion'),
                'type'  => 'text',
                'responsivePriority' => '3',
                'width' => '60px',
            ], [
                'name'  => 'tipo',
                'label' => trans('cesi::core.preimpresos.fields.tipo'),
                'type'  => 'model_function',
                'function_name' => 'DspTipo',
                'orderable' => false,
                'responsivePriority' => '4',
            ], [
                'name'  => 'activo',
                'label' => trans('cesi::core.preimpresos.fields.activo'),
                'type'  => 'sino',
                'width' => '60px',
                'responsivePriority' => '1',
            ]

        ]);
    }

    public function getList()
    {
        // if a search term was present
        if ($this->getRequest()->input('filter_tipo')) {
            $valor = $this->getRequest()->input('filter_tipo');
            $this->getQuery()->where('core_preimpresos.tipo', '=', $valor);
        }

        return parent::getList();
    }

    public function hasUploadFields($form, $id = false)
    {
        return true;
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
                'margenCab' => 'numeric|between:0,999',
                'margenPie' => 'numeric|between:0,999',
                'margenIzq' => 'numeric|between:0,999',
                'margenDer' => 'numeric|between:0,999',
                'tituloPosX' => 'numeric|between:0,999',
                'tituloPosY' => 'numeric|between:0,999',
                'logoPosX' => 'numeric|between:0,999',
                'logoPosY' => 'numeric|between:0,999',
            ],
            'messages' => [
                'name.required'     => trans('cesi::core.preimpresos.validations.name_required'),
                'name.max'          => trans('cesi::core.preimpresos.validations.name_max'),
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
                'margenCab' => 'numeric|between:0,999',
                'margenPie' => 'numeric|between:0,999',
                'margenIzq' => 'numeric|between:0,999',
                'margenDer' => 'numeric|between:0,999',
                'tituloPosX' => 'numeric|between:0,999',
                'tituloPosY' => 'numeric|between:0,999',
                'logoPosX' => 'numeric|between:0,999',
                'logoPosY' => 'numeric|between:0,999',
            ],
            'messages' => [
                'name.required'     => trans('cesi::core.preimpresos.validations.name_required'),
                'name.max'          => trans('cesi::core.preimpresos.validations.name_max'),
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
    public function alterValuesToSave(Request $request, $values, $id = null) {

        if (!array_key_exists('activo', $values)) {
            $values['activo'] = 0;
        }

        if (!array_key_exists('mostrarCab', $values)) {
            $values['mostrarCab'] = 0;
        }

        if (!array_key_exists('mostrarLogo', $values)) {
            $values['mostrarLogo'] = 0;
        }

        if (!array_key_exists('mostrarTitulo', $values)) {
            $values['mostrarTitulo'] = 0;
        }

        if (!array_key_exists('mostrarSubtitulo', $values)) {
            $values['mostrarSubtitulo'] = 0;
        }

        if (!array_key_exists('mostrarPie', $values)) {
            $values['mostrarPie'] = 0;
        }

        if (!array_key_exists('pieSeparador', $values)) {
            $values['pieSeparador'] = 0;
        }

        if (!array_key_exists('pieFecha', $values)) {
            $values['pieFecha'] = 0;
        }

        if (!array_key_exists('pieHora', $values)) {
            $values['pieHora'] = 0;
        }

        if (!array_key_exists('pieNumPag', $values)) {
            $values['pieNumPag'] = 0;
        }

        if (!array_key_exists('pieNumParte', $values)) {
            $values['pieNumParte'] = 0;
        }

        return $values;
    }

    /**
     * Redirecciona a la vista ".list" despues de guardar los datos
     *
     * @param $record
     * @param \Illuminate\Http\Request $request
     * @param String tipo
     *
     * @return \Illuminate\Http\Response
     */
    public function getRedirectAfterSave($record, Request $request, $tipo = null)
    {
        if ($request->hasFile('filepdf')) {
            $record->archivo = $this->uploadImage($request, $record);
            $record->save();
        }

        return parent::getRedirectAfterSave($record, $request, $tipo);
    }

    /**
     * Upload Image.
     *
     * @param Request $request
     * @param CorePreimpresos $record
     * @return string $input
     */
    public function uploadImage(Request $request, CorePreimpresos $record)
    {
        $uppath = '';
        $storage = Storage::disk('upload');
        $path = 'preimpresos'.DIRECTORY_SEPARATOR;
        $file = $request->file('filepdf');

        if ($request->file('filepdf')->isValid()) {

            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = 'preimpreso_'. $record->slug .'.'.$extension;

            $storage->put($path.$fileName, file_get_contents($file->getRealPath()));

            $uppath = $path.$fileName;
            // $uppath = $request->logoupload->storeAs('public', 'logo.'.$extension );
        }

        return $uppath;
    }
}
