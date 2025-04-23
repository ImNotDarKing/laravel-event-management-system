<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function events()
    {
        $user = auth()->user();

        $attendances = $user->attendances()->with('event')->get();

        $upcoming = $attendances->filter(fn($a) => $a->event->starts_at >= Carbon::now())->pluck('event');
        $past     = $attendances->filter(fn($a) => $a->event->starts_at <  Carbon::now())->pluck('event');

        return view('profile.events', compact('upcoming','past'));
    }
}
