@extends('admin.layout')

@section('content')

<style>

.paid { color:green; font-weight:bold; }
.due { color:red; font-weight:bold; }

table th, table td{
    text-align:center;
    border:1px solid #000 !important;
    font-size:13px;
    padding:6px;
}

/* ================= PRINT FIX (SAFE METHOD) ================= */
@media print {

    body {
        margin:0;
        padding:0;
    }

    /* hide everything first */
    body * {
        visibility: hidden;
    }

    /* show only print area */
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

    .no-print {
        display: none !important;
    }

    /* force bootstrap columns to behave in print */
    .row {
        display: block !important;
    }

    .col-md-6 {
        width: 100% !important;
        display: block !important;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
}

</style>

<div class="content-wrapper">

<section class="content-header no-print">

    <h1>Monthly Report</h1>

    <button class="btn btn-success" onclick="window.print()">
        Print PDF
    </button>

</section>

<section class="content container-fluid">

<form method="GET" class="form-inline mb-3 no-print">

    <input type="month" name="month" value="{{ $month }}" class="form-control">

    <button class="btn btn-primary">Filter</button>

</form>

<!-- ================= PRINT AREA START ================= -->
<div id="printArea">

<!-- HEADER -->
<div style="text-align:center; margin-bottom:20px;">

    <img src="{{ asset('images/logo.png') }}" style="height:60px; margin-bottom:5px;">

    <h3 style="margin:0;">
        PLANNERS & DESIGNERS ASSOCIATION
    </h3>

    <h5 style="margin:5px 0;">
        Monthly Report - {{ \Carbon\Carbon::parse($month)->format('F Y') }}
    </h5>

</div>

<div class="row">

<!-- ================= PAID ================= -->
<div class="col-md-6">

<h3 style="text-align:center;">PAID</h3>

<table class="table table-bordered">

<thead>
<tr>
    <th>SL</th>
    <th>Name</th>
    <th>ID</th>
    <th>Amount</th>
</tr>
</thead>

<tbody>

@php $sl = 1; @endphp

@foreach($paid as $p)

<tr>
    <td>{{ $sl++ }}</td>
    <td>{{ $p->user->name ?? 'N/A' }}</td>
    <td>{{ $p->user->member_id ?? 'N/A' }}</td>
    <td class="paid">{{ $p->amount }}</td>
</tr>

@endforeach

<tr>
    <th colspan="3">Total</th>
    <th class="paid">{{ $totalPaid }}</th>
</tr>

</tbody>

</table>

</div>

<!-- ================= DUE ================= -->
<div class="col-md-6">

<h3 style="text-align:center;">DUE</h3>

<table class="table table-bordered">

<thead>
<tr>
    <th>SL</th>
    <th>Name</th>
    <th>ID</th>
    <th>Amount</th>
</tr>
</thead>

<tbody>

@php $sl = 1; @endphp

@foreach($due as $d)

<tr>
    <td>{{ $sl++ }}</td>
    <td>{{ $d->user->name ?? 'N/A' }}</td>
    <td>{{ $d->user->member_id ?? 'N/A' }}</td>
    <td class="due">{{ $d->amount }}</td>
</tr>

@endforeach

<tr>
    <th colspan="3">Total</th>
    <th class="due">{{ $totalDue }}</th>
</tr>

</tbody>

</table>

</div>

</div>

</div>
<!-- ================= PRINT AREA END ================= -->

</section>

</div>

@endsection