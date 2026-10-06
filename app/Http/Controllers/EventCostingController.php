<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventCosting;

class EventCostingController extends Controller
{
    // Event costing list
    public function index()
{
    $costings = \App\Models\EventCosting::with('event')
        ->latest()
        ->get();

    return view('admin.events.costing_list', compact('costings'));
}

    public function create()
    {
        $events = Event::latest()->get();

        return view('admin.events.costing_add', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id'     => 'required',
            'date'         => 'required',
            'amount'       => 'required',
            'description'  => 'nullable',
            'file'         => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('image/event_costing'), $name);

            $filePath = 'image/event_costing/'.$name;
        }

        EventCosting::create([
            'event_id'     => $request->event_id,
            'date'         => $request->date,
            'amount'       => $request->amount,
            'description'  => $request->description,
            'file'         => $filePath,
            'status'       => 0,
        ]);

        return back()->with('success', 'Cost Added Successfully');
    }

    // Event Costing Approve
    public function approve($id)
{
    $costing = \App\Models\EventCosting::findOrFail($id);

    $costing->status = 1; // APPROVED
    $costing->save();

    return back()->with('success', 'Costing approved successfully!');
}



}
