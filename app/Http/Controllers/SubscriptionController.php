<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Member;
use App\Models\Receipt;
use App\Models\User;

use App\Jobs\ProcessReceiptJob;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReceiptMail;




class SubscriptionController extends Controller
{
    /**
     * SUBSCRIPTION LIST PAGE
     */
    public function due_subscription()
{
    $subscriptions = Subscription::with(['user.member'])
        ->where('status', 0)
        ->latest()
        ->get();

    return view('admin.subscriptions.due_subscriptions', compact('subscriptions'));
}

    public function pending_subscription()
{
    $subscriptions = Subscription::with(['user.member'])
        ->where('status', 0)
        ->latest()
        ->get();

    return view('admin.subscriptions.due_subscriptions', compact('subscriptions'));
}

    public function paid_subscription()
{
    $subscriptions = Subscription::with(['user.member'])
        ->where('status', 1)
        ->latest()
        ->get();

    return view('admin.subscriptions.paid_subscriptions', compact('subscriptions'));
}


public function dueList($user_id)
{
    return Subscription::where('user_id', $user_id)
        ->where('status', 0)
        ->orderBy('due_date', 'asc')
        ->get(['month_label','due_date']);
}

// collect payment page
public function collect_payment()
{
    $members = Member::with('user')->latest()->get();
    return view('admin.subscriptions.members_list', compact('members'));
}

// Pay subscrition
// Pay subscrition
public function paySubscription(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'months' => 'required|integer|min:1',
        'payment_date' => 'required|date',
    ]);

    $userId = $request->user_id;
    $months = (int) $request->months;
    $paymentDate = $request->payment_date;
    $receiverId = Auth::id();

    DB::beginTransaction();

    try {

        // =========================
        // STEP 1: GET DUE SUBSCRIPTIONS
        // =========================
        $dueSubscriptions = Subscription::where('user_id', $userId)
            ->where('status', 0)
            ->orderBy('due_date', 'asc')
            ->get();

        $paidMonths = [];

        // =========================
        // STEP 2: PAY EXISTING DUES
        // =========================
        foreach ($dueSubscriptions as $sub) {

            if ($months <= 0) break;

            $sub->update([
                'status' => 1,
                'payment_date' => $paymentDate,
                'receiver' => $receiverId
            ]);

            $paidMonths[] = $sub->month_label;
            $months--;
        }

        // =========================
        // STEP 3: CREATE EXTRA MONTHS IF NEEDED
        // =========================
        if ($months > 0) {

            $last = Subscription::where('user_id', $userId)
                ->orderBy('due_date', 'desc')
                ->first();

            $startDate = $last
                ? \Carbon\Carbon::parse($last->due_date)->addMonth()
                : \Carbon\Carbon::parse($paymentDate);

            while ($months > 0) {

                $monthLabel = $startDate->format('F Y');
                $monthValue = $startDate->format('Y-m');

                $exists = Subscription::where('user_id', $userId)
                    ->where('month', $monthValue)
                    ->exists();

                if (!$exists) {

                    $new = Subscription::create([
                        'user_id' => $userId,
                        'amount' => $last->amount ?? 0,
                        'month' => $monthValue,
                        'month_label' => $monthLabel,
                        'due_date' => $startDate->toDateString(),
                        'status' => 1,
                        'payment_date' => $paymentDate,
                        'receiver' => $receiverId
                    ]);

                    $paidMonths[] = $monthLabel;
                    $months--;
                }

                $startDate->addMonth();
            }
        }

        DB::commit();

        // =========================
        // STEP 4: ONLY DISPATCH JOB (PDF + EMAIL + RECEIPT)
        // =========================

        \App\Jobs\ProcessReceiptJob::dispatch(
            $userId,
            $paidMonths,
            $paymentDate,
            $receiverId
        );

        // =========================
        // FINAL RESPONSE (FAST)
        // =========================

        return redirect()->back()->with(
            'success',
            'Payment Successful! Receipt is being generated & will be sent shortly.'
        );

    } catch (\Exception $e) {

        DB::rollback();

        return redirect()->back()->with('error', $e->getMessage());
    }
}

// report
public function receiptIndex()
{
    $receipts = Receipt::with('user')
        ->latest()
        ->get();

    return view('admin.subscriptions.receipts', compact('receipts'));
}

public function receiptShow($id)
{
    return Receipt::with('user')->findOrFail($id);
}

public function receiptEdit($id)
{
    $receipt = Receipt::findOrFail($id);

    return view('admin.subscriptions.receipt_edit', compact('receipt'));
}


// receipt preview
public function receipt_preview()
{
    $member = Member::first();

    if (!$member) {
        abort(404, 'No member found');
    }

    $user = User::find($member->user_id);

    $subscription = Subscription::where('user_id', $member->user_id)
                    ->latest()
                    ->first();

    $amount = $subscription?->amount ?? 1500;


    $in_words = 'One Six Hundred Taka Only';

    return view('admin.subscriptions.receipt_preview', [

        'member' => $member,
        'subscription' => $subscription,

        'name' => $user?->name ?? 'Demo Member',

        'member_id' => $user?->member_id ?? $member->member_id ?? 'PDA-001',

        'date' => now()->format('d M Y'),

        'months' => $subscription?->month_label
                    ?? $subscription?->month
                    ?? 'January 2026',

        'amount' => $amount,

        'in_words' => $in_words,

    ]);
}


}
