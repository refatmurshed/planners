@extends('admin.layout')

@section('content')

<div class="content-wrapper">

<section class="content-header">
    <h1>Add New User</h1>
</section>

<section class="content container-fluid">

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<form action="{{ route('admin.users_store') }}" method="POST" autocomplete="off">
@csrf

<div class="box box-solid">
<div class="box-body">

<div class="row">

<div class="col-md-6">
    <label>Full Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
</div>

<div class="col-md-6">
    <label>Email Address</label>
    <input type="email" 
           name="email" 
           class="form-control" 
           value="{{ old('email') }}"
           autocomplete="new-email"
           required>
</div>

</div>

<br>

<div class="row">

<div class="col-md-6">
    <label>Password</label>
    <input type="password" 
           name="password" 
           class="form-control"
           autocomplete="new-password"
           readonly
           onfocus="this.removeAttribute('readonly');"
           required>
</div>

<div class="col-md-6">
    <label>Confirm Password</label>
    <input type="password" 
           name="password_confirmation" 
           class="form-control"
           autocomplete="new-password"
           readonly
           onfocus="this.removeAttribute('readonly');"
           required>
</div>

</div>

<br>

<div class="row">

<div class="col-md-6">
    <label>User Role</label>
    <select name="role" class="form-control" required>
        <option value="2" {{ old('role') == 2 ? 'selected' : 'selected' }}>Member</option>
        <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
    </select>
</div>

</div>

<br>

<button type="submit" class="btn btn-success">
    <i class="fa fa-save"></i> Save User
</button>

</div>
</div>

</form>

</section>

</div>

@endsection
