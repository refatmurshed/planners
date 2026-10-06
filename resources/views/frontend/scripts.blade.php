{{-- ================= CORE SCRIPTS ================= --}}

<script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/breaking-news-ticker.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/YouTubePopUp.jquery.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('assets/frontend/js/app.js') }}"></script>

{{-- ================= PAGE SAFE INIT (DO NOT TOUCH app.js) ================= --}}
<script>
$(window).on('load', function () {

    /* SLIDER SAFETY */
    if ($('#header-slider').length) {
        $('#header-slider').carousel({
            interval: 5000,
            ride: "carousel"
        });
    }

    /* NEWS TICKER SAFETY */
    if ($('#newsTicker14').length) {
        $('#newsTicker14').breakingNews({
            scrollSpeed: '2',
            radius: '0'
        });
    }

    /* YOUTUBE POPUP SAFETY */
    $("a.bla-1").YouTubePopUp();

    /* SPEECH CAROUSEL */
    if ($('.speches-carousel').length) {
        $('.speches-carousel').owlCarousel({
            autoplay: true,
            loop: true,
            nav: true,
            dots: false,
            items: 1
        });
    }

    /* STATUS CAROUSEL */
    if ($('.status-carousel').length) {
        $('.status-carousel').owlCarousel({
            autoplay: true,
            loop: true,
            nav: false,
            dots: false,
            responsive: {
                0: { items: 2 },
                768: { items: 3 },
                991: { items: 4 }
            }
        });
    }

});
</script>

@stack('scripts')