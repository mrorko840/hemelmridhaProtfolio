<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function send(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required|min:3|max:20',
            'message'=>'required',
        ]);
        $support = new Support();
        $support->name      = $request->name;
        $support->email      = $request->email;
        $support->subject      = $request->subject;
        $support->message      = $request->message;
        $support->save();
        return response()->json(['msg'=>'Message Send successfully!', 'cls'=>'success', 'data'=>$support]);
    }

    public function allMessage(){
        $pageTitle = 'All Messages';
        $support = Support::latest()->get();
        return view('backend.support', compact('support', 'pageTitle'));
    }
    
    public function pendingMessage(){
        $pageTitle = 'Pending Messages';
        $support = Support::where('is_read', 0)->latest()->get();
        return view('backend.support', compact('support', 'pageTitle'));
    }

    public function isReadMessage(Request $request){
        // dd($request->all());
        $support = Support::findOrFail($request->id);
        $support->is_read = 1; //true
        $support->save();
        $pendingCount = Support::where('is_read', 0)->count();
        return response()->json(['msg'=>'Mark as Read!', 'cls'=>'info', 'data'=>$support, 'count'=>$pendingCount]);
    }

    public function allMessageAjax(){
        $support = Support::latest()->get();
        $pendingCount = Support::where('is_read', 0)->count();
        return response()->json(['data'=>$support,'count'=>$pendingCount]);
    }

    public function deleteMessage(Request $request){
        $support = Support::findOrFail($request->id);
        $support->delete();
        $pendingCount = Support::where('is_read', 0)->count();
        return response()->json(['msg'=>'Message Deleted SuccessFully!', 'cls'=>'success', 'data'=>$support, 'count'=>$pendingCount]);
    }
 
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Support $support)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Support $support)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Support $support)
    {
        //
    }
}
