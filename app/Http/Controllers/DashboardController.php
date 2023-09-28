<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $data['page_title']="Dashboard";
        if(Auth::user()->user_type==="Admin"){
            return view('admin.dashboard',$data);
        }
        else if(Auth::user()->user_type==="Parent"){
            return view('parent.dashboard',$data);
        }
        else if(Auth::user()->user_type==="Teacher"){
            return view('teacher.dashboard',$data);
        }
        else if(Auth::user()->user_type==="Student"){
            return view('student.dashboard',$data);
        }
    }
}
