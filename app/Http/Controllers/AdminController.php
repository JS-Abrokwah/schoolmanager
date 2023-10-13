<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\NewAccountMail;
use Mail;
use Hash;
use Str;
use Auth;

class AdminController extends Controller
{
    public function list(){
        $adminsList=User::adminList();
        return view('admin.admin.list',['page_title'=>"Admin List",'adminsRecord'=>$adminsList]);
    }

    public function addNewAdmin(Request $request){
        // dd($request);
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users'
        ]);

        $foundUser=User::where('email','=',$request->email)->where('is_deleted','=',false)->first();
        if($this->isOnline()){
            $school = Auth::user()->school;
            $user =  new User;
            $user->first_name = trim($request->first_name);
            $user->last_name = trim($request->last_name);
            $user->email = trim($request->email);
            $user->user_type = "Admin";
            $user->password = Hash::make(Str::random(8));
            $user->remember_token = Str::random(30); 
            $school->users()->save($user);
            Mail::to($user->email)->send(new NewAccountMail($user));
            return redirect()->back()->with('success',"New Admin successfully created");
        }else{
            return redirect()->back()->with('error',"Oops! Couldn't add new Admin. Check your internet connection and try again");
        }
    }

    public function destroy(Request $request){
        $user=User::where('user_type','=','Admin')->where('id','!=',Auth::user()->id)->find($request->id);
        if(!empty($user)){
            $user->is_deleted=true;
            $user->email = 'deletedaccount';
            $user->save();
            return redirect()->back()->with(['success'=>"Admin ($user->first_name $user->last_name) successfully deleted"]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function warnDelete($id){
        $user=User::where('user_type','=','Admin')->where('id','!=',Auth::user()->id)->find($id);
        if(!empty($user)){
            return redirect()->back()->with(['warnAdmin'=>$user]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function edit($id){
        $user=User::where('user_type','=','Admin')->where('id','!=',Auth::user()->id)->find($id);
        if(!empty($user)){
            return redirect()->back()->with(['editAdmin'=>$user]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function update(Request $request){
        $user=User::where('user_type','=','Admin')->where('id','!=',Auth::user()->id)->find($request->id);
        if(!empty($user)){
            $user->id=$request->id;
            $user->first_name=$request->upfirst_name;
            $user->last_name=$request->uplast_name;
            $user->email=$request->upemail;
            $user->save();

            return redirect()->back()->with(['success'=>"Admin update successful"]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }
    // Check whether user is online
    public function isOnline($site="https://youtube.com"){
        return (@fopen($site,"r"))?true:false;
    }
}
