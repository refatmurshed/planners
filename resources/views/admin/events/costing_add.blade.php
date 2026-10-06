@extends('admin.layout')

@section('content')

<div class="content-wrapper">

<section class="content-header">
    <h1>Add Event Costing</h1>

    <a href="{{ route('event.costing.list') }}" class="btn btn-primary">
        Back to List
    </a>
</section>

<section class="content container-fluid">

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="box box-solid">
<div class="box-body">

<form action="{{ route('event.costing.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row">

    <!-- EVENT -->
    <div class="col-md-6">
        <label>Select Event</label>
        <select name="event_id" class="form-control" required>
            <option value="">-- Select Event --</option>

            @foreach($events as $event)
                <option value="{{ $event->id }}">
                    {{ $event->name }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- DATE -->
    <div class="col-md-6">
        <label>Date</label>
        <input type="date" name="date" class="form-control" required>
    </div>

</div>

<br>

<div class="row">

    <!-- AMOUNT -->
    <div class="col-md-6">
        <label>Amount</label>
        <input type="number" name="amount" class="form-control" required>
    </div>

    <!-- FILE -->
    <div class="col-md-6">
        <label>File</label>
        <input type="file" name="file" class="form-control">
    </div>

</div>

<br>

<!-- DESCRIPTION -->
<div class="row">
    <div class="col-md-12">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
</div>

<br>

<button class="btn btn-success">
    Save Costing
</button>

</form>

</div>
</div>

</section>

</div>

@endsection
