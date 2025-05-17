<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\UploadEvents;
use App\Models\Announcement;
use App\Models\Slider;
use App\Models\PrincipalMsg;
use App\Models\upcoming_events; 
use App\Models\ManagerMsg;
use App\Models\News;

class FrontEndController extends Controller
{
    public function home()
    {
        $announcements = Announcement::with('files')->get();
        $announcementCount = $announcements->count();
        $principalMsg = PrincipalMsg::latest()->first();

        // Events 
        $events = UploadEvents::all()->groupBy('common_header');

         // Fetch all slider records
        //  $scrollers = Slider::first();
        $scrollers = News::whereNotNull('image_url')->get();
         
        $slider = Slider::first();

        $sliders = [
            [
            'image_url' => $slider->slider1,
            'header' => $slider->slider1_heading,
            'common_header' => $slider->slider1_description,
            ],
            [
            'image_url' => $slider->slider2,
            'header' => $slider->slider2_heading,
            'common_header' => $slider->slider2_description,
            ],
            [
            'image_url' => $slider->slider3,
            'header' => $slider->slider3_heading,
            'common_header' => $slider->slider3_description,
            ],
    ];
    
        return view('home', compact('sliders', 'announcements','scrollers', 'principalMsg','events'));
    }

   
    public function about()
    {
        $upcomingEvent = upcoming_events::orderByDesc('event_date')->get();
        return view('about',compact('upcomingEvent'));
    }

    public function footer()
    {
        return view('footer');
    }
    public function downloadResult()
{
   
   return redirect()->back()->with('notification', 'Your result is ready! Download now.');
}

public function viewPrincipal()
    {
        $principalMsg = PrincipalMsg::latest()->first();
        $managerMsg = ManagerMsg::latest()->first();
        return view('prinicpalmsgpage',compact('principalMsg','managerMsg'));
    }

}
