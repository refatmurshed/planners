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

.total-col{
    font-weight:bold;
    background:#f2f2f2;
}

/* ================= TOP BAR STYLE ================= */
.top-bar{
    display:flex;
    justify-content:flex-end;
    margin-bottom:10px;
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
    width:500px;
    max-width:95%;
    margin:50px auto;
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

.month-list{
    margin-top:10px;
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

    #printArea, #printArea *{
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
    <h1>Subscription Report</h1>

    <!-- ONLY ONE PRINT BUTTON -->
    <button class="btn btn-primary" onclick="window.print()">
        Print
    </button>
</section>

<section class="content container-fluid">

<!-- ================= COLUMN BOX ================= -->
<div class="top-bar no-print">

    <div class="column-box">

        <strong>Print Columns</strong>

        <label><input type="checkbox" class="col-check" value="0" checked> SL</label>
        <label><input type="checkbox" class="col-check" value="1" checked> Member Name</label>
        <label><input type="checkbox" class="col-check" value="2" checked> Member ID</label>
        <label><input type="checkbox" class="col-check" value="3" checked> Phone</label>
        <label><input type="checkbox" class="col-check" value="4" checked> Total Paid</label>
        <label><input type="checkbox" class="col-check" value="5" checked> Total Due</label>

        <br><br>

        <button class="btn btn-danger btn-sm" onclick="printSelectedColumns()">
            Print Selected
        </button>

    </div>

</div>

<!-- ================= PRINT AREA ================= -->
<div id="printArea">

<div style="text-align:center;margin-bottom:10px;">
    <h3>PLANNERS & DESIGNERS ASSOCIATION</h3>
    <small>Subscription Report</small>
</div>

<table id="reportTable" style="width:100%;border-collapse:collapse;">

<thead>
<tr>
    <th>SL</th>
    <th>Member Name</th>
    <th>Member ID</th>
    <th>Phone</th>
    <th>Total Paid</th>
    <th>Total Due</th>
    <th class="no-print">Action</th>
</tr>
</thead>

<tbody>

@php
$sl = 1;
$grandPaid = 0;
$grandDue = 0;

/* SORT BY LAST DIGIT */
$membersSorted = $members->sortBy(function($m){
    preg_match('/(\d+)$/', $m->member_code, $match);
    return isset($match[1]) ? (int)$match[1] : 0;
});
@endphp

@foreach($membersSorted as $member)

@php
$paid = 0;
$due = 0;

$subs = \App\Models\Subscription::where('user_id', $member->user_id)->get();

foreach($subs as $s){
    if($s->status == 1){
        $paid += $s->amount;
    } else {
        $due += $s->amount;
    }
}

$grandPaid += $paid;
$grandDue += $due;
@endphp

<tr>

    <td>{{ $sl++ }}</td>
    <td class="member-name">{{ $member->user->name ?? 'N/A' }}</td>
    <td>{{ $member->member_code ?? 'N/A' }}</td>
    <td>{{ $member->user->phone ?? 'N/A' }}</td>
    <td class="paid">{{ $paid }}</td>
    <td class="due">{{ $due }}</td>

    <td class="no-print">
        <button
            class="btn btn-info btn-xs"
            onclick="openMemberModal(
                '{{ $member->user->name ?? 'N/A' }}',
                '{{ $member->member_code ?? 'N/A' }}',
                '{{ $paid }}',
                '{{ $due }}',
                `@foreach($subs as $sub)
                    <tr>
                        <td>{{ $sub->month ?? '-' }}</td>
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
    <th colspan="4">TOTAL</th>
    <th class="paid">{{ $grandPaid }}</th>
    <th class="due">{{ $grandDue }}</th>
    <th class="no-print"></th>
</tr>
</tfoot>

</table>

</div>

</section>
</div>

<!-- ================= MODAL ================= -->
<div id="memberModal" class="custom-modal">

    <div class="custom-modal-content">

        <span class="close-modal" onclick="closeMemberModal()">
            &times;
        </span>

        <h3 style="margin-top:0;">Member Subscription Details</h3>

        <table style="width:100%;margin-bottom:15px;">
            <tr>
                <th style="width:150px;">Member Name</th>
                <td id="modalMemberName"></td>
            </tr>

            <tr>
                <th>Member ID</th>
                <td id="modalMemberId"></td>
            </tr>

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

            <h4>Month List</h4>

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

/* ================= MODAL ================= */
function openMemberModal(name,id,paid,due,months){

    document.getElementById('modalMemberName').innerText = name;
    document.getElementById('modalMemberId').innerText = id;
    document.getElementById('modalPaid').innerText = paid;
    document.getElementById('modalDue').innerText = due;
    document.getElementById('modalMonthList').innerHTML = months;

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

/* ================= PRINT SELECTED COLUMNS ================= */
function printSelectedColumns(){

    let selected = [];
    document.querySelectorAll(".col-check:checked")
    .forEach(e => selected.push(parseInt(e.value)));

    let table = document.getElementById("reportTable");

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

    <h3 style="text-align:center;">Subscription Report</h3>

    <table>
    <thead><tr>`;

    table.querySelectorAll("thead th").forEach((th,i)=>{
        if(selected.includes(i)){
            html += `<th>${th.innerText}</th>`;
        }
    });

    html += `</tr></thead><tbody>`;

    /* BODY */
    table.querySelectorAll("tbody tr").forEach(row=>{
        html += `<tr>`;
        row.querySelectorAll("td").forEach((td,i)=>{
            if(selected.includes(i)){
                html += `<td>${td.innerText}</td>`;
            }
        });
        html += `</tr>`;
    });

    /* FOOTER FIX (TOTAL INCLUDED) */
    let footer = table.querySelector("tfoot tr");

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
    iframe.style.position="fixed";
    iframe.style.width="0";
    iframe.style.height="0";
    document.body.appendChild(iframe);

    let doc = iframe.contentWindow.document;
    doc.open();
    doc.write(html);
    doc.close();

    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    setTimeout(()=>document.body.removeChild(iframe), 500);
}

</script>

@endsection