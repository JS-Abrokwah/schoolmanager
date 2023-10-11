<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Models\School;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;

class AuthController extends Controller
{
    public function welcome(){
        if(!empty(Auth::check())){
            if(Auth::user()->user_type==="Admin"){
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type==="Parent"){
                return redirect('parent/dashboard');
            }
            else if(Auth::user()->user_type==="Teacher"){
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type==="Student"){
                return redirect('student/dashboard');
            }
        }
        return view('welcome',['page_title'=>'Welcome']);
    }

    public function newSchool(){
        if(!empty(Auth::check())){
            if(Auth::user()->user_type==="Admin"){
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type==="Parent"){
                return redirect('parent/dashboard');
            }
            else if(Auth::user()->user_type==="Teacher"){
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type==="Student"){
                return redirect('student/dashboard');
            }
        }
        return view('auth.new-school',['page_title'=>'New School']);

    }

    public function createSchool(Request $request){
        $request->validate([
            'name'=>'required | unique:schools',
            'waec_id'=>'required',
            'ownership'=>'required',
            'gender'=>'required',
            'town'=>'required',
            'district'=>'required',
            'region'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required | email | unique:users',
            'password'=>'required | min:6 | max:14'
        ]);

        if($request->terms !== "on"){
            return redirect()->back()->with('terms-warning',"$request->name is already registered");
        }

        $school = new School();
        $admin = new User();
        
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->user_type = $request->user_type;
        $admin->password = Hash::make($request->password);
        // $admin->save();


        $school->name=$request->name;
        $school->waec_id=$request->waec_id;
        $school->ownership=$request->ownership;
        $school->gender=$request->gender;
        $school->town=$request->town;
        $school->district=$request->district;
        $school->region=$request->region;
        $school->save();
        $school->users()->save($admin);

        return redirect('login')->with('success','Registration successful. Login to continue.');
    }

    public function login(){
        if(!empty(Auth::check())){
            if(Auth::user()->user_type==="Admin"){
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type==="Parent"){
                return redirect('parent/dashboard');
            }
            else if(Auth::user()->user_type==="Teacher"){
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type==="Student"){
                return redirect('student/dashboard');
            }
        }
        return view('auth.login',['page_title'=>"Login"]);
    }

    public function authLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $remember=!empty($request->remember)?true:false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            if(Auth::user()->user_type==="Admin"){
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type==="Parent"){
                return redirect('parent/dashboard');
            }
            else if(Auth::user()->user_type==="Teacher"){
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type==="Student"){
                return redirect('student/dashboard');
            }
        }else{
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }
    }

    public function forgotPassword(){
        Auth::logout();
        return view('auth.forgot',['page_title'=>"Forgot Password"]);
    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email'=>'required|email',
        ]);
        $user = User::getEmailSingle($request->email);
        if (!empty($user) && $this->isOnline()) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success',"Password Reset Link sent to {$user->email}. Kindly check and reset your password");
        } else {
            return ($this->isOnline())? redirect()->back()->with('error',"Email not found in the system!"):redirect()->back()->with('error',"Oops! Couldn't send reset link. Check your internet connection and try again");
        }  
    }

    public function resetPassword($remember_token){
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)){
            return view('auth.reset',['page_title'=>"Reset Password",'user'=>$user]);
        }else{
            abort('404');
        }
    }

    public function resetUserPassword($remember_token, Request $request){
        $request->validate([
            'new_password'=>'required',
            'confirm_password'=>'required'
        ]);
        if($request->new_password === $request->confirm_password){
           $user = User::getTokenSingle($remember_token);
           $user->password = Hash::make($request->new_password);
           $user->remember_token = Str::random(30);
           $user->save();
           return redirect('login')->with('success','Password successfully reset'); 
        }else{
            return redirect()->back()->with('not_match', 'Password does not match');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }

    // Check for internet connectivity
    public function isOnline($site="https://youtube.com"){
        return (@fopen($site,"r"))?true:false;
    }

}
