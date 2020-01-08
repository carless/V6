<?php
namespace Cesi\Core\app\Models;

use Cesi\Core\CesiCrudTrait;
use Cesi\Core\libs\Models\Sortable\Sortable;
use Cesi\Core\libs\Models\Sortable\SortableTrait;
use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\libs\Models\Traits\UserStamps;
use Illuminate\Database\Eloquent\Model;

class CoreDashboardItem extends Model implements Sortable
{
    use FillableFields;
    use Userstamps;
    use CesiCrudTrait;
    use SortableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    public $sortable = [
        'order_column_name' => 'sorting',
        'sort_when_creating' => true,
    ];

    protected $table = 'core_dashboard_items';

    protected $fillable = [
        'name',
        'dashboard_id',
        'area',
        'tipo',
        'sorting',
        'config'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'created_by' => 1,
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable('core_dashboard_items');
    }

    /**
     * Always json_decode settings so they are usable
     */
    public function getConfigAttribute($value) {
        return json_decode($value);

        // you could always make sure you get an array returned also
        // return json_decode($value, true);
    }

    /**
     * Always json_encode the settings when saving to the database
     */
    public function setConfigAttribute($value) {
        $this->attributes['config'] = json_encode($value);
    }

    public function DspMove()
    {
        $html = '';

        $routerAlias = 'admin.core.dashboarditems';
        $html .= "<a href='" . route( $routerAlias.'.moveup', $this->getKey()) ."' >";
        $html .= "<span class='float-left'><i class='fas fa-arrow-alt-circle-up'></i></span>";
        $html .= "</a>";

        $html .= "&nbsp;";
        $html .= "<a href='" . route( $routerAlias.'.movedown', $this->getKey()) ."' >";
        $html .= "<span class='float-right'><i class='fas fa-arrow-alt-circle-down'></i></span>";
        $html .= "</a>";
        // $html .= "&nbsp;" . $this->lft . "&nbsp;" . $this->rgt;

        return $html;
    }
}