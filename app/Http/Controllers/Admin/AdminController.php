<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

       
    public function adminhome () 
    {
        return view('admin.home'); 
    }

    public function adminabout () 
    {
        return view('admin.about'); 
    }

    public function adminacademics () 
    {
        return view('admin.academics'); 
    }
    public function adminfaculties () 
    {
        return view('admin.faculties'); 
    }
    public function adminactivities () 
    {
        return view('admin.activities'); 
    }
    public function adminachievements () 
    {
        return view('admin.achievements'); 
    }
    public function admingalleries () 
    {
        return view('admin.galleries'); 
    }
    public function adminstudentlife () 
    {
        return view('admin.studentlife'); 
    }
    public function adminevent () 
    {
        return view('admin.event'); 
    }
    public function adminapplications () 
    {
        return view('admin.onlineapplications'); 
    }

}
