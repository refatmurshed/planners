@if ($errors->any())
    <div class="alert alert-danger" style="text-align: center; background: red; font-size: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
<div class="alert alert-primary" style="text-align: center; background: skyblue; font-size: 20px;">
  <p>{{Session::get('success')}}</p>
</div>
@endif