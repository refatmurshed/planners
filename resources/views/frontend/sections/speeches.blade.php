<!-- speches area start -->
<section class="speches-section">

<style>

/* ================= SECTION ================= */
.speches-section{
    padding:60px 0;
    overflow:hidden;
    background:#fff;
}

/* ================= TITLE ================= */
.title-div h2{
    font-size:32px;
    font-weight:700;
}

.title-div span{
    color:#ff5e14;
}

/* ================= OWL FIX ================= */
.speches-carousel{
    opacity:0;
    transition:opacity 0.3s ease;
}

.speches-carousel.owl-loaded{
    opacity:1;
}

/* prevent flicker */
.owl-carousel .item{
    min-height:300px;
}

/* ================= SPEECH BOX ================= */
.speches-content{
    padding:15px;
}

.speches-content h5{
    font-size:20px;
    font-weight:700;
    margin-top:10px;
}

.speches-content h6{
    font-size:14px;
    color:#777;
}

.speches-content p{
    font-size:14px;
    line-height:1.6;
    margin-top:10px;
}

.speech-box img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
}

/* alignment helpers */
.text-lg-right{
    text-align:right;
}

.mr-lg-5{
    margin-right:30px;
}

.ml-lg-5{
    margin-left:30px;
}

/* ================= BUTTON ================= */
.more-info{
    display:inline-block;
    margin-top:10px;
    color:#ffffff;
    font-weight:600;
    text-decoration:none;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .text-lg-right{
        text-align:left !important;
    }

    .mr-lg-5,
    .ml-lg-5{
        margin:0 !important;
    }

    .speech-box img{
        width:90px;
        height:90px;
    }
}

</style>

<div class="container">

    <!-- TITLE -->
    <div class="row">
        <div class="col-lg-10 offset-lg-1 mb-4">
            <div class="title-div text-lg-center">
                <h2>Guest <span>speech</span></h2>
            </div>
        </div>
    </div>

    <!-- CAROUSEL -->
    <div class="owl-carousel speches-carousel">

        <!-- ITEM 1 -->
        <div class="item">
            <div class="row">

                <div class="col-lg-6">
                    <div class="speches-content text-lg-right mr-lg-5">

                        <div class="speech-box">
                            <img src="assets/frontend/images/1662200543edited0.png">
                        </div>

                        <h5>Engineer Tanveer Ahmed</h5>
                        <h6>General Secretary</h6>

                        <p>
                            Established on 9 December 2017 in the oldest city of Mymensingh...
                        </p>

                        <a href="#" class="more-info">Read More →</a>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="speches-content ml-lg-5">

                        <div class="speech-box">
                            <img src="assets/frontend/images/1662200123edited0.png">
                        </div>

                        <h5>Engineer Partha Protim Bonik</h5>
                        <h6>President</h6>

                        <p>
                            Planners and Designers Association was formed on December 9, 2017...
                        </p>

                        <a href="#" class="more-info">Read More →</a>

                    </div>
                </div>

            </div>
        </div>

        <!-- ITEM 2 -->
        <div class="item">
            <div class="row">

                <div class="col-lg-6">
                    <div class="speches-content text-lg-right mr-lg-5">

                        <div class="speech-box">
                            <img src="assets/frontend/images/speech-1583756227-0.png">
                        </div>

                        <h5>Dr. Engineer Md. Mahbub Ali</h5>
                        <h6>Outgoing President</h6>

                        <p>
                            With the aim of building Digital Bangladesh...
                        </p>

                        <a href="#" class="more-info">Read More →</a>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="speches-content ml-lg-5">

                        <div class="speech-box">
                            <img src="assets/frontend/images/1662199705edited0.png">
                        </div>

                        <h5>Engineer Sajal Chandra Chanda</h5>
                        <h6>Founder General Secretary</h6>

                        <p>
                            I extend my warmest greetings...
                        </p>

                        <a href="#" class="more-info">Read More →</a>

                    </div>
                </div>

            </div>
        </div>

        <!-- ITEM 3 -->
        <div class="item">
            <div class="row">

                <div class="col-lg-6">
                    <div class="speches-content text-lg-right mr-lg-5">

                        <div class="speech-box">
                            <img src="assets/frontend/images/speech-1583756683-0.png">
                        </div>

                        <h5>Engineer Md. Mobarak Hossain Anadi</h5>
                        <h6>Outgoing General Secretary</h6>

                        <p>
                            The third inauguration ceremony of the beloved organization...
                        </p>

                        <a href="#" class="more-info">Read More →</a>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

</section>
<!-- speches area end -->

<script>
 $(document).ready(function(){

    $('.speches-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        autoplay:true,
        autoplayTimeout:5000,
        smartSpeed:800,
        items:1,
        autoplayHoverPause:true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn'
    });

});
</script>