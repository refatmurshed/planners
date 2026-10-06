@extends('admin.layout')

@section('content')

<style>
th, td { text-align:center; }

.badge-pending{
    background:orange;
    color:white;
    padding:5px 10px;
    border-radius:10px;
}

.overlay {
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.6);
    display:none;
    z-index:9999;
}

.popup-box {
    width:450px;
    background:white;
    margin:70px auto;
    padding:20px;
    border-radius:10px;
}

.btn-row {
    text-align:right;
    margin-top:15px;
}

.member-box {
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:10px;
}

.member-box img {
    width:50px;
    height:50px;
    border-radius:50%;
    object-fit:cover;
}

.view-table{
    width:100%;
    margin-top:10px;
    border-collapse:collapse;
}

.view-table th,
.view-table td{
    border:1px solid #ddd;
    padding:8px;
    text-align:left;
}
</style>

<div class="content-wrapper">

<section class="content-header">
    <h1>Paid Subscriptions</h1>
</section>

<section class="content container-fluid">

@if(Session::has('success'))
    <div class="alert alert-success text-center">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger text-center">
        {{ Session::get('error') }}
    </div>
@endif

<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>SL</th>
    <th>Member Name</th>
    <th>Member ID</th>
    <th>Month</th>
    <th>Amount</th>
    <th>Due Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@php $i=1; @endphp

@foreach($subscriptions as $sub)

<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $sub->user->name ?? 'N/A' }}</td>
    <td>{{ $sub->user->member->member_code ?? 'N/A' }}</td>
    <td>{{ $sub->month_label }}</td>
    <td>{{ $sub->amount }}</td>
    <td>{{ $sub->due_date }}</td>

    <td><span class="">Paid</span></td>

    <td>
        <button type="button"
                class="btn btn-success btn-xs openPayPopup"
                data-name="{{ $sub->user->name ?? 'N/A' }}"
                data-image="{{ $sub->user->image ?? '' }}"
                data-memberid="{{ $sub->user->member->member_code ?? 'N/A' }}"
                data-month="{{ $sub->month_label }}"
                data-amount="{{ $sub->amount }}"
                data-date="{{ $sub->due_date }}"
                data-status="Paid">
            View
        </button>
    </td>
</tr>

@endforeach

</tbody>

</table>

</section>
</div>

<!-- POPUP -->
<div class="overlay" id="payPopup">

    <div class="popup-box">

        <h4>Subscription Details</h4>

        <div class="member-box">
            <img id="memberImage" src="">
            <strong id="memberName"></strong>
        </div>

        <table class="view-table">

            <tr>
                <th>Member ID</th>
                <td id="viewMemberId"></td>
            </tr>

            <tr>
                <th>Month</th>
                <td id="viewMonth"></td>
            </tr>

            <tr>
                <th>Amount</th>
                <td id="viewAmount"></td>
            </tr>

            <tr>
                <th>Due Date</th>
                <td id="viewDate"></td>
            </tr>

            <tr>
                <th>Status</th>
                <td id="viewStatus"></td>
            </tr>

        </table>

        <div class="btn-row">
            <button type="button" class="btn btn-danger" onclick="closePayPopup()">Close</button>
        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function(){

    $(document).on('click', '.openPayPopup', function(){

        let name = $(this).data('name');
        let image = $(this).data('image');
        let memberid = $(this).data('memberid');
        let month = $(this).data('month');
        let amount = $(this).data('amount');
        let date = $(this).data('date');
        let status = $(this).data('status');

        $('#memberName').text(name);

        $('#viewMemberId').text(memberid);
        $('#viewMonth').text(month);
        $('#viewAmount').text(amount);
        $('#viewDate').text(date);
        $('#viewStatus').text(status);

        if(image){
            $('#memberImage').attr('src', image);
        } else {
            $('#memberImage').attr('src', 'https://via.placeholder.com/50');
        }

        $('#payPopup').fadeIn();

    });

});

function closePayPopup(){
    $('#payPopup').fadeOut();
}

</script>

@endsection