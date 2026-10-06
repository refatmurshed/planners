@extends('admin.layout')

@section('content')

<style>

th, td {
    text-align:center;
    font-size:12px;
    border:1px solid #000 !important;
    padding:5px;
}

.member-name{
    text-align:left !important;
}

.paid { color:#28a745; font-weight:bold; }
.due { color:#dc3545; font-weight:bold; }
.total-text { color:#000; font-weight:bold; }

.top-actions{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    margin-bottom:15px;
    flex-wrap:wrap;
}

.report-buttons button{
    margin-right:10px;
}

.column-box{
    background:#f8f8f8;
    border:1px solid #ddd;
    padding:12px;
    border-radius:8px;
    width:320px;
}

.column-box strong{
    display:block;
    margin-bottom:10px;
    font-size:14px;
}

.column-box label{
    display:inline-block;
    margin-right:10px;
    font-size:13px;
    margin-bottom:5px;
}

/* MODAL */
.custom-modal{
    display:none;
    position:fixed;
    z-index:9999;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
}

.custom-modal-content{
    background:#fff;
    width:700px;
    max-width:95%;
    margin:40px auto;
    border-radius:8px;
    padding:20px;
    position:relative;
}

.close-modal{
    position:absolute;
    right:15px;
    top:10px;
    font-size:22px;
    cursor:pointer;
    font-weight:bold;
}

.member-box{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:15px;
}

.member-box img{
    width:70px;
    height:70px;
    border-radius:50%;
    object-fit:cover;
    border:1px solid #ddd;
}

.month-list table{
    width:100%;
    border-collapse:collapse;
}

.month-list th,
.month-list td{
    border:1px solid #ccc !important;
    padding:6px;
    font-size:12px;
}

/* PRINT */
@media print {

    body *{
        visibility:hidden;
    }

    #printArea,
    #printArea *{
        visibility:visible;
    }

    #printArea{
        position:absolute;
        left:0;
        top:0;
        width:100%;
        padding:10px;
    }

    .no-print{
        display:none !important;
    }

    .custom-modal{
        display:none !important;
    }

    table{
        width:100% !important;
        border-collapse:collapse !important;
    }
}

</style>

<div class="content-wrapper">

<section class="content-header no-print">
    <h1>Custom Subscription Report</h1>
</section>

<section class="content container-fluid">

<!-- TOP -->
<div class="top-actions no-print">

    <div class="report-buttons">

        <button class="btn btn-primary" onclick="showYearTable()">
            This Year
        </button>

        <button class="btn btn-success" onclick="showMonthTable()">
            This Month
        </button>

      

    </div>

    <!-- COLUMN BOX -->
    <div class="column-box">

        <strong>Print Columns</strong>

        <label><input type="checkbox" class="col-check" value="0" checked> SL</label>
        <label><input type="checkbox" class="col-check" value="1" checked> Name</label>
        <label><input type="checkbox" class="col-check" value="2" checked> ID</label>
        <label><input type="checkbox" class="col-check" value="3" checked> Paid</label>
        <label><input type="checkbox" class="col-check" value="4" checked> Due</label>
        <label><input type="checkbox" class="col-check" value="5" checked> Total</label>

        <br><br>

        <button class="btn btn-danger btn-sm" onclick="printSelectedColumns()">
            Print Selected
        </button>

    </div>

</div>

<!-- PRINT AREA -->
<div id="printArea">

<div style="text-align:center;margin-bottom:15px;">
    <h3>PLANNERS & DESIGNERS ASSOCIATION</h3>

    <h4 id="reportTitle">
        This Year Subscription Report
    </h4>
</div>

<!-- YEAR TABLE -->
<table id="yearTable" style="width:100%;border-collapse:collapse;">

<thead>
<tr>
    <th>SL</th>
    <th>Name</th>
    <th>ID</th>
    <th>Paid</th>
    <th>Due</th>
    <th>Total</th>
    <th class="no-print">Action</th>
</tr>
</thead>

<tbody>

@php
$sl=1;
$yearPaidTotal=0;
$yearDueTotal=0;
@endphp

@foreach($members as $member)

@php

$yearPaid = 0;
$yearDue = 0;

$subs = \App\Models\Subscription::where('user_id',$member->user_id)
->whereYear('due_date', date('Y'))
->get();

foreach($subs as $sub){

    if($sub->status == 1){
        $yearPaid += $sub->amount;
    }else{
        $yearDue += $sub->amount;
    }
}

$total = $yearPaid + $yearDue;

$yearPaidTotal += $yearPaid;
$yearDueTotal += $yearDue;

@endphp

<tr>

    <td>{{ $sl++ }}</td>

    <td class="member-name">
        {{ $member->user->name ?? 'N/A' }}
    </td>

    <td>
        {{ $member->member_code ?? 'N/A' }}
    </td>

    <td class="paid">
        {{ $yearPaid }}
    </td>

    <td class="due">
        {{ $yearDue }}
    </td>

    <td class="total-text">
        {{ $total }}
    </td>

    <td class="no-print">

        <button
            class="btn btn-info btn-xs"
            onclick="openMemberModal(
                '{{ $member->user->name ?? 'N/A' }}',
                '{{ $member->member_code ?? 'N/A' }}',
                '{{ $member->user->image ?? '' }}',
                '{{ $yearPaid }}',
                '{{ $yearDue }}',

                `@foreach($subs as $sub)
                    <tr>
                        <td>{{ $sub->month_label ?? '-' }}</td>
                        <td>{{ $sub->amount }}</td>

                        <td>
                            @if($sub->status == 1)
                                Paid
                            @else
                                Due
                            @endif
                        </td>
                    </tr>
                @endforeach`
            )"
        >
            View
        </button>

    </td>

