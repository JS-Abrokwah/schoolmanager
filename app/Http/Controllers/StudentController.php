<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Mail\NewAccountMail;
use Mail;
use Auth;
use Hash;
use Str;

class StudentController extends Controller
{
    //
    public function list() {
        $students = Student::studentsList();
        // dd($students);
        return view('admin.student.list',['page_title'=>'Student List','studentsRecord'=>$students]);
    }
    public function addNewStudent(Request $request) {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'date_of_birth'=>'required | date',
            'email'=>'required | email | unique:users',
            'phone_no'=>'required | min:10 | max: 13',
            'sex'=>'required',
            'religion'=>'required',
            'address'=>'required',
            'admission_number'=>'required',
            'index_number'=>'required',
            'admission_date'=>'required | date',
            'roll_number'=>'required',
            'residence'=>'required',
            'house'=>'required',
            'last_school_attended'=>'required',
        ]);
        // dd($request->all());
        if ($this->isOnline()){
            $user = new User();
            $student = new Student();

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->user_type = 'Student';
            $user->password = Hash::make(Str::random(8));
            $user->phone_no = $request->phone_no;
            $user->sex = $request->sex;
            $user->religion = $request->religion;
            $user->address = $request->address;
            $user->remember_token = Str::random(30); 

            $student->date_of_birth = $request->date_of_birth;
            $student->admission_date = $request->admission_date;
            $student->admission_number = $request->admission_number;
            $student->index_number = $request->index_number;
            $student->roll_number = $request->roll_number;
            $student->residence = $request->residence;
            $student->house = $request->house;
            $student->last_school_attended  = $request->last_school_attended ;

            Auth::user()->school->users()->save($user);
            $user->student()->save($student);
            $student->admin()->associate(Auth::user()->admin->id);

            Mail::to($user->email)->send(new NewAccountMail($user));
            return redirect()->back()->with('success',"Student successfully added");
        } else{
            abort(408);
        }
    }
    public function edit($id) {
        
    }
    public function update(Request $request) {
        
    }
    public function warnDelete($id) {
        
    }
    public function destroy(Request $request) {
        
    }
    public function studentDetail($id) {
        $student = Student::findStudent($id);
        if(!empty($student)){
            dd($student);
        }else{
            abort(404);
        }
    }

     // Check whether user is online
     public function isOnline($site="https://youtube.com"){
        return (@fopen($site,"r"))?true:false;
    }
}
