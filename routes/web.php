<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourierController;


require __DIR__.'/auth.php';


Route::get('/',
    'HomeController@show_home_page'
)->name('home');




Route::group(['prefix' => 'basket'], function(){
    Route::post('/add_item/{id}', 'BasketController@add_item')->name('add_to_basket');

    Route::group(['middleware' => 'basket_not_empty'], function (){

        Route::get('/', 'BasketController@index')->name('basket');
        Route::get('/order', 'OrdersController@create')->name('basket-order');

        Route::post('/delete_item/{id}', 'BasketController@remove_item')->name('remove_from_basket');
        Route::post('/order', 'OrdersController@store')->name('basket-confirm');
    });
});


Route::view('/delivery', 'delivery')->name('delivery');
Route::view('/contact', 'contact')->name('contact');
Route::view('/service', 'service')->name('service');
Route::view('/support', 'support')->name('support');
Route::view('/about', 'about')->name('about');
Route::view('/personal-data', 'personal-data')->name('personal-data');
Route::view('/terms', 'terms')->name('terms');

// Нужно 2 пути, для формы и для сохранения результата формы обратной связи
Route::get('/support-form',
    'ContactController@create'
)->name('support-form');

Route::post('/support-form-store',
    'ContactController@store'
)->name('support-form-store');

// ========== CATALOG ==========
Route::get('/catalog/{directory_alias}', 'CatalogController@index')->name('catalog-directory-alias');
Route::get('/catalog/{directory_alias}/{item_alias}', 'CatalogController@detail')->name('catalog-item');
Route::get('/catalog', 'CatalogController@index')->name('catalog');
Route::get('/stocks', 'CatalogController@show_stocks')->name('stocks');




// ========== ADMIN ==========
Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin'
    ], function(){
        //Route::get('orders', 'OrdersController@show_all_orders')->name('check-all-orders');


        Route::group(['middleware' => 'is_editor'], function(){
            Route::resource('orders', OrdersController::class)->except([
                'destroy'
            ]);

        });


        Route::resource('contacts', ContactController::class);

        Route::resource('items', Admin\ItemsController::class);
        Route::resource('directories', Admin\DirectoryController::class);
        Route::resource('couriers', Admin\CourierController::class);
        Route::resource('storages', Admin\StorageController::class);


        //----- comments
        Route::resource('items.comments', Comments_controller::class)->shallow(); //дока к этому: https://laravel.com/docs/8.x/controllers
});







// ===== testing and debug =====
Route::post('/test/submit', 'ZTest_controller@test_submit')->name('test_submit');
Route::view('/test', 'ztest')->name('test');
Route::view('/admin/info', 'admin.php_info');
