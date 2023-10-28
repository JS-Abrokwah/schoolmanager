<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function list(){
        $subjectRecords = Subject::subjectList();
        return view('admin.subject.list',['page_title'=>'Subject', 'subjectRecords' => $subjectRecords]);
    }

    public function addNewSubject(Request $request){
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'status'=>'required',
            'category'=>'required',
        ]);
        // dd($request->all());
        Subject::create($request->all());
        return redirect('admin/subject/list')->with('success', "($request->name) successfully added");
    }

    public function edit($id){
        $subject=Subject::find($id);
        if(!empty($subject)){
            return redirect()->back()->with(['subject'=>$subject]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function update(Request $request){
        $subject=Subject::find($request->id);
        if(!empty($subject)){
            $subject->name = $request->name;
            $subject->type = $request->type;
            $subject->status = $request->status;
            $subject->save();
            return redirect()->back()->with(['success'=>"Subject update successful"]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function warnDelete($id){
        $subject=Subject::find($id);
        if(!empty($subject)){
            return redirect()->back()->with(['warnSubject'=>$subject]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function destroy(Request $request){
        $subject=Subject::find($request->id);

        if(!empty($subject)){
            $subject->delete();
            return redirect()->back()->with(['success'=>"($subject->name) successfully deleted"]);
        }else{
            return redirect()->back()->with(['error'=>"404! Resource Not Found"]);
        }
    }

    public function subjectDetail($id) {
        dd($id);
    }
    
}
