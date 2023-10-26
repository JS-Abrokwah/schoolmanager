<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function list() {
        return view('admin.teacher.list',['page_title'=>'Teacher List']);
    }
    public function addNewTeacher(Request $request) {
        
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
