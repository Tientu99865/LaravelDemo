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

