<?php
namespace Cesi\Core\app\Models;

use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\libs\Models\Traits\UserStamps;
use Illuminate\Database\Eloquent\Model;

class CoreSettings extends Model
{
    use FillableFields;
    use Userstamps;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'key',
        'description',
        'value',
        'field',
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

        $this->table = 'core_settings';
    }
}
