<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:organizer');
    }

    public function index()
    {
        $events = \Auth::user()
                       ->events()
                       ->orderBy('starts_at')
                       ->get();

        return view('organizer.events.index', compact('events'));
    }

    public function create()
    {
        return view('organizer.events.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'title'             => 'required',
            'short_description' => 'required',
            'location'          => 'required',
            'starts_at'         => 'required',
        ]);

        $data['organizer_id'] = \Auth::id();
        Event::create($data);

        return redirect()->route('organizer.events.index');
    }

    public function edit(Event $event)
    {
        return view('organizer.events.edit', compact('event'));
    }

    public function update(Request $r, Event $event)
    {
        $event->update($r->only([
            'title','short_description','description',
            'location','starts_at','paid','image'
        ]));

        return redirect()->route('organizer.events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back();
    }
}