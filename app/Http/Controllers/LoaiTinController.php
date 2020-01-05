<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;
use App\LoaiTin;
class LoaiTinController extends Controller
{
    //
    public function getDanhsach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
               'Ten'=>'required|unique:LoaiTin,Ten|min:2|max:100',
                'TheLoai'=>"required"
            ],
            [
                'Ten.required'=>"Bạn chưa nhập tên loại tin",
                'Ten.unique'=>"Tên loại tin đã tồn tại",
                'Ten.min'=>"Tên loại tin phải có độ dài từ 2 đến 100 ký tự",
                'Ten.max'=>"Tên loại tin phải có độ dài từ 2 đến 100 ký tự",
                'TheLoai.required'=>"Bạn chưa chọn thể loại",
            ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('ThongBao','Bạn đã thêm thành công');
    }
    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin/loaitin/sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,
            [
                'Ten'=>'required|unique:LoaiTin,Ten|min:2|max:100',
                'TheLoai'=>"required"
            ],
            [
                'Ten.required'=>"Bạn chưa nhập tên loại tin",
                'Ten.unique'=>"Tên loại tin đã tồn tại",
                'Ten.min'=>"Tên loại tin phải có độ dài từ 2 đến 100 ký tự",
                'Ten.max'=>"Tên loại tin phải có độ dài từ 2 đến 100 ký tự",
                'TheLoai.required'=>"Bạn chưa chọn thể loại",
            ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheloai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('ThongBao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('ThongBao','Bạn đã xóa thành công');
    }
}
