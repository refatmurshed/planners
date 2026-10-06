@extends('admin.layout')

@section('content')

<style>
th { text-align: center; }

.member-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #ddd;
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
}

/* ================= NEW FEATURE UI ONLY ================= */

.top-bar{
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:10px;
    margin-bottom:10px;
}

.search-box{
    width:300px;
}

.column-box{
    background:#f8f8f8;
    border:1px solid #ddd;
    padding:10px;
    border-radius:6px;
}

.column-box label{
    margin-right:10px;
    font-size:13px;
}

.pagination-box{
    text-align:center;
    margin-top:10px;
}

.pagination-box button{
    border:none;
    background:#007bff;
    color:#fff;
    padding:5px 10px;
    margin:2px;
    border-radius:4px;
}

.pagination-box button.active{
    background:#28a745;
}

.entry-info{
    margin-top:10px;
    font-weight:bold;
}

.paid-box{
    background:#28a745;
    color:#fff;
    padding:4px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.due-box{
    background:#dc3545;
    color:#fff;
    padding:4px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

</style>

<div class="content-wrapper">

<section class="content-header">
    <h1>Members Payment</h1>
</section>

<section class="content container-fluid">

{{-- SUCCESS --}}
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


<!-- ================= TOP BAR ================= -->
<div class="top-bar">

    <input type="text"
           id="searchInput"
           class="form-control search-box"
           placeholder="Search members...">

    <div class="column-box">

        <strong>Print Columns</strong><br><br>

        <label><input type="checkbox" class="col-check" value="0" checked> SL</label>
        <label><input type="checkbox" class="col-check" value="1" checked> Name</label>
        <label><input type="checkbox" class="col-check" value="2" checked> Member Code</label>
        <label><input type="checkbox" class="col-check" value="3" checked> Phone</label>
        <label><input type="checkbox" class="col-check" value="4" checked> Joining Date</label>
        <label><input type="checkbox" class="col-check" value="5" checked> Total Paid</label>
        <label><input type="checkbox" class="col-check" value="6" checked> Total Due</label>
        <label><input type="checkbox" class="col-check" value="7" > Image</label>
        <label><input type="checkbox" class="col-check" value="8" > Action</label>

        <br><br>

        <button class="btn btn-danger btn-sm" onclick="printSelectedColumns()">
            Print
        </button>

    </div>

</div>


<table class="table table-bordered table-striped" id="memberTable">

<thead>
<tr>
    <th>SL</th>
    <th>Name</th>
    <th>Member Code</th>
    <th>Phone</th>
    <th>Joining Date</th>
    <th>Total Paid</th>
    <th>Total Due</th>
    <th>Image</th>
    <th>Action</th>
</tr>
</thead>

<tbody id="tableBody">

@php
    $i = 1;
@endphp

@foreach($members as $member)

@php

    $paid = \App\Models\Subscription::where('user_id', $member->user_id)
                ->where('status', 1)
                ->sum('amount');

    $due = \App\Models\Subscription::where('user_id', $member->user_id)
                ->where('status', 0)
                ->sum('amount');

@endphp

<tr>

<td>{{ $i++ }}</td>

<td>{{ $member->user->name ?? 'N/A' }}</td>

<td>{{ $member->member_code ?? 'M-'.$member->id }}</td>

<td>{{ $member->user->phone ?? 'N/A' }}</td>

<td>{{ $member->joining_date }}</td>

<td>
    <span style="display:block; text-align:center;">
        {{ $paid }}
    </span>
</td>

<td>
    <span style="display:block; text-align:center;">
        {{ $due }}
    </span>
</td>

<td>
    @if(!empty($member->image))
        <img src="{{ asset($member->image) }}" class="member-img">
    @else
        <img src="{{ asset('assets/admin/profile.png') }}" class="member-img">
    @endif
</td>

<td>
    <button class="btn btn-success btn-xs openPayPopup"
        data-user="{{ $member->user_id }}"
        data-name="{{ $member->user->name ?? 'N/A' }}"
        data-image="{{ $member->user->image ?? '' }}">
        Pay
    </button>
</td>

</tr>

@endforeach

</tbody>

</table>


<!-- NEW INFO -->
<div class="entry-info" id="entryInfo"></div>
<div class="pagination-box" id="pagination"></div>

</section>
</div>


<!-- ================= POPUP ================= -->
<div class="overlay" id="payPopup">

    <div class="popup-box">

        <h4>Collect Payment</h4>

        <div class="member-box">
            <img id="memberImage" src="">
            <strong id="memberName"></strong>
        </div>

        <form method="POST" action="{{ route('subscription.pay') }}">
            @csrf

            <input type="hidden" name="user_id" id="user_id">

            <div>
                <strong>Due Months:</strong>
                <div id="duePreview">Loading...</div>
            </div>

            <div style="margin-top:10px;">
                <label>Payment Months</label>
                <input type="number" name="months" class="form-control" min="1" required>
            </div>

            <div style="margin-top:10px;">
                <label>Payment Date</label>
                <input type="date"
                       name="payment_date"
                       class="form-control"
                       value="{{ date('Y-m-d') }}"
                       required>
            </div>

            <div class="btn-row">
                <button type="button" class="btn btn-danger" onclick="closePayPopup()">Cancel</button>
                <button type="submit" class="btn btn-success">Confirm</button>
            </div>

        </form>

    </div>

</div>


<!-- ================= SCRIPT ================= -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

const rowsPerPage = 100;

const tbody = document.getElementById("tableBody");
const rows = Array.from(tbody.querySelectorAll("tr"));

const searchInput = document.getElementById("searchInput");
const pagination = document.getElementById("pagination");
const entryInfo = document.getElementById("entryInfo");

let filteredRows = [...rows];
let currentPage = 1;


function renderTable(){

    rows.forEach(r => r.style.display = "none");

    let start = (currentPage - 1) * rowsPerPage;
    let end = start + rowsPerPage;

    filteredRows.slice(start, end).forEach(r => r.style.display = "");

    updateInfo(start, end);
    createPagination();
}


function updateInfo(start, end){

    let total = filteredRows.length;

    let from = total === 0 ? 0 : start + 1;
    let to = end > total ? total : end;

    entryInfo.innerHTML =
        `Showing ${from} to ${to} of ${total} entries`;
}


function createPagination(){

    pagination.innerHTML = "";

    let pages = Math.ceil(filteredRows.length / rowsPerPage);

    for(let i=1;i<=pages;i++){

        let btn = document.createElement("button");

        btn.innerText = i;

        if(i === currentPage) btn.classList.add("active");

        btn.onclick = () => {
            currentPage = i;
            renderTable();
        };

        pagination.appendChild(btn);
    }
}


searchInput.addEventListener("keyup", function(){

    let val = this.value.toLowerCase();

    filteredRows = rows.filter(r =>
        r.innerText.toLowerCase().includes(val)
    );

    currentPage = 1;

    renderTable();
});


// PRINT
function printSelectedColumns(){

    let selected = [];

    document.querySelectorAll(".col-check:checked")
    .forEach(e => selected.push(parseInt(e.value)));

    let table = document.getElementById("memberTable");

    let html = `
    <html>
    <head>
    <style>
        body{font-family:Arial;padding:20px;}
        table{width:100%;border-collapse:collapse;}
        th,td{border:1px solid #000;padding:6px;text-align:center;}
    </style>
    </head>
    <body>
    <h3 style="text-align:center;">Members Payment</h3>
    <table>
    <thead><tr>`;

    table.querySelectorAll("thead th").forEach((th,i)=>{
        if(selected.includes(i)){
            html += `<th>${th.innerText}</th>`;
        }
    });

    html += `</tr></thead><tbody>`;

    filteredRows.forEach(row=>{
        if(row.style.display !== "none"){

            html += `<tr>`;

            row.querySelectorAll("td").forEach((td,i)=>{
                if(selected.includes(i)){
                    html += `<td>${td.innerText}</td>`;
                }
            });

            html += `</tr>`;
        }
    });

    html += `</tbody></table></body></html>`;


    let iframe = document.createElement("iframe");
    iframe.style.display = "none";
    document.body.appendChild(iframe);

    let doc = iframe.contentWindow.document;
    doc.open();
    doc.write(html);
    doc.close();

    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    setTimeout(()=>{
        document.body.removeChild(iframe);
    }, 800);
}


// INIT
renderTable();


// ================= POPUP =================
$(document).on('click', '.openPayPopup', function(){

    let userId = $(this).data('user');
    let name = $(this).data('name');
    let image = $(this).data('image');

    $('#user_id').val(userId);
    $('#memberName').text(name);

    if(image){
        $('#memberImage').attr('src', image);
    } else {
        $('#memberImage').attr('src', '/assets/admin/profile.png');
    }

    $('#payPopup').show();

    $('#duePreview').html('Loading...');

    $.get('/admin/subscription/due-list/' + userId, function(res){

        let html = "";

        if(res.length === 0){
            html = "<span style='color:green'>No Due</span>";
        } else {
            res.forEach(function(item){
                html += item.month_label + " - " + item.due_date + "<br>";
            });
        }

        $('#duePreview').html(html);
    });

});

function closePayPopup(){
    $('#payPopup').hide();
}

</script>

@endsection