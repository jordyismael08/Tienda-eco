<?php
Route::prefix('/admin')->group(function(){
    Route::get('/','Admin\DashboardController@getDashboard')->name('dashboard');

    //Modulo de Usuarios
    Route::get ('/usuarios/{estado}','Admin\UserController@getUsers')->name('user_list');
    Route::get ('/usuario/{id}/editar','Admin\UserController@getUserEdit')->name('user_edit');
    Route::post ('/usuario/{id}/editar','Admin\UserController@postUserEdit')->name('user_edit');
    Route::get ('/usuario/{id}/banned','Admin\UserController@getUserBanned')->name('user_banned');
    Route::get ('/usuario/{id}/permisos','Admin\UserController@getUserPermissions')->name('user_permisos');
    Route::post ('/usuario/{id}/permisos','Admin\UserController@postUserPermissions')->name('user_permisos');

    // Modulo De Producto
    Route::get('/productos/{estado}','Admin\ProductController@getHome')->name('productos');
    Route::get('/producto/add','Admin\ProductController@getProductAdd')->name('producto_add');
    Route::get('/producto/{id}/editar','Admin\ProductController@getProductEdit')->name('producto_editar');
    Route::get('/producto/{id}/eliminar','Admin\ProductController@getProductDelete')->name('producto_eliminar');
    Route::get('/producto/{id}/restaurar','Admin\ProductController@getProductRestore')->name('producto_eliminar');
    Route::post('/producto/add','Admin\ProductController@postProductAdd')->name('producto_add');
    Route::post('/producto/buscar','Admin\ProductController@postProductSearch')->name('buscar_producto');
    Route::post('/producto/{id}/editar','Admin\ProductController@postProductEdit')->name('producto_editar');
    Route::post('/producto/{id}/galeria/add','Admin\ProductController@postProductGalleryAdd')->name('producto_galeria_add');
    Route::get('/producto/{id}/galeria/{gid}/eliminar','Admin\ProductController@getProductGalleryDelete')->name('producto_galeria_eliminar');

    // Categorias
    Route::get('/categorias/{modulo}','admin\CategoriesController@getHome')->name('categorias');
    Route::post('/categoria/add','Admin\CategoriesController@postCategoryAdd')->name('categoria_add');
    Route::get('/categoria/{id}/editar','Admin\CategoriesController@getCategoryEdit')->name('categoria_editar');
    Route::post('/categoria/{id}/editar','Admin\CategoriesController@postCategoryEdit')->name('categoria_editar');
    Route::get('/categoria/{id}/eliminar','Admin\CategoriesController@getCategoryDelete')->name('categoria_eliminar');
});
