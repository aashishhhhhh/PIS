<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    @yield('styles')
</head>
<body>

    <div class="text-right">

        <button id="printbtn" class="btn btn-primary"><i class="fas fa-print"></i></button>
        <a id="backBtn" href="{{route('maag-form-list')}}" class="btn btn-primary"><i class="fas fa-backspace"></i></a>
        </div>
    
    <div class="card" id="printdiv">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-left">
                    <img src="{{ asset('storage/upload/gov.jpg') }}" alt=""
                    class="px-1" height="150" width="300">
                </div>
                <div class="col-md-4 text-center">
                    {{-- todo --}}
                    <p>याङवरक  गाउपलिका</p>
                    <h3>गाउ कार्यपालिकाको कार्यलय</h3>
                    <p>थर्पु, पांचथर</p>
                    <p>१ न. प्रदेश, नेपाल</p>
                    <p> <b> भ्रमण प्रतिवेदन</b></p>
    
                </div>
                <div class="col-md-4 text-right">
                    <p>म. ले. प. फारम न. : ९०९ </p>
                </div>

            <div class="col-md-12 text-left">
                    <p>भ्रमण आदेश न: {{nepali($staffVisit->aadesh_no)}}</p>
                    <p>भ्रमण टोलिप्रमुख: {{$leader}}</p>
                    <p>भ्रमण अवधि: {{nepali($difference_in_days)}} दिन</p>
                </div>
            </div>

        <div class="row"> 
            <div class="col-md-12">
                <label for="">भ्रमणको उदस्य</label>
                <div style="border: 2px solid black; padding:5px;">
                    <p> {!!$visit_udasya!!} </p>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <label for="">सम्पादित मुख्य मुख्य काम</label>
                <div style="border: 2px solid black; padding:5px;">
                    <p> {!!$mukhya_kaam!!} </p>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <label for="">सारास तथा सुजावहरु</label>
                <div style="border: 2px solid black; padding:5px;">
                    <p> {!!$suggestion!!} </p>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <label for="">भ्रमण पुस्टि गर्ने संलग्न कागजातको विवरण</label>
                <div style="border: 2px solid black; padding:5px;">
                    <p> {!!$visit_paper_details!!} </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text:left">

                <br>
                <br>
                ....................................
                <br>
                भ्रमणमा जाने कर्मचारी
                <p>नाम: {{$staff_name->nep_name}}</p>
                <p>पद: {{$staffService->positions->name}}</p>
            </div>
        </div>
            
        </div>
    </div>
</body>

    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</html>

<script>
    $("#printbtn").click(function () {
        $('#printbtn').hide();
        $('#backBtn').hide();
        window.print();
        $('#printbtn').show();
        $('#backBtn').show();
});
</script>