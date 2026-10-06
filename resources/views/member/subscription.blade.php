@php
    $user = auth()->user();

    $member = \App\Models\Member::where('user_id', $user->id)->first();

    $subs = \App\Models\Subscription::where('user_id', $user->id)
                ->orderBy('due_date', 'desc')
                ->get();

    $receiverUsers = \App\Models\User::whereIn(
    'id',
    $subs->pluck('receiver')->filter()
    )->get()->keyBy('id');

@endphp

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>My Due Payments</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#eef2f7;
    font-family:'Segoe UI',sans-serif;
    margin:0;
}

.member-dashboard{
    max-width:1400px;
    margin:auto;
    padding:25px;
}

.top-banner{
    background:linear-gradient(135deg,#0f172a,#1e3a8a);
    color:#fff;
    padding:30px;
    border-radius:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.welcome-area{
    display:flex;
    align-items:center;
    gap:25px;
}

.member-image{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid rgba(255,255,255,.25);
}

.welcome-text h1{
    font-size:32px;
    margin:0 0 8px;
}

.welcome-text p{
    margin:0;
    opacity:.9;
}

.member-id-badge{
    display:inline-block;
    margin-top:10px;
    background:rgba(255,255,255,.15);
    padding:6px 14px;
    border-radius:20px;
    font-size:13px;
}

.btn-home{
    background:#16a34a;
    color:#fff;
    text-decoration:none;
    padding:10px 18px;
    border-radius:8px;
    font-weight:600;
}

.btn-home:hover{
    color:#fff;
}

.table-box{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.table-title{
    padding:20px;
    border-bottom:1px solid #eee;
}

.table-title h2{
    margin:0;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#f8fafc;
    padding:15px;
}

td{
    padding:15px;
    border-top:1px solid #eee;
}

tr:hover{
    background:#f8fafc;
}

.badge-due{
    background:#fee2e2;
    color:#dc2626;
    padding:7px 14px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

.badge-paid{
    background:#dcfce7;
    color:#166534;
    padding:7px 14px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

.btn-pay{
    border:none;
    background:#dc2626;
    color:#fff;
    padding:8px 14px;
    border-radius:8px;
    font-size:13px;
    font-weight:600;
}

.btn-view{
    border:none;
    background:#16a34a;
    color:#fff;
    padding:8px 14px;
    border-radius:8px;
    font-size:13px;
    font-weight:600;
}

.empty{
    text-align:center;
    padding:30px;
}

@media(max-width:768px){

    .top-banner{
        flex-direction:column;
        text-align:center;
        gap:20px;
    }

    .welcome-area{
        flex-direction:column;
    }

    .table-responsive{
        overflow:auto;
    }
}

</style>
</head>
<body>

<div class="member-dashboard">

    <div class="top-banner">

        <div class="welcome-area">

            @if($member && $member->image)
                <img src="{{ asset($member->image) }}" class="member-image">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff&size=200"
                     class="member-image">
            @endif

            <div class="welcome-text">

                <h1>My Subscription</h1>

                <p>Manage your payments & dues</p>

                @if($user->member_id)
                    <span class="member-id-badge">
                        Member ID : {{ $user->member_id }}
                    </span>
                @endif

            </div>

        </div>

        <a href="{{ route('member.dashboard') }}" class="btn-home">
            🏠 Dashboard
        </a>

    </div>

    <div class="table-box">

        <div class="table-title">
            <h2>Subscription List</h2>
        </div>

        <div class="table-responsive">

            <table>

                <thead>
                <tr>
                    <th>SL</th>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>

                @forelse($subs as $key => $sub)

                    <tr>

                        <td>{{ $key+1 }}</td>

                        <td>
                            {{ $sub->month_label ?? $sub->month }}
                        </td>

                        <td>
                            ৳ {{ number_format($sub->amount,2) }}
                        </td>

                        <td>
                            {{ date('d M Y', strtotime($sub->due_date)) }}
                        </td>

                        <td>

                            @if($sub->status == 1)

                                <span class="badge-paid">
                                    Paid
                                </span>

                            @else

                                <span class="badge-due">
                                    Due
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($sub->status == 0)

                                <button
                                    class="btn-pay"
                                    data-bs-toggle="modal"
                                    data-bs-target="#payModal{{ $sub->id }}">
                                    Pay Now
                                </button>

                            @else

                                <button
                                    class="btn-view"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $sub->id }}">
                                    View
                                </button>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="empty">
                            No Subscription Found 🎉
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- MODALS --}}

@foreach($subs as $sub)

    @if($sub->status == 0)

        <div class="modal fade" id="payModal{{ $sub->id }}" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Pay Subscription
                        </h5>

                        <button class="btn-close"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    <form action="#" method="POST">

                        @csrf

                        <div class="modal-body">

                            <input type="hidden"
                                   name="subscription_id"
                                   value="{{ $sub->id }}">

                            <div class="mb-3">

                                <label class="form-label">
                                    Month
                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $sub->month_label ?? $sub->month }}"
                                       readonly>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Amount
                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $sub->amount }}"
                                       readonly>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Receiver Number
                                </label>

                                <input type="text"
                                       class="form-control"
                                       placeholder="017xxxxxxxx">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Transaction ID
                                </label>

                                <input type="text"
                                       class="form-control"
                                       placeholder="Enter trx id">

                            </div>

                        </div>

                        <div class="modal-footer">

                            <!-- <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                Close
                            </button>

                            <button type="submit"
                                    class="btn btn-success">
                                Submit Payment
                            </button> -->

                        </div>

                    </form>

                </div>

            </div>

        </div>

    @else

        <div class="modal fade" id="viewModal{{ $sub->id }}" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Payment Details
                        </h5>

                        <button class="btn-close"
                                data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <table class="table">

                            <tr>
                                <th>Month</th>
                                <td>{{ $sub->month_label ?? $sub->month }}</td>
                            </tr>

                            <tr>
                                <th>Amount</th>
                                <td>৳ {{ number_format($sub->amount,2) }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>Paid</td>
                            </tr>

                            <tr>
                                <th>Payment Date</th>
                                <td>
                                    {{ $sub->payment_date ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Receiver</th>
                                <td>
                                    {{ $receiverUsers[$sub->receiver]->name ?? '-' }}
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    @endif

@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>