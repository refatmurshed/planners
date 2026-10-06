@extends('admin.layout')

@section('content')

<style>

th, td{
    text-align:center;
}

/* ================= BASIC ================= */

.no-print{
    display:inline-block;
}

/* ================= PRINT FIX ================= */

@media print {

    .no-print{
        display:none !important;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    th, td{
        border:1px solid #000;
        padding:5px;
        font-size:12px;
    }

    thead{
        display: table-header-group;
    }

    tfoot{
        display: table-footer-group;
    }
}

</style>

<div class="content-wrapper">

<section class="content-header">
    <h1>Event Registration List</h1>

    <!-- ✅ PRINT BUTTON (WILL STAY VISIBLE ON SCREEN) -->
    <button class="btn btn-success no-print" onclick="window.print()">
        Print
    </button>
</section>

<section class="content container-fluid">

<!-- FILTER -->
<form method="GET" class="no-print" style="margin-bottom:15px;">

    <select name="event_id" class="form-control" required style="width:250px; display:inline-block;">
        <option value="">Select Event</option>

        @foreach($events as $event)
            <option value="{{ $event->id }}"
                {{ $selectedEvent == $event->id ? 'selected' : '' }}>
                {{ $event->name }}
            </option>
        @endforeach

    </select>

    <button class="btn btn-primary">Show</button>

</form>

@if($selectedEvent)
    <h4 class="no-print">Total Collected: {{ $totalCollected }}</h4>
@endif


<!-- ================= PRINT AREA ================= -->
<div id="printArea">

<div style="text-align:center; margin-bottom:10px;">
    <h3>PLANNERS & DESIGNERS ASSOCIATION</h3>
</div>

<table class="table table-bordered">

<thead>
<tr>
    <th>SL</th>
    <th>Name</th>
    <th>Member ID</th>
    <th>Fee Paid</th>
    <th>Fee Pending</th>
    <th>Status</th>
    <th class="no-print">Action</th>
</tr>
</thead>

<tbody>

@php
$totalPaid = 0;
$totalPending = 0;
$i = 1;
@endphp

@foreach($registrations as $reg)

@php
$paid = $reg->status == 1 ? $reg->fee : 0;
$pending = $reg->status == 0 ? $reg->fee : 0;

$totalPaid += $paid;
$totalPending += $pending;
@endphp

<tr>

    <td>{{ $i++ }}</td>
    <td style="text-align:left">{{ $reg->user->name }}</td>
    <td>{{ $reg->user->member->member_code ?? 'N/A' }}</td>
    <td>{{ $paid ? $paid : '-' }}</td>
    <td>{{ $pending ? $pending : '-' }}</td>

    <td>
        @if($reg->status == 1)
            <span style="color:green;">Paid</span>
        @else
            <span style="color:orange;">Pending</span>
        @endif
    </td>

    <td class="no-print">
        @if($reg->status == 0)
            <form action="{{ route('event.reg.approve', $reg->id) }}" method="POST">
                @csrf
                <button class="btn btn-success btn-xs">Approve</button>
            </form>
        @else
            -
        @endif
    </td>

</tr>

@endforeach

</tbody>

<!-- ✅ TOTAL ROW (PRINT WILL SHOW THIS) -->
<tfoot>
<tr>
    <th colspan="3">Total</th>
    <th>{{ $totalPaid }}</th>
    <th>{{ $totalPending }}</th>
    <th colspan="2"></th>
</tr>
</tfoot>

</table>

</div>
<!-- ================= PRINT AREA END ================= -->

</section>

</div>

@endsection