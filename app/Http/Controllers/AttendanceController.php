<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function store(Request $request, $eventId)
    {
        \Auth::user()->attendances()->updateOrCreate(
            ['event_id' => $eventId],
            ['going'    => true]
        );

        return back();
    }
}