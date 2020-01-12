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

//Login

Route::get('admin/dangnhap','UserController@getdangnhapAdmin');
Route::post('admin/dangnhap','UserController@postdangnhapAdmin');
Route::get('admin/logout','UserController@getdangxuatAdmin');

//Route group admin

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function (){
    //The Loai
   Route::group(['prefix'=>'theloai'],function (){

       Route::get('danhsach','TheLoaiController@getDanhsach');

       Route::get('sua/{id}','TheLoaiController@getSua');
       Route::post('sua/{id}','TheLoaiController@postSua');

       Route::get('them','TheLoaiController@getThem');
       Route::post('them','TheLoaiController@postThem');

       Route::get('xoa/{id}','TheLoaiController@getXoa');
   });
    //loai tin
    Route::group(['prefix'=>'loaitin'],function (){

        Route::get('danhsach','LoaiTinController@getDanhsach');

        Route::get('sua/{id}','LoaiTinController@getSua');
        Route::post('sua/{id}','LoaiTinController@postSua');

        Route::get('them','LoaiTinController@getThem');
        Route::post('them','LoaiTinController@postThem');

        Route::get('xoa/{id}','LoaiTinController@getXoa');
    });
    //Slide
    Route::group(['prefix'=>'slide'],function (){

        Route::get('danhsach','SlideController@getDanhsach');

        Route::get('sua/{id}','SlideController@getSua');
        Route::post('sua/{id}','SlideController@postSua');

        Route::get('them','SlideController@getThem');
        Route::post('them','SlideController@postThem');

        Route::get('xoa/{id}','SlideController@getXoa');

    });
//    TinTuc
    Route::group(['prefix'=>'tintuc'],function (){

        Route::get('danhsach','TinTucController@getDanhsach');

        Route::get('sua/{id}','TinTucController@getSua');
        Route::post('sua/{id}','TinTucController@postSua');

        Route::get('them','TinTucController@getThem');
        Route::post('them','TinTucController@postThem');

        Route::get('xoa/{id}','TinTucController@getXoa');
    });
    //Comment
    Route::group(['prefix'=>'comment'],function (){
        Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');
    });
    //User
    Route::group(['prefix'=>'user'],function (){

        Route::get('danhsach','UserController@getDanhsach');

        Route::get('xoa/{id}','UserController@getXoa');
    });
    // AJAX giua the loai va loai tin
    Route::group(['prefix'=>'ajax'],function (){
       Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });
});
