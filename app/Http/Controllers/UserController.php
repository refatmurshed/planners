<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Subscription;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /**
     * USERS LIST
     */
    public function users_list()
    {
        $users = User::latest()->get();

        return view('admin.users.users_list', compact('users'));
    }


    /**
 * APPROVE USER + MEMBER + SUBSCRIPTION
 */

public function approve(Request $request, $id)
{
    // validation
    $request->validate([
        'member_id'    => 'required|unique:users,member_id|unique:members,member_code',
        'joining_date' => 'nullable|date',
    ]);

    $user = User::findOrFail($id);

    // already approved check
    if ($user->status == 1) {
        return back()->with('success', 'User already approved');
    }

    // joining date (default today)
    $joiningDate = $request->joining_date
        ? Carbon::parse($request->joining_date)
        : Carbon::now();

    // approve user
    $user->status = 1;
    $user->member_id = $request->member_id;
    $user->save();

    // member create
    $memberExists = Member::where('user_id', $user->id)->exists();

    if (!$memberExists) {

        Member::create([
            'user_id'      => $user->id,
            'member_code'  => $request->member_id,
            'joining_date' => $joiningDate,
        ]);
    }

    // settings
    $settings = Setting::first();

    $amount = $settings->subscription_amount ?? 0;
    $dueDay = $settings->due_day ?? 1;

    // loop months
    $start = $joiningDate->copy()->startOfMonth();
    $end = Carbon::now()->startOfMonth();

    $totalMonths = 0;

    while ($start <= $end) {

        $month = $start->format('Y-m');
        $monthLabel = $start->format('F Y');

        // due date
        $dueDate = Carbon::createFromFormat('Y-m-d', $month . '-01')
            ->addDays($dueDay - 1);

        // duplicate check
        $exists = Subscription::where('user_id', $user->id)
            ->where('month', $month)
            ->exists();

        if (!$exists) {

            Subscription::create([
                'user_id'     => $user->id,
                'amount'      => $amount,
                'month'       => $month,
                'month_label' => $monthLabel,
                'due_date'    => $dueDate,
                'status'      => 0,
            ]);

            $totalMonths++;
        }

        $start->addMonth();
    }

    // total amount
    $totalAmount = $totalMonths * $amount;

    // FINAL MESSAGE
    return back()->with(
        'success',
        "User approved | Member ID: {$user->member_id} | {$totalMonths} months due created | Total: {$totalAmount} TK"
    );
}
    








/**
 * Admin User Create Page
 */
public function adminCreate()
{
    return view('admin.users.user_create');
}


/**
 * Admin Store User
 */
public function adminStore(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
        'role' => 'required|in:1,2',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'status' => 0,
    ]);

    return back()->with('success','User Created Successfully');
}



}
