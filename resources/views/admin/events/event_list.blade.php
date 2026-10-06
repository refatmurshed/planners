@extends('admin.layout')

@section('content')

<style>
th, td { text-align:center; }

.event-img {
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:5px;
    border:1px solid #ddd;
}

/* ================= NEW FEATURE UI ================= */

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
    padding:5px 10px;
    margin:2px;
    background:#007bff;
    color:#fff;
    border-radius:4px;
}

.pagination-box button.active{
    background:#28a745;
}

.entry-info{
    margin-top:10px;
    font-weight:bold;
}

</style>

<div class="content-wrapper">

<section class="content-header">
    <h1>Event List</h1>

    <a href="{{ route('event.create') }}" class="btn btn-primary">
        Add Event
    </a>
</section>

<section class="content container-fluid">

@if(Session::has('success'))
    <div class="alert alert-success text-center">
        {{ Session::get('success') }}
    </div>
@endif


<!-- ================= NEW TOP BAR ================= -->
<div class="top-bar">

    <input type="text"
           id="searchInput"
           class="form-control search-box"
           placeholder="Search events...">

    <div class="column-box">

        <strong>Print Columns</strong><br><br>

        <label><input type="checkbox" class="col-check" value="0" checked> SL</label>
        <label><input type="checkbox" class="col-check" value="1" checked> Image</label>
        <label><input type="checkbox" class="col-check" value="2" checked> Name</label>
        <label><input type="checkbox" class="col-check" value="3" checked> Date</label>
        <label><input type="checkbox" class="col-check" value="4" checked> Last Reg.</label>
        <label><input type="checkbox" class="col-check" value="5" checked> Fee</label>
        <label><input type="checkbox" class="col-check" value="6" checked> Description</label>

        <br><br>

        <button class="btn btn-danger btn-sm" onclick="printSelectedColumns()">
            Print
        </button>

    </div>

</div>


<div class="box box-solid">
<div class="box-body">

<table class="table table-bordered table-striped" id="eventTable">

<thead>
<tr>
    <th>SL</th>
    <th>Image</th>
    <th>Name</th>
    <th>Date</th>
    <th>Last Reg.</th>
    <th>Fee</th>
    <th>Description</th>
</tr>
</thead>

<tbody id="tableBody">

@php $i = 1; @endphp

@foreach($events as $event)

<tr>

<td>{{ $i++ }}</td>

<td>
    @if($event->image)
        <img src="{{ asset($event->image) }}" class="event-img">
    @else
        <img src="{{ asset('assets/admin/profile.png') }}" class="event-img">
    @endif
</td>

<td>{{ $event->name }}</td>

<td>{{ $event->event_date }}</td>

<td>{{ $event->last_registration_date }}</td>

<td>{{ $event->min_fee }}</td>

<td>{{ $event->description }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>
</div>


<!-- ================= NEW INFO ================= -->
<div class="entry-info" id="entryInfo"></div>
<div class="pagination-box" id="pagination"></div>

</section>

</div>


<!-- ================= SCRIPT ================= -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

/* ================= TABLE ENGINE ================= */

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


/* ================= PRINT ================= */

function printSelectedColumns(){

    let selected = [];

    document.querySelectorAll(".col-check:checked")
    .forEach(e => selected.push(parseInt(e.value)));

    let table = document.getElementById("eventTable");

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
    <h3 style="text-align:center;">Event List</h3>
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

</script>

@endsection