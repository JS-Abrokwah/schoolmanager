<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use Auth;

class SchoolClassController extends Controller
{
    public function list(){
        $classRecords=SchoolClass::classList();
        return view('admin.class.list', ['page_title'=>"Class List",'classRecords'=>$classRecords]);
    }
    public function addNewClass(Request $request){
        $request->validate([
            'name'=>'required',
            'status'=>'required',
        ]);
        SchoolClass::create($request->all());
        return redirect('admin/class/list')->with('success', "Class ($request->name) successfully added");
    }

    public function edit($id){
        // dd($id);
        $class=SchoolClass::find($id);
        if(!empty($class)){
            return redirect()->back()->with(['class'=>$class]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function update(Request $request){
        $class=SchoolClass::find($request->id);
        if(!empty($class)){
            $class->name = $request->name;
            $class->status = $request->status;
            $class->save();
            return redirect()->back()->with(['success'=>"Class update successful"]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    } 
    
    public function warnDelete($id){
        $class=SchoolClass::find($id);
        if(!empty($class)){
            return redirect()->back()->with(['warnClass'=>$class]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
        
    } 
    
    public function destroy(Request $request){
        $class=SchoolClass::find($request->id);
        if(!empty($class)){
            $class->is_deleted = true;
            $class->save();
            return redirect()->back()->with(['success'=>"Class ($class->name) successfully deleted"]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }
}
