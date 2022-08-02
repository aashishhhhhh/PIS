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

    <div class="card">
        <div class="card-header">
            <h3>भ्रमण खर्च बिल</h3>
        </div>
        <div class="card-body">
            {{-- <form action="" method="POST">
                @csrf

                <div class="row m-4 text-center">
                    <div class="col-md-12">
                        <label for="">आदेश न. हालनुहोस:</label>
                        <div class="search">
                          <input type="number" name="aadesh_no" class="form-control"  placeholder="आदेश न हालनुहोस">
                        </div>
                      </div>

                      <div class="col-md-12 mt-2">
                        <button class="btn btn-primary">
                            <i class="fa fa-search"></i></button>
                      </div>
                </div>
            </form> --}}
        
          <form action="{{route('print-bhraman-kharcha')}}" method="POST">
            <input type="hidden" name="aadesh_no" value="{{$visit->aadesh_no}}" >
              @csrf
            <div class="row">

            <div class="table-responsive">
                <table class="table table_bordered">
                    <thead>
                        <tr>
                            <th colspan="2">प्रस्थान</th>
                            <th colspan="2">पहुच</th>
                            <th rowspan="2">भ्रमण साधन</th>
                            <th rowspan="2">भ्रमण खर्च</th>
                            <th colspan="3">दैनिक भत्ता</th>
                            <th colspan="2">फुटकर खर्च</th>
                            <th rowspan="2">कुल जम्मा</th>
                            <th rowspan="2">कैफियत</th>
                            <th rowspan="2">स्वीकृत</th>
                        </tr>

                        <tr id="addrow">
                            <th>स्थान</th>
                            <th>मिति</th>
                            <th>स्थान</th>
                            <th>मिति</th>
                            <th>दिन</th>
                            <th>दर</th>
                            <th>जम्मा</th>
                            <th>विवरण</th>
                            <th>जम्मा</th>
                        </tr>
                    </thead>
                    <tbody  id="row_body">

                    {{-- @foreach ($visit->staffVisitAadeshDetail as $key => $item)
                        <tr id="rem_bank{{$key}}">
                           <td>
                                <input type="hidden" name="destination_no[]" value="{{$item->destination_no}}">
                               <input type="text" name="prasthan_place[]" value="{{$item->departure_place}}" id="prasthan_place{{$key}}" class="prasthan_place{{$key}}">
                           </td>
                           <td><input type="text" class="date" name="prasthan_date[]" id="prasthan_date{{$key}}" value="{{$item->departure_date}}"></td>
                           <td><input type="text" name="pahuch_place[]" id="pahuch_place{{$key}}" class="pahuch_place{{$key}}" value="{{$item->destination_place}}"></td>
                           <td><input type="text" class="date" name="pahuch_date[]" id="pahuch_date{{$key}}" value="{{$item->destination_date}}"></td>
                           <td><input type="text" name="visit_vehicle[]" id="visit_vehicle{{$key}}" class="visit_vehicle{{$key}}"
                            @if ($item->visit_vehicle==1)
                                value='कार्यलयको'
                            @endif

                            @if ($item->visit_vehicle==2)
                                value='सार्वजनिक'
                            @endif

                            @if ($item->visit_vehicle==3)
                                value='भाडाको'
                            @endif
                            ></td>
                           <td><input type="number" name="visit_expense[]" id="visit_expense{{$key}}" onchange="calculateTotal({{$key}})" class="visit_expense{{$key}}"></td>
                           <td><input type="number" onchange="calculateTotal({{$key}})" name="bhatta_day[]" id="bhatta_day{{$key}}"  class="bhatta_day{{$key}}"></td>
                           <td><input type="number" onchange="calculateTotal({{$key}})" name="bhatta_rate[]" id="bhatta_rate{{$key}}" value="{{$staffService->bhattas->bhatta}}" class="bhatta_rate{{$key}}"></td>
                           <td><input type="number"  name="bhatta_total[]" id="bhatta_total{{$key}}" class="bhatta_total{{$key}}"></td>
                           <td><input type="text" name="futkar_detail[]" id="futkar_detail{{$key}}" class="futkar_detail{{$key}}"></td>
                           <td><input type="number" onchange="calculateTotal({{$key}})" name="futkar_total[]" id="futkar_total{{$key}}" class="futkar_total{{$key}}"></td>
                           <td><input type="number" name="all_total[]" class="all_total{{$key}}" id="all_total{{$key}}"></td>
                           <td><input type="text" name="remarks[]" class="remarks{{$key}}" id="remarks{{$key}}"></td>
                           <td>
                            @if($item->is_approved==0)
                            <a href="{{route('approve-particular-destination',$item->id)}}" class="btn btn-primary"><i class="fas fa-thumbs-up"></i></a>
                            @else
                            <a href="{{route('decline-particular-destination',$item->id)}}" class="btn btn-primary"><i class="fas fa-thumbs-down"></i></a>
                            @endif
                        </td>
                           {{-- <td>
                            @if ($key>=1)
                            <a id="remove_btn" onclick="removeBank({{$key}})"  class="btn btn-danger df"><i class="fa fa-times"></i></a>
                            @else
                            <a class="btn btn-primary" id="addRow" onclick="addRow()"><i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                            @endif
                           </td> --}}
                        </tr>
                    @endforeach --}}

                        <tr id="last1">
                            <td>
                                </td>
                                
                                <td style="max-width: 200px;">
                                    
                                <td style="max-width: 200px;">
                                </td>
                    
                                <td class="text-center">
                                </td>
                    
                                <td style="max-width: 200px;">
                                    जम्मा
                                </td>
                                
                                <td class="bhraman_total1">

                                    <input type="text" class="bhraman_total1" name="bhraman_total" value="" readonly>
                                </td>
                    
                                <td class="text-center">
                                </td>
                    
                               <td class="text-center">
                                </td>
                    
                                <td class="text-center">
                                    <input type="text" class="bhatta_total_all1" name="bhatta_total_all" value="" readonly>
                                </td>
                    
                                <td class="text-center">
                               </td>
                    
                                <td class="text-center">
                                    <input type="text" class="futkat_total_all1" name="futkat_total_all" value="" readonly>
                                </td>
                    
                                <td class="text-center">
                                    <input type="text" class="total_all_all1" name="total_all_all" value="" readonly>
                                </td>
                    
                                <td class="text-center">
                               </td>

                               <td class="text-center">
                                 <a class="btn btn-primary" onclick="test({{$key+1}})"><i class="fas fa-calculator"></i> </a> 
                               </td>
                    
                        </tr>

                        <tr id="lastt1">
                            <td>
                                <p> भ्रमण खर्च </p>
                            </td>
                            <td>
                                <p class="bhraman_total"> </p>
                             </td>
                             <td colspan="8" rowspan="5"  style="border: none !important"> 
                                {{-- <div class="" style="position: relative; left:100px;"> 
                                    <p> स्वीकृत भ्रमण आदेश न र मिति : <input type="text"> </p>
                                    <br>
                                    <br>
                                    <br>
                                    <p>पेश भएको व्यहोरा ठिक छ, झुट्टा ठहरे प्रचलित कानुन बमोजिम सहने छु बजाउने छु |</p>
                                    <br>
                                    <br>
                                    <p>भ्रमण गर्ने कर्मचारी दश्तखत:</p>
                                    <p>मिति: <input type="text"></p>
                                </div>   --}}
                            </td>
                             <td style="border: none !important; text-align:right"> स्वीकृत रकम रु  </td>
                             <td>   </td>
                             <td colspan="2" rowspan="5"  style="border: none !important; text-align:right"></td>
                        </tr>

                        <tr id="lastt11">
                            <td>
                                <p > ६.२५ दिनको भ्रमण भत्ता </p>
                            </td>

                            <td>
                                <p class="bhatta_total_all"> </p>
                             </td>
                             {{-- <td colspan="2" style="border: none !important;"> 
                            <p> जाच गर्ने अधिकारीको दस्तखत:</p>
                            <p> मिति:
                                <input class="date" name="jaach_date" id="jaach_date" type="text"></p>
                            <br>
                            <br>
                            <br>
                            <p>स्वीकृतगर्ने अधिकारीको दस्तखत</p>
                            <p>मिति <input type="text" class="date" id="swikrit_date" name="swikrit_date"></p>
                            </td> --}}
                        </tr>

                        <tr id="lastt21">
                            <td> 
                                <p > फूटकर खर्च </p>
                            </td>

                            <td>
                                <p class="futkat_total_all"> </p>
                             </td>
                        </tr>

                        <tr id="lastt31">
                            <td>
                                <p > कुल जम्मा </p>
                            </td>

                            <td>
                                <p class="total_all_all"> </p>
                             </td>
                        </tr>

                        <tr id="lastt41">
                            <td>
                                <p> भ्रमण पेस्की रु </p>
                            </td>

                            <td>
                                <input type="text" class="form-control" name="bhraman_peski">
                             </td>
                        </tr>

                        
                        <tr id="lastt51">
                            <td>
                                <p> खुद भुक्तानी पाऊने रकम रु</p>
                            </td>

                            <td>
                                <input type="text" class="form-control" name="khud_bhuktani">
                            </td>
                        </tr>
                    </tbody>
                
                </table>

            </div>

           
        </div>

        {{-- <div class="row">
            <div class="col-md-4">
               <p>स्वीकृत भ्रमण आदेश न. र मिति: <input type="text" class="datee"></p>
            </div>

            <div class="col-md-4">
                <p>भ्रमण गर्ने कर्मचारीको दस्तखत:</p>
                <p>मिति: <input type="text" class="datee"></p>
             </div>

             <div class="col-md-4">
                <p>जाच गर्ने अधिकारीको दस्तखत:</p>
                <p>मिति: <input type="text" class="datee"></p>
             </div>
        </div>

        <div class="row">
             <div class="col-md-4">
                 <p>स्वीकृत गर्ने कर्मचारीको दस्तखत:</p>
                 <p>मिति: <input type="text" class="datee"></p>
              </div>
 
        </div> --}}
        <div class="cared-footer text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>      




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