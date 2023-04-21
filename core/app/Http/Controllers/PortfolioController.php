<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::latest()->get();
        return view('backend.portfolio', compact('portfolio'));
    }
    

    public function store(Request $request)
    {
        if($request->id == null){
            $portfolio = new Portfolio();
        }else{
            $portfolio = Portfolio::findOrFail($request->id);
        }

        //++image upload++//
        if($request->image){
            $imageName = time().'.'.$request->image->extension();  
            $link = 'assets/img/portfolio/' . $portfolio->image;
            if(File::exists($link)){
                unlink($link);
            }
            $request->image->move('assets/img/portfolio/', $imageName);
            $portfolio->image   = $imageName;
        }

        $portfolio->title       = $request->title;
        $portfolio->link        = $request->link;
        $portfolio->type        = $request->type;
        $portfolio->save();

        if($request->id == null){
            return response()->json(['msg'=>'Portfolio Added successfully!', 'cls'=>'success', 'data'=>$portfolio]);
        }else{
            return response()->json(['msg'=>'Portfolio Updated successfully!', 'cls'=>'success', 'data'=>$portfolio]);
        }
    }

    
    public function destroy(Request $request)
    {
        $portfolio = Portfolio::findOrFail($request->id);
        $link = 'assets/img/portfolio/' . $portfolio->image;
        if($link && $portfolio->image){
            unlink($link);
        }
        $portfolio->delete();
        return response()->json(['msg'=>'Portfolio Deleted successfully!', 'cls'=>'error', 'data'=>$portfolio]);
    }
}
