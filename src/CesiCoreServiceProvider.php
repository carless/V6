<?php
namespace Cesi\Core;

use Cesi\Core\App\Console\CompileCesi;
use Cesi\Core\libs\Models\Nested\NestedSet;
use Cesi\Core\libs\Router\CesiRouter;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Route;

class CesiCoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Where the route file lives, both inside the package and in the app (if overwritten).
     *
     * @var string
     */
    public $routeFilePath = '/routes/cesi/core.php';

    /**
     * Where custom routes can be written, and will be registered by Cesi.
     *
     * @var string
     */
    public $customRoutesFilePath = '/routes/cesi/custom.php';

    /**
     * Perform post-registration booting of services.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $customViewsFolder = resource_path('views/vendor/cesi/core');

        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        if (file_exists(resource_path('views/vendor/cesi/core'))) {
            $this->loadViewsFrom($customViewsFolder, 'cesi');
        }
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'cesi');

        $this->loadTranslationsFrom(realpath(__DIR__.'/resources/lang'), 'cesi');

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/config/cesi/core.php', 'cesi.core'
        );

        // add the root disk to filesystem configuration
        app()->config['filesystems.disks.'.config('cesi.core.root_disk_name')] = [
            'driver' => 'local',
            'root'   => base_path(),
        ];

        // $this->addCustomAuthConfigurationValues();
        $this->registerMiddlewareGroup($this->app->router);
        $this->setupRoutes($this->app->router);
        // $this->setupCustomRoutes($this->app->router);
        $this->publishFiles();
    }


    /**
     * Load the Cesi helper methods, for convenience.
     */
    public function loadHelpers()
    {
        require_once __DIR__.'/helpers.php';
    }

    /**
     * El inicio de sesión CESI difiere del inicio de sesión estándar de Laravel.
     * Como tal, CESI utiliza su propio proveedor de autenticación, agente de contraseñas y guardia.
     *
     * Este método agrega esos valores de configuración además de lo que esté en config/auth.php.
     * Los desarrolladores pueden sobrescribir el proveedor de CESI, el agente de contraseñas o el
     * protector agregando un provider/broker/guard con el nombre de "cesi" dentro de su archivo config/auth.php.
     * O pueden usar otro provider/broker/guard por completo, cambiando el valor dorrespondiente dentro de config/cesi/core.php
     */
    public function addCustomAuthConfigurationValues()
    {
        // add the cesi_users authentication provider to the configuration
        app()->config['auth.providers'] = app()->config['auth.providers'] +
            [
                'cesi' => [
                    'driver'  => 'eloquent',
                    'model'   => config('cesi.core.user_model_fqn'),
                ],
            ];

        // add the cesi_users password broker to the configuration
        app()->config['auth.passwords'] = app()->config['auth.passwords'] +
            [
                'cesi' => [
                    'provider'  => 'cesi',
                    'table'     => 'password_resets',
                    'expire'    => 60,
                ],
            ];

        // add the cesi_users guard to the configuration
        app()->config['auth.guards'] = app()->config['auth.guards'] +
            [
                'cesi' => [
                    'driver'   => 'session',
                    'provider' => 'cesi',
                ],
            ];
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // by default, use the routes file provided in vendor
        $routeFilePathInUse = __DIR__.$this->routeFilePath;

        // but if there's a file with the same name in routes/cesi, use that one
        if (file_exists(base_path().$this->routeFilePath)) {
            $routeFilePathInUse = base_path().$this->routeFilePath;
        }

        $this->loadRoutesFrom($routeFilePathInUse);
    }

    /**
     * Load custom routes file.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupCustomRoutes(Router $router)
    {
        // if the custom routes file is published, register its routes
        if (file_exists(base_path().$this->customRoutesFilePath)) {
            $this->loadRoutesFrom(base_path().$this->customRoutesFilePath);
        }
    }

    public function registerMiddlewareGroup(Router $router)
    {
        $middleware_key = config('cesi.core.middleware_key');
        $middleware_class = config('cesi.core.middleware_class');

        if (!is_array($middleware_class)) {
            $router->pushMiddlewareToGroup($middleware_key, $middleware_class);

            return;
        }

        foreach ($middleware_class as $middleware_class) {
            $router->pushMiddlewareToGroup($middleware_key, $middleware_class);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        Blueprint::macro('nestedSet', function () {
            NestedSet::columns($this);
        });

        Blueprint::macro('dropNestedSet', function () {
            NestedSet::dropColumns($this);
        });

        // register the helper functions
        $this->loadHelpers();

        // register the artisan commands
        $this->commands([CompileCesi::class]);

        $loader = AliasLoader::getInstance();
        $loader->alias('CESI', \Cesi\Core\CesiCoreServiceProvider::class);
    }

    public static function registerRouter($name, $controller, array $options = [])
    {
        return new CesiRouter($name, $controller, $options);
    }

    public function publishFiles()
    {
        $cesi_base_views = [__DIR__.'/resources/views' => resource_path('views/vendor/cesi/core')];
        $cesi_public_assets = [__DIR__.'/public' => public_path('vendor/cesi')];
        $cesi_lang_files = [__DIR__.'/resources/lang' => resource_path('lang/vendor/cesi')];
        $cesi_config_files = [__DIR__.'/config' => config_path()];


        $cesi_custom_routes_file = [__DIR__.$this->customRoutesFilePath => base_path($this->customRoutesFilePath)];

        // establish the minimum amount of files that need to be published, for CesiBackpack to work;
        // there are the files that will be published by the install command
        /*$minimum = array_merge(
            $error_views,
            $backpack_public_assets,
            $backpack_config_files,
            $backpack_menu_contents_view,
            $backpack_custom_routes_file,
            $adminlte_assets,
            $gravatar_assets
        );
        */

        $this->publishes([__DIR__ . '/database/migrations/' => database_path('migrations')], 'migrations');
        $this->publishes([__DIR__ . '/database/seeds/' => database_path('seeds')], 'seeds');

        // register all possible publish commands and assign tags to each
        $this->publishes($cesi_config_files, 'config');
        $this->publishes($cesi_lang_files, 'lang');
        $this->publishes($cesi_base_views, 'views');
        // $this->publishes($error_views, 'errors');
        $this->publishes($cesi_public_assets, 'public');
        $this->publishes($cesi_custom_routes_file, 'custom_routes');
    }
}
