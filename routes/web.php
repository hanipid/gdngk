<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

// Route::get('/users', 'UserController@index')
// Route::get('/users/create', 'UserController@create');
// Route::get('/users/{id}/edit', 'UserController@edit');
// Route::post('/users', 'UserController@store');
// Route::put('/users/{id}', 'UserController@update');
// Route::delete('/users/{id}', 'UserController@destroy');
Route::resource('users', 'UserController')->middleware('auth');

// Route::get('/commodities', 'CommodityController@index');
// Route::get('/commodities/create', 'CommodityController@create');
// Route::get('/commodities/{id}', 'CommodityController@show');
// Route::post('/commodities', 'CommodityController@store');
// Route::get('/commodities/{id}/edit', 'CommodityController@edit');
// Route::put('/commodities/{id}', 'CommodityController@update');
Route::resource('commodities', 'CommodityController')->middleware('auth');

Route::get('/commodities/{commodityId}/grades', 'CommodityGradeController@index')->middleware('auth');
Route::get('/commodities/{commodityId}/grades/create', 'CommodityGradeController@create')->middleware('auth');
Route::post('/commodities/{commodityId}/grades', 'CommodityGradeController@store')->middleware('auth');
Route::get('/commodities/{commodityId}/grades/{id}/edit', 'CommodityGradeController@edit')->middleware('auth');
Route::put('/commodities/{commodityId}/grades/{id}', 'CommodityGradeController@update')->middleware('auth');
Route::delete('/commodities/{commodityId}/grades/{id}', 'CommodityGradeController@destroy')->middleware('auth');
// Route::resource('commodities/grades', 'CommodityGradeController')->middleware('auth');

Route::get('/warehouses', 'WarehouseController@index')->middleware('auth');
Route::get('/warehouses/create', 'WarehouseController@create')->middleware('auth');
Route::post('/warehouses', 'WarehouseController@store')->middleware('auth');
Route::get('/warehouses/{id}/edit', 'WarehouseController@edit')->middleware('auth');
Route::put('/warehouses/{id}', 'WarehouseController@update')->middleware('auth');
Route::get('/warehouses/{id}', 'WarehouseController@show')->middleware('auth');
Route::delete('/warehouses/{id}', 'WarehouseController@destroy')->middleware('auth');
Route::get('/print/{id}', 'WarehouseController@print')->middleware('auth');

Route::get('/stocks', 'StockController@index')->middleware('auth');
Route::get('/stocks/create', 'StockController@create')->middleware('auth');
Route::post('/stocks', 'StockController@store')->middleware('auth');
Route::get('/stocks/{id}/edit', 'StockController@edit')->middleware('auth');
Route::put('/stocks/{id}', 'StockController@update')->middleware('auth');
Route::get('/stocks/{warehouseId}/{farmerId}', 'StockController@show')->middleware('auth');
Route::delete('/stocks/{id}', 'StockController@destroy')->middleware('auth');
Route::delete('/stocks/deletegrade/{id}', 'StockController@destroyGrade')->middleware('auth');

Route::get('/receipts', 'WarehouseReceiptController@index')->middleware('auth');
Route::get('/receipts/{farmer_id}/create', 'WarehouseReceiptController@create')->middleware('auth');
Route::post('/receipts', 'WarehouseReceiptController@store')->middleware('auth');