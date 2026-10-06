@extends('admin.layout')

@section('content')

<style>

th, td{
    text-align:center;
    vertical-align:middle;
}

.badge-approved{
    background:green;
    color:white;
    padding:5px 10px;
    border-radius:10px;
}

.overlay{
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.6);
    display:none;
    z-index:9999;
}

.popup-box{
    width:400px;
    background:white;
    margin:100px auto;
    padding:20px;
    border-radius:8px;
}

.btn-row{
    text-align:right;
    margin-top:15px;
}

/* NEW */

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    margin-bottom:15px;
    flex-wrap:wrap;
}

.search-box{
    width:300px;
}

.column-box{
    border:1px solid #ddd;
    padding:10px;
    border-radius:5px;
    background:#fafafa;
}

.column-box label{
    margin-right:10px;
    display:inline-block;
}

.pagination-box{
    text-align:center;
    margin-top:15px;
}

.pagination-box button{
    border:none;
    padding:6px 12px;
    margin:2px;
    border-radius:4px;
    background:#007bff;
    color:white;
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
        <h1>Users List</h1>
    </section>

    <section class="content container-fluid">

        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
        @endif

        <!-- TOP BAR -->

        <div class="top-bar">

            <div>

                <input type="text"
                       id="searchInput"
                       class="form-control search-box"
                       placeholder="Search anything...">

            </div>

            <!-- COLUMN SELECT -->

            <div class="column-box">

                <strong>Select Print Columns</strong>
                <br><br>

                <label>
                    <input type="checkbox" class="print-column" value="0" checked>
                    SL
                </label>

                <label>
                    <input type="checkbox" class="print-column" value="1" checked>
                    Name
                </label>

                <label>
                    <input type="checkbox" class="print-column" value="2" checked>
                    User ID
                </label>

                <label>
                    <input type="checkbox" class="print-column" value="3" checked>
                    Email
                </label>

                <label>
                    <input type="checkbox" class="print-column" value="4" checked>
                    Category
                </label>

                <label>
                    <input type="checkbox" class="print-column" value="5" checked>
                    Status
                </label>

                <label>
                    <input type="checkbox" class="print-column" value="6">
                    Action
                </label>

                <br><br>

                <button onclick="printSelectedColumns()"
                        class="btn btn-danger btn-sm">
                    Print Table
                </button>

            </div>

        </div>

        <!-- TABLE -->

        <table class="table table-bordered table-striped"
               id="userTable">

            <thead>

                <tr>

                    <th>SL</th>
                    <th>Name</th>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody id="tableBody">

                @php $i=1; @endphp

                @foreach($users as $user)

                <tr>

                    <td>{{ $i++ }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->id }}</td>

                    <td>{{ $user->email }}</td>

                    <td>

    @if($user->status == 0)

        Member

    @elseif($user->status == 1)

        Admin

    @else

        Others

    @endif

</td>

                    <td>

                        @if($user->status == 1)

                            <span class="badge-approved">
                                Approved
                            </span>

                        @else

                            <button class="btn btn-warning btn-xs openPopup"
                                    data-id="{{ $user->id }}">
                                Pending
                            </button>

                        @endif

                    </td>

                    <td>

                        <button class="btn btn-info btn-xs">
                            View
                        </button>

                        <button class="btn btn-primary btn-xs">
                            Edit
                        </button>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <!-- ENTRY INFO -->

        <div class="entry-info" id="entryInfo"></div>

        <!-- PAGINATION -->

        <div class="pagination-box"
             id="pagination"></div>

    </section>
</div>


<!-- CUSTOM POPUP -->

<div class="overlay" id="popup">

    <div class="popup-box">

        <h4>Approve User</h4>

        <form method="POST"
              id="approveForm">

            @csrf

            <label>Member ID</label>

            <input type="text"
                   name="member_id"
                   class="form-control"
                   placeholder="Enter Member ID">

            <label>Joining Date</label>

            <input type="date"
                   name="joining_date"
                   id="joining_date"
                   class="form-control"
                   value="{{ date('Y-m-d') }}">

            <div style="margin-top:10px;">

                <strong>Due Months:</strong>

                <div id="monthPreview"></div>

            </div>

            <div style="margin-top:10px;">

                <strong>Total:</strong>

                <span id="totalAmount">0</span> TK

            </div>

            <div class="btn-row">

                <button type="button"
                        class="btn btn-danger"
                        onclick="closePopup()">
                    Cancel
                </button>

                <button type="submit"
                        class="btn btn-success">
                    Confirm
                </button>

            </div>

        </form>

    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

let subscriptionAmount = {{ \App\Models\Setting::first()->subscription_amount ?? 0 }};

let userId = null;


// OPEN POPUP

