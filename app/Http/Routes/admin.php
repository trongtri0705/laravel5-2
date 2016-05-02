<?php

Route::group([
    'prefix' => '/admin',
    'namespace' => 'Admin',
    'as' => 'admin::', // Group represent name
], function () {

    Route::get('login', 'SessionController@index')->name('getLogin');
    Route::post('login', 'SessionController@postLogin');
    Route::get('logout', 'SessionController@getLogout');

    /*
     * Admin Auth
     */
    Route::group([
        'middleware' => ['adminAuth','roles'],  
        'roles' => ['administrator', 'manager'],      
    ], function () {
        // Dashboard
        Route::get('/', 'DashboardController@index');
        Route::get('/settings', 'SettingsController@index')->name('settings');
        Route::post('/settings', 'SettingsController@store');

        // Admin routes module
        $adminRouteDir = __DIR__.'/Admin';
        $adminRoutes = scandir($adminRouteDir);
        foreach ($adminRoutes as $adminRoute):
            if ($adminRoute == '.' || $adminRoute == '..') {
                continue;
            }
            require sprintf($adminRouteDir.'/%s', $adminRoute);
        endforeach;

    });
});
