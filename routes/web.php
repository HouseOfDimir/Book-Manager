<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'users'], function(){
    Route::get('/view', 'usersController@execute')->name('users.index');
    Route::post('/inscription', 'usersController@createUser')->name('users.createUser');
    Route::get('/delete/{fkUser}', 'usersController@deleteUser')->name('users.deleteUser');
    Route::post('/modify', 'usersController@toModifyUser')->name('users.toModifyUser');
    Route::post('/edit', 'usersController@editUser')->name('users.editUser');
});

Route::group(['prefix' => 'books'], function(){
    Route::get('/view', 'booksController@execute')->name('books.index');
    Route::post('/inscription', 'booksController@createBook')->name('books.createBook');
    Route::get('/delete/{fkBook}', 'booksController@deleteBook')->name('books.deleteBook');
    Route::post('/modify', 'booksController@toModifyBook')->name('books.toModifyBook');
    Route::post('/edit', 'booksController@editBook')->name('books.editBook');
});

Route::group(['prefix' => 'jeux'], function(){
    Route::get('/view', 'jeuxController@execute')->name('jeux.index');
    Route::post('/inscription', 'jeuxController@createJeu')->name('jeux.createJeu');
    Route::get('/delete/{fkJeu}', 'jeuxController@deleteJeu')->name('jeux.deleteJeu');
    Route::post('/modify', 'jeuxController@toModifyJeu')->name('jeux.toModifyJeu');
    Route::post('/edit', 'jeuxController@editJeu')->name('jeux.editJeu');
});

Route::group(['prefix' => 'ajax'], function(){
    Route::post('/getJeu', 'ajaxController@getJeu')->name('ajax.getJeu');
    Route::post('/getUser', 'ajaxController@getUser')->name('ajax.getUser');
    Route::post('/getBook', 'ajaxController@getBook')->name('ajax.getLivre');
});

Route::group(['prefix' => 'reservJeu'], function(){
    Route::get('/view', 'reservJeuController@execute')->name('reservJeu.index');
    Route::post('/inscription', 'reservJeuController@createReservJeu')->name('reservJeu.createReservJeu');
    Route::get('/delete/{fkReservJeu}', 'reservJeuController@deleteReservJeu')->name('reservJeu.deleteReservJeu');
    Route::get('/modify/{fkReservJeu}', 'reservJeuController@editReservJeu')->name('reservJeu.toModifyReservJeu');
});

Route::group(['prefix' => 'reservBook'], function(){
    Route::get('/view', 'reservBookController@execute')->name('reservBook.index');
    Route::post('/inscription', 'reservBookController@createReservBook')->name('reservBook.createReservBook');
    Route::get('/delete/{fkReservBook}', 'reservBookController@deleteReservBook')->name('reservBook.deleteReservBook');
    Route::get('/modify/{fkReservBook}', 'reservBookController@editReservBook')->name('reservBook.toModifyReservBook');
});
