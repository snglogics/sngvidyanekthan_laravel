<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated before accessing this page
    }

    public function index()
    {
        return view('admin.dashboard'); // Admin dashboard view
    }
 
}
