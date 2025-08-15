<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;


class NavbarController extends Controller
{
    public function announcementCount()
    {
        $announcements = Announcement::with('files')->get();
        $announcementCount = $announcements->count();
    }
}