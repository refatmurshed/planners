@extends('admin.layout')

@section('content')

<div class="content-wrapper">

<section class="content-header">
    <h1>Add Sponsor</h1>
</section>

<section class="content container-fluid">

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<form action="{{ route('admin.sponsors_store') }}" method="POST">
@csrf

<div class="box box-solid">
<div class="box-body">

<div class="row">

<div class="col-md-6">
    <label>Sponsor Name</label>
    <input type="text" name="name" class="form-control" required>
</div>

<div class="col-md-6">
    <label>Amount</label>
    <input type="number" step="0.01" name="amount" class="form-control" required>
</div>

</div>

<br>

<div class="row">

<div class="col-md-6">
    <label>Select Member</label>
    <select name="user_id" class="form-control">
        <option value="">Select Member</option>

        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach

    </select>
</div>

<div class="col-md-6">
    <label>Select Event</label>
    <select name="event_id" class="form-control">
        <option value="">Select Event</option>

        @foreach($events as $event)
            <option value="{{ $event->id }}">{{ $event->name }}</option>
        @endforeach

    </select>
</div>

</div>

<br>

<label>Description</label>
<textarea name="description" class="form-control" rows="4"></textarea>

<br>

<button class="btn btn-success">Save Sponsor</button>

</div>
</div>

</form>

</section>

</div>

@endsection
