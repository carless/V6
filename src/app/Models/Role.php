<?php

namespace Cesi\Core\app\Models;

use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\CesiCrudTrait;
use Spatie\Permission\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    use CesiCrudTrait;

    // protected $fillable = ['name', 'guard_name', 'updated_at', 'created_at'];
    use FillableFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'guard_name',
    ];

    protected $attributes = [
        'guard_name' => 'web',
    ];

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');

        parent::__construct($attributes);

        $this->setTable(config('permission.table_names.roles'));
    }
}
