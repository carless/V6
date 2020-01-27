<?php
namespace Cesi\Core\app\Models;

use Carbon\Carbon;
use Cesi\Core\app\App\Helpers\CesiCoreHelper;
use Cesi\Core\CesiCrudTrait;
use Cesi\Core\libs\Models\CoreModel;
use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\libs\Models\Traits\UserStamps;

class CoreTask extends CoreModel
{
    use FillableFields;
    use Userstamps;
    use CesiCrudTrait;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'status_id',
        'prioridad',
        'fecha_inicio',
        'fecha_final',
        'progreso',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'created_by' => 1,
    ];

    /**
     * The guarded field which are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @inheritdoc
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('core_taskmanager');
    }

    public static function boot() {
        parent::boot();
        self::saving(function($model) {

            if ($model->status_id == 2) {
                $model->progreso = 100;

                if (is_null($model->fecha_final) ) {
                    $model->fecha_final = Carbon::parse(Carbon::now())->format('Y-m-d');
                }
            }
        });
    }

    public function asignedUser()
    {
        return $this->belongsTo(CesiUser::class, 'user_id');
    }

    public function statusName()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function DspStatus() {

        $html = "";
        if (isset($this->status_id)) {
            $taskStatus = CesiCoreHelper::getTaskStatus($this->status_id);
            // CoreTaskStatus::find($this->status_id);
            if ($taskStatus) {
                $html .= "<span class='pull-left " . $taskStatus->classname . "'>" . $taskStatus->name . "</span>";
            }
        }

        return $html;
    }

    public function DspPrioridad() {
        $html = "";

        $a = CesiCoreHelper::getTaskPrioridad();
        if (isset($a[$this->prioridad])) {
            $html = $a[$this->prioridad];
        }
        return $html;
    }
}
