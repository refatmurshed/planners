<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Sponsor;
use App\Models\Subscription;
use App\Models\EventRegistration;
use App\Models\EventCosting;
use DB;

class AccountsController extends Controller
{
    public function report(Request $request)
    {
        // selected year
        $year = $request->year ?? date('Y');

        // dropdown years
        $years = Event::selectRaw('YEAR(event_date) as year')
            ->union(
                Subscription::selectRaw('YEAR(due_date) as year')
            )
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        /*
        ===============================
        SUBSCRIPTION
        ===============================
        */

        $subscriptionPaid = Subscription::whereYear('due_date', $year)
            ->where('status', 1)
            ->sum('amount');

        $subscriptionDue = Subscription::whereYear('due_date', $year)
            ->where('status', 0)
            ->sum('amount');

        /*
        ===============================
        EVENTS
        ===============================
        */

        $events = Event::whereYear('event_date', $year)->pluck('id');

        $totalEvents = $events->count();

        $registrationPaid = EventRegistration::whereIn('event_id', $events)
            ->where('status', 1)
            ->sum('fee');

        $registrationDue = EventRegistration::whereIn('event_id', $events)
            ->where('status', 0)
            ->sum('fee');

        $eventSponsor = Sponsor::where('type', 1)
            ->whereIn('event_id', $events)
            ->sum('amount');

        $eventCost = EventCosting::whereIn('event_id', $events)
            ->sum('amount');

        /*
        ===============================
        GENERAL SPONSOR
        ===============================
        */

        $generalSponsor = Sponsor::where('type', 0)
            ->whereYear('created_at', $year)
            ->sum('amount');

        /*
        ===============================
        FINAL SUMMARY
        ===============================
        */

        $totalIncome =
            $subscriptionPaid +
            $registrationPaid +
            $eventSponsor +
            $generalSponsor;

        $totalExpense = $eventCost;

        $netBalance = $totalIncome - $totalExpense;

        return view('admin.accounts.report', compact(
            'year',
            'years',
            'subscriptionPaid',
            'subscriptionDue',
            'totalEvents',
            'registrationPaid',
            'registrationDue',
            'eventSponsor',
            'eventCost',
            'generalSponsor',
            'totalIncome',
            'totalExpense',
            'netBalance'
        ));
    }
}
