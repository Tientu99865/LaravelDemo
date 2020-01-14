<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
class PageController extends Controller
{
    //

    function __construct()
    {
        $theloai = TheLoai::all();
        view()->share('theloai',$theloai);
    }

    function trangchu(){
        return view('pages/trangchu');
    }

    function lienhe(){
        return view('pages/lienhe');
    }
}
