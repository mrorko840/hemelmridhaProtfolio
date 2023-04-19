<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = GeneralSetting::first();
        return view('backend.setting',compact('setting'));
    }
    
    public function update(Request $request)
    {
        // dd($request->all());
        $setting = GeneralSetting::first();
        if($request->image){
            $imageName = time().'.'.$request->image->extension();  
            $link = 'assets/img/logoicon/' . $setting->favicon;
            if($link && $setting->favicon){
                unlink($link);
            }
            $request->image->move('assets/img/logoicon/', $imageName);
            $setting->favicon     = $imageName;
        }
        
        $setting->site_name       = $request->site_name;
        $setting->save();
        return response()->json(['msg'=>'Data update successfully!', 'cls'=>'success', 'data'=>$setting]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneralSetting $generalSetting)
    {
        //
    }
}
