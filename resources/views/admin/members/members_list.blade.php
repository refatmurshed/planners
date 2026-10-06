@extends('admin.layout')

@section('content')

<style>
th {
    text-align: center;
}

.member-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #ddd;
}

.badge-approved {
    background: #28a745;
    color: #fff;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 12px;
}

/* ================= TOP BAR ================= */
.top-bar{
    display:flex;
    justify-content:flex-end;
    margin-bottom:15px;
}

.column-box{
    border:1px solid #ddd;
    padding:10px;
    border-radius:6px;
    background:#f8f8f8;
}

.column-box label{
    margin-right:10px;
    font-size:13px;
}

/* ================= POPUP ================= */
.overlay{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.6);
    display:none;
    z-index:99999;
    overflow:auto;
}

.popup-box{
    width:400px;
    background:#fff;
    margin:70px auto;
    padding:25px;
    border-radius:10px;
    position:relative;
}

.popup-member-img{
    width:100px;
    height:100px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #eee;
    display:block;
    margin:0 auto 15px;
}

.popup-title{
    text-align:center;
    margin-bottom:20px;
}

.info-row{
    margin-bottom:12px;
    font-size:15px;
}

.info-row strong{
    display:inline-block;
    width:120px;
}

.close-btn{
    position:absolute;
    top:10px;
    right:15px;
    font-size:22px;
    cursor:pointer;
    color:red;
}

.amount-paid{
    color:#28a745;
    font-weight:bold;
}

.amount-due{
    color:#dc3545;
    font-weight:bold;
}
</style>

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">
        <h1>Members List</h1>

        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-home"></i>
                </a>
                Members List
            </li>
        </ol>
    </section>

    <!-- CONTENT -->
    <section class="content container-fluid">

        <!-- PRINT OPTION -->
        <div class="top-bar">

            <div class="column-box">

                <strong>Print Columns</strong>
                <br><br>

                <label>
                    <input type="checkbox" class="col-check" value="0" checked>
                    SL
                </label>

                <label>
                    <input type="checkbox" class="col-check" value="1" checked>
                    Name
                </label>

                <label>
                    <input type="checkbox" class="col-check" value="2" checked>
                    Member ID
                </label>

                <label>
                    <input type="checkbox" class="col-check" value="3" checked>
                    Phone
                </label>

                <label>
                    <input type="checkbox" class="col-check" value="4" checked>
                    Joining Date
                </label>

                <label>
                    <input type="checkbox" class="col-check" value="5" checked>
                    Total Paid
                </label>

                <label>
                    <input type="checkbox" class="col-check" value="6" checked>
                    Total Due
                </label>

                <label>
                    <input type="checkbox" class="col-check" value="7" checked>
                    Image
                </label>

                <label>
                    <input type="checkbox" class="col-check" value="8" checked>
                    Action
                </label>

                <br><br>

                <button
                    class="btn btn-danger btn-sm"
                    onclick="printSelectedColumns()"
                >
                    Print
                </button>

            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="box box-solid">

                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Member ID</th>
                                    <th>Phone</th>
                                    <th>Joining Date</th>
                                    <th>Total Paid</th>
                                    <th>Total Due</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @php $i = 1; @endphp

                                @foreach($members as $member)

                                @php

                                    $paidAmount = \App\Models\Subscription::where('user_id', $member->user_id)
                                                    ->where('status', 1)
                                                    ->sum('amount');

                                    $dueAmount = \App\Models\Subscription::where('user_id', $member->user_id)
                                                    ->where('status', 0)
                                                    ->sum('amount');

                                @endphp

                                <tr>

                                    <td style="text-align:center">
                                        {{ $i }}
                                    </td>

                                    <td>
                                        {{ $member->user->name ?? 'N/A' }}
                                    </td>

                                    <td style="text-align:center">
                                        {{ $member->member_code ?? 'M-' . $member->id }}
                                    </td>

                                    <td style="text-align:center">
                                        {{ $member->phone ?? 'N/A' }}
                                    </td>

                                    <td style="text-align:center">
                                        {{ $member->joining_date }}
                                    </td>

                                    <td style="text-align:center">
                                        <span class="amount-paid">
                                             {{ number_format($paidAmount, 2) }}
                                        </span>
                                    </td>

                                    <td style="text-align:center">
                                        <span class="amount-due">
                                             {{ number_format($dueAmount, 2) }}
                                        </span>
                                    </td>

                                    <td style="text-align:center">

                                        @if(isset($member->image))
                                            <img src="{{ asset($member->image) }}" class="member-img">
                                        @else
                                            <img src="{{ asset('assets/admin/profile.png') }}" class="member-img">
                                        @endif

                                    </td>

                                    <td style="text-align:center">

                                        <button
                                            class="btn btn-info btn-xs viewBtn"

                                            data-name="{{ $member->user->name ?? 'N/A' }}"

                                            data-memberid="{{ $member->member_code ?? 'M-'.$member->id }}"

                                            data-phone="{{ $member->phone ?? 'N/A' }}"

                                            data-paid="{{ number_format($paidAmount, 2) }}"

                                            data-due="{{ number_format($dueAmount, 2) }}"

                                            data-image="@if(isset($member->image)){{ asset($member->image) }}@else{{ asset('assets/admin/profile.png') }}@endif"
                                        >
                                            View
                                        </button>

                                        <button class="btn btn-primary btn-xs">
                                            Edit
                                        </button>

                                    </td>

                                </tr>

                                @php $i++; @endphp
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>

            </div>
        </div>

    </section>

