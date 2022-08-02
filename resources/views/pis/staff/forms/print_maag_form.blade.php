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
                    <p> <b> कार्यलय कोड न.:</b></p>
                    <p> <b> माग फारम</b></p>
    
                </div>
                <div class="col-md-4 text-right">
                    <p>म. ले. प. फारम न. : ४०१</p>
                </div>
    
                <div class="col-md-12 text-right">
                    <p>आ. व.: {{$fiscal_year}}</p>
                    @foreach ($latest as $item)
                        
                    @endforeach
                <p>माग न: {{nepali($item->maag_no)}}</p>
                    <p>मिति: {{$date}}</p>
                  </div>
                <div class="col-md-12">
                    <table class="table table-bordered" style="font-size: 13px;">
                        <thead>
                          <tr>
                            <th rowspan="2" scope="col">क्र.स.</th>
                            <th rowspan="2" scope="col">सामानको नाम</th>
                            <th rowspan="2" scope="col">स्पेसीफिकेसन</th>
                            <th colspan="2" style="text-align: center">माग गरिएको</th>
                            <th rowspan="2" scope="col">कैफियत</th>
                          </tr>
                          <tr>
                            <td>एकाई</td>
                            <td>परिमाण</td>
                          </tr>
                        </thead>
                        <tbody>
                            
                          @foreach ($latest as $key => $item)
                          <tr>
                            <td>{{nepali($key+1)}}</td>
                            <td>{{$item->saman->name}}</td>
                            <td>{{$item->specification}}</td>
                            <td>{{$item->unit}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->remarks}}</td>
                          </tr>
                          @endforeach

                       
                        </tbody>
                      </table>
                </div>
                <div class="col-md-4">
                    <p> माग गर्नेको दस्तखत: </p>
                    <p> नाम: {{$staff->nep_name}} </p>
                    <p> मिति: {{nepali($maag_date) }} </p>
                    <p> प्रयोजन: {{$prayojan }} </p>
                </div>
        
                <div class="col-md-4">
                    <p> सिफारिस गर्नेको दस्तखत: </p>
                    <p> नाम: {{$sifarish_garneko_name}}</p>
                    <p> मिति: {{nepali($sifarish_date)}}</p>
                    
                    </p>
                </div>
        
                <div class="col-md-4">
                    <p> क.) सिफारिस गर्नेको @if($kharid_type == 1) <i class="fas fa-check"></i> @endif  </p>
                    <p>   ख.) मौज्दातबाट दिनु @if($kharid_type == 2) <i class="fas fa-check"></i> @endif</p>
                </div>
    
               
            </div>
            <hr>
            <div class="row">
              <div class="col-md-4">
                <p>आदेश दिनेको दस्तखत: </p>
                <p>मिति: {{$aadesh_date}} </p>
            </div>
    
            <div class="col-md-4">
              <p>माल सामान बुजिलिनेको दस्तखत: </p>
              <p>मिति: {{$maal_saman_bujeko}} </p>
          </div>
    
          <div class="col-md-4">
            <p>जिन्सी खातामा चडाउनेको दस्तखत:</p>
            <p>मिति: {{$maal_saman_bujeko}} </p>
        </div>
            </div>
    
           
        </div>
    </div>
    
    

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

</body>


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