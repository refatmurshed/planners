<section class="profile-section">

    @php
        $member = \App\Models\Member::where('user_id', auth()->id())->first();
    @endphp

    <!-- TOP PROFILE CARD -->
    <div class="top-profile-card">

        <div class="profile-image-wrapper">

            @if($member && $member->image)
                <img src="{{ asset($member->image) }}" class="profile-image-main">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff&size=200"
                     class="profile-image-main">
            @endif

        </div>

        <div class="top-profile-info">
            <h1>{{ $user->name }}</h1>

            <p>{{ $user->email }}</p>

            @if($user->member_id)
                <span class="member-badge">
                    Member ID: {{ $user->member_id }}
                </span>
            @endif
        </div>

    </div>


    <!-- PROFILE INFORMATION -->
    <div class="profile-card">

        <div class="card-title-area">
            <h2>Account Information</h2>
            <p>Update your name and email address</p>
        </div>

        <form id="send-verification"
              method="post"
              action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post"
              action="{{ route('profile.update') }}"
              class="modern-form">

            @csrf
            @method('patch')

            <div class="form-grid">

                <div class="form-group">
                    <label>Name</label>

                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="modern-input"
                        :value="old('name', $user->name)"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <x-input-error class="mt-2"
                        :messages="$errors->get('name')" />
                </div>

                <div class="form-group">
                    <label>Email</label>

                    <x-text-input
                        id="email"
                        name="email"
                        type="email"
                        class="modern-input"
                        :value="old('email', $user->email)"
                        required
                        autocomplete="username"
                    />

                    <x-input-error class="mt-2"
                        :messages="$errors->get('email')" />
                </div>

            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="verify-box">

                    <p>
                        Your email address is unverified.
                    </p>

                    <button form="send-verification"
                            class="verify-btn">
                        Re-send Verification Email
                    </button>

                </div>

                @if (session('status') === 'verification-link-sent')

                    <div class="success-alert">
                        Verification link sent successfully.
                    </div>

                @endif

            @endif

            <div class="button-row">

                <x-primary-button class="save-button">
                    Save Changes
                </x-primary-button>

                @if (session('status') === 'profile-updated')
                    <span class="saved-text">
                        Saved Successfully
                    </span>
                @endif

            </div>

        </form>

    </div>


    <!-- BASIC INFORMATION -->
    <div class="profile-card">

        <div class="card-title-area">
            <h2>Basic Information</h2>
            <p>Update your phone, address, image and description</p>
        </div>

        

        <form method="POST"
              action="{{ route('member.basic.update') }}"
              enctype="multipart/form-data"
              class="modern-form">

            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label>Phone Number</label>

                    <input type="text"
                           name="phone"
                           class="modern-input"
                           value="{{ $member->phone ?? '' }}"
                           placeholder="Enter your phone number">
                </div>

                <div class="form-group">

                <!-- CURRENT IMAGE SHOW -->
    <div style="margin-bottom:10px;">
        @if($member && $member->image)
            <img src="{{ asset($member->image) }}"
                 style="width:90px;height:90px;border-radius:12px;object-fit:cover;border:2px solid #ddd;">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                 style="width:90px;height:90px;border-radius:12px;object-fit:cover;border:2px solid #ddd;">
        @endif
    </div>
                    <label>Profile Image</label>
                    <input type="file"
                           name="image"
                           class="modern-input file-input">
                </div>

                <div class="form-group full-width">
                    <label>Address</label>

                    <input type="text"
                           name="address"
                           class="modern-input"
                           value="{{ $member->address ?? '' }}"
                           placeholder="Enter your address">
                </div>

                <div class="form-group full-width">
                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="modern-input textarea-box"
                        placeholder="Write something about yourself...">{{ $member->description ?? '' }}</textarea>
                </div>

            </div>

            <div class="button-row">

                <button class="basic-save-btn">
                    Update Basic Information
                </button>

            </div>

        </form>

    </div>

</section>



<style>

body{
    background:#f1f5f9;
    font-family:'Segoe UI',sans-serif;
}

