@extends('layouts.app')

@section('content')

<div class="member-dashboard">

    <div class="top-banner">
        <div class="welcome-text">
            <h1>My Registration</h1>
            <p>Events and program registrations</p>
        </div>

        <div class="gear-icon">🎯</div>
    </div>

    <div class="table-card">

        <div class="table-header">
            <h2>Registration List</h2>
        </div>

        <table class="custom-table">

            <thead>
                <tr>
                    <th>SL</th>
                    <th>Event Name</th>
                    <th>Registration Date</th>
                    <th>Fee</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>Engineering Meetup 2026</td>
                    <td>10 Jan 2026</td>
                    <td>৳ 500</td>
                    <td>
                        <span class="badge paid">Registered</span>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@include('member.partials.table-style')

@endsection