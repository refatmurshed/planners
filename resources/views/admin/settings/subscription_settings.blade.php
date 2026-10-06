@extends('admin.layout')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h1>Edit Subscription Settings</h1>
    </section>

    <section class="content container-fluid">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <div class="box box-primary">
                    <div class="box-body">

                        <form method="POST" action="{{ route('admin.subscription.settings.update') }}">
                            @csrf

                            <div class="form-group">
                                <label>Subscription Amount</label>
                                <input type="number" step="0.01"
                                       name="subscription_amount"
                                       class="form-control"
                                       value="{{ $settings->subscription_amount ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label>Due Day (1-31)</label>
                                <input type="number"
                                       name="due_day"
                                       class="form-control"
                                       value="{{ $settings->due_day ?? '' }}">
                            </div>

                            <button type="submit" class="btn btn-success">
                                Save Settings
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </section>

</div>

@endsection
