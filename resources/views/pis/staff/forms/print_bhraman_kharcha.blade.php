<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <title>AdminLTE 3 | Dashboard</title> --}}

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
    {{-- <style type="text/css" media="print">
        @page { size: landscape; }
      </style> --}}
      {{-- <style>
        @media print{@page {size: landscape}}
      </style> --}}
      <style type="text/css" media="print">
        @page { 
            size: landscape;
        }
        /* body { 
            writing-mode: tb-rl;
        } */

    </style>

</head>
<body>
    <div class="text-right">

        <button id="printbtn" class="btn btn-primary"><i class="fas fa-print"></i></button>
        <a id="backBtn" href="{{route('bhraman-list')}}" class="btn btn-primary"><i class="fas fa-backspace"></i></a>
        </div>
        <div class="letter_wrap">
        <div class="letter_inner">
          <!-- <a id="print_btn" href="./printe_letter.html" target="_blank">
            <i class="fa-solid fa-print"></i> <span> प्रिन्ट </span>
          </a> -->
          <div class="letter_header" id="rashid_letter">
            <img src="{{ asset('storage/upload/gov_logo.png') }}" alt="" class="letter_logo" />
            <div class="letter_number_detail">
              <div>नाम : {{isset($staffVisitAadesh->staffs->nep_name)? $staffVisitAadesh->staffs->nep_name : ''}}</div>
              <div>दर्जा : {{isset($staff_service->positions->name) ? $staff_service->positions->name : ''}} </div>
              <div> कार्यालय :  </div>
              <div> स्थायी ठेगाना :  </div>
            </div>
            <div class="letter_title">
              <p>याङवरक  गाउपलिका</p>
              <h3>गाउ कार्यपालिकाको कार्यलय</h3>
              <p>थर्पु, पांचथर</p>
              <p>१ न. प्रदेश, नेपाल</p>
              <p> <b> नत्थी रशिद बिल आदिको संख्या : </b></p>
              <p> <b> भ्रमणको उदेस्य : {{$staffVisitAadesh->visit_aim}}</b></p>

  
              {{-- <div class="letter_type"></div> --}}
            </div>
            <div class="letter_date">
              <div> म. ले. प. फा. नं. : </div>
              <img src="emblem_nepal.png" alt="">
            </div>
          </div>
          <div class="letter_body mt-5" >
            <table class="letter_table table table_bordered">
              <tr>
                <th colspan="2"> प्रस्थान </th>
                <th colspan="2"> पहुँच </th>
                <th rowspan="2"> भ्रमण साधन </th>
                <th rowspan="2"> भ्रमण खर्च </th>
                <th colspan="3"> दैनिक भता </th>
                <th  colspan="2"> फुटकर खर्च </th>
                <th rowspan="2"> कुल जम्मा </th>
                <th rowspan="2"> कैफियत </th>
              </tr>
              <tr>
                <th> स्थान </th>
                <th> मिति </th>
                <th> स्थान </th>
                <th> मिति </th>
                <th> दिन </th>
                <th> दर </th>
                <th> जम्मा </th>
                <th> विवरण </th>
                <th> जम्मा </th>
              </tr>
              
              @foreach ($latest as $item)
              <tr>
                <td> {{$item->prasthan_place}} </td>
                <td> {{$item->prasthan_date}}</td>
                <td> {{$item->pahuch_place}} </td>
                <td> {{$item->pahuch_date}} </td>
                <td> @if($item->visit_vehicle=='1')
                     कार्यलयको
                    @endif
                    @if($item->visit_vehicle=='2')
                     सार्वजनिक
                    @endif
                    @if ($item->visit_vehicle=='3')
                        भाडाको
                    @endif
                </td>
                <td> {{$item->visit_expense}}</td>
                <td> {{$item->bhatta_day}}</td>
                <td> {{$item->bhatta_rate}} </td>
                <td> {{$item->bhatta_total}} </td>
                <td>{{$item->futkar_detail}} </td>
                <td> {{$item->futkar_total}} </td>
                <td> {{$item->all_total}}</td>
                <td> {{$item->remarks}}</td>
              </tr>
              @endforeach

              <tr>
                <td>  </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> 
                  जम्मा
                </td>
                <td>{{$item->bhraman_total}}</td>
                <td> </td>
                <td> </td>
                <td>{{$item->bhatta_total_all}}</td>
                <td></td>
                <td> {{$item->futkat_total_all}}</td>
                <td>{{$item->total_all_all}}</td>
                <td> </td>
              </tr>


              <tr>
                <td colspan="3"> १. भमण खर्च </td>
                <td>{{$item->bhraman_total}} </td>
                <td colspan="5" rowspan="6" style="border: 0px !important;">
                  <div> स्वीकृत भ्रमण आदेश र मिति: </div>
                  <br>
                  <div>
                    पेश भएको व्यहोरा ठिक छ, झुटा ठहरे प्रचलित कानुन बमोजिम सहने छु बजाउने छु |
                  </div>
                  <br>
                  <div> भ्रमण गर्ने कर्मचारीको दस्तखत : </div>
                  <div> मिति: {{$item->karmachari_date}} </div>                </td>
                <td colspan="2" style="border: 0px !important; text-align: right;"> स्विकर्ती रकम रु : </td>
                <td>{{$item->swikrit_amount}} </td>
                <td  style="border: 0px !important;"></td>
              </tr>
  
              <tr>
                <td colspan="3"> ६.२५ दिनको भ्रमण भत्ता
                 
                </td>
                <td> {{$item->bhatta_total_all}} </td>
                
                <td rowspan="5" colspan="4" style="border: 0px !important;"> 
                  <div> जाच गर्ने अधिकारीको दस्तखत : </div>
                  <div> मिति : {{$item->jaach_date}}  </div>
                  <br>
                  <div> स्वीकृत गर्ने अधिकारीको दस्तखत : </div>
                  <div> मिति : {{$item->swikrit_date}} </div>
                </td>
           
              </tr>
            
              <tr>
                <td colspan="3"> फूटकर खर्च

                </td>
                <td>{{$item->futkat_total_all}} </td>
                <!-- <td rowspan="5"> </td> -->
              </tr>
  
              <tr>
                <td colspan="3"> कुल जम्मा</td>
                <td> {{$item->total_all_all}}</td>
                <!-- <td rowspan="5"> </td> -->
              </tr>
  
              <tr>
                <td colspan="3"> भ्रमण पेस्की रु



                </td>
                <td>{{$item->bhraman_peski}} </td>
                <!-- <td rowspan="5"> </td> -->
              </tr>
  
              <tr>
                <td colspan="3"> खुद भुक्तानी पाऊने रकम रु
                </td>
                <td>{{$item->khud_bhuktani}} </td>
                <!-- <td rowspan="5"> </td> -->
              </tr>
  
  
              
            </table>
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

<script>
    const onPrint = () => {
            var divContents = document.getElementById("rashid_letter").innerHTML;
            var head = document.getElementsByTagName('head')[0].innerHTML;
            console.log(head);
            var a = window.open('', '', 'height=1000, width=1000');
            a.document.write('<html>');
            a.document.write('<head>');
            a.document.write(head);
            a.document.write('</head>');
            a.document.write('<body>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.onload = function() {
                a.onafterprint = a.close;
               a.print();
            };

        }
</script>


  