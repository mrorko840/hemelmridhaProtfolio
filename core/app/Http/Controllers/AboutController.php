<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        return view('backend.about',compact('about'));
    }
    
    public function update(Request $request)
    {
        $about = About::where('id', 1)->first();
        if($request->image){
            $imageName = time().'.'.$request->image->extension();  
            $link = 'assets/img/profile/' . $about->image;
            if(File::exists($link)){
                unlink($link);
            }
            $request->image->move('assets/img/profile/', $imageName);
            $about->image     = $imageName;
        }
        
        $about->title          = $request->title;
        $about->name          = $request->name;
        $about->email         = $request->email;
        $about->phone         = $request->phone;
        $about->address       = $request->address;
        $about->education     = $request->education;
        $about->dob           = $request->dob;
        $about->website       = $request->website;
        $about->details       = $request->details;
        $about->save();
        return response()->json(['msg'=>'Data update successfully!', 'cls'=>'success', 'data'=>$about]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        //
    }
}
