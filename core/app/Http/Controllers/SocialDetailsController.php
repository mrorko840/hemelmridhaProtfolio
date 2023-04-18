<?php

namespace App\Http\Controllers;

use App\Models\SocialDetails;
use Illuminate\Http\Request;

class SocialDetailsController extends Controller
{
    public function index()
    {
        $social = SocialDetails::latest()->get();
        return view('backend.social', compact('social'));
    }
    
    public function store(Request $request)
    {
        if($request->id == null){
            $social = new SocialDetails();
        }else{
            $social = SocialDetails::findOrFail($request->id);
        }

        $social->icon       = $request->icon;
        $social->name       = $request->name;
        $social->link       = $request->link;
        $social->save();

        if($request->id == null){
            return response()->json(['msg'=>'Social Details Added successfully!', 'cls'=>'success', 'data'=>$social]);
        }else{
            return response()->json(['msg'=>'Social Details Updated successfully!', 'cls'=>'success', 'data'=>$social]);
        }
    }
    
    public function destroy(Request $request){
        $social = SocialDetails::findOrFail($request->id);
        $social->delete();
        return response()->json(['msg'=>'Social Details Deleted successfully!', 'cls'=>'success', 'data'=>$social]);
    }
}
