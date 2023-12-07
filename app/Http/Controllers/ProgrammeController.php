<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programme;
use Auth;

class ProgrammeController extends Controller
{
    public function list() {
        $programmes = Programme::programmeList();
        // dd($programmes);
        return view('admin.programme.list',['page_title'=>'Programme List','programmeRecord'=>$programmes]);
    }
    public function addNewProgramme(Request $request) {
        $request->validate([
            'name'=>'required',
            'certification'=>'required',
            'description'=>'required | max:120',
            'specialization'=>'required',
            'status'=>'required',
        ]);
    
        $programme = new Programme();
        $school = Auth::user()->school;
        $programme->name = $request->name;
        $programme->certification = $request->certification;
        $programme->description = $request->description;
        $programme->specialization = $request->specialization;
        $programme->status = $request->status;
        $programme->created_by = Auth::user()->id;

        $school->programmes()->save($programme);

        return redirect()->back()->with('success',"New Programme successfully created");
    }
    public function edit($id) {
        $programme = Programme::find($id);
        if(!empty($programme)){
            return redirect()->back()->with(['programme'=>$programme]);
        }else{
            abort(404);
        }
    }
    public function update(Request $request) {
        $programme = Programme::find($request->id);
        if(!empty($programme)){
            $programme->name = $request->name;
            $programme->certification = $request->certification;
            $programme->description = $request->description;
            $programme->specialization = $request->specialization;
            $programme->status = $request->status;
            $programme -> save();
            return redirect()->back()->with('success',"Programme successfully successfully");
        }else{
            abort(404);
        }
        
    }
    public function warnDelete($id) {
        $programme=Programme::find($id);
        if(!empty($programme)){
            return redirect()->back()->with(['warnProgramme'=>$programme]);
        }else{
            abort(404);
        }
        
    }
    public function destroy(Request $request) {
        $programme = Programme::find($request->id);
        if (!empty($programme)){
            $programme->delete();
            return redirect()->back()->with(['success'=>"($programme->name) successfully deleted"]);
        }else{
            abort(404);
        }
    }
}
