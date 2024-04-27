<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vito - Responsive Bootstrap 4 Admin Dashboard Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/assets') }}/images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/responsive.css">
    <link href="{{ asset('dashboard/assets/dropify.css') }}" rel="stylesheet">
    <!--  Owl-carousel css-->
    {{-- <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet"> --}}
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/assets') }}/images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/responsive.css">
    <link rel="shortcut icon" href="{{ asset('dashboard/assets') }}/images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/css/responsive.css">
    <!-- Full calendar -->
    <link href='{{ asset('dashboard/assets') }}/fullcalendar/core/main.css' rel='stylesheet' />
    <link href='{{ asset('dashboard/assets') }}/fullcalendar/daygrid/main.css' rel='stylesheet' />
    <link href='{{ asset('dashboard/assets') }}/fullcalendar/timegrid/main.css' rel='stylesheet' />
    <link href='{{ asset('dashboard/assets') }}/fullcalendar/list/main.css' rel='stylesheet' />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('dashboard/assets/plugins/prism/prism.css') }}" rel="stylesheet">
    @yield('css')

</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">

        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <div class="iq-sidebar">
            @include('dashboard.layout.sidebar')
        </div>
        <!-- TOP Nav Bar -->
        <div class="iq-top-navbar">
            @include('dashboard.layout.navbar')
        </div>
        <!-- TOP Nav Bar END -->
        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            @yield('contant')
        </div>
    </div>



    <!-- Wrapper END -->
    <!-- Footer -->
    <footer class="bg-white iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright 2020 <a href="#">Vito</a> All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END -->

    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('dashboard/assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ asset('dashboard/assets') }}/js/jquery.min.js"></script>
    <script src="{{ asset('dashboard/assets') }}/js/popper.min.js"></script>
    <script src="{{ asset('dashboard/assets') }}/js/bootstrap.min.js"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/jquery.appear.js"></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/countdown.min.js"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/waypoints.min.js"></script>
    <script src="{{ asset('dashboard/assets') }}/js/jquery.counterup.min.js"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/wow.min.js"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/apexcharts.js"></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/slick.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/select2.min.js"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/owl.carousel.min.js"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/jquery.magnific-popup.min.js"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/smooth-scrollbar.js"></script>
    <!-- lottie JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/lottie.js"></script>
    <!-- am core JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/core.js"></script>
    <!-- am charts JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/charts.js"></script>
    <!-- am animated JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/animated.js"></script>
    <!-- am kelly JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/kelly.js"></script>
    <!-- am maps JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/maps.js"></script>
    <!-- am worldLow JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/dark.js"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/chart-custom.js"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('dashboard/assets') }}/js/custom.js"></script>
    <script src="{{ asset('dashboard/assets/dropify.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>

@yield('script')
@stack('js')

</body>

</html>
