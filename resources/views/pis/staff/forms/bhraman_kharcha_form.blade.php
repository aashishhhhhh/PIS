@extends('layout.layout')
@section('title', 'भ्रमण')
@section('menu_show_bhramad', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('bhramad_kharcha_bill', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
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

            <div class="table">
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

                    @foreach ($visit->staffVisitAadeshDetail as $key => $item)
                        <tr id="rem_bank{{$key}}">
                           <td>
                                <input type="hidden" name="destination_no[]" value="{{$item->destination_no}}">
                               <input type="text" name="prasthan_place[]" value="{{$item->departure_place}}" id="prasthan_place{{$key}}" class="prasthan_place{{$key}}">
                           </td>
                           <td><input type="text" class="date" name="prasthan_date[]" id="prasthan_date{{$key}}" value="{{$item->departure_date}}"></td>
                           <td><input type="text" name="pahuch_place[]" id="pahuch_place{{$key}}" class="pahuch_place{{$key}}" value="{{$item->destination_place}}"></td>
                           <td><input type="text" class="datee" name="pahuch_date[]" id="pahuch_date{{$key}}" value="{{$item->destination_date}}"></td>
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
                        </tr>
                    @endforeach

                        <tr id="last1">
                            <td class="text-center">
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
                                <div class="" style="position: relative; left:100px;"> 
                                    <p> स्वीकृत भ्रमण आदेश न र मिति : </p>
                                    <br>
                                    <br>
                                    <br>
                                    <p>पेश भएको व्यहोरा ठिक छ, झुट्टा ठहरे प्रचलित कानुन बमोजिम सहने छु बजाउने छु |</p>
                                    <br>
                                    <br>
                                    <p>भ्रमण गर्ने कर्मचारी दश्तखत:</p>
                                    <p>मिति: <input type="text" class="date" name="karmachari_date"></p>
                                </div>  
                            </td>
                             <td style="border: none !important; text-align:right"> स्वीकृत रकम रु  </td>
                             <td> <input type="text" name="swikrit_amount">   </td>
                             <td colspan="2" rowspan="5"  style="border: none !important; text-align:right"></td>
                        </tr>

                        <tr id="lastt11">
                            <td>
                                <p > ६.२५ दिनको भ्रमण भत्ता </p>
                            </td>

                            <td>
                                <p class="bhatta_total_all"> </p>
                             </td>
                             <td colspan="2" style="border: none !important;"> 
                            <p> जाच गर्ने अधिकारीको दस्तखत:</p>
                            <p> मिति:
                                <input class="date" name="jaach_date" id="jaach_date" type="text"></p>
                            <br>
                            <br>
                            <br>
                            <p>स्वीकृतगर्ने अधिकारीको दस्तखत</p>
                           
                            <div class="container"
                                <p>मिति   <input type="text" class="date" id="swikrit_date" name="swikrit_date"></p>
                            
                            </td>
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
</div>
@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/convert_nepali.js') }}"></script>
<script>
          var visit = @json($visit, JSON_PRETTY_PRINT);
$('.date').nepaliDatePicker({
          ndpYear: true,
          ndpMonth: true,
          ndpYearCount: 70,
          ndpTriggerButton: false,
          ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
          ndpTriggerButtonClass: 'btn btn-primary',
          disableBefore: visit.from_date,
          disableAfter: visit.to_date
      });
      
</script>


<script>


    // function addRow()
    // {
    //     var visit =  @json($visit, JSON_PRETTY_PRINT);
    //     var detailLength = visit.staff_visit_aadesh_detail.length;
    //     i=detailLength;
    //     $('.date').nepaliDatePicker({
    //               ndpYear: true,
    //               ndpMonth: true,
    //               ndpYearCount: 70,
    //               ndpTriggerButton: false,
    //               ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
    //               ndpTriggerButtonClass: 'btn btn-primary',
    //               disableBefore: visit.from_date,
    //               disableAfter: visit.to_date
    //           });

       
    //     var html = '<tr id="rem_bank' + i + '">' +
    //         '<td class="text-center">' +
    //         '<input type="text" name="prasthan_place[]" class="prasthan_place'+i+'">' +
    //         '</td>' +
            
    //         '<td style="max-width: 200px;">'+
    //             '<input type="text" class="date" name="prasthan_date[]">'+
    //         '</td>'+

                
    //         '<td style="max-width: 200px;">'+
    //             '<input type="text" name="pahuch_place[]" class="pahuch_place'+i+'">' +
    //         '</td>'+

    //         '<td class="text-center">' +
    //             '<input type="text" class="date" name="pahuch_date[]">'+
    //         '</td>' +

    //         '<td style="max-width: 200px;">'+
    //             '<input type="text" name="visit_vehicle[]" class="visit_vehicle'+i+'">' +
    //         '</td>'+

    //         '<td style="max-width: 200px;">'+
    //             '<input type="text" name="visit_expense[]" onchange="calculateTotal('+i+')" class="visit_expense'+i+'">' +
    //         '</td>'+


    //         '<td class="text-center">' +
    //         '<input type="text" onchange="calculateTotal('+i+')" name="bhatta_day[]" class="bhatta_day'+i+'">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '<input type="text" onchange="calculateTotal('+i+')" name="bhatta_rate[]" class="bhatta_rate'+i+'">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '<input type="text" name="bhatta_total[]" class="bhatta_total'+i+'">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '<input type="text" name="futkar_detail[]"  class="futkar_detail'+i+'">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '<input type="text" name="futkar_total[]" onchange="calculateTotal('+i+')" class="futkar_total'+i+'">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '<input type="text" name="all_total[]" class="all_total'+i+'">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '<input type="text" name="remarks[]" class="remarks'+i+'">' +
    //         '</td>' +

    //         '<td>'+
    //         '<a id="remove_btn" onclick="removeBank(' + i +')"  class="btn btn-danger df"><i class="fa fa-times"></i></a>'+
    //         '</td>'+

    //         '</tr>'

    //         var html2 = '<tr id="last' + i + '">' +
    //         '<td class="text-center">' +
    //         '</td>' +
            
    //         '<td style="max-width: 200px;">'+
    //         '</td>'+

                
    //         '<td style="max-width: 200px;">'+
    //         '</td>'+

    //         '<td class="text-center">' +
    //         '</td>' +

    //         '<td style="max-width: 200px;">'+
    //             'जम्मा'+
    //         '</td>'+
            
    //         '<td class="bhraman_total'+i+'">' +
    //             '<input type="text" class="bhraman_total'+i+'" name="bhraman_total" value="" readonly>'+
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //             '<input type="text" class="bhatta_total_all'+i+'" name="bhatta_total_all" value="" readonly>'+
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //             '<input type="text" class="futkat_total_all'+i+'" name="futkat_total_all" value="" readonly>'+
    //         '</td>' +

    //         '<td class="text-center">' +
    //             '<input type="text" class="total_all_all'+i+'" name="total_all_all" value="" readonly>'+
    //         '</td>' +

    //         '<td class="text-center">' +
    //         '</td>' +

    //         '<td class="text-center">' +
    //             ' <a class="btn btn-primary" onclick="test('+i+')"><i class="fas fa-calculator"></i> </button> '+
    //         '</td>' +
    //         '</tr>'

    //         var html3 =  '<tr id="lastt' + i + '">'+
    //             '<td>'+
    //                 '<p> भ्रमण खर्च </p>'+
    //             '</td>'+

    //             '<td>'+
    //                 '<p class="bhraman_total"> </p>'+
    //             '</td>'+
    //         '</tr>'

    //         var html4 =  '<tr id="lastt1' + i + '">'+
    //             '<td>'+
    //                 '<p> ६.२५ दिनको भ्रमण भत्ता </p>'+
    //             '</td>'+

    //             '<td>'+
    //                 '<p class="bhatta_total_all"> </p>'+
    //             '</td>'+
    //         '</tr>'

    //         var html5 =  '<tr id="lastt2' + i + '">'+
    //             '<td>'+
    //                 '<p> फूटकर खर्च </p>'+
    //             '</td>'+

    //             '<td>'+
    //                 '<p class="futkat_total_all"> </p>'+
    //             '</td>'+
    //         '</tr>'

    //         var html6 =  '<tr id="lastt3' + i + '">'+
    //             '<td>'+
    //                 '<p> कुल जम्मा </p>'+
    //             '</td>'+

    //             '<td>'+
    //                 '<p class="total_all_all"> </p>'+
    //             '</td>'+
    //         '</tr>'

    //         var html7 =  '<tr id="lastt4' + i + '">'+
    //             '<td>'+
    //                 '<p> भ्रमण पेस्की रु </p>'+
    //             '</td>'+

    //             '<td>'+
    //                 '<input type="text" class="form-control" name="bhraman_peski">'+
    //             '</td>'+
    //         '</tr>'

    //         var html8 =  '<tr id="lastt5' + i + '">'+
    //             '<td>'+
    //                 '<p> खुद भुक्तानी पाऊने रकम रु </p>'+
    //             '</td>'+

    //             '<td>'+
    //                 '<input type="text" class="form-control" name="khud_bhuktani">'+
    //             '</td>'+
    //         '</tr>'


    //         let k = i-1;
    //         $("#row_body").append(html);
    //         $('#last'+k).html('');
    //         $('#lastt'+k).html(''); 
    //         $('#lastt1'+k).html('');
    //         $('#lastt2'+k).html('');
    //         $('#lastt3'+k).html('');
    //         $('#lastt4'+k).html('');
    //         $('#lastt5'+k).html('');
          
    //         $("#row_body").append(html2);
    //         $("#row_body").append(html3);
    //         $("#row_body").append(html4);
    //         $("#row_body").append(html5);
    //         $("#row_body").append(html6);
    //         $("#row_body").append(html7);
    //         $("#row_body").append(html8);
    //         i++;
    //         j++;
    //         $('.date').nepaliDatePicker({
    //               ndpYear: true,
    //               ndpMonth: true,
    //               ndpYearCount: 70,
    //               ndpTriggerButton: false,
    //               ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
    //               ndpTriggerButtonClass: 'btn btn-primary',
    //               disableBefore: visit.from_date,
    //               disableAfter: visit.to_date
    //           });
         
    //         }
</script>

<script>
    let previous_total_visit=0;
    let previous_total_bhatta=0;
    let bhatta_day;
    let bhatta_rate;
    let futkar_total;
    let visit_expense;
    let index=0;
   function calculateTotal(i)
    {
        let index = i;
        bhatta_day = $('.bhatta_day'+i).val();
        bhatta_rate = $('.bhatta_rate'+i).val();
        futkar_total = $('.futkar_total'+i).val();
        visit_expense = $('.visit_expense'+i).val();
       let total_expense = parseInt(visit_expense) + parseInt(previous_total_visit);
       previous_total_visit = parseInt(total_expense);

       let total_bhatta = bhatta_day*bhatta_rate;
        $('.bhatta_total'+i).val(total_bhatta);
        
       if (futkar_total!='') {
           let all_total = parseInt(futkar_total)  +parseInt(total_bhatta);
            $('.all_total'+i).val(all_total);
       }
    }
   

    function test(i) {
        console.log(i);
        let total_expense_all=0;
        let total_all_bhatta =0;
        let total_all_futkar =0;
        let total_all_all =0;
        for (let index = 0; index < i; index++) {
            total_expense_all = parseInt($('.visit_expense'+index).val()) + parseInt(total_expense_all);
            total_all_bhatta = parseInt($('.bhatta_total'+index).val()) + parseInt(total_all_bhatta);
            total_all_futkar = parseInt($('.futkar_total'+index).val()) + parseInt(total_all_futkar);
            total_all_all = parseInt($('.all_total'+index).val()) + parseInt(total_all_all);
        }
            $('.bhraman_total1').val(total_expense_all);
            $('.bhatta_total_all1').val(total_all_bhatta);
            $('.futkat_total_all1').val(total_all_futkar);
            $('.total_all_all1').val(total_all_all);            
     
        $('.bhraman_total').text(total_expense_all);
        $('.bhatta_total_all').text(total_all_bhatta);
        $('.futkat_total_all').text(total_all_futkar);
        $('.total_all_all').text(total_all_all);
    }

</script>

<script>
     function removeBank(index) {
           $('#rem_bank'+index).html('');
        }
</script>

<script>
    var visit = @json($visit, JSON_PRETTY_PRINT);
    console.log(visit);

    $.each(visit.staff_visit_aadesh_detail, function( index, value ) {
        if (value.is_approved==1) {
            $('#prasthan_place'+index).prop("disabled",'disabled');
            $('#prasthan_date'+index).prop("disabled",'disabled');
            $('#pahuch_place'+index).prop("disabled",'disabled');
            $('#pahuch_date'+index).prop("disabled",'disabled');
            $('#visit_vehicle'+index).prop("disabled",'disabled');
            // $('#departure_date'+index).prop("disabled", 'disabled');
            // $('#destination_place'+index).prop('disabled', 'disabled');
            // $('#destination_date'+index).prop("disabled", 'disabled');
            // $("#visit_vehicle"+index).prop('disabled', 'disabled');
            // $("#destination_no"+index).prop('disabled', 'disabled');
            // $("#is_approved"+index).prop('disabled', 'disabled');
            }
      });

</script>

<script>
//      $(".date").nepaliDatePicker({
//     container: ".container",
//   });
</script>

@endsection