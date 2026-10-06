@extends('admin.layout')

@section('content')

<style>
th, td {
    text-align: center;
}

.paid {
    color: green;
    font-weight: bold;
}

.due {
    color: red;
    font-weight: bold;
}

.member-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}
</style>

<div class="content-wrapper">

<!-- HEADER -->
<section class="content-header">
    <h1>{{ $event->name }} - Registration List</h1>

    <a href="{{ route('event.list') }}" class="btn btn-primary">
        Back
    </a>
</section>

<!-- CONTENT -->
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

<div class="box box-solid">
<div class="box-body">

<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>SL</th>
    <th>Image</th>
    <th>Name</th>
    <th>Email</th>
    <th>Fee</th>
    <th>Status</th>
    <th>Payment Date</th>
</tr>
</thead>

<tbody>

@php $i = 1; @endphp

@foreach($registrations as $reg)

<tr>

    <td>{{ $i++ }}</td>

    <!-- IMAGE -->
    <td>
        @if($reg->user->image)
            <img src="{{ asset($reg->user->image) }}" class="member-img">
        @else
            <img src="{{ asset('assets/admin/profile.png') }}" class="member-img">
        @endif
    </td>

    <!-- NAME -->
    <td>{{ $reg->user->name ?? 'N/A' }}</td>

    <!-- EMAIL -->
    <td>{{ $reg->user->email ?? 'N/A' }}</td>

    <!-- FEE -->
    <td>{{ $reg->fee }}</td>

    <!-- STATUS -->
    <td>
        @if($reg->status == 1)
            <span class="paid">Paid</span>
        @else
            <span class="due">Due</span>
        @endif
    </td>

    <!-- PAYMENT DATE -->
    <td>
        {{ $reg->payment_date ?? '-' }}
    </td>

</tr>

@endforeach

</tbody>

</table>

</div>
</div>

</section>

</div>

@endsection
