<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Auth;

class StudentController extends Controller
{
    //
    public function list() {
        $students = User::studentsList();
        // dd($students);
        return view('admin.student.list',['page_title'=>'Student List','studentsRecord'=>$students]);
    }
    public function addNewStudent(Request $request) {
        dd($request->all());
    }
    public function edit($id) {
        
    }
    public function update(Request $request) {
        
    }
    public function warnDelete($id) {
        
    }
    public function destroy(Request $request) {
        
    }
}
