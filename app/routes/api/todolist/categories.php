<?php

Route::namespace('TodoList\Categories')
    ->prefix('/users/{user_id}/categories')
    ->name('users.categories.')
    ->group(function () {
        Route::get('/', 'GetCategoriesController')->name('get.many');
        Route::post('/', 'CreateCategoryController')->name('create');
        Route::get('/{category_id}', 'GetCategoryController')->name('get.one');
        Route::put('/{category_id}', 'UpdateCategoryController')->name('update');
        Route::delete('/{category_id}', 'DeleteCategoryController')->name('delete');
    });
