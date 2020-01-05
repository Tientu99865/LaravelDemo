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
use App\TheLoai;

Route::get('/', function () {
    return view('welcome');
});
//test lien ket
Route::get('test_lienket',function (){
    $TheLoai = TheLoai::find(1);
    foreach ($TheLoai->loaitin as $LoaiTin){
        echo $LoaiTin->Ten."<br>";
    }
});
//test giao dien
Route::get('test_giaodien',function (){
    return view('admin.theloai.danhsach');
});

//Route group admin

Route::group(['prefix'=>'admin'],function (){
   Route::group(['prefix'=>'theloai'],function (){

       Route::get('danhsach','TheLoaiController@getDanhsach');

       Route::get('sua','TheLoaiController@getSua');

       Route::get('them','TheLoaiController@getThem');
   });

    Route::group(['prefix'=>'loaitin'],function (){

        Route::get('danhsach','LoaiTinController@getDanhsach');

        Route::get('sua','LoaiTinController@getSua');

        Route::get('them','LoaiTinController@getThem');
    });

    Route::group(['prefix'=>'slide'],function (){

        Route::get('danhsach','SlideController@getDanhsach');

        Route::get('sua','SlideController@getSua');

        Route::get('them','SlideController@getThem');
    });

    Route::group(['prefix'=>'tintuc'],function (){

        Route::get('danhsach','TinTucController@getDanhsach');

        Route::get('sua','TinTucController@getSua');

        Route::get('them','TinTucController@getThem');
    });

    Route::group(['prefix'=>'user'],function (){

        Route::get('danhsach','UserController@getDanhsach');

        Route::get('sua','UserController@getSua');

        Route::get('them','UserController@getThem');
    });
});
