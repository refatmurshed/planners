@extends('admin.layout')

@section('content')

<style>
th, td{
    text-align:center;
    font-size:13px;
}

.member-img{
    width:45px;
    height:45px;
    border-radius:50%;
    object-fit:cover;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;
}

.column-box{
    padding:10px;
    border:1px solid #ddd;
    background:#f8f8f8;
    border-radius:8px;
}

.overlay{
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    background:rgba(0,0,0,0.6);
    display:none;
}

.popup{
    width:500px;
    background:#fff;
    margin:60px auto;
    padding:20px;
    border-radius:10px;
}
</style>

<div class="content-wrapper">

<section class="content-header">
    <h1>Subscription Money Receipts</h1>
</section>

<section class="content container-fluid">

<!-- TOP BAR -->
<div class="top-bar">

    <input type="text" id="search" class="form-control" placeholder="Search...">

    <div class="column-box">
        <label><input type="checkbox" checked> SL</label>
        <label><input type="checkbox" checked> Member</label>
        <label><input type="checkbox" checked> Receipt No</label>
        <label><input type="checkbox" checked> Months</label>
        <label><input type="checkbox" checked> Amount</label>
        <label><input type="checkbox" checked> Date</label>
        <label><input type="checkbox" checked> PDF</label>
        <label><input type="checkbox" checked> Action</label>

        <button onclick="printTable()" class="btn btn-danger btn-sm">Print</button>
    </div>

</div>

<table class="table table-bordered" id="table">

<thead>
<tr>
    <th>SL</th>
    <th>Member</th>
    <th>Receipt No</th>
    <th>Months</th>
    <th>Total Amount</th>
    <th>Date</th>
    <th>PDF</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@foreach($receipts as $key => $r)
<tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $r->user->name ?? 'N/A' }}</td>
    <td>{{ $r->receipt_no }}</td>
    <td>{{ $r->months }}</td>
    <td>{{ $r->total_amount }}</td>
    <td>{{ $r->payment_date }}</td>

    <td>
        <a href="{{ asset('receipts/'.$r->pdf_file) }}" target="_blank">
            Preview
        </a>
    </td>

    <td>
        <button class="btn btn-info btn-xs" onclick="viewReceipt({{ $r->id }})">View</button>

        <a href="/admin/subscription-receipts/{{ $r->id }}/edit" class="btn btn-warning btn-xs">
            Edit
        </a>
    </td>
</tr>
@endforeach
</tbody>

</table>

</section>
</div>

<!-- POPUP -->
<div class="overlay" id="popup">
    <div class="popup">
        <h4>Receipt Details</h4>
        <div id="details"></div>
        <button onclick="closePopup()" class="btn btn-danger btn-sm">Close</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

function viewReceipt(id){

    $.get('/admin/subscription-receipts/' + id, function(data){

        let html = `
            <p><b>Name:</b> ${data.user.name}</p>
            <p><b>Receipt No:</b> ${data.receipt_no}</p>
            <p><b>Months:</b> ${data.months}</p>
            <p><b>Total:</b> ${data.total_amount}</p>
            <p><b>Date:</b> ${data.payment_date}</p>
        `;

        $('#details').html(html);
        $('#popup').show();
    });
}

function closePopup(){
    $('#popup').hide();
}

function printTable(){
    let w = window.open('');
    w.document.write(document.getElementById('table').outerHTML);
    w.print();
    w.close();
}

</script>

@endsection