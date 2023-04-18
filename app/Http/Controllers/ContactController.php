<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::first();
        return view('backend.contact',compact('contact'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $contact = Contact::first();
        $contact->location       = $request->location;
        $contact->phone          = $request->phone;
        $contact->email          = $request->email;
        $contact->map            = $request->map;
        $contact->save();
        return response()->json(['msg'=>'Data update successfully!', 'cls'=>'success', 'data'=>$contact]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
