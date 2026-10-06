<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Subscription;

class AdminController extends Controller
{
    public function dashboard()
{
    // Total Active Members
    $totalMembers = User::where('role', 2)
                        ->where('status', 1)
                        ->count();

    // Pending Members
    $pendingMembers = User::where('role', 2)
                          ->where('status', 0)
                          ->count();

    // Total Events
    $totalEvents = Event::count();

    // Total Subscription Due
    $totalSubscriptionDue = Subscription::where('status', 0)->sum('amount');

    // Total Subscription Paid
    $totalSubscriptionPaid = Subscription::where('status', 1)->sum('amount');

    return view('admin.dashboard', compact(
        'totalMembers',
        'pendingMembers',
        'totalEvents',
        'totalSubscriptionDue',
        'totalSubscriptionPaid'
    ));
}

    public function pendingUsers()
    {
        $users = User::where('status', 0)->get();
        return view('admin.pending-users', compact('users'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 1;
        $user->save();

        return redirect()->back()->with('success', 'User approved successfully');
    }
}
