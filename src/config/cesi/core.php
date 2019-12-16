<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Look & feel customizations
    |--------------------------------------------------------------------------
    |
    | Make it yours.
    |
    */

    // Project name. Shown in the breadcrumbs and a few other places.
    'project_name' => 'Negocio',

    // Menu logos
    'logo_lg'   => '<b>Nego</b>cio',
    'logo_mini' => '<b>N</b>g',

    'skin' => 'skin-purple',

    // Content of the HTML meta robots tag to prevent indexing and link following
    'meta_robots_content' => 'noindex, nofollow',

    /*
    |--------------------------------------------------------------------------
    | Registration Open
    |--------------------------------------------------------------------------
    |
    | Choose whether new users/admins are allowed to register.
    | This will show up the Register button in the menu and allow access to the
    | Register functions in AuthController.
    |
    | By default the registration is open only on localhost.
    */

    'registration_open' => env('CESI_REGISTRATION_OPEN', env('APP_ENV') === 'local'),

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    // The prefix used in all base routes (the 'admin' in admin/dashboard)
    // You can make sure all your URLs use this prefix by using the cesi_url() helper instead of url()
    'route_prefix' => 'admin',

    // Set this to false if you would like to use your own AuthController and PasswordController
    // (you then need to setup your auth routes manually in your routes.php file)
    'setup_auth_routes' => true,

    // Set this to false if you would like to skip adding the dashboard routes
    // (you then need to overwrite the login route on your AuthController)
    'setup_dashboard_routes' => true,

    // Set this to false if you would like to skip adding "my account" routes
    // (you then need to manually define the routes in your web.php)
    'setup_my_account_routes' => true,

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    // Fully qualified namespace of the User model
    'user_model_fqn' => Cesi\Core\app\Models\CesiUser::class,

    // The classes for the middleware to check if the visitor is an admin
    // Can be a single class or an array of clases
    'middleware_class' => [
        App\Http\Middleware\CheckIfAdmin::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ],

    // Alias for that middleware
    'middleware_key' => 'admin',
    // Note: It's recommended to use the cesi_middleware() helper everywhere, which pulls this key for you.

    // Username column for authentication
    // The Cesi default is the same as the Laravel default (email)
    // If you need to switch to username, you also need to create that column in your db
    'authentication_column'      => 'email',
    'authentication_column_name' => 'Email',

    // The guard that protects the Cesi admin panel.
    // If null, the config.auth.defaults.guard value will be used.
    'guard' => 'web',

    // The password reset configuration for Cesi.
    // If null, the config.auth.defaults.passwords value will be used.
    'passwords' => 'cesi',

    // What kind of avatar will you like to show to the user?
    // Default: gravatar (automatically use the gravatar for his email)
    // Other options:
    // - placehold (generic image with his first letter)
    // - example_method_name (specify the method on the User model that returns the URL)
    'avatar_type' => 'gravatar',

    /*
    |--------------------------------------------------------------------------
    | File System
    |--------------------------------------------------------------------------
    */

    // Cesi\Core sets up its own filesystem disk, just like you would by
    // adding an entry to your config/filesystems.php. It points to the root
    // of your project and it's used throughout all Cesi packages.
    //
    // You can rename this disk here. Default: root
    'root_disk_name' => 'root',

    'crud' => [
        'default_page_length' => 25,
    ],

    'permissionmanager' => [
        'models' => [
            'user'       => Cesi\Core\app\Models\CesiUser::class,
            'permission' => Cesi\Core\app\Models\Permission::class,
            'role'       => Cesi\Core\app\Models\Role::class,
        ],
    ],
];