</tr>

@endforeach

</tbody>

<tfoot>
<tr>

    <th colspan="3">
        TOTAL
    </th>

    <th class="paid">
        {{ $yearPaidTotal }}
    </th>

    <th class="due">
        {{ $yearDueTotal }}
    </th>

    <th class="total-text">
        {{ $yearPaidTotal + $yearDueTotal }}
    </th>

    <th class="no-print"></th>

</tr>
</tfoot>

</table>

<!-- MONTH TABLE -->
<table id="monthTable" style="width:100%;border-collapse:collapse;display:none;">

<thead>
<tr>
    <th>SL</th>
    <th>Name</th>
    <th>ID</th>
    <th>Paid</th>
    <th>Due</th>
    <th>Total</th>
    <th class="no-print">Action</th>
</tr>
</thead>

<tbody>

@php
$sl2=1;
$monthPaidTotal=0;
$monthDueTotal=0;
@endphp

@foreach($members as $member)

@php

$monthPaid = 0;
$monthDue = 0;

$monthSubs = \App\Models\Subscription::where('user_id',$member->user_id)
->whereMonth('due_date', date('m'))
->whereYear('due_date', date('Y'))
->get();

foreach($monthSubs as $sub){

    if($sub->status == 1){
        $monthPaid += $sub->amount;
    }else{
        $monthDue += $sub->amount;
    }
}

$monthTotal = $monthPaid + $monthDue;

$monthPaidTotal += $monthPaid;
$monthDueTotal += $monthDue;

@endphp

<tr>

    <td>{{ $sl2++ }}</td>

    <td class="member-name">
        {{ $member->user->name ?? 'N/A' }}
    </td>

    <td>
        {{ $member->member_code ?? 'N/A' }}
    </td>

    <td class="paid">
        {{ $monthPaid }}
    </td>

    <td class="due">
        {{ $monthDue }}
    </td>

    <td class="total-text">
        {{ $monthTotal }}
    </td>

    <td class="no-print">

        <button
            class="btn btn-info btn-xs"
            onclick="openMemberModal(
                '{{ $member->user->name ?? 'N/A' }}',
                '{{ $member->member_code ?? 'N/A' }}',
                '{{ $member->user->image ?? '' }}',
                '{{ $monthPaid }}',
                '{{ $monthDue }}',

                `@foreach($monthSubs as $sub)
                    <tr>
                        <td>{{ $sub->month_label ?? '-' }}</td>
                        <td>{{ $sub->amount }}</td>

                        <td>
                            @if($sub->status == 1)
                                Paid
                            @else
                                Due
                            @endif
                        </td>
                    </tr>
                @endforeach`
            )"
        >
            View
        </button>

    </td>

</tr>

@endforeach

</tbody>

<tfoot>
<tr>

    <th colspan="3">
        TOTAL
    </th>

    <th class="paid">
        {{ $monthPaidTotal }}
    </th>

    <th class="due">
        {{ $monthDueTotal }}
    </th>

    <th class="total-text">
        {{ $monthPaidTotal + $monthDueTotal }}
    </th>

    <th class="no-print"></th>

</tr>
</tfoot>

</table>

</div>

</section>
</div>

