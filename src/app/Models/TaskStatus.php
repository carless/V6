<?php
namespace Cesi\Core\app\Models;

use Cesi\Core\CesiCrudTrait;
use Cesi\Core\libs\Models\CoreModel;
use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\libs\Models\Traits\UserStamps;

class TaskStatus extends CoreModel
{
    use FillableFields;
    use Userstamps;
    use CesiCrudTrait;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name',
        'classname',
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

        $this->setTable('core_taskstatus');
    }
}
