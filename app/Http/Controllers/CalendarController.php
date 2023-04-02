<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CalendarController extends Controller
{
   public function index(Request $request)
   {
    if($request->ajax()) {  
       
        $data = Event::get();
      
        return response()->json($data);
    }
    
    return view('admindashboard.calendar.calendar');
   }


 
    public function calendarEvents(Request $request)
    {
       
        switch ($request->type) {
           case 'create':
              $event = Event::create([
                  'event_name' => $request->event_name,
                  'event_start' => $request->event_start,
                  'event_end' => $request->event_end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'edit':
              $event = Event::find($request->id)->update([
                  'event_name' => $request->event_name,
                  'event_start' => $request->event_start,
                  'event_end' => $request->event_end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # ...
             break;
        }
    }
}
