@extends('admin.layout')

@section('content')

<style>

.paid { color:green; font-weight:bold; }
.due { color:red; font-weight:bold; }

table th, table td{
    text-align:center;
    border:1px solid #000 !important;
    padding:6px;
    font-size:13px;
}

/* ================= PRINT ================= */
@media print {

    .no-print {
        display: none !important;
    }

    body {
        margin: 0;
        padding: 0;
    }

    body * {
        visibility: hidden;
    }

    #printArea, #printArea * {
        visibility: visible;
    }

    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 10px;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    tr, td, th {
        page-break-inside: avoid !important;
    }
}

</style>

<div class="content-wrapper">

<section class="content-header no-print">

    <h1>Member Report</h1>

    <button class="btn btn-success" onclick="window.print()">
        Print
    </button>

</section>

<section class="content container-fluid">

<form method="GET" class="form-inline mb-3 no-print">

    <select name="member_id" class="form-control" required>

        <option value="">Select Member</option>

        @foreach(\App\Models\Member::with('user')->get() as $m)
            <option value="{{ $m->id }}"
                {{ request('member_id') == $m->id ? 'selected' : '' }}>
                {{ $m->user->name ?? 'N/A' }}
            </option>
        @endforeach

    </select>

    <button class="btn btn-primary">View</button>

</form>

@if($member)

<!-- ================= PRINT AREA ================= -->
<div id="printArea">

<!-- HEADER -->
<div style="text-align:center; margin-bottom:15px;">

    <img src="{{ asset('images/logo.png') }}" style="height:60px;"><br>

    <h3 style="margin:5px 0;">
        PLANNERS & DESIGNERS ASSOCIATION
    </h3>

    <h4 style="margin:0;">
        Member Report
    </h4>

    <p style="margin:5px 0;">
        <b>Name:</b> {{ $member->user->name }} |
        <b>ID:</b> {{ $member->member_code ?? $member->id }}
    </p>

</div>

<table class="table table-bordered">

<thead>
<tr>
    <th>Month</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Payment Date</th>
</tr>
</thead>

<tbody>

@foreach($subscriptions as $sub)

<tr>

    <td>{{ $sub->month_label }}</td>

    <td>{{ $sub->amount }}</td>

    <td>
        @if($sub->status == 1)
            <span class="paid">Paid</span>
        @else
            <span class="due">Due</span>
        @endif
    </td>

    <td>{{ $sub->payment_date ?? '-' }}</td>

</tr>

@endforeach

<tr>
    <th>Total Paid</th>
    <th colspan="3">{{ $totalPaid }}</th>
</tr>

<tr>
    <th>Total Due</th>
    <th colspan="3">{{ $totalDue }}</th>
</tr>

</tbody>

</table>

</div>
<!-- ================= END PRINT AREA ================= -->

@endif

</section>

</div>

@endsection