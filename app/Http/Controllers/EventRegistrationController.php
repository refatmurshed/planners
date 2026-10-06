<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;

class EventRegistrationController extends Controller
{
    /**
     * REGISTRATION PAGE (ADMIN)
     */
    public function create()
    {
        $events = Event::latest()->get();
        $users  = User::latest()->get();

        return view('admin.events.register', compact('events', 'users'));
    }

    /**
     * STORE REGISTRATION (DEFAULT PENDING)
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id'  => 'required|exists:users,id',
        ]);

        // DUPLICATE CHECK
        $exists = EventRegistration::where('event_id', $request->event_id)
            ->where('user_id', $request->user_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Already registered for this event!');
        }

        $event = Event::findOrFail($request->event_id);

        EventRegistration::create([
            'event_id' => $event->id,
            'user_id'  => $request->user_id,
            'fee'      => $event->min_fee ?? 0,
            'status'   => 0, // PENDING
        ]);

        return back()->with('success', 'Registration successful (Pending approval)');
    }

    /**
     * MANAGE PAGE (FILTER + TOTAL)
     */
    public function manage(Request $request)
    {
        $events = Event::all();

        $selectedEvent = $request->event_id;

        $registrations = collect();
        $totalCollected = 0;

        if ($selectedEvent) {

            $registrations = EventRegistration::with('user')
                ->where('event_id', $selectedEvent)
                ->latest()
                ->get();

            // ONLY APPROVED TOTAL
            $totalCollected = $registrations
                ->where('status', 1)
                ->sum('fee');
        }

        return view('admin.events.manage_registrations', compact(
            'events',
            'registrations',
            'selectedEvent',
            'totalCollected'
        ));
    }

    /**
     * APPROVE PAYMENT
     */
    public function approve($id)
    {
        $reg = EventRegistration::findOrFail($id);

        $reg->status = 1; // PAID
        $reg->payment_date = date('Y-m-d');
        $reg->save();

        return back()->with('success', 'Payment approved successfully!');
    }

    /**
     * OPTIONAL: EVENT WISE LIST
     */
    public function adminList($id)
    {
        $event = Event::findOrFail($id);

        $registrations = EventRegistration::with('user')
            ->where('event_id', $id)
            ->latest()
            ->get();

        return view('admin.events.registration_list', compact('event', 'registrations'));
    }
}
