<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Models\User;
use App\Models\Event;

class SponsorController extends Controller
{
    public function sponsors_list()
    {
        $sponsors = Sponsor::with(['user','event'])->latest()->get();

        return view('admin.sponsors.sponsors_list', compact('sponsors'));
    }

    public function sponsors_add()
    {
        $users = User::all();
        $events = Event::all();
        return view('admin.sponsors.sponsors_add', compact('users','events'));
    }

    public function sponsors_store(Request $request)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'amount'    => 'required|numeric|min:0',
        'user_id'   => 'nullable|exists:users,id',
        'event_id'  => 'nullable|exists:events,id',
        'description' => 'nullable|string'
    ]);

    Sponsor::create([
        'name'        => $request->name,
        'user_id'     => $request->user_id ?: null,
        'event_id'    => $request->event_id ?: null,
        'amount'      => $request->amount,
        'description' => $request->description,

        // Event থাকলে type = 1, না থাকলে general
        'type'        => $request->event_id ? 1 : 0,
    ]);

    return redirect()->route('admin.sponsors_list')
        ->with('success', 'Sponsor Added Successfully');
}



}
