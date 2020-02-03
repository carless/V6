<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Carbon\Carbon;
use Cesi\Core\app\App\Helpers\CesiCoreHelper;
use Cesi\Core\app\Models\CoreEmailTmpl;
use Cesi\Core\libs\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailTmplController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->setModel(CoreEmailTmpl::class);
        $this->setEntityNameStrings(trans('cesi::core.emailtmpl.name_singular'), trans('cesi::core.emailtmpl.name_plural'));
        $this->setRoute(cesi_url('core.emailtmpl'));
        $this->setRouterAlias('admin.core.emailtmpl');
        $this->setResourceAlias('cesi::core.admin.emailtmpl');
        $this->setPermissionName('admin.core.emailtmpl');

        $this->setDefaultOrderColumn('name');
        $this->setDefaultOrderDirection('asc');

        // $this->initFilters();

        parent::setup();
    }

    public function initButtons()
    {
        parent::initButtons();

        if ($this->tienePermiso('update')) {
            $this->addButton('top', 'sendtest', 'view', 'cesi::admin.emailtmpl.buttons.sendtest', 'beginning');
        }

        // $this->addButton('top', 'refresh', 'view', 'cesi::crud.buttons.refresh', 'end');
    }

    public function initColumns()
    {
        // Columns.
        $this->setColumns([
            [
                'name'  => 'id',
                'label' => trans('cesi::core.emailtmpl.fields.id'),
                'type'  => 'text',
                'width' => '30px',
                'visible' => false,
                'orderable' => false,
            ], [
                'name'  => 'name',
                'label' => trans('cesi::core.emailtmpl.fields.name'),
                'type'  => 'text',
                'responsivePriority' => '1',
            ], [
                'name'  => 'slug',
                'label' => trans('cesi::core.emailtmpl.fields.slug'),
                'type'  => 'text',
                'responsivePriority' => '2',
            ], [
                'name'  => 'theme',
                'label' => trans('cesi::core.emailtmpl.fields.theme'),
                'type'  => 'text',
                'responsivePriority' => '3',
            ]
        ]);
    }

    /**
     * Classes using this trait have to implement this method.
     * Used to validate store.
     *
     * @return array
     */
    public function StoreValidationData()
    {
        return [
            'rules' => [
                'slug' => 'required|min:3|max:255|unique:core_email_tmpl,slug',
            ],
            'messages' => [],
            'attributes' => [],
            'advanced' => [],
        ];
    }

    /**
     * Classes using this trait have to implement this method.
     * Used to validate update.
     *
     * @param $record
     * @return array
     */
    public function UpdateValidationData($record)
    {
        return [
            'rules' => [
                'slug' => 'required|min:3|max:255|unique:core_email_tmpl,slug,'.$record->id,
            ],
            'messages' => [],
            'attributes' => [],
            'advanced' => [],
        ];
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

        if (!empty($request->input('slug'))) {
            $values['slug'] = str_slug($request->input('slug', ''), '_');
        } else {
            $values['slug'] = str_slug($request->input('name', ''), '_');
        }

        return $values;
    }

    public function sendtest(Request $request) {

        $ids = $request->input('idtmpl', 0);
        $myId = intval($ids);
        $toEmail = $request->input('to_email', '');

        if ($myId>=1) {
            $list = $this->getBaseQuery()->where('id', $myId)->get();
            $lerror = false;

            foreach($list as $item) {
                // dd($item);

                $dataEmail = array();
                $dataEmail['to']        = $toEmail;
                $dataEmail['slug']      = $item->slug;
                $dataEmail['data']      = [
                    'sitename' => config('cesicore.project_name'),
                    'username' => 'Nombre del usuario',
                ];

                if (!$this->sendEmail($dataEmail)) {
                    $lerror = true;
                }
            }

            if ($lerror) {
                return response()->json([
                    'status' => 'error',
                    'title' => 'Envio del test',
                    'msg' => 'Errores en el envio',
                ]);
            } else {
                return response()->json([
                    'status' => 'success',
                    'title' => 'Envio del test',
                    'msg' => 'Email Enviado',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'title' => 'Envio del test',
                'msg' => 'No se han encontrado registros',
            ]);
        }
    }
}
