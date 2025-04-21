<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $pending = Event::where('status', 'pending')->get();
        return view('admin.events.index', compact('pending'));
    }

    public function updateStatus(Request $r, $id)
    {
        $e = Event::findOrFail($id);
        $e->status = $r->input('status');
        $e->save();

        return back();
    }

    public function destroy($id)
    {
        Event::destroy($id);
        return back();
    }
}