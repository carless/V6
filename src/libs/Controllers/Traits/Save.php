<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait Save
{
    /**
     * Classes using this trait have to implement this method.
     * Used to validate store.
     *
     * @return array
     */
    public function StoreValidationData()
    {
        return [
            'rules' => [],
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
            'rules' => [],
            'messages' => [],
            'attributes' => [],
            'advanced' => [],
        ];
    }

    /**
     * Validate the given request with the given rules.
     *
     * @param \Illuminate\Http\Request $request
     * @param $action
     * @param null $record
     *
     * @return
     */
    public function checkValidate(Request $request, $action, $record = null)
    {
        if ($action === 'store') {
            $validation = $this->StoreValidationData();
        } else {
            $validation = $this->UpdateValidationData($record);
        }

        $validation['rules'] = is_array($validation['rules']) ? $validation['rules'] : [];
        $validation['messages'] = is_array($validation['messages']) ? $validation['messages'] : [];
        $validation['attributes'] = is_array($validation['attributes']) ? $validation['attributes'] : [];
        if (! isset($validation['advanced']) || ! is_array($validation['advanced'])) {
            $validation['advanced'] = [];
        }

        if (count($validation['advanced'])) {
            $v = Validator::make(
                $request->all(),
                $validation['rules'],
                $validation['messages'],
                $validation['attributes']
            );

            // DOC: https://laravel.com/docs/5.6/validation
            foreach ($validation['advanced'] as $data) {
                if (isset($data['attribute']) && isset($data['rules']) && is_callable($data['callback'])) {
                    $v->sometimes($data['attribute'], $data['rules'], $data['callback']);
                }
            }

            return $v->validate();
        } else {
            return $this->validate($request, $validation['rules'], $validation['messages'], $validation['attributes']);
        }
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
        switch ($tipo) {
            case 'update':
                $this->AfterUpdate($record);
                break;
            case 'store':
                $this->AfterStore($record);
                break;
        }

        $isModalForm = $request->input('_ismodal' , '0');
        if ($isModalForm == 1) {
//            echo "es un modal form";
//            die();
            return view('cesi::crud.editmodalclose');
        } else {
            return redirect(route($this->getRouterAlias() . '.list'));
        }
    }

    /**
     * Classes using this trait have to implement this method.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function getValuesToSave(Request $request)
    {
        return $request->only($this->getModel()::getFillableFields());
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
        return $values;
    }

    /**
     * Check if the create/update form has upload fields.
     * Upload fields are the ones that have "upload" => true defined on them.
     *
     * @param  string   $form create/update/both - defaults to 'both'
     * @param  bool|int $id   id of the entity - defaults to false
     *
     * @return bool
     */
    public function hasUploadFields($form, $id = false)
    {

        /*
        TODO
        $fields = $this->getFields($form, $id);
        $upload_fields = array_where($fields, function ($value, $key) {
            return isset($value['upload']) && $value['upload'] == true;
        });

        return count($upload_fields) ? true : false;
        */

        return false;
    }
}
