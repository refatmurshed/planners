@extends('admin.layout')

@section('content')
<div class="content-wrapper" style="min-height: 536.609px;">

  <section class="content-header" style="padding: 20px 30px;">
    <h1>Dashboard <small>Control panel</small></h1>
    <ol class="breadcrumb" style="background: transparent; padding-left: 0;">
      <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
    </ol>
  </section>

  <section class="content container-fluid" style="padding: 0 30px;">

    
    <!-- 🔷 TOP CARDS -->
    <div class="row" style="margin-bottom: 50px;">
      
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <label>300</label>
            <p>Transactions</p>
          </div>
          <div class="icon"><i class="fa fa-exchange"></i></div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <label>BDT: 97,854.07</label>
            <p>Bank Balance</p>
          </div>
          <div class="icon"><i class="fa fa-credit-card"></i></div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <label>BDT: 0.00</label>
            <p>Receivable</p>
          </div>
          <div class="icon"><i class="fa fa-money"></i></div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <label>BDT: 0.00</label>
            <p>Payable</p>
          </div>
          <div class="icon"><i class="fa fa-bank"></i></div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>

    <hr style="min-height:2px; background:red">

    
    <!-- 🔥 ICONIC DASHBOARD MODULES -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        <!-- Members -->
        <a href="/admin/members" class="bg-white p-6 rounded-xl shadow text-center hover:shadow-xl hover:-translate-y-2 transition duration-300">
            <div class="text-4xl mb-2">👥</div>
            <h3 class="font-semibold">Members</h3>
        </a>

        <!-- Events -->
        <a href="#" class="bg-white p-6 rounded-xl shadow text-center hover:shadow-xl hover:-translate-y-2 transition duration-300">
            <div class="text-4xl mb-2">🎯</div>
            <h3 class="font-semibold">Events</h3>
        </a>

        <!-- Subscriptions -->
        <a href="#" class="bg-white p-6 rounded-xl shadow text-center hover:shadow-xl hover:-translate-y-2 transition duration-300">
            <div class="text-4xl mb-2">💳</div>
            <h3 class="font-semibold">Subscriptions</h3>
        </a>

        <!-- Accounts -->
        <a href="#" class="bg-white p-6 rounded-xl shadow text-center hover:shadow-xl hover:-translate-y-2 transition duration-300">
            <div class="text-4xl mb-2">💰</div>
            <h3 class="font-semibold">Accounts</h3>
        </a>

        <!-- Reporting -->
        <a href="#" class="bg-white p-6 rounded-xl shadow text-center hover:shadow-xl hover:-translate-y-2 transition duration-300">
            <div class="text-4xl mb-2">📊</div>
            <h3 class="font-semibold">Reporting</h3>
        </a>

        <!-- Website -->
        <a href="/" target="_blank" class="bg-white p-6 rounded-xl shadow text-center hover:shadow-xl hover:-translate-y-2 transition duration-300">
            <div class="text-4xl mb-2">🌐</div>
            <h3 class="font-semibold">Website</h3>
        </a>

        <!-- User Access -->
        <a href="#" class="bg-white p-6 rounded-xl shadow text-center hover:shadow-xl hover:-translate-y-2 transition duration-300">
            <div class="text-4xl mb-2">🔐</div>
            <h3 class="font-semibold">User Access</h3>
        </a>

        <!-- Settings -->
        <a href="#" class="bg-white p-6 rounded-xl shadow text-center hover:shadow-xl hover:-translate-y-2 transition duration-300">
            <div class="text-4xl mb-2">⚙️</div>
            <h3 class="font-semibold">Settings</h3>
        </a>

    </div>

  </section>
</div>
@endsection
