<?php

namespace App\Http\Controllers;

use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    //

    public function getDanhsach(){
        $slide = Slide::all();
        return view('admin/slide/danhsach',['slide'=>$slide]);
    }
    public function getThem(){
        return view('admin/slide/them');
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten'=>'required|min:2|unique:Slide,Ten',
                'NoiDung'=>'required',
                'link'=>'required'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên slide',
                'Ten.unique'=>"Tên slide đã tồn tại",
                'Ten.min'=>"Tên slide phải có độ dài trên 2 ký tự",
                'NoiDung.required'=>'Bạn chưa nhập nội dung',
                'link.required'=>'Bạn chưa nhập đường dẫn cho slide'
            ]);

        $slide = new Slide();
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->link;

        if ($request->has('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'gif'){
                return redirect('admin/slide/them')->with('Loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg,gif');
            }
            $name = $file->getClientOriginalName(); // ham lay ten hinh ra
            $Hinh = time()."_".$name;
            while (file_exists('upload/slide/'.$Hinh)){
                $Hinh = time()."_".$name;
            }
            $file->move('upload/slide',$Hinh);
            $slide->Hinh = $Hinh;
        }
        else
        {
            $slide->Hinh = "";
        }

        $slide->save();

        return redirect('admin/slide/them')->with('ThongBao','Bạn đã thêm thành công');

    }
    public function getSua($id){
        $slide = Slide::find($id);
        return view('admin/slide/sua',['slide'=>$slide]);
    }

    public function postSua(Request $request,$id){
        $slide = Slide::find($id);
        $this->validate($request,
            [
                'Ten'=>'required|min:2|unique:Slide,Ten',
                'NoiDung'=>'required',
                'link'=>'required'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên slide',
                'Ten.unique'=>"Tên slide đã tồn tại",
                'Ten.min'=>"Tên slide phải có độ dài trên 2 ký tự",
                'NoiDung.required'=>'Bạn chưa nhập nội dung',
                'link.required'=>'Bạn chưa nhập đường dẫn cho slide',
            ]);

        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->link;

        if ($request->has('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'gif'){
                return redirect('admin/slide/sua/'.$id)->with('Loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg,gif');
            }
            $name = $file->getClientOriginalName(); // ham lay ten hinh ra
            $Hinh = time()."_".$name;
            while (file_exists('upload/slide/'.$Hinh)){
                $Hinh = time()."_".$name;
            }
            $file->move('upload/slide',$Hinh);
            unlink('upload/slide/'.$slide->Hinh);
            $slide->Hinh = $Hinh;
        }

        $slide->save();

        return redirect('admin/slide/sua/'.$id)->with('ThongBao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        $slide = Slide::find($id);
        $slide->delete();

        return redirect('admin/slide/danhsach')->with('ThongBao','Bạn đã xóa thành công');
    }
}
