@extends('admin.layout')

@section('content')

<style>
th, td{
    text-align:center;
    vertical-align:middle !important;
}
.profit{
    color:green;
    font-weight:700;
}
.loss{
    color:red;
    font-weight:700;
}
.overlay{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.6);
    display:none;
    z-index:9999;
}
.popup{
    width:620px;
    background:#fff;
    margin:60px auto;
    padding:25px;
    border-radius:8px;
}
@media(max-width:768px){
    .popup{
        width:95%;
    }
}
</style>

<div class="content-wrapper">

<section class="content-header">
    <h1>Event Report</h1>
</section>

<section class="content container-fluid">

<div class="box box-solid">
<div class="box-body table-responsive">

<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>SL</th>
    <th>Event Name</th>
    <th>Members</th>
    <th>Paid Fee</th>
    <th>Pending Fee</th>
    <th>Sponsor</th>
    <th>Total Income</th>
    <th>Total Cost</th>
    <th>Profit / Loss</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@php $i=1; @endphp

@foreach($events as $event)

@php

$memberCount = $event->registrations->count();

$paidFee = $event->registrations
            ->where('status',1)
            ->sum('fee');

$pendingFee = $event->registrations
                ->where('status',0)
                ->sum('fee');

$sponsorAmount = $event->sponsors->sum('amount');

$totalIncome = $paidFee + $sponsorAmount;

$totalCost = $event->costings
            ->where('status',1)
            ->sum('amount');

$net = $totalIncome - $totalCost;

@endphp

<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $event->name }}</td>
    <td>{{ $memberCount }}</td>
    <td>{{ number_format($paidFee,2) }}</td>
    <td>{{ number_format($pendingFee,2) }}</td>
    <td>{{ number_format($sponsorAmount,2) }}</td>
    <td>{{ number_format($totalIncome,2) }}</td>
    <td>{{ number_format($totalCost,2) }}</td>

    <td>
        @if($net >= 0)
            <span class="profit">
                Profit {{ number_format($net,2) }}
            </span>
        @else
            <span class="loss">
                Loss {{ number_format(abs($net),2) }}
            </span>
        @endif
    </td>

    <td>
        <button
            class="btn btn-info btn-xs openPopup"
            data-name="{{ $event->name }}"
            data-members="{{ $memberCount }}"
            data-paid="{{ number_format($paidFee,2) }}"
            data-pending="{{ number_format($pendingFee,2) }}"
            data-sponsor="{{ number_format($sponsorAmount,2) }}"
            data-income="{{ number_format($totalIncome,2) }}"
            data-cost="{{ number_format($totalCost,2) }}"
            data-net="{{ $net }}"
        >
            View
        </button>
    </td>
</tr>

@endforeach

</tbody>

</table>

</div>
</div>

</section>
</div>


<!-- POPUP -->
<div class="overlay" id="popup">

<div class="popup">

<h3>Event Full Report</h3>
<hr>

<p><b>Event Name:</b> <span id="p_name"></span></p>
<p><b>Total Members:</b> <span id="p_members"></span></p>
<p><b>Paid Fee:</b> <span id="p_paid"></span></p>
<p><b>Pending Fee:</b> <span id="p_pending"></span></p>
<p><b>Sponsor Amount:</b> <span id="p_sponsor"></span></p>
<p><b>Total Income:</b> <span id="p_income"></span></p>
<p><b>Total Cost:</b> <span id="p_cost"></span></p>
<p><b>Final Result:</b> <span id="p_net"></span></p>

<br>

<button class="btn btn-danger btn-sm" onclick="closePopup()">Close</button>

</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$('.openPopup').click(function(){

    $('#p_name').text($(this).data('name'));
    $('#p_members').text($(this).data('members'));
    $('#p_paid').text($(this).data('paid'));
    $('#p_pending').text($(this).data('pending'));
    $('#p_sponsor').text($(this).data('sponsor'));
    $('#p_income').text($(this).data('income'));
    $('#p_cost').text($(this).data('cost'));

    let net = parseFloat($(this).data('net'));

    if(net >= 0){
        $('#p_net').html('<span style="color:green;font-weight:bold">Profit '+ net.toFixed(2) +'</span>');
    }else{
        $('#p_net').html('<span style="color:red;font-weight:bold">Loss '+ Math.abs(net).toFixed(2) +'</span>');
    }

    $('#popup').show();
});

function closePopup(){
    $('#popup').hide();
}

</script>

@endsection
