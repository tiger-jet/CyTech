<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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
//ログイン前
Route::middleware(['guest']) ->group(function () {
// ログイン画面表示
Route::get('/','App\Http\Controllers\cytechController@showLogin') ->name('home');
//ログイン処理
Route::post('/login','App\Http\Controllers\cytechController@login') ->name('login');
// 新規登録画面
Route::get('/register','App\Http\Controllers\cytechController@showRegister') ->name('register');
//登録処理
Route::post('/exeRegister','App\Http\Controllers\cytechController@exeRegister') ->name('exeRegister');

});

//ログイン後
Route::middleware(['auth']) ->group(function () {
//ログアウト
Route::post('/logout','App\Http\Controllers\cytechController@logout') ->name('logout');
// 商品一覧画
Route::get('/product','App\Http\Controllers\cytechController@showProduct') ->name('product');
//検索実行
Route::post('/product','App\Http\Controllers\cytechController@search') ->name('search');
// 商品登録画面
Route::get('/product/create','App\Http\Controllers\cytechController@showCreate') ->name('create');
// 商品登録
Route::post('/product/store','App\Http\Controllers\cytechController@exeStore') ->name('store');
// 商品詳細画面
Route::get('/product/{id}','App\Http\Controllers\cytechController@showDetail') ->name('show');
//商品情報編集画面
Route::get('/product/edit/{id}','App\Http\Controllers\cytechController@showEdit') ->name('edit');
//商品情報更新処理
Route::post('/product/update','App\Http\Controllers\cytechController@exeUpdate') ->name('update');
//商品情報削除
Route::post('/product/delete/{id}','App\Http\Controllers\cytechController@exeDelete') ->name('delete');
});






