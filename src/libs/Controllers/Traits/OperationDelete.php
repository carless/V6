<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Cesi\Core\app\Http\Controllers\Exceptions\AccessDeniedException;
use Illuminate\Http\Request;

trait OperationDelete
{

    /**
     * @param $id
     * @return string
     * @throws AccessDeniedException
     */
    public function destroy($id)
    {
        $this->setOperation('delete');
        if ($this->tienePermiso('delete')) {
            // get entry ID from Request (makes sure its the last ID for nested resources)
            $id = $this->getCurrentEntryId() ?? $id;

            $record = $this->getModel()->findOrFail($id);

            if (!$this->checkDestroy($record)) {
                $this->getRedirectAfterDelete($record, false);
            }

            $success = $record->delete();

            return $this->getRedirectAfterDelete($record, $success);
        } else {
            throw new AccessDeniedException(trans('cesi::core.crud.unauthorized_access', ['access' => 'delete']));
        }
    }

    /**
     * Redirecciona a la vista ".list" despues de guardar los datos
     *
     * @param $record
     * @param bool $success
     * @param string $message
     *
     * @return \Illuminate\Http\Response
     */
    public function getRedirectAfterDelete($record, $success = true, $message = '')
    {
        $isModalForm = $this->getRequest()->input('_ismodal' , '0');

        if ($isModalForm == 1) {
            if (empty($message)) {
                if ($success) {
                    $message = trans('cesi::core.delete_data_success');
                } else {
                    $message = trans('cesi::core.delete_data_failed');
                }
            }

            return response()->json([
                    'success' => $success,
                    'message' => $message,
                ]);
        } else {
            return redirect()->route($this->getRouterAlias() . '.list');
        }
    }


    /**
     * @param $record
     * @return bool
     */
    public function checkDestroy($record)
    {
        return true;
    }
}
