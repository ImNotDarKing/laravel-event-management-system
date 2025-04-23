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
    public function destroy($eventId)
    {
        $user = auth()->user();
        $user->attendances()->where('event_id', $eventId)->delete();
        return back();
    }
}