<?php
namespace Cesi\Core\app\Models;

use Cesi\Core\CesiCrudTrait;
use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\libs\Models\Traits\UserStamps;
use Illuminate\Database\Eloquent\Model;

class CoreEmailTmpl extends Model
{
    use FillableFields;
    use Userstamps;
    use CesiCrudTrait;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name',
        'slug',
        'theme',
        'subject',
        'content',
        'from_name',
        'from_email',
        'cc_email'
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

        $this->table = 'core_email_tmpl';
    }
}
