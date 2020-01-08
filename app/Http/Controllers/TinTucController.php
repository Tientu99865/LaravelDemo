<?php

namespace App\Http\Controllers;

use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    //
    public function getDanhsach(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin/tintuc/danhsach',['tintuc'=>$tintuc]);
    }
    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin/tintuc/them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request){

    }
    public function getSua($id){

    }
    public function postSua(Request $request,$id){

    }

    public function getXoa($id){

    }
}
