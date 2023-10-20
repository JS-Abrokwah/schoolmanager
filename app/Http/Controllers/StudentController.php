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
        return view('admin.student.list',['page_title'=>'Student List']);
    }
    public function addNewStudent(Request $request) {
        
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
