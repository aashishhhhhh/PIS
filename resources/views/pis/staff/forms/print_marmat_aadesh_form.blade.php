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
    <a id="backBtn" href="{{route('marmat-form-list')}}" class="btn btn-primary"><i class="fas fa-backspace"></i></a>
    </div>
    <div class="card" id="printdiv">
        <div class="container">
    
            <div class="row">
                <div class="col-md-4 text-left">
                    <img src="{{ asset('storage/upload/gov.jpg') }}" alt=""
                    class="px-1" height="200" width="350">
                </div>
                <div class="col-md-4 text-center">
                    {{-- todo --}}
                    <p>याङवरक  गाउपलिका</p>
                    <h3>गाउ कार्यपालिकाको कार्यलय</h3>
                    <p>थर्पु, पांचथर</p>
                    <p>१ न. प्रदेश, नेपाल</p>
                    <p> <b> कार्यलय कोड न.:</b></p>
                    <p> <b> मर्मत, सम्भार तथा सम्रक्षण आवेदन फाराम</b></p>
                    <p>आर्थिक बर्स: .......... साल ....... महिना.....</p>
    
                </div>
                <div class="col-md-12 text-right">

                  <p>मर्मत आवेदन फारम न: </p>
                  {{-- <input type="hidden" name="fiscal_year" value=""> --}}
    
                  <p id="maag_no">मिति: {{nepali($date)}}
                  </p>
                </div>
    
                <div class="col-md-12 text-left">
                  मर्मत आवेदनकर्ताले भर्ने
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered" style="font-size: 13px;">
                        <thead>
                          <tr>
                            <td rowspan="2" style="text-align: center;">क्र.स.</td>
                            <td rowspan="2" style="text-align: center;">सामानको विवरण</td>
                            <td rowspan="2" style="text-align: center;">समान पहिचान न.</td>
                            <td rowspan="2" style="text-align: center;">अनुमति मर्मत लागत<!-- /उप समूह !--></td>
                            <td  style="text-align: center;">मर्मत गर्नुपर्ने कारण</td>
                            <td rowspan="2" style="text-align: center;">मर्मत आवेद्नकर्ता नाम र सहि</td>
                            <td rowspan="2" style="text-align: center;">कैफियत</td>
                            <td rowspan="2" style="text-align: center;"></td>
                            
                          </tr>
                        </thead>
                        <tbody>
    
                          @foreach ($latest as $key => $item)
                          <tr>
                            <td>{{nepali($key+1)}}</td>
                            <td>{{$item->saman_bibaran}}</td>
                            <td>{{$item->saman_pahichan_no}}</td>
                            <td>{{$item->anumati_marmat_lagat}}</td>
                            <td>{{$item->reason}}</td>
                            <td>{{$item->applicant_name}}</td>
                            <td>{{$item->remarks}}</td>
                          </tr>
                          @endforeach
                       
                        </tbody>
                      </table>
                </div>
    
                <div class="col-md-12">
                  <table class="table table-bordered" style="font-size: 13px;">
                    <thead>
                      <th>
                        <td rowspan="2" style="text-align: center;">स्टोरकिपर/फाटवालाले भर्ने </td>
                        <td rowspan="2" style="text-align: center;">वारेन्टी अवधि भए / नभएको</td>
                        <td rowspan="2" style="text-align: center;">अगाडी मर्मत गरिएको पटक</td>
                        <td rowspan="2" style="text-align: center;">अगाडी मर्मत गरिएको मिति</td>
                        <td  style="text-align: center;">अगाडी मर्मत गरिएको रकम</td>
                        <td rowspan="2" style="text-align: center;">मर्मत आवेद्नकर्ता नाम र सहि</td>
                      </th>
                    </thead>
    
                    <tbody>
                      <tr>
    
                      </tr>
                    </tbody>
                  </table>
    
                </div>
               
            </div>
            <hr>
             <div class="row">
             <div class="col-md-4">
                <p>श्री.............. </p>
                <p>मर्मत आदेश दिइएको व्यक्ति/निकायको नाम: {{$staff->nep_name}} </p>
                <p>ठेगाना: {{$staff_address->municipalities->nep_name}} </p>
                <p>फोन न: {{$staff_address->p_contact}}</p>
                <p>संस्था दर्ता न:  {{$staff->sanstha_darta_no}}</p>
                <p>प्यान न:{{$staff->pyan_no}} </p>
                <p>माथि उल्लेखित सामानको मर्मत गरि मिति {{nepali($staff_detail_date)}} भित्र यस कार्यालयमा बिल/इन्भाइससहित बुजाउनु होला: </p>
            </div> 
    
            <div class="col-md-4">
              <p>सिफरिस गर्ने साखा प्रमुखको सहि: </p>
              <p>नाम: 
                @foreach ($staffs as $item)
                @if ($item->id==$sakha_pramukh_name)
                नाम: {{$item->nep_name}}
                @endif
            @endforeach  
              </p>
              <p> दर्जा: {{$sakha_pramukh_position}}</p>
              <p>मिति: {{$sakha_pramukh_date}} </p>   
          </div>
    
          <div class="col-md-4">
            <p>सिफरिस गर्ने साखा प्राविधिकको सहि: </p>
            <p>
                @foreach ($staffs as $item)
                @if ($item->id==$sakha_prawidhik_name)
                नाम: {{$item->nep_name}}
                @endif
            @endforeach  </p>
            <p> दर्जा: {{$sakha_prawidhik_position}}  </p>
            <p>मिति: {{nepali($sakha_prawidhik_date)}} </p>
        </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-md-12">
              <p>स्वीकृत गर्ने कार्यलय प्रमुखको सहि: </p>
              <p>
                @foreach ($staffs as $item)
                    @if ($item->id==$karylaya_pramukh_name)
                    नाम: {{$item->nep_name}}
                    @endif
                @endforeach    
              </p>
              
              <p>दर्जा:{{$karylaya_pramukh_position}} </p>
              <p>मिति: {{nepali($karylaya_pramukh_date)}}</p>   
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