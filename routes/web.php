<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CourierController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\StorageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;

require __DIR__.'/auth.php';



// ========== ADMIN ==========
Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'middleware' => 'is_editor'
    ], function(){

        Route::resource('orders', OrderController::class)->except('destroy');
        Route::post('orders/{order}/paid',
            [OrderController::class, 'paid'])->name('order-paid');
        Route::post('orders/{order}/change-status',
            [OrderController::class, 'change_status'])->name('change-status');
        Route::post('orders/{order}/set-courier',
            [OrderController::class, 'set_courier'])->name('set-courier');

        Route::resource('contacts', ContactController::class)->only(['index', 'edit', 'update']);
        Route::resource('items', ItemController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('couriers', CourierController::class);
        Route::resource('storages', StorageController::class)->except('show');
        Route::resource('users', UserController::class)->only(['index', 'destroy']);
});




// ========== USERS ==========
Route::get('/',[CatalogController::class, 'index'])->name('index');
Route::group([
    'prefix' => 'personal',
    'middleware' => 'auth'
    ], function(){
        Route::resource('users', UserController::class)->except(['index', 'create', 'store', 'destroy']);
        Route::resource('orders', OrderController::class)->except(['create']);
        Route::get('my-orders', [OrderController::class, 'show_personal_orders'])->name('personal_orders');


});


// ========== BASKET ==========
Route::group(['prefix' => 'basket'], function(){
    Route::post('/add_item/{item}', [BasketController::class, "add_item"])->name('add_to_basket');

    Route::group(['middleware' => 'basket_not_empty'], function (){

        Route::get('/', [BasketController::class, "index"])->name('basket');
        Route::get('/order', [OrderController::class, "create"])->name('basket-order');
        Route::post('/order/{item}/delete_item', [BasketController::class, "remove_item"])->name('remove_from_basket');
        Route::post('/order', [OrderController::class, "store"])->name('basket-confirm');
    });
});



Route::resource('support', ContactController::class)->only('create', 'store');


// ========== CATALOG ==========
Route::get('/catalog', [CatalogController::class, "index"])->name('catalog');
Route::get('/catalog/{category_id}',
    [CatalogController::class, "index"])->name('catalog-category-alias');
Route::get('/catalog/{category_alias}/{item_alias}',
    [CatalogController::class, "show"])->name('catalog-item');
// Route::get('/stocks',  [CatalogController::class, "show_stocks"])->name('stocks');




// ========== INFO ==========
Route::view('/delivery', 'info.delivery')->name('delivery');
Route::view('/contact', 'info.contact')->name('contact');
Route::view('/service', 'info.service')->name('service');
Route::view('/support', 'info.support')->name('support');
Route::view('/about', 'info.about')->name('about');
Route::view('/personal-data', 'info.personal-data')->name('personal-data');
Route::view('/terms', 'info.terms')->name('terms');
// Route::view('/','index')->name('index');

// ===== testing and debug =====
Route::view('/admin/info', 'admin.php_info');
