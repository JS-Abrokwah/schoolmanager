<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Mail\NewAccountMail;
use Mail;
use Hash;
use Str;
use Auth;

class AdminController extends Controller
{
    public function list(){
        $adminsList=Admin::adminList();
        return view('admin.admin.list',['page_title'=>"Admin List",'adminsRecord'=>$adminsList]);
    }

    public function addNewAdmin(Request $request){
        // dd($request);
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'phone_no'=>'required | min:10 | max:13',
            'sex'=>'required',
            'staff_id'=>'required',
            'position'=>'required',
        ]);

        if($this->isOnline()){
            $school = Auth::user()->school;
            $user =  new User;
            $admin = new Admin();

            $user->first_name = trim($request->first_name);
            $user->last_name = trim($request->last_name);
            $user->email = trim($request->email);
            $user->user_type = "Admin";
            $user->password = Hash::make(Str::random(8));
            $user->phone_no = trim($request->phone_no);
            $user->sex = trim($request->sex);
            $user->remember_token = Str::random(30); 
            $school->users()->save($user);

            $admin->staff_id = $request->staff_id;
            $admin->position = $request->position;

            $user->admin()->save($admin);
            
            Mail::to($user->email)->send(new NewAccountMail($user));
            return redirect()->back()->with('success',"New Admin successfully created");
        }else{
            abort(408);
        }
    }

    public function destroy(Request $request){
        $user=User::where('user_type','=','Admin')->where('id','!=',Auth::user()->id)->find($request->id);
        if(!empty($user)){
            $user->delete();
            return redirect()->back()->with(['success'=>"Admin ($user->first_name $user->last_name) successfully deleted"]);
        }else{
            abort(404);
        }
    }

    public function warnDelete($id){
        $user=User::where('user_type','=','Admin')->where('id','!=',Auth::user()->id)->find($id);
        if(!empty($user)){
            return redirect()->back()->with(['warnAdmin'=>$user]);
        }else{
            abort(404);
        }
    }

    public function edit($id){
        $user=User::where('user_type','=','Admin')->where('id','!=',Auth::user()->id)->find($id);
        if(!empty($user)){
            return redirect()->back()->with(['editAdmin'=>$user]);
        }else{
            abort(404);
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
            abort(404);
        }
    }
    // Check whether user is online
    public function isOnline($site="https://youtube.com"){
        return (@fopen($site,"r"))?true:false;
    }
}
