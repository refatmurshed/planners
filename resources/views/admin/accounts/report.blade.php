@extends('admin.layout')

@section('content')

<div class="content-wrapper p-4">

    <section class="content-header">
        <h1>Accounts Report</h1>
    </section>

    <section class="content">

        <!-- Year Filter -->
        <form method="GET" action="{{ route('admin.accounts.report') }}" class="mb-4">
            <div style="max-width:250px;">
                <select name="year" onchange="this.form.submit()" class="form-control">
                    @foreach($years as $yr)
                        <option value="{{ $yr }}" {{ $year == $yr ? 'selected' : '' }}>
                            {{ $yr }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Cards -->
        <div class="row">

            <div class="col-md-4">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ number_format($totalIncome,2) }}</h3>
                        <p>Total Income</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ number_format($totalExpense,2) }}</h3>
                        <p>Total Expense</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ number_format($netBalance,2) }}</h3>
                        <p>Net Balance</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Details Table -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Yearly Summary - {{ $year }}</h3>
            </div>

            <div class="box-body table-responsive">

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Subscription Paid</th>
                        <td>{{ number_format($subscriptionPaid,2) }}</td>
                    </tr>

                    <tr>
                        <th>Subscription Due</th>
                        <td>{{ number_format($subscriptionDue,2) }}</td>
                    </tr>

                    <tr>
                        <th>Total Events</th>
                        <td>{{ $totalEvents }}</td>
                    </tr>

                    <tr>
                        <th>Registration Paid</th>
                        <td>{{ number_format($registrationPaid,2) }}</td>
                    </tr>

                    <tr>
                        <th>Registration Due</th>
                        <td>{{ number_format($registrationDue,2) }}</td>
                    </tr>

                    <tr>
                        <th>Event Sponsor</th>
                        <td>{{ number_format($eventSponsor,2) }}</td>
                    </tr>

                    <tr>
                        <th>General Sponsor</th>
                        <td>{{ number_format($generalSponsor,2) }}</td>
                    </tr>

                    <tr>
                        <th>Event Cost</th>
                        <td>{{ number_format($eventCost,2) }}</td>
                    </tr>

                    <tr style="font-weight:bold; background:#f4f4f4;">
                        <th>Final Balance</th>
                        <td>{{ number_format($netBalance,2) }}</td>
                    </tr>

                </table>

            </div>
        </div>

    </section>
</div>

@endsection
