@extends('admin.layout')

@section('content')

<div class="content-wrapper">

<section class="content-header">
    <h1>Add Event</h1>
</section>

<section class="content container-fluid">

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="box box-solid">
<div class="box-body">

<div class="row">

<div class="col-md-6">
    <label>Event Name</label>
    <input type="text" name="name" class="form-control" required>
</div>

<div class="col-md-6">
    <label>Event Date</label>
    <input type="date" name="event_date" class="form-control" required>
</div>

</div>

<br>

<div class="row">

<div class="col-md-6">
    <label>Last Registration Date</label>
    <input type="date" name="last_registration_date" class="form-control">
</div>

<div class="col-md-6">
    <label>Minimum Fee</label>
    <input type="number" step="0.01" name="min_fee" class="form-control">
</div>

</div>

<br>

<label>Description</label>
<textarea name="description" class="form-control" rows="4"></textarea>

<br>

<label>Event Image</label>
<input type="file" name="image" class="form-control">

<br>

<button type="submit" class="btn btn-success">
    Save Event
</button>

</div>
</div>

</form>

</section>

</div>

@endsection
