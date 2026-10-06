<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * EVENT LIST
     */
    public function event_list()
    {
        $events = Event::latest()->get();

        return view('admin.events.event_list', compact('events'));
    }

    /**
     * ADD PAGE
     */
    public function add()
    {
        return view('admin.events.add_event');
    }

    /**
     * STORE EVENT
     */
    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'name'  => 'required|string|max:255',
            'event_date'  => 'required|date',
            'min_fee' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // IMAGE UPLOAD
        $imagePath = null;

if ($request->hasFile('image')) {

    $image = $request->file('image');

    // unique name (important)
    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

    // move to public/images/events
    $image->move(public_path('images/events'), $imageName);

    // save path in DB
    $imagePath = 'images/events/' . $imageName;
}

        // STORE
        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'last_registration_date' => $request->last_registration_date,
            'min_fee' => $request->min_fee ?? 0,
            'image' => $imagePath,
        ]);

        return redirect()->route('event.list')
            ->with('success', 'Event added successfully');
    }

    public function adminRegister(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
        'user_id'  => 'required|exists:users,id',
    ]);

    // duplicate check
    $exists = \App\Models\EventRegistration::where('event_id', $request->event_id)
        ->where('user_id', $request->user_id)
        ->exists();

    if ($exists) {
        return back()->with('error', 'This member already registered!');
    }

    $event = \App\Models\Event::findOrFail($request->event_id);

    \App\Models\EventRegistration::create([
        'event_id' => $event->id,
        'user_id'  => $request->user_id,
        'fee'      => $event->min_fee,
        'status'   => 0, // due
    ]);

    return back()->with('success', 'Member registered successfully!');
}

public function adminList($id)
{
    $event = \App\Models\Event::findOrFail($id);

    $registrations = \App\Models\EventRegistration::with('user')
        ->where('event_id', $id)
        ->latest()
        ->get();

    return view('admin.events.registration_list', compact('event', 'registrations'));
}





}
