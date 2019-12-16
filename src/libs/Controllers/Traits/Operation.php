<?php
namespace Cesi\Core\libs\Controllers\Traits;

trait Operation
{
    /*
    |--------------------------------------------------------------------------
    |                               OPERATIONS
    |--------------------------------------------------------------------------
    | Ayuda a los desarrolladores a configurar y obtener la operación CRUD actual, según lo define
    | el método del controlador que se está ejecutando.
    */
    public $operation;

    /**
     * Optiene la operación CRUD actual que se realiza.
     *
     * @return string Operation being performed in string form.
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Establezca la operación CRUD que se realiza en forma de cadena.
     *
     * @param string $operation_name Ex: create / update / revision / delete
     */
    public function setOperation($operation_name)
    {
        $this->operation = $operation_name;
    }
}