<?php

use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;
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




/*Route::group(['middleware' => ['auth', 'role:RESIDENT']], function() { 
    Route::resource('resident', App\Http\Controllers\PostController::class);
});*/


//auth route for both 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    


});


// for RESIDENTS


///for SECURITY
Route::group(['middleware' => ['auth', 'role:SECURITY']], function() { 
    Route::post('/pinconfirmation', 'App\Http\Controllers\EgressController@pinConfirmation')->name('pinConfirmation');
    Route::get('/dashboard/{id}/edit', 'App\Http\Controllers\DashboardController@edit')->name('dashboard.edit');
    Route::get('/dashboard/store', 'App\Http\Controllers\DashboardController@store')->name('dashboard/store');
    Route::delete('/dashboard/{id}', 'App\Http\Controllers\DashboardController@destroy')->name('dashboard.destroy');
    Route::post('/dashboard/{id}', 'App\Http\Controllers\DashboardController@update')->name('dashboard.update');
    Route::get('/entry', 'App\Http\Controllers\EntryController@index')->name('entry');
    Route::get('/entry/store', 'App\Http\Controllers\EntryController@store')->name('entry/store');
    Route::get('/exit', 'App\Http\Controllers\EgressController@index')->name('exit');
    Route::get('/exit/store', 'App\Http\Controllers\EgressController@store')->name('exit/store');
    
    Route::resource('address', App\Http\Controllers\addressController::class);
    Route::resource('visitorType', App\Http\Controllers\VisitorTypeController::class);
    Route::resource('community', App\Http\Controllers\CommunityController::class);
    Route::resource('authorisationStatus', App\Http\Controllers\AuthorisationController::class);
    Route::resource('officialAddress', App\Http\Controllers\OfficialAddressController::class);
    
    
});

Route::group(['middleware' => ['auth', 'role:RESIDENT']], function() { 
    
    Route::get('/pinchange', 'App\Http\Controllers\ResidentDetailController@pinChange')->name('pinchange');
    Route::post('/pinchange', 'App\Http\Controllers\ResidentDetailController@pinUpdate')->name('pinchange.update');
    Route::get('/profile', 'App\Http\Controllers\ResidentDetailController@index')->name('profile');
    Route::post('/profile', 'App\Http\Controllers\ResidentDetailController@store')->name('profile.store');
    Route::get('/dashboard/{id}/edit', 'App\Http\Controllers\DashboardController@edit')->name('dashboard.edit');
    Route::post('/dashboard', 'App\Http\Controllers\DashboardController@store')->name('dashboard.store');
    Route::delete('/dashboard/{id}', 'App\Http\Controllers\DashboardController@destroy')->name('dashboard.destroy');
    Route::post('/dashboard/{id}', 'App\Http\Controllers\DashboardController@update')->name('dashboard.update');
    Route::resource('/residentDetails', App\Http\Controllers\ResidentDetailController::class);
    
});



require __DIR__.'/auth.php';