$(document).on('click', '.openPopup', function(){

    userId = $(this).data('id');

    let url = "{{ route('admin.users_approve', ':id') }}";

    url = url.replace(':id', userId);

    $('#approveForm').attr('action', url);

    $('#popup').show();
});


// CLOSE POPUP

function closePopup(){

    $('#popup').hide();

    $('#monthPreview').html('');

    $('#totalAmount').text(0);
}


// CALC MONTHS

$('#joining_date').on('change', function(){

    let val = $(this).val();

    if(!val) return;

    let joinDate = new Date(val);

    let today = new Date();

    let current = new Date(
        joinDate.getFullYear(),
        joinDate.getMonth(),
        1
    );

    let preview = '';

    let count = 0;

    while(current <= today){

        let month = current.toLocaleString(
            'default',
            { month: 'long' }
        );

        let year = current.getFullYear();

        preview += month + ' ' + year + '<br>';

        count++;

        current.setMonth(current.getMonth() + 1);
    }

    $('#monthPreview').html(preview);

    $('#totalAmount').text(count * subscriptionAmount);
});



// =====================================
// SEARCH + PAGINATION
// =====================================

const rowsPerPage = 100;

const tbody = document.getElementById('tableBody');

const rows = Array.from(tbody.querySelectorAll('tr'));

const pagination = document.getElementById('pagination');

const searchInput = document.getElementById('searchInput');

const entryInfo = document.getElementById('entryInfo');

let filteredRows = [...rows];

let currentPage = 1;


// DISPLAY ROWS

function displayRows(){

    rows.forEach(row => row.style.display = 'none');

    let start = (currentPage - 1) * rowsPerPage;

    let end = start + rowsPerPage;

    filteredRows.slice(start, end).forEach(row => {
        row.style.display = '';
    });

    updateEntryInfo(start, end);

    createPagination();
}


// ENTRY INFO

function updateEntryInfo(start, end){

    let total = filteredRows.length;

    let from = total === 0 ? 0 : start + 1;

    let to = end > total ? total : end;

    entryInfo.innerHTML =
        `Showing ${from} to ${to} from ${total} entries`;
}


// CREATE PAGINATION

function createPagination(){

    pagination.innerHTML = '';

    let totalPages =
        Math.ceil(filteredRows.length / rowsPerPage);

    for(let i = 1; i <= totalPages; i++){

        let btn = document.createElement('button');

        btn.innerText = i;

        if(i === currentPage){
            btn.classList.add('active');
        }

        btn.addEventListener('click', function(){

            currentPage = i;

            displayRows();
        });

        pagination.appendChild(btn);
    }
}


// SEARCH

searchInput.addEventListener('keyup', function(){

    let value = this.value.toLowerCase();

    filteredRows = rows.filter(row =>
        row.innerText.toLowerCase().includes(value)
    );

    currentPage = 1;

    displayRows();
});


// INITIAL

displayRows();



// =====================================
// PRINT SELECTED COLUMNS
// =====================================

function printSelectedColumns(){

    let checkedColumns = [];

    document.querySelectorAll('.print-column:checked')
        .forEach(el => {
            checkedColumns.push(parseInt(el.value));
        });

    let table = document.getElementById('userTable');

    let html = `
        <html>
        <head>

            <title>Users List</title>

            <style>

                body{
                    font-family:Arial;
                    padding:20px;
                }

                table{
                    width:100%;
                    border-collapse:collapse;
                }

                th, td{
                    border:1px solid #000;
                    padding:8px;
                    text-align:center;
                }

            </style>

        </head>

        <body>

        <h2 style="text-align:center;">
            Users List
        </h2>

        <table>

            <thead>
                <tr>
    `;

    table.querySelectorAll('thead th').forEach((th, index) => {

        if(checkedColumns.includes(index)){

            html += `<th>${th.innerText}</th>`;
        }
    });

    html += `</tr></thead><tbody>`;


    filteredRows.forEach(row => {

        if(row.style.display !== 'none'){

            html += `<tr>`;

            row.querySelectorAll('td').forEach((td, index) => {

                if(checkedColumns.includes(index)){

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


    // HIDDEN IFRAME PRINT
    let iframe = document.createElement('iframe');

    iframe.style.position = 'fixed';
    iframe.style.right = '0';
    iframe.style.bottom = '0';
    iframe.style.width = '0';
    iframe.style.height = '0';
    iframe.style.border = '0';

    document.body.appendChild(iframe);

    let doc = iframe.contentWindow.document;

    doc.open();

    doc.write(html);

    doc.close();

    iframe.contentWindow.focus();

    iframe.contentWindow.print();

    setTimeout(() => {
        document.body.removeChild(iframe);
    }, 1000);
}

</script>

@endsection