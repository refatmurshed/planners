<div class="member-dashboard">

    @php
        $member = \App\Models\Member::where('user_id', auth()->id())->first();
    @endphp

    <!-- Header -->
    <div class="top-banner">

        <div class="welcome-area">

            <div class="member-image-box">

                @if($member && $member->image)
                    <img src="{{ asset($member->image) }}" class="member-image">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff&size=200" class="member-image">
                @endif

            </div>

            <div class="welcome-text">
                <h1>Welcome, {{ auth()->user()->name }}</h1>
                <p>Welcome to PDA Engineering Network 🚀</p>

                @if(auth()->user()->member_id)
                    <span class="member-id-badge">
                        ID: {{ auth()->user()->member_id }}
                    </span>
                @endif
            </div>

        </div>

    <div class="gear-icon">

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="logout-gear-btn">
    ⚙️
</button>
    </form>

    <small style="display:block;text-align:center;color:#fff;">
        
    </small>

</div>

    </div>

    <!-- Stats -->
    <div class="stats-grid">

        <div class="stat-card dark">
            <div class="icon">👤</div>
            <h3>My Profile</h3>
            <a href="{{ route('profile.edit') }}">Open Profile</a>
        </div>

        <div class="stat-card blue">
            <div class="icon">💳</div>
            <h3>My Subscriptions</h3>
            <a href="{{ route('member.my.subscription') }}">View</a>
        </div>

        <div class="stat-card purple">
            <div class="icon">🎯</div>
            <h3>Event Registration</h3>
            <a href="{{ route('member.my.registration') }}">View</a>
        </div>

        <div class="stat-card red">
            <div class="icon">🤝</div>
            <h3>Become Sponsor</h3>
            <a href="#">Sponsor Now</a>
        </div>

        

    </div>

    <!-- Events -->
    <div class="section-title">
        <h2>Live Events</h2>
        <p>Professional networking & engineering programs</p>
    </div>

    <div class="event-grid">

        <div class="event-card">
            <div class="event-image">🏗️</div>
            <div class="event-body">
                <h3>Engineering Meetup 2026</h3>
                <p>Date: 25 July 2026</p>
                <p>Fee: 500 BDT</p>
                <a href="#">Register Now</a>
            </div>
        </div>

        <div class="event-card">
            <div class="event-image">📐</div>
            <div class="event-body">
                <h3>Design Innovation Summit</h3>
                <p>Date: 10 August 2026</p>
                <p>Fee: 300 BDT</p>
                <a href="#">Register Now</a>
            </div>
        </div>

        <div class="event-card">
            <div class="event-image">⚡</div>
            <div class="event-body">
                <h3>Power & Energy Seminar</h3>
                <p>Date: 18 Sept 2026</p>
                <p>Fee: 400 BDT</p>
                <a href="#">Register Now</a>
            </div>
        </div>

    </div>

</div>


<style>

body{
    background:#eef2f7;
    font-family:'Segoe UI',sans-serif;
}

/* Main */
.member-dashboard{
    max-width:1400px;
    margin:auto;
    padding:25px;
}

/* Header */
.top-banner{
    background:linear-gradient(135deg,#0f172a,#1e3a8a);
    color:#fff;
    padding:30px;
    border-radius:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
    margin-bottom:30px;
    position:relative;
    overflow:hidden;
}

.welcome-area{
    display:flex;
    align-items:center;
    gap:25px;
}

.member-image-box{
    position:relative;
}

.member-image{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid rgba(255,255,255,.25);
    box-shadow:0 10px 30px rgba(0,0,0,.35);
    animation:floatImage 4s ease-in-out infinite;
    background:#fff;
}

@keyframes floatImage{
    0%{
        transform:translateY(0px);
    }
    50%{
        transform:translateY(-10px);
    }
    100%{
        transform:translateY(0px);
    }
}

.welcome-text h1{
    font-size:34px;
    margin-bottom:8px;
    font-weight:700;
}

.welcome-text p{
    opacity:.9;
    margin-bottom:12px;
}

.member-id-badge{
    display:inline-block;
    background:rgba(255,255,255,.15);
    padding:8px 16px;
    border-radius:30px;
    font-size:14px;
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,255,255,.2);
}



.logout-gear-btn{
    background:none;
    border:none;
    font-size:60px;
    cursor:pointer;
    color:#fff;
    animation:spin 10s linear infinite;
    padding:0;
    position:relative;
}

.logout-gear-btn:hover{
    opacity:.8;
}

.logout-gear-btn::after{
    content:'Logout';
    position:absolute;
    top:70px;
    left:50%;
    transform:translateX(-50%);
    background:#dc2626;
    color:#fff;
    font-size:13px;
    font-weight:600;
    padding:6px 12px;
    border-radius:6px;
    white-space:nowrap;
    opacity:0;
    visibility:hidden;
    transition:.3s;
}

.logout-gear-btn:hover::after{
    opacity:1;
    visibility:visible;
}

@keyframes spin{
    from{transform:rotate(0deg);}
    to{transform:rotate(360deg);}
}

/* Cards */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:45px;
}

.stat-card{
    background:#fff;
    border-radius:16px;
    padding:25px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 30px rgba(0,0,0,.15);
}

.stat-card .icon{
    font-size:45px;
    margin-bottom:12px;
}

.stat-card h3{
    font-size:20px;
    margin-bottom:15px;
    color:#111827;
}

.stat-card a{
    display:inline-block;
    padding:10px 18px;
    border-radius:8px;
    color:#fff;
    text-decoration:none;
    font-weight:600;
}

/* Colors */
.blue a{background:#2563eb;}
.orange a{background:#ea580c;}
.green a{background:#16a34a;}
.purple a{background:#7c3aed;}
.red a{background:#dc2626;}
.dark a{background:#111827;}

/* Section */
.section-title{
    text-align:center;
    margin-bottom:25px;
}

.section-title h2{
    font-size:30px;
    color:#111827;
}

.section-title p{
    color:#6b7280;
}

/* Events */
.event-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:25px;
}

.event-card{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    transition:.3s;
}

.event-card:hover{
    transform:translateY(-8px);
}

.event-image{
    height:180px;
    background:linear-gradient(135deg,#0ea5e9,#1d4ed8);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:70px;
    color:#fff;
}

.event-body{
    padding:22px;
}

.event-body h3{
    margin-bottom:10px;
    color:#111827;
}

.event-body p{
    color:#4b5563;
    margin-bottom:8px;
}

.event-body a{
    margin-top:12px;
    display:inline-block;
    background:#0f172a;
    color:#fff;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
}

.event-body a:hover{
    background:#1e3a8a;
}

/* Mobile */
@media(max-width:768px){

.top-banner{
    flex-direction:column;
    text-align:center;
    gap:20px;
}

.welcome-area{
    flex-direction:column;
}

.welcome-text h1{
    font-size:26px;
}

.member-image{
    width:100px;
    height:100px;
}


}

</style>