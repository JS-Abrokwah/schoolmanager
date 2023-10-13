<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::user()->user_type==="Admin"){
            return view('admin.dashboard',['page_title'=>'Dashboard']);
        }
        else if(Auth::user()->user_type==="Parent"){
            return view('parent.dashboard',['page_title'=>'Dashboard']);
        }
        else if(Auth::user()->user_type==="Teacher"){
            return view('teacher.dashboard',['page_title'=>'Dashboard']);
        }
        else if(Auth::user()->user_type==="Student"){
            return view('student.dashboard',['page_title'=>'Dashboard']);
        }
    }
}
