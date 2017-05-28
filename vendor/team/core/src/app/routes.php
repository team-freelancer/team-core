<?php


Route::group(['prefix' => 'admin'], function(){
    Route::any('login', 'Auth\LoginController@index');
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('/', 'AdminController@index');

    Route::get('manager', 'Auth\ManagerController@index');
    Route::any('manager/create', 'Auth\ManagerController@create');
    Route::any('manager/update/{id}', 'Auth\ManagerController@create');
    Route::any('api/manager', 'Auth\ManagerController@fetchingAdmin');

    Route::get('menu', 'MenuController@index');
    Route::any('menu/create', 'MenuController@create');
    Route::any('menu/update/{id}', 'MenuController@create');

    Route::any('api/table', 'ApiController@getTable');
    Route::any('api/upload', 'ApiController@upload');
    Route::any('api/delete/file', 'ApiController@deleteFile');

    // Route::get('module', 'ModuleController@index');
    // Route::any('module/create', 'ModuleController@create');
    // Route::any('module/update/{id}', 'ModuleController@create');
    // Route::any('api/module', 'ApiController@fetchingModule');

    // Route::get('module/{path}', 'ModuleController@indexModule');
    // Route::any('module/{path}/create', 'ModuleController@createModule');
    // Route::any('module/{path}/update/{id}', 'ModuleController@createModule');
    // Route::any('api/module/{path}', 'ApiController@fetchingModuleItem');
});

Route::any('{slug}', function ($slug) {
    return redirect(url('thong-bao.html'))->with(['message' => 'Liên kết không tồn tại']);
})->where('slug', '([A-z\d-\/_.]+)?');