</div>


<!-- ================= VIEW POPUP ================= -->
<div class="overlay" id="viewPopup">

    <div class="popup-box">

        <span class="close-btn" onclick="closePopup()">
            ×
        </span>

        <img src="" id="popupImage" class="popup-member-img">

        <h3 class="popup-title" id="popupName"></h3>

        <div class="info-row">
            <strong>Member ID :</strong>
            <span id="popupMemberId"></span>
        </div>

        <div class="info-row">
            <strong>Phone :</strong>
            <span id="popupPhone"></span>
        </div>

        <div class="info-row">
            <strong>Total Paid :</strong>
            <span id="popupPaid" class="amount-paid"></span>
        </div>

        <div class="info-row">
            <strong>Total Due :</strong>
            <span id="popupDue" class="amount-due"></span>
        </div>

    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

/* ================= DATATABLE ================= */
$(document).ready(function(){

    setTimeout(function(){

        if($.fn.DataTable.isDataTable('#example1')){

            let table = $('#example1').DataTable();

            table.page.len(100).draw(false);

        }

    }, 300);

});


/* ================= VIEW POPUP ================= */
$(document).on('click', '.viewBtn', function(){

    let name = $(this).data('name');
    let memberId = $(this).data('memberid');
    let phone = $(this).data('phone');
    let paid = $(this).data('paid');
    let due = $(this).data('due');
    let image = $(this).data('image');

    $('#popupName').text(name);
    $('#popupMemberId').text(memberId);
    $('#popupPhone').text(phone);
    $('#popupPaid').text('TK ' + paid);
    $('#popupDue').text('TK ' + due);
    $('#popupImage').attr('src', image);

    $('#viewPopup').fadeIn();

});


/* ================= CLOSE ================= */
function closePopup(){
    $('#viewPopup').fadeOut();
}


/* ================= OUTSIDE CLICK CLOSE ================= */
$(document).mouseup(function(e){

    let popup = $(".popup-box");

    if (!popup.is(e.target) && popup.has(e.target).length === 0) {
        $('#viewPopup').fadeOut();
    }

});


/* ================= PRINT ================= */
function printSelectedColumns(){

    let selected = [];

    document.querySelectorAll(".col-check:checked")
    .forEach(el => selected.push(parseInt(el.value)));

    let table = document.getElementById("example1");

    let html = `
    <html>
    <head>
    <style>
        body{
            font-family:Arial;
            padding:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #000;
            padding:6px;
            text-align:center;
        }
    </style>
    </head>

    <body>

    <h3 style="text-align:center;">
        Members List
    </h3>

    <table>

    <thead>
    <tr>
    `;

    table.querySelectorAll("thead th").forEach((th,i)=>{

        if(selected.includes(i)){

            html += `<th>${th.innerText}</th>`;

        }

    });

    html += `</tr></thead><tbody>`;


    table.querySelectorAll("tbody tr").forEach(row => {

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

    html += `
    </tbody>
    </table>
    </body>
    </html>
    `;


    let iframe = document.createElement("iframe");

    iframe.style.position = "fixed";
    iframe.style.right = "0";
    iframe.style.bottom = "0";
    iframe.style.width = "0";
    iframe.style.height = "0";
    iframe.style.border = "0";

    document.body.appendChild(iframe);

    let doc = iframe.contentWindow.document;

    doc.open();
    doc.write(html);
    doc.close();

    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    setTimeout(() => {
        document.body.removeChild(iframe);
    }, 800);

}

</script>

@endsection