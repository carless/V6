<?php
namespace Cesi\Core\app\Models;

use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\libs\Models\Traits\UserStamps;
use Illuminate\Database\Eloquent\Model;

class CoreNotifications extends Model
{
    use FillableFields;
    use Userstamps;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'core_notifications';

    protected $fillable = ['message', 'user_id', 'tipo', 'is_read'];

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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable('core_notifications');
    }
}
