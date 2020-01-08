<?php

namespace App\Http\Controllers;

use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;
use Illuminate\Http\Request;
use Psy\Util\Str;

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
        $this->validate($request,
            [
                'TheLoai'=>'required',
                'LoaiTin'=>'required',
                'TieuDe'=>'required|min:2|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required',
            ],
            [
                'TheLoai.required'=>'Bạn chưa chọn thể loại',
                'LoaiTin.required'=>'Bạn chưa chọn loại tin',
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'TieuDe.unique'=>"Tiêu đề đã tồn tại",
                'TieuDe.min'=>"Tiêu đề phải có độ dài trên 2 ký tự",
                'TomTat.required'=>'Bạn chưa nhập tóm tắt',
                'NoiDung.required'=>'Bạn chưa nhập nội dung',
            ]);

        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;

        if ($request->has('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'gif'){
                return redirect('admin/tintuc/them')->with('Loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg,gif');
            }
            $name = $file->getClientOriginalName(); // ham lay ten hinh ra
            $Hinh = rand()."_".$name;
            while (file_exists('upload/tintuc/'.$Hinh)){
                $Hinh = rand()."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            $tintuc->Hinh = $Hinh;
        }
        else
        {
            $tintuc->Hinh = "";
        }

        $tintuc->save();

        return redirect('admin/tintuc/them')->with('ThongBao','Bạn đã thêm thành công');
    }
    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin/tintuc/sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postSua(Request $request,$id){
        $tintuc = TinTuc::find($id);
        $this->validate($request,
            [
                'TheLoai'=>'required',
                'LoaiTin'=>'required',
                'TieuDe'  => 'required|min:5|unique:TinTuc,TieuDe,'.$tintuc->id,
                'TomTat'=>'required',
                'NoiDung'=>'required',
            ],
            [
                'TheLoai.required'=>'Bạn chưa chọn thể loại',
                'LoaiTin.required'=>'Bạn chưa chọn loại tin',
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'TieuDe.unique'=>"Tiêu đề đã tồn tại",
                'TieuDe.min'=>"Tiêu đề phải có độ dài trên 2 ký tự",
                'TomTat.required'=>'Bạn chưa nhập tóm tắt',
                'NoiDung.required'=>'Bạn chưa nhập nội dung',
            ]);

        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;

        if ($request->has('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'gif'){
                return redirect('admin/tintuc/them')->with('Loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg,gif');
            }
            $name = $file->getClientOriginalName(); // ham lay ten hinh ra
            $Hinh = rand()."_".$name;
            while (file_exists('upload/tintuc/'.$Hinh)){
                $Hinh = rand()."_".$name;
            }

            $file->move('upload/tintuc',$Hinh);
            unlink('upload/tintuc/'.$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }

        $tintuc->save();

        return redirect('admin/tintuc/sua/'.$id)->with('ThongBao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('ThongBao','Bạn đã xóa thành công');
    }
}
