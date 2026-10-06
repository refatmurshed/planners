@extends('admin.layout')

@section('content')

<style>
th, td { text-align:center; }

.badge-approved{
    background:green;
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
    width:400px;
    background:white;
    margin:100px auto;
    padding:20px;
    border-radius:8px;
}

.btn-row {
    text-align:right;
    margin-top:15px;
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

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>User Number</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @php $i=1; @endphp
                @foreach($users as $user)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @if($user->status == 1)
                            <span class="badge-approved">Approved</span>
                        @else
                            <button class="btn btn-warning btn-xs openPopup"
                                data-id="{{ $user->id }}">
                                Pending
                            </button>
                        @endif
                    </td>

                    <td>
                        <button class="btn btn-info btn-xs">View</button>
                        <button class="btn btn-primary btn-xs">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </section>
</div>


<!-- CUSTOM POPUP -->
<div class="overlay" id="popup">

    <div class="popup-box">

        <h4>Approve User</h4>

        <form method="POST" id="approveForm">
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

                <button type="button" class="btn btn-danger" onclick="closePopup()">
                    Cancel
                </button>

                <button type="submit" class="btn btn-success">
                    Confirm
                </button>

            </div>

        </form>

    </div>

</div>


<!-- SCRIPT -->
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

    let current = new Date(joinDate.getFullYear(), joinDate.getMonth(), 1);

    let preview = '';
    let count = 0;

    while(current <= today){

        let month = current.toLocaleString('default', { month: 'long' });
        let year = current.getFullYear();

        preview += month + ' ' + year + '<br>';

        count++;
        current.setMonth(current.getMonth() + 1);
    }

    $('#monthPreview').html(preview);
    $('#totalAmount').text(count * subscriptionAmount);
});

</script>

@endsection
