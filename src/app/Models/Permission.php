<?php
namespace Cesi\Core\app\Models;

use Cesi\Core\CesiCrudTrait;
use Spatie\Permission\Models\Permission as OriginalPermission;

class Permission extends OriginalPermission
{
    use CesiCrudTrait;

    protected $fillable = ['name', 'guard_name', 'updated_at', 'created_at'];
}
