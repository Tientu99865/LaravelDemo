<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getDanhsach(){
        $user = User::all();
        return view('admin/user/danhsach',['user'=>$user]);
    }
    public function getThem(){
        return view('admin/user/them');
    }

    public function getXoa($id){
        $user = User::find($id);
        $comment = Comment::where('idUser',$id); //Tìm các comment của user
        $comment->delete(); //Xóa các comment của user
        $user->delete(); //Xóa user
        return redirect('admin/user/danhsach')->with('ThongBao','Xóa tài khoản thành công');
    }

    public function getdangnhapAdmin(){
        return view('admin/login');
    }
    public function postdangnhapAdmin(Request $request){
        $this->validate($request,
            [
                'email'=>'required',
                'password'=>'required|min:3|max:32'
            ],
            [
                'email.required'=>'Bạn chưa nhập email',
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Password không được nhỏ hơn 3 kí tự',
                'password.max'=>'Password không được lớn hơn 3 kí tự'
            ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('admin/theloai/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('ThongBao','Đăng nhập không thành công');
        }
    }
    public function getdangxuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
