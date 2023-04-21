<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home_section = HomeSection::first();
        return view('backend.home',compact('home_section'));
    }
    
    public function update(Request $request)
    {
        // dd($request->profession);
        $home_section = HomeSection::first();
        if($request->image){
            $imageName = time().'.'.$request->image->extension();
            $link = 'assets/img/home_section/' . $home_section->bg_img;
            if(File::exists($link)){
                unlink($link);
            }
            $request->image->move('assets/img/home_section/', $imageName);
            $home_section->bg_img     = $imageName;
        }
        // $profession = json_decode($request->profession, true);
        
        $home_section->profession       = $request->profession;
        $home_section->save();
        return response()->json(['msg'=>'Data update successfully!', 'cls'=>'success', 'data'=>$home_section]);
    }
    
    public function destroy(HomeSection $homeSection)
    {
        //
    }
}
