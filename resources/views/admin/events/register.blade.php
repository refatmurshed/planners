@extends('admin.layout')

@section('content')

<style>
th, td {
    text-align: center;
}
</style>

<div class="content-wrapper">

<section class="content-header">
    <h1>Event Registration (Admin)</h1>
</section>

<section class="content container-fluid">

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<div class="box box-solid">
<div class="box-body">

<form action="{{ route('event.register.store') }}" method="POST">
@csrf

<div class="row">

    <!-- EVENT -->
    <div class="col-md-6">
        <label>Select Event</label>
        <select name="event_id" class="form-control" required>
            <option value="">-- Select Event --</option>

            @foreach($events as $event)
                <option value="{{ $event->id }}">
                    {{ $event->name }} (Fee: {{ $event->min_fee }})
                </option>
            @endforeach

        </select>
    </div>

    <!-- MEMBER (UPDATED SECTION ONLY) -->
    <div class="col-md-6">
        <label>Select Member</label>
        <select name="user_id" class="form-control" required>
            <option value="">-- Select Member --</option>

            @foreach(\App\Models\Member::with('user')->get() as $member)
                <option value="{{ $member->user_id }}">
                    {{ $member->user->name ?? 'N/A' }}
                    ({{ $member->member_code ?? 'M-'.$member->id }})
                </option>
            @endforeach

        </select>
    </div>

</div>

<br>

<button class="btn btn-success">
    Register (Pending)
</button>

</form>

</div>
</div>

</section>

</div>

@endsection