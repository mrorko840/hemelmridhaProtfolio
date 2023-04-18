<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\About;
use App\Models\Contact;
use App\Models\HomeSection;
use App\Models\Skill;
use App\Models\Portfolio;
use App\Models\SocialDetails;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomePage(){
        $about                  = About::first();
        $portfolio['all']       = Portfolio::latest()->get();
        $portfolio['types']     = Portfolio::distinct()->get('type');
        $skill                  = Skill::latest()->get();
        $social                 = SocialDetails::latest()->get();
        $home_section           = HomeSection::first();
        $contact                = Contact::first();
        return view('frontend.layouts.app', compact('about', 'portfolio', 'skill', 'social', 'home_section', 'contact'));
    }
}
