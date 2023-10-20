<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function list() {
        return view('admin.parent.list',['page_title'=>'Parent List']);
    }
    public function addNewParent(Request $request) {
        
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
