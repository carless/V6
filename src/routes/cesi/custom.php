<?php
/**
 * Created by PhpStorm.
 * User: Carless
 * Date: 11/11/2019
 * Time: 17:33
 */

Route::group([
    'prefix'     => config('cesi.core.route_prefix', 'admin'),
    'middleware' => ['web', config('cesi.core.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
}); // this should be the absolute last line of this file