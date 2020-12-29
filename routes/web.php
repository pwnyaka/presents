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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// роуты группы для создание просмотра, просмотра поздравления, подтверждения участия в поздравление
Route::group([
    'namespace' => 'Room',
], function() {
    Route::resource('room', 'RoomController')->middleware('auth')->middleware('room');// если у ресуоса будут неиспользуемые роуты, то нужно не забыть их закрыть, к примру destroy, врядли будем использовать
    Route::get('/rooms/{room}/invite', 'InviteController@invite')->name('invite');
    Route::get('/rooms/{room}/join', 'JoinController@index')->name('join');
    Route::get('/rooms/{room}/exit', 'ExitController@index')->name('exit');
});

Route::group([
    'namespace' => 'Social',
], function () {
    Route::get('login/vk', 'LoginVKController@redirectToProvider')->name('loginVK');
    Route::get('login/vk/callback', 'LoginVKController@handleProviderCallback');
});

Route::group([
    'namespace' => 'Catalog',
], function () {
    Route::get('/catalog', 'IndexController@index')->name('catalog');
});

Route::group([
    'namespace' => 'Person',
], function () {
    Route::get('/person-account', 'IndexController@index')->name('person-account');
});



