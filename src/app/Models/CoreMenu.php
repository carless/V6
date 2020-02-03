<?php
namespace Cesi\Core\app\Models;

use Cesi\Core\CesiCrudTrait;
use Cesi\Core\libs\Models\Nested\NodeTrait;
use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\libs\Models\Traits\UserStamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CoreMenu extends Model
{
    use NodeTrait;
    use FillableFields;
    use Userstamps;
    use CesiCrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'core_menu';

    protected $fillable = ['name', 'type', 'link', 'icon', 'parent_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable('core_menu');
    }

    public function parent()
    {
        return $this->belongsTo(CoreMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CoreMenu::class, 'parent_id')->orderBy('lft');;
    }

    public function hasChildren()
    {
        return count($this->children);
    }

    public function DspTreeName()
    {
        $html = "";
        $html .= '<span style="width:20px;display: inline-block;margin-right: 5px;"><i class="fas ' . $this->icon . '"></i></span>' ;
        $html .= str_repeat('<span class="gi">|&mdash;</span>', $this->level);
        $html .= '&nbsp;' . $this->name;
        return $html;
    }

    public function DspTreeNameRaw()
    {
        $html = "";
        $html .= str_repeat('|--', $this->level);
        $html .= ' ' . $this->name;
        return $html;
    }

    public function getUrl()
    {
        switch ($this->type) {
            case 'root':
                return '';
                break;

            case 'separator':
                return '#';
                break;

            case 'route':
                if (Route::has($this->link)) {
                    return route($this->link);
                } else {
                    return '#';
                }
                break;

            default:
                return '#';
                break;
        }
    }

    public function checkTieneAlgunPermiso()
    {
        if ($this->isRoot()) {
            return true;
        }
        $lreturn = false;

        $submenus = count($this->children);
        if ($submenus) {
            foreach ($this->children as $menu) {
                if ($menu->type == "route") {
                    if (Route::has($menu->link)) {
                        // Si tiene route ... miramos si existe ... sino lo creamos
                        // echo "findOrCreate Permission to " . $menu->link . "<br/>";

                        \Spatie\Permission\Models\Permission::findOrCreate($menu->link, 'web');
                        $lreturn = $lreturn || cesi_user()->hasPermissionTo($menu->link);
                        // $lreturn = true;
                    } else {
                        // echo "el " . $menu->link . " no existe";
                    }
                }
            }
        } else {
            // echo "findOrCreate Permission to " . $this->link . "<br/>";
            if (!empty($this->link)) {
                \Spatie\Permission\Models\Permission::findOrCreate($this->link, 'web');
                $lreturn = $lreturn || cesi_user()->hasPermissionTo($this->link);
            }
            // $lreturn = true;
        }
        return $lreturn;
    }

    public function DspMove()
    {
        $html = '';

        $routerAlias = 'admin.core.menu';
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