/* MAIN */
.profile-section{
    max-width:1100px;
    margin:auto;
    padding:20px;
    display:flex;
    flex-direction:column;
    gap:25px;
}

/* TOP CARD */
.top-profile-card{
    background:linear-gradient(135deg,#0f172a,#1d4ed8);
    border-radius:24px;
    padding:30px;
    display:flex;
    align-items:center;
    gap:25px;
    color:#fff;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
    position:relative;
    overflow:hidden;
}

.profile-image-wrapper{
    flex-shrink:0;
}

.profile-image-main{
    width:130px;
    height:130px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid rgba(255,255,255,.25);
    background:#fff;
    box-shadow:0 12px 30px rgba(0,0,0,.25);
    animation:floatImage 4s ease-in-out infinite;
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

.top-profile-info h1{
    font-size:34px;
    font-weight:700;
    margin-bottom:8px;
}

.top-profile-info p{
    opacity:.9;
    margin-bottom:15px;
}

.member-badge{
    background:rgba(255,255,255,.15);
    padding:10px 18px;
    border-radius:30px;
    font-size:14px;
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,255,255,.15);
}

/* CARD */
.profile-card{
    background:#fff;
    border-radius:24px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

/* TITLE */
.card-title-area{
    margin-bottom:25px;
}

.card-title-area h2{
    font-size:28px;
    font-weight:700;
    color:#0f172a;
    margin-bottom:6px;
}

.card-title-area p{
    color:#64748b;
}

/* FORM */
.modern-form{
    display:flex;
    flex-direction:column;
    gap:22px;
}

/* GRID */
.form-grid{
    display:grid;
    grid-template-columns:repeat(2,minmax(0,1fr));
    gap:22px;
}

.full-width{
    grid-column:1 / -1;
}

/* INPUT */
.modern-input{
    width:100%;
    padding:14px 18px;
    border-radius:14px;
    border:1px solid #dbe3ee;
    background:#f8fafc;
    transition:.3s;
    font-size:15px;
}

.modern-input:focus{
    outline:none;
    border-color:#2563eb;
    background:#fff;
    box-shadow:0 0 0 4px rgba(37,99,235,.12);
}

/* LABEL */
.form-group label{
    display:block;
    margin-bottom:10px;
    font-weight:600;
    color:#0f172a;
}

/* TEXTAREA */
.textarea-box{
    resize:none;
}

/* BUTTONS */
.button-row{
    display:flex;
    align-items:center;
    gap:15px;
    flex-wrap:wrap;
}

.save-button{
    padding:12px 24px !important;
    border-radius:14px !important;
}

.basic-save-btn{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:#fff;
    border:none;
    padding:14px 26px;
    border-radius:14px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
    box-shadow:0 10px 25px rgba(37,99,235,.25);
}

.basic-save-btn:hover{
    transform:translateY(-3px);
}

/* ALERT */
.verify-box{
    background:#fff7ed;
    border:1px solid #fed7aa;
    padding:16px;
    border-radius:14px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
}

.verify-btn{
    background:#ea580c;
    color:#fff;
    border:none;
    padding:10px 16px;
    border-radius:10px;
    cursor:pointer;
}

.success-alert{
    background:#dcfce7;
    color:#166534;
    padding:14px;
    border-radius:12px;
    font-weight:600;
}

.saved-text{
    color:#16a34a;
    font-weight:600;
}

/* FILE */
.file-input{
    padding:11px;
}

/* MOBILE */
@media(max-width:768px){

.profile-section{
    padding:12px;
}

.top-profile-card{
    flex-direction:column;
    text-align:center;
    padding:25px;
}

.top-profile-info h1{
    font-size:28px;
}

.profile-image-main{
    width:110px;
    height:110px;
}

.profile-card{
    padding:22px;
}

.card-title-area h2{
    font-size:24px;
}

.form-grid{
    grid-template-columns:1fr;
    gap:18px;
}

.button-row{
    flex-direction:column;
    align-items:stretch;
}

.basic-save-btn,
.save-button{
    width:100%;
    justify-content:center;
}

.verify-box{
    flex-direction:column;
    align-items:flex-start;
}

}

</style>