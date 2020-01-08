<?php
namespace Cesi\Core\app\Models;

use Cesi\Core\CesiCrudTrait;
use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\libs\Models\Traits\UserStamps;
use Illuminate\Database\Eloquent\Model;

class CoreDashboard extends Model
{
    use FillableFields;
    use Userstamps;
    use CesiCrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'core_dashboard';

    protected $fillable = ['name'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable('core_dashboard');
    }

    public function lineas()
    {
        return $this->hasMany( CoreDashboardItem::class, 'dashboard_id');
    }
}