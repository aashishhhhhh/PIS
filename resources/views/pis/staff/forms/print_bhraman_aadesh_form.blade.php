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
    <style  type="text/css" media="print">
        @page { 
        size: landscape auto;
    }

    </style>
    @yield('styles')
</head>
<body>

    <div class="text-right">

        <button id="printbtn" class="btn btn-primary"><i class="fas fa-print"></i></button>
        <a id="backBtn" href="{{route('bhraman-aadesh-form')}}" class="btn btn-primary"><i class="fas fa-backspace"></i></a>
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
                        <p> <b> भ्रमण आदेश</b></p>
                    </div>

                    <div class="col-md-4 text-right">
                        <p>म. ले. प. फारम न. : २०३ </p>
                    </div>
                    <div class="col-md-12 text-right">
                        <p>आदेश न:  {{nepali($latest->aadesh_no)}}</p>
                        <p>मिति: {{$latest->date}}</p>
                    </div>
                </div>

                <div class="row">
                   <div class="col-md-4">
                       <p>कर्मचारी संकेत न.: {{$latest->s_no}}</p>
                   </div>
                </div>

                <div class="row">
                    <div class="col-md-4">

                        <p>भ्रमण गर्ने पदाधिकारी वा कर्मचारीको नाम: {{$latest->staffs->nep_name}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p>पद: {{$latest->position}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p>कार्यलय: {{$latest->office}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p>भ्रमण गर्ने स्थान(विदेश भए मुलुक र सहर): {{$latest->visit_place_name}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>भ्रमणको उद्स्य: </label>

                        <div style="border-style:solid">
                            
                            <p style="padding: 4%"> {{$latest->visit_aim}}</p> 
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p>भ्रमण अवधि: {{$difference_in_days}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @foreach ($detail as $item)
                        <p>भ्रमण गने साधन:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if ($item->visit_vehicle==1)<i class="fas fa-check-square"></i>@endif कार्यलयको&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if ($item->visit_vehicle==2)<i class="fas fa-check-square"></i>@endif सार्वजनिक&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if ($item->visit_vehicle==3)<i class="fas fa-check-square"></i>@endif भाडाको  </p>
                        @break
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p>भ्रमणको निमित्त माग गरको पेस्की खर्च : {{$latest->visit_expense}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <label for="">भ्रमण सम्बन्धि आवस्यक विवरण: </label>
                        <div style="border-style:solid">
                            
                          <p style="padding: 4%"> </p> 
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-9">
                        ...........................................................
                         <p>भ्रमण गर्ने पधादिकारी:  {{$latest->staffs->nep_name}}</p>
                         <p>मिति:- </p>
                    </div>

                    <div class="col-md-3 ">
                        ...........................................................
                        <div>
                            <p>भ्रमण स्वीकृत गर्ने गर्ने पधादिकारी: </p>
                            <p>मिति:- </p>
                        </div>
                    
                   </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h4><b> <u>प्रसासन शाखाले भर्ने</u> </b></h4>
                        <p>हाजिरी खातामा जनाएको मिति:</p>
                        <p>जनाउने कर्मचारीको दस्तखत:</p>
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