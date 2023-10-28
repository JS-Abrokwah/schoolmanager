<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Programme;
use Auth;

class ClassesController extends Controller
{
    public function list(){
        $classRecords=Classes::classList();
        $programmes =  Programme::allProgrammes();
        return view('admin.class.list', ['page_title'=>"Class List",'classRecords'=>$classRecords,"programmes"=>$programmes]);
    }
    public function addNewClass(Request $request){
        $request->validate([
            'name'=>'required',
            'status'=>'required',
            'programme'=>'required',
        ]);
        // dd($request->all());
        $class = new Classes();
        $school=Auth::user()->school;

        $class->name = $request->name;
        $class->created_by = $request->created_by;
        $class->status = $request->status;
        $class->programme()->associate($request->programme);
        $school->classes()->save($class);
        return redirect('admin/class/list')->with('success', "Class ($request->name) successfully added");
    }

    public function edit($id){
        // dd($id);
        $class=Classes::find($id);
        if(!empty($class)){
            return redirect()->back()->with(['class'=>$class]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function update(Request $request){
        $class=Classes::find($request->id);
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
        $class=Classes::find($id);
        if(!empty($class)){
            return redirect()->back()->with(['warnClass'=>$class]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
        
    } 
    
    public function destroy(Request $request){
        $class=Classes::find($request->id);
        if(!empty($class)){
            $class->is_deleted = true;
            $class->save();
            return redirect()->back()->with(['success'=>"Class ($class->name) successfully deleted"]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function classDetail($id) {
        $page_title = Classes::find($id)->name;
        $class_id = Classes::find($id)->id;
        $class = Classes::detail($id);
        $subjects = Subject::subjectsNotForClass($id);
            // dd($class);
        return view('admin.class.detail',compact('class'),['page_title'=>$page_title,'classId'=>$class_id, 'subjects'=>$subjects]);
    }

    public function attachSubject(Request $request){
        $class=Classes::find($request->class_id);
        // $subject=Subject::find($request->subject_id);
        if(!empty($request->subject_id)){
            $class->subjects()->attach($request->subject_id);
        }
        $page_title = $class->name;
        $class_id = $class->id;
        $subjects = Subject::subjectsNotForClass($class->id);
        $class = Classes::detail($class->id);
        return redirect("admin/class/view_class/$class_id")->with([compact('class'),'page_title'=>$page_title,'classId'=>$class_id, 'subjects'=>$subjects]);
    }

    public function detachSubject($class_id, $subject_id) {
        // dd($class_id, $subject_id);
        $class=Classes::find($class_id);
        $subject=Subject::find($subject_id);
        $class->subjects()->detach($subject->id);
        $page_title = $class->name;
        $class_id = $class->id;
        $subjects = Subject::subjectsNotForClass($class->id);
        $class = Classes::detail($class->id);
        return redirect("admin/class/view_class/$class_id")->with([compact('class'),'page_title'=>$page_title,'classId'=>$class_id, 'subjects'=>$subjects]);
    }
}
