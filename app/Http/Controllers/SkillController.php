<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skill = Skill::latest()->get();
        return view('backend.skills', compact('skill'));
    }
    
    
    public function store(Request $request)
    {
        if($request->id == null){
            $skill = new Skill();
        }else{
            $skill = Skill::findOrFail($request->id);
        }

        $skill->name        = $request->name;
        $skill->percentage  = $request->percentage;
        $skill->save();

        if($request->id == null){
            return response()->json(['msg'=>'Skill Added successfully!', 'cls'=>'success', 'data'=>$skill]);
        }else{
            return response()->json(['msg'=>'Skill Updated successfully!', 'cls'=>'success', 'data'=>$skill]);
        }
    }
    
    
    public function destroy(Request $request)
    {
        $skill = Skill::findOrFail($request->id);
        $skill->delete();
        return response()->json(['msg'=>'Skill Deleted successfully!', 'cls'=>'success', 'data'=>$skill]);

    }
}
