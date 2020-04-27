<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get ('/', function(){
    return Auth::user()->level;
})->middleware('jwt.verify');
Route::post('register', 'karyawancontroller@register');
Route::post('login', 'karyawancontroller@login');
Route::get('karyawan', 'karyawancontroller@getAuthenticatedUser')->middleware('jwt.verify');

//detail
Route::post('/simpan_pelanggan','pelanggancontroller@store')->middleware('jwt.verify');
Route::put('/ubah_pelanggan/{id}','pelanggancontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_pelanggan/{id}','pelanggancontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_pelanggan','pelanggancontroller@tampil_pelanggan')->middleware('jwt.verify');
Route::get('pelanggan',"pelanggancontroller@index")->middleware('jwt.verify');

//cafe
Route::post('/simpan_cafe','cafecontroller@store')->middleware('jwt.verify');
Route::put('/ubah_cafe/{id}','cafecontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_cafe/{id}','cafecontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_cafe','cafecontroller@tampil_cafe')->middleware('jwt.verify');
Route::get('cafe',"cafecontroller@index")->middleware('jwt.verify');

//menu
Route::post('/simpan_menu','menucontroller@store')->middleware('jwt.verify');
Route::put('/ubah_menu/{id}','menucontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_menu/{id}','menucontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_menu','menucontroller@tampil_menu')->middleware('jwt.verify');
Route::get('menu',"menucontroller@index")->middleware('jwt.verify');

//transaksi
Route::post('/simpan_transaksi','transaksicontroller@store')->middleware('jwt.verify');
Route::put('/ubah_transaksi/{id}','transaksicontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_transaksi/{id}','transaksicontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_transaksi','transaksicontroller@tampil_transaksi')->middleware('jwt.verify');
Route::get('transaksi',"transaksicontroller@index")->middleware('jwt.verify');

//detail
Route::post('/simpan_detail','detailcontroller@store')->middleware('jwt.verify');
Route::put('/ubah_detail/{id}','detailcontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_detail/{id}','detailcontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_detail','detailcontroller@tampil_detail')->middleware('jwt.verify');
Route::get('detail',"detailcontroller@index")->middleware('jwt.verify');

