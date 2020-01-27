<?php

/*
|--------------------------------------------------------------------------
| Cesi\Core Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Cesi\Core package.
|
*/

Route::group(
    [
        'namespace'  => 'Cesi\Core\app\Http\Controllers',
        'middleware' => 'web',
        'prefix'     => config('cesi.core.route_prefix', 'admin'),
    ],
    function () {
        // if not otherwise configured, setup the auth routes
        if (config('cesi.core.setup_auth_routes')) {
            // Authentication Routes...
            Route::get('login', 'Auth\LoginController@showLoginForm')->name('cesi.auth.login');
            Route::post('login', 'Auth\LoginController@login');
            Route::get('logout', 'Auth\LoginController@logout')->name('cesi.auth.logout');
            Route::post('logout', 'Auth\LoginController@logout');

            // Registration Routes...
            Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('cesi.auth.register');
            Route::post('register', 'Auth\RegisterController@register');

            // Password Reset Routes...
            Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('cesi.auth.password.reset');
            Route::post('password/reset', 'Auth\ResetPasswordController@reset');
            Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('cesi.auth.password.reset.token');
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('cesi.auth.password.email');
        }

        // if not otherwise configured, setup the dashboard routes


        // if not otherwise configured, setup the "my account" routes
        /*
        if (config('cesi.core.setup_my_account_routes')) {
            Route::get('edit-account-info', 'Auth\MyAccountController@getAccountInfoForm')->name('cesi.account.info');
            Route::post('edit-account-info', 'Auth\MyAccountController@postAccountInfoForm');
            Route::get('change-password', 'Auth\MyAccountController@getChangePasswordForm')->name('cesi.account.password');
            Route::post('change-password', 'Auth\MyAccountController@postChangePasswordForm');
        }
        */
    });

Route::group([
    'namespace' => 'Cesi\Core\app\Http\Controllers',
    'prefix' => config('cesi.core.route_prefix', 'admin'),
    'as' => 'admin.',
    'middleware' => ['web', cesi_middleware()]
], function () {
    if (config('cesi.core.setup_dashboard_routes')) {
        Route::get('dashboard', 'AdminController@dashboard')->name('core.dashboard');
        Route::get('/', 'AdminController@redirect')->name('dashboard');
    }
});

Route::group([
    'namespace' => 'Cesi\Core\app\Http\Controllers\Admin',
    'prefix' => config('cesi.core.route_prefix', 'admin'),
    'as' => 'admin.core.',
    'middleware' => ['web', cesi_middleware()]
], function () {
    CESI::registerRouter('role', 'RoleCrudController');
    CESI::registerRouter('user', 'UserCrudController');
    CESI::registerRouter('permission', 'PermissionController');
    CESI::registerRouter('menu', 'CoreMenuController');
    Route::get('menu/moveup/{id}',
        [
            'as' => 'menu.moveup',
            'uses' => 'CoreMenuController@moveup'
        ]);

    Route::get('menu/movedown/{id}',
        [
            'as' => 'menu.movedown',
            'uses' => 'CoreMenuController@movedown'
        ]);

    CESI::registerRouter('coredashboard', 'CoreDashboardController');
    CESI::registerRouter('dashboarditems', 'CoreDashboardItemsController');

    Route::get('dashboarditems/moveup/{id}',
        [
            'as' => 'dashboarditems.moveup',
            'uses' => 'CoreDashboardItemsController@moveup'
        ]);

    Route::get('dashboarditems/movedown/{id}',
        [
            'as' => 'dashboarditems.movedown',
            'uses' => 'CoreDashboardItemsController@movedown'
        ]);

    CESI::registerRouter('taskstatus', 'TaskStatusController');
    CESI::registerRouter('task', 'CoreTaskController');
});

/*
Route::group([
    'namespace'  => 'Cesi\Core\app\Http\Controllers\Admin',
    'prefix'     => config('cesi.core.route_prefix', 'admin'),
    'middleware' => ['web', cesi_middleware()],
    ], function () {
        CESI::registerRouter('role', 'RoleCrudController');
        CESI::registerRouter('user', 'UserCrudController');
        CESI::registerRouter('permission', 'PermissionController');
        CESI::registerRouter('coremenu', 'CoreMenuController');
    });
*/
