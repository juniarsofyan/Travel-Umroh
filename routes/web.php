<?php

use App\CardWork;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('home', function () {
    return redirect('/');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard.index');

    Route::resource('category', 'CategoryController')->except([
        'show'
    ]);

    Route::resource('component', 'ComponentController')->except([
        'show'
    ]);

    Route::resource('customer', 'CustomerController')->except([
        'show'
    ]);

    Route::resource('inventory', 'InventoryController')->except([
        'show'
    ]);

    Route::resource('material', 'MaterialController')->except([
        'show'
    ]);

    Route::resource('process', 'ProcessController')->except([
        'show'
    ]);

    Route::resource('user', 'UserController')->except([
        'show'
    ]);

    Route::resource('permission', 'PermissionController')->except([
        'show'
    ]);

    Route::resource('role', 'RoleController')->except([
        'show'
    ]);

    Route::resource('project', 'ProjectController')->except([
        'show'
    ]);

    /* Route::get('cardwork/{id}/detail', 'CardWorkController@detail')->name('cardwork.detail');
    Route::post('cardwork/{id}/detail', 'CardWorkController@storeDetail')->name('cardwork.storedetail');
    Route::delete('cardwork/{id}/detail/delete', 'CardWorkController@destroyDetail')->name('cardwork.destroydetail');
    Route::get('cardwork/{id}/detail/edit', 'CardWorkController@editDetail')->name('cardwork.editdetail');
    Route::put('cardwork/{id}/detail/update', 'CardWorkController@updateDetail')->name('cardwork.updatedetail'); */

    Route::resource('cardwork', 'CardWorkController')->except([
        'show'
    ]);

    Route::get('/cardworkdetail/{cardwork_id}', 'CardWorkDetailController@index')->name('cardworkdetail.index');
    Route::get('/cardworkdetail/{cardwork_id}/{id}/edit', 'CardWorkDetailController@edit')->name('cardworkdetail.edit');

    Route::resource('cardworkdetail', 'CardWorkDetailController')->except([
        'create', 'show', 'index', 'edit'
    ]);

    Route::resource('officer', 'OfficerController')->except([
        'show'
    ]);

    Route::prefix('reports')->group(function () {
        Route::get('/', 'ReportController@byCategory')->name('report.bycategory');
    });

    Route::resource('hotels', 'HotelController')->except([
        'show'
    ]);

    Route::resource('airlines', 'AirlineController')->except([
        'show'
    ]);

    Route::resource('rooms', 'RoomController')->except([
        'show'
    ]);

    Route::livewire('itinerary-templates/create', 'itinerary.create-itinerary-template');
    Route::resource('itinerary-templates', 'ItineraryTemplateController')->except([
        'create'
    ]);
});
