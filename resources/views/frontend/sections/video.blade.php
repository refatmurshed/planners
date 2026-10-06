<!-- content start -->
<!-- header section start -->

<style>
.header-section.video-header{
    position:relative;
    width:100%;
    height:100vh;
    overflow:hidden;
}

/* ===== VIDEO BACKGROUND ===== */
.header-section.video-header .bg-video{
    position:absolute;
    top:50%;
    left:50%;
    min-width:100%;
    min-height:100%;
    width:auto;
    height:auto;
    transform:translate(-50%, -50%);
    object-fit:cover;
    z-index:1;
}

/* ===== DARK OVERLAY ===== */
.video-overlay{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0, 0, 0, 0.2);
    z-index:2;
}

/* ===== CONTENT WRAPPER ===== */
.header-section.video-header .cover{
    position:relative;
    z-index:3;
    height:100%;
    display:flex;
    align-items:center;
}

/* ===== TEXT STYLE ===== */
.header-section.video-header h3{
    color:#fff;
    font-size:22px;
    margin-bottom:10px;
    letter-spacing:1px;
}

.header-section.video-header h1{
    color:#fff;
    font-size:48px;
    font-weight:700;
    line-height:1.2;
    margin-bottom:25px;
}

/* ===== BUTTONS ===== */
.header-section.video-header .credential a{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:12px 22px;
    margin-right:10px;
    border-radius:4px;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
    line-height:1;
}

.header-section.video-header .credential a.active{
    background:#ff5e14;
    color:#fff;
}

.header-section.video-header .credential a:not(.active){
    background:transparent;
    border:1px solid #fff;
    color:#fff;
}

.header-section.video-header .credential a:hover{
    background:#ff5e14;
    border-color:#ff5e14;
    color:#fff;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
    .header-section.video-header h1{
        font-size:30px;
    }

    .header-section.video-header h3{
        font-size:18px;
    }
}
</style>

<header class="header-section video-header">

    <!-- VIDEO -->
    <video 
    autoplay 
    muted 
    loop 
    playsinline 
    preload="metadata"
    poster="{{ asset('assets/frontend/images/banner.png') }}"
    class="bg-video">
        <source src="{{ asset('assets/frontend/images/video2.mp4') }}" type="video/mp4">
        Your browser does not support video.
    </video>

    <!-- OVERLAY -->
    <div class="video-overlay"></div>

    <!-- CONTENT -->
    <div class="cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">

                    <h3>Welcome to</h3>
                    <h1>Planners and Designers Association!</h1>

                    <div class="credential">
                        <a href="#" class="active">About Us</a>
                        <a href="#" class="active">Contact Us</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</header>

<!-- header section end -->