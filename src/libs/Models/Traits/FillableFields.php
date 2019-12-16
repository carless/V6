<?php
namespace Cesi\Core\libs\Models\Traits;

trait FillableFields
{
    /**
     * @return array
     */
    public static function getFillableFields()
    {
        return (new static())->getFillable();
    }

    /**
     * @return mixed
     */
    public function getRecordTitle()
    {
        return $this->id;
    }
}