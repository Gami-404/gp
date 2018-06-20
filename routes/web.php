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

Route::get('/', 'HomeController@index')->name('root');


Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@register')->name('register');


Route::post('/cvs/upload', 'UploaderController@uploads')->name('cvs.upload');
Route::get('/cvs/upload', 'UploaderController@showForm')->name('cvs.upload');


// Searches
Route::get('/search', 'SearchController@searchForm')->name('search.form');
Route::any('/profile', 'HomeController@profile')->name('profile.edit');
Route::post('/search', 'SearchController@search')->name('search');

// CVs
Route::get('/history', 'CvsConrtoller@index')->name('cvs.history');
Route::get('/cvs/{id}/delete', 'CvsConrtoller@delete')->name('cvs.delete');


// Send e-mail
Route::post('/mail/contact', 'MailController@send')->name('mail.contact');


Route::get('/home', 'HomeController@home')->name('home');
