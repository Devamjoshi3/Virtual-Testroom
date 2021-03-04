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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin','Admin@index');
Route::get('/admin/exam_category','Admin@exam_category');
Route::post('/admin/add_new_category','Admin@add_new_category');
Route::get('/admin/delete_category/{id}','Admin@delete_category');
Route::get('/admin/edit_category/{id}','Admin@edit_category');
Route::post('/admin/edit_new_category','Admin@edit_new_category');
Route::get('/admin/category_status/{id}','Admin@category_status');
