<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    public function homepage()
    {
        return view('FrontEnd.homepage');
    }
    public function aboutus()
    {
        return view('FrontEnd.about');
    }
    public function contactus()
    {
        return view('FrontEnd.contact');
    }
    public function singlepage()
    {
        return view('FrontEnd.single');
    }
    public function department()
    {
        return view('FrontEnd.department');
    }
    public function appointment()
    {
        return view('FrontEnd.appointment');
    }
    public function subscribe()
    {
        return view('FrontEnd.subscribe');
    }
    public function doctors()
    {
        return view('FrontEnd.doctors');
    }


}
