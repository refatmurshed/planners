@extends('admin.layout')

@section('content')

<style>
/* 🔥 MODERN CARD STYLE (UNCHANGED) */
.modern-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 22px; /* 🔥 increased padding */
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    transition: all 0.25s ease;
    border: 1px solid #f1f1f1;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 20px; /* 🔥 spacing fix */
}

.modern-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 25px rgba(0,0,0,0.12);
}

.modern-icon {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 28px;
    color: #fff;
    transition: all 0.3s ease;
}

.modern-card:hover .modern-icon {
    transform: rotate(8deg) scale(1.1);
}

.modern-title {
    font-size: 16px;
    font-weight: 600;
    color: #444;
}

.modern-sub {
    font-size: 12px;
    color: #999;
}

/* soft backgrounds */
.bg-soft-blue { background: #e8f1ff; }
.bg-soft-green { background: #e9f8ef; }
.bg-soft-yellow { background: #fff7e6; }
.bg-soft-red { background: #ffecec; }
.bg-soft-purple { background: #f3e8ff; }
.bg-soft-aqua { background: #e6fbff; }
.bg-soft-gray { background: #f5f5f5; }

.icon-blue { background: #3b82f6; }
.icon-green { background: #22c55e; }
.icon-yellow { background: #f59e0b; }
.icon-red { background: #ef4444; }
.icon-purple { background: #a855f7; }
.icon-aqua { background: #06b6d4; }
.icon-gray { background: #6b7280; }
</style>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Dashboard <small>Control panel</small></h1>
    </section>

    <section class="content">

        <!-- TOP STATS -->
        <div class="row">

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $totalMembers }}</h3>
                        <p>Members</p>
                    </div>
                    <div class="icon"><i class="fa fa-users"></i></div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $totalEvents }}</h3>
                        <p>Events</p>
                    </div>
                    <div class="icon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $totalSubscriptionDue }}</h3>
                        <p>Total Due</p>
                    </div>
                    <div class="icon"><i class="fa fa-money"></i></div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $totalSubscriptionPaid }}</h3>
                        <p>Collected</p>
                    </div>
                    <div class="icon"><i class="fa fa-bank"></i></div>
                </div>
            </div>

        </div>

        <hr>

        <!-- 🔥 MODERN CARDS -->
        <div class="row">

            <!-- Members -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{ route('admin.members_list') }}">
                    <div class="modern-card bg-soft-blue">
                        <div class="modern-icon icon-blue"><i class="fa fa-users"></i></div>
                        <div class="modern-title">Members</div>
                        <div class="modern-sub">Manage users</div>
                    </div>
                </a>
            </div>

            <!-- Events -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{ route('event.list') }}">
                    <div class="modern-card bg-soft-green">
                        <div class="modern-icon icon-green"><i class="fa fa-calendar"></i></div>
                        <div class="modern-title">Events</div>
                        <div class="modern-sub">Manage events</div>
                    </div>
                </a>
            </div>

            <!-- Subscriptions -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{ route('admin.collect_payment') }}">
                    <div class="modern-card bg-soft-yellow">
                        <div class="modern-icon icon-yellow"><i class="fa fa-credit-card"></i></div>
                        <div class="modern-title">Subscriptions</div>
                        <div class="modern-sub">Payments</div>
                    </div>
                </a>
            </div>

            <!-- Accounts -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{ route('admin.accounts.report') }}">
                    <div class="modern-card bg-soft-red">
                        <div class="modern-icon icon-green"><i class="fa fa-globe"></i></div>
                        <div class="modern-title">Accounts</div>
                        <div class="modern-sub">Finance</div>
                    </div>
                </a>
            </div>

            <!-- Reports -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="modern-card bg-soft-purple">
                        <div class="modern-icon icon-purple"><i class="fa fa-bar-chart"></i></div>
                        <div class="modern-title">Reports</div>
                        <div class="modern-sub">Analytics</div>
                    </div>
                </a>
            </div>

            <!-- Website -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="/" target="_blank">
                    <div class="modern-card bg-soft-aqua">
                        <div class="modern-icon icon-aqua"><i class="fa fa-globe"></i></div>
                        <div class="modern-title">Website</div>
                        <div class="modern-sub">Visit site</div>
                    </div>
                </a>
            </div>

            <!-- SMS -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="modern-card bg-soft-blue">
                        <div class="modern-icon icon-blue"><i class="fa fa-comment"></i></div>
                        <div class="modern-title">SMS</div>
                        <div class="modern-sub">Messaging system</div>
                    </div>
                </a>
            </div>

            <!-- User Access -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{ route('admin.users_list') }}">
                    <div class="modern-card bg-soft-gray">
                        <div class="modern-icon icon-gray"><i class="fa fa-lock"></i></div>
                        <div class="modern-title">User Access</div>
                        <div class="modern-sub">Permissions</div>
                    </div>
                </a>
            </div>

            <!-- Settings -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{ route('admin.subscription.settings') }}">
                    <div class="modern-card bg-soft-yellow">
                        <div class="modern-icon icon-yellow"><i class="fa fa-cogs"></i></div>
                        <div class="modern-title">Settings</div>
                        <div class="modern-sub">Configuration</div>
                    </div>
                </a>
            </div>

        </div>

    </section>

</div>

@endsection