<!-- MODAL -->
<div id="memberModal" class="custom-modal">

    <div class="custom-modal-content">

        <span class="close-modal" onclick="closeMemberModal()">
            ×
        </span>

        <h3>Member Details</h3>

        <div class="member-box">

            <img id="modalImage" src="">

            <div>
                <div>
                    <strong id="modalMemberName"></strong>
                </div>

                <div>
                    ID :
                    <span id="modalMemberId"></span>
                </div>
            </div>

        </div>

        <table style="width:100%;margin-bottom:15px;">

            <tr>
                <th>Total Paid</th>
                <td class="paid" id="modalPaid"></td>
            </tr>

            <tr>
                <th>Total Due</th>
                <td class="due" id="modalDue"></td>
            </tr>

        </table>

        <div class="month-list">

            <h4>Payment List</h4>

            <table>

                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="modalMonthList"></tbody>

            </table>

        </div>

    </div>

</div>

<script>

/* YEAR */
function showYearTable(){

    document.getElementById('yearTable').style.display = 'table';
    document.getElementById('monthTable').style.display = 'none';

    document.getElementById('reportTitle').innerText =
    'This Year Subscription Report';
}

/* MONTH */
function showMonthTable(){

    document.getElementById('yearTable').style.display = 'none';
    document.getElementById('monthTable').style.display = 'table';

    document.getElementById('reportTitle').innerText =
    'This Month Subscription Report';
}

/* MODAL */
function openMemberModal(name,id,image,paid,due,months){

    document.getElementById('modalMemberName').innerText = name;
    document.getElementById('modalMemberId').innerText = id;
    document.getElementById('modalPaid').innerText = paid;
    document.getElementById('modalDue').innerText = due;
    document.getElementById('modalMonthList').innerHTML = months;

    if(image){
        document.getElementById('modalImage').src = image;
    }else{
        document.getElementById('modalImage').src =
        'https://via.placeholder.com/70';
    }

    document.getElementById('memberModal').style.display = 'block';
}

function closeMemberModal(){
    document.getElementById('memberModal').style.display = 'none';
}

window.onclick = function(event){

    let modal = document.getElementById('memberModal');

    if(event.target == modal){
        modal.style.display = 'none';
    }
}

/* PRINT SELECTED */
function printSelectedColumns(){

    let selected = [];

    document.querySelectorAll(".col-check:checked")
    .forEach(e => selected.push(parseInt(e.value)));

    let activeTable =
    document.getElementById('yearTable').style.display == 'none'
    ? document.getElementById('monthTable')
    : document.getElementById('yearTable');

    let title =
    document.getElementById('reportTitle').innerText;

    let html = `
    <html>
    <head>
    <style>
        body{font-family:Arial;padding:20px;}
        table{width:100%;border-collapse:collapse;}
        th,td{
            border:1px solid #000;
            padding:6px;
            text-align:center;
        }
    </style>
    </head>
    <body>

    <div style="text-align:center;margin-bottom:10px;">
        <h2>PLANNERS & DESIGNERS ASSOCIATION</h2>
        <h4>${title}</h4>
    </div>

    <table>

    <thead>
    <tr>`;

    activeTable.querySelectorAll("thead th").forEach((th,i)=>{

        if(selected.includes(i)){
            html += `<th>${th.innerText}</th>`;
        }
    });

    html += `</tr></thead><tbody>`;

    activeTable.querySelectorAll("tbody tr").forEach(row=>{

        html += `<tr>`;

        row.querySelectorAll("td").forEach((td,i)=>{

            if(selected.includes(i)){
                html += `<td>${td.innerText}</td>`;
            }
        });

        html += `</tr>`;
    });

    let footer = activeTable.querySelector("tfoot tr");

    if(footer){

        html += `<tr>`;

        footer.querySelectorAll("th,td").forEach((td,i)=>{

            if(selected.includes(i)){
                html += `<td><b>${td.innerText}</b></td>`;
            }
        });

        html += `</tr>`;
    }

    html += `
    </tbody>
    </table>
    </body>
    </html>`;

    let iframe = document.createElement("iframe");

    iframe.style.position = "fixed";
    iframe.style.width = "0";
    iframe.style.height = "0";

    document.body.appendChild(iframe);

    let doc = iframe.contentWindow.document;

    doc.open();
    doc.write(html);
    doc.close();

    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    setTimeout(() => {
        document.body.removeChild(iframe);
    }, 500);
}

</script>

@endsection