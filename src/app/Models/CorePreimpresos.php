<?php
namespace Cesi\Core\app\Models;

use Cesi\Core\app\App\Helpers\CesiCoreHelper;
use Cesi\Core\CesiCrudTrait;
use Cesi\Core\libs\Models\Sluggable\HasSlug;
use Cesi\Core\libs\Models\Sluggable\SlugOptions;
use Cesi\Core\libs\Models\Traits\FillableFields;
use Cesi\Core\libs\Models\Traits\UserStamps;
use Illuminate\Database\Eloquent\Model;

class CorePreimpresos extends Model
{
    use FillableFields;
    use Userstamps;
    use CesiCrudTrait;
    use HasSlug;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name',
        'slug',
        'archivo',
        'tipo',
        'papel',
        'orientacion',
        'margenCab',
        'margenPie',
        'margenIzq',
        'margenDer',
        'mostrarCab',
        'mostrarLogo',
        'mostrarTitulo',
        'mostrarSubtitulo',
        'mostrarPie',
        'tituloPosX',
        'tituloPosY',
        'logoPosX',
        'logoPosY',
        'pieSeparador',
        'pieFecha',
        'pieHora',
        'pieNumPag',
        'pieNumParte',
        'observaciones',
        'activo',
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

        $this->table = 'core_preimpresos';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function DspTipo() {
        $html = "";

        $a = CesiCoreHelper::getTiposPreImpresos();
        if (isset($a[$this->tipo])) {
            $html = $a[$this->tipo];
        }
        return $html;
    }
}
