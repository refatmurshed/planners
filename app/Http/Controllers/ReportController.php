<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\Subscription;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventCosting;

class ReportController extends Controller
{
    
 public function fullSubscriptionReport(Request $request)
{
    $year = $request->year ?? date('Y');

    // AVAILABLE YEARS FROM DB
    $years = Subscription::selectRaw('YEAR(due_date) as year')
        ->distinct()
        ->orderBy('year','desc')
        ->pluck('year');

    // MONTHS
    $months = [];
    for ($m = 1; $m <= 12; $m++) {
        $months[] = Carbon::create($year, $m)->format('Y-m');
    }

    $members = Member::with('user')->get();

    $subscriptions = Subscription::whereYear('due_date', $year)->get();

    $data = [];

    foreach ($members as $member) {

        foreach ($months as $month) {

            $data[$member->id][$month] = $subscriptions->first(function($item) use ($member, $month){
                return $item->user_id == $member->user_id && $item->month == $month;
            });
        }
    }

    return view('admin.reports.full_subscription_report',
        compact('members','months','data','years','year')
    );
}


public function custom_sub_report()
{
    $members = \App\Models\Member::with('user')->get();

    return view('admin.reports.custom_subscription', compact('members'));
}



public function monthlyReport(Request $request)
{
    $month = $request->month ?? date('Y-m');

    $subscriptions = Subscription::where('month', $month)->get();

    $paid = $subscriptions->where('status', 1);
    $due = $subscriptions->where('status', 0);

    $totalPaid = $paid->sum('amount');
    $totalDue = $due->sum('amount');

    return view('admin.reports.monthly_report', compact(
        'month', 'paid', 'due', 'totalPaid', 'totalDue'
    ));
}

public function memberReport(Request $request)
{
    $memberId = $request->member_id;

    $member = null;
    $subscriptions = collect();
    $totalPaid = 0;
    $totalDue = 0;

    if ($memberId) {

        $member = \App\Models\Member::with('user')->find($memberId);

        if ($member) {

            $subscriptions = Subscription::where('user_id', $member->user_id)
                ->orderBy('due_date', 'asc')
                ->get();

            $totalPaid = $subscriptions->where('status', 1)->sum('amount');
            $totalDue = $subscriptions->where('status', 0)->sum('amount');
        }
    }

    return view('admin.reports.member_report', compact(
        'member', 'subscriptions', 'totalPaid', 'totalDue'
    ));
}

// custom report

public function customReport(Request $request)
{
    $start = $request->start; // format: 2025-01
    $end   = $request->end;   // format: 2026-02

    $months = [];
    $data = [];

    $grandPaid = 0;
    $grandDue = 0;

    if ($start && $end) {

        // START & END DATE
        $startDate = Carbon::createFromFormat('Y-m', $start)->startOfMonth();
        $endDate   = Carbon::createFromFormat('Y-m', $end)->endOfMonth();

        // ALL MONTHS BETWEEN RANGE
        $current = $startDate->copy();

        while ($current <= $endDate) {
            $months[] = $current->format('Y-m');
            $current->addMonth();
        }

        // GET SUBSCRIPTIONS IN RANGE
        $subscriptions = Subscription::whereBetween('due_date', [$startDate, $endDate])->get();

        foreach ($months as $month) {

            $monthSubs = $subscriptions->filter(function ($item) use ($month) {
                return $item->month == $month;
            });

            $paid = $monthSubs->where('status', 1)->sum('amount');
            $due  = $monthSubs->where('status', 0)->sum('amount');

            $data[$month] = [
                'paid' => $paid,
                'due'  => $due,
            ];

            $grandPaid += $paid;
            $grandDue  += $due;
        }
    }

    return view('admin.reports.custom_report', compact(
        'start','end','months','data','grandPaid','grandDue'
    ));
}

// Event Report
public function eventReport()
{
    $events = Event::with([
        'registrations',
        'costings',
        'sponsors'
    ])->latest()->get();

    return view('admin.reports.event_report', compact('events'));
}




}
