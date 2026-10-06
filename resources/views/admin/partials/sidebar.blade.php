<!-- Sidebar Layout -->
<aside class="main-sidebar">
    <section class="sidebar">

        <!-- Animation CSS -->
        <style>
            .sidebar-menu li a {
                display: flex;
                align-items: center;
                gap: 10px;
                transition: all 0.3s ease;
            }

            .sidebar-menu li a i {
                transition: all 0.4s ease;
            }

            .sidebar-menu li:hover i {
                animation: bounceGlow 0.6s ease forwards;
                filter: drop-shadow(0 0 5px white);
            }

            @keyframes bounceGlow {
                0% { transform: scale(1); }
                30% { transform: scale(1.3) rotate(10deg); }
                60% { transform: scale(0.9) rotate(-10deg); }
                100% { transform: scale(1) rotate(0deg); }
            }
        </style>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree" data-widget="tree">

            <li class="header">NAVIGATION</li>

            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Members -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Members</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.members_list') }}"><i class="fa fa-list"></i> Members List</a></li>
                    <li><a href="{{ route('admin.add_member') }}"><i class="fa fa-user-plus"></i> Add Member</a></li>
                </ul>
            </li>

            <!-- Subscriptions -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span>Subscriptions</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.collect_payment') }}"><i class="fa fa-money"></i> Collect Subscription</a></li>
                    <li><a href="{{ route('report.subscription') }}"><i class="fa fa-check-circle"></i> Full Report</a></li>
                    <li><a href="{{ route('report.sub_custom') }}"><i class="fa fa-check-circle"></i> Custom Report</a></li>
                    <li><a href="{{ route('subscription.receipts') }}"><i class="fa fa-check-circle"></i> Money Receipts</a></li>
                    <li><a href="{{ route('admin.receipt_preview') }}"><i class="fa fa-check-circle"></i> Receipt Design</a></li>
                    <li><a href="{{ route('report.monthly') }}"><i class="fa fa-line-chart"></i> Month Wise Report</a></li>
                    <li><a href="{{ route('report.member') }}"><i class="fa fa-users"></i> Member Wise Report</a></li>
                    <li><a href="{{ route('report.custom') }}"><i class="fa fa-filter"></i> Custom Date Report</a></li>
                    <li><a href="{{ route('admin.due_subscriptions') }}"><i class="fa fa-clock-o"></i> Due List</a></li>
                    <li><a href="{{ route('admin.paid_subscriptions') }}"><i class="fa fa-check-circle"></i> Paid List</a></li>
                </ul>
            </li>

            <!-- Events -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    <span>Events</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('event.list') }}"><i class="fa fa-calendar-check-o"></i> Event List</a></li>
                    <li><a href="{{ route('event.register.page') }}"><i class="fa fa-user-plus"></i> Registration</a></li>
                    <li><a href="{{ route('event.reg.manage') }}"><i class="fa fa-list-alt"></i> Registration List</a></li>
                    <li><a href="{{ route('event.costing.add') }}"><i class="fa fa-plus-circle"></i> Add Cost</a></li>
                    <li><a href="{{ route('event.costing.list') }}"><i class="fa fa-table"></i> Cost List</a></li>
                    <li><a href="{{ route('report.event') }}"><i class="fa fa-user-plus"></i> Event Report</a></li>

                </ul>
            </li>

            <!-- Sponsors -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-heart"></i>
                    <span>Sponsors</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.sponsors_list') }}"><i class="fa fa-list"></i> Sponsor List</a></li>
                    <li><a href="{{ route('admin.sponsors_add') }}"><i class="fa fa-handshake-o"></i> Collect Sponsor</a></li>
                </ul>
            </li>

            <!-- Accounts -->
            <li>
                <a href="{{ route('admin.accounts.report') }}">
                    <i class="fa fa-line-chart"></i>
                    <span>Accounts</span>
                </a>
            </li>

            <!-- Reports -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Reports</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('report.subscription') }}"><i class="fa fa-file-text"></i> Subscription</a></li>
                    
                    <li><a href="{{ route('report.event') }}"><i class="fa fa-calendar"></i> Event</a></li>
                </ul>
            </li>

            <!-- Website -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Website</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-image"></i> Slider</a></li>
                    <li><a href="#"><i class="fa fa-font"></i> Homepage Text</a></li>
                </ul>
            </li>

            <!-- SMS -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-comments"></i>
                    <span>SMS</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-paper-plane"></i> Send SMS</a></li>
                    <li><a href="#"><i class="fa fa-history"></i> SMS Report</a></li>
                </ul>
            </li>

            <!-- User Access -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-shield"></i>
                    <span>User Access</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.users_list') }}"><i class="fa fa-user"></i> Users</a></li>
                    <li><a href="{{ route('admin.users_create') }}"><i class="fa fa-lock"></i> Create User</a></li>
                </ul>
            </li>

            <!-- Settings -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Settings</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.subscription.settings') }}"><i class="fa fa-cog"></i> Subscription</a></li>
                    <li><a href="#"><i class="fa fa-wrench"></i> System</a></li>
                </ul>
            </li>

        </ul>
    </section>
</aside>
