@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_marmat_aadesh', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('marmat_form', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection


@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<form action="{{route('marmat-form-print')}}" method="GET">

  <div class="card">

    <div class="card-header text-right">
    </div>
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
                <p> <b> मर्मत, सम्भार तथा सम्रक्षण आवेदन फाराम</b></p>
                <p>आर्थिक बर्स: .......... साल ....... महिना.....</p>

            </div>
            <div class="col-md-12 text-right">
              @foreach ($latest as $item)
                  
              @endforeach
              <p>मर्मत आवेदन फारम न: {{nepali($item->marmat_form_no)}} </p>
              <input type="hidden" name="fiscal_year" value="{{$fiscal_year}}">

                @php
                $id = array();
                foreach ($latest as $key => $value) {
                    $id[$key] = $value->id;
                }
                @endphp

              @foreach ($id as $item)
              <input type="hidden" name="latest[]" value="{{$item}}">
              @endforeach
              <p id="maag_no">मिति: <input type="text" name="date" id="date" class="date">
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
                <tr>
                  <td> जिन्सी संकेत न </td>
                  <td> वारेन्टी अवधि भए / नभएको</td>
                  <td>अगाडी मर्मत गरिएको पटक </td>
                  <td> अगाडी मर्मत गरिएको मिति<!-- /उप समूह !--></td>
                  <td>अगाडी मर्मत गरिएको रकम </td>
                </tr>
                <tr>
                  <td> {{$marmatstorekeeper->sanket_no}} </td>
                  <td>@if ($marmatstorekeeper->has_warranty==1)
                    भएको
                  @else
                    नभएको
                  @endif</td>
                  <td>{{$marmatstorekeeper->before_marmat_times}}</td>
                  <td>{{$marmatstorekeeper->before_marmat_date}}</td>
                  <td>{{$marmatstorekeeper->before_marmat_price}}</td>
                </tr>
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
            <p>माथि उल्लेखित सामानको मर्मत गरि मिति <input type="text" name="staff_detail_date" class="date"> भित्र यस कार्यालयमा बिल/इन्भाइससहित बुजाउनु होला: </p>
        </div>

        <div class="col-md-4">
          <p>सिफरिस गर्ने साखा प्रमुखको सहि: </p>
          <p>नाम: <select name="sakha_pramukh_name" id="sakha_pramukh_name">
            <option value="">छान्नुहोस्</option>
            @foreach ($staff_all as $item)
                <option value="{{$item->id}}">{{$item->nep_name}}</option>
            @endforeach  
          </select> </p>
          <p> दर्जा: <input id="sakha_pramukh_position" name="sakha_pramukh_position" type="text" readonly>  </p>
          <p>मिति: <input type="text" name="sakha_pramukh_date" class="date"> </p>   
      </div>

      <div class="col-md-4">
        <p>सिफरिस गर्ने साखा प्राविधिकको सहि: </p>
        <p>नाम: <select name="sakha_prawidhik_name" id="sakha_prawidhik_name">
          <option value="">छान्नुहोस्</option>  
          @foreach ($staff_all as $item)
          <option value="{{$item->id}}">{{$item->nep_name}}</option>
        @endforeach
        </select> </p>
        <p> दर्जा: <input id="sakha_prawidhik_position" name="sakha_prawidhik_position" type="text" readonly>  </p>
        <p>मिति: <input type="text" name="sakha_prawidhik_date" class="date"> </p>
    </div>
        </div>

        <hr>
        <div class="row">
        <div class="col-md-4">
          <p>स्वीकृत गर्ने कार्यलय प्रमुखको सहि: </p>
          <p>नाम:
            <select name="karylaya_pramukh_name" id="karylaya_pramukh_name">
              <option value="">छान्नुहोस्</option>  
              @foreach ($staff_all as $item)
              <option value="{{$item->id}}">{{$item->nep_name}}</option>
            @endforeach
            </select>  </p>
          <p>दर्जा: <input name="karylaya_pramukh_position" id="karylaya_pramukh_position"  type="text" readonly> </p>
          <p>मिति: <input type="text" name="karylaya_pramukh_date" class="date"> </p>   
      </div>
        </div>
    </div>


    <div class="card-footer">
      <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> प्रिन्ट गर्नुहोस</button>
    </div>
</div>
</form>

@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/convert_nepali.js') }}"></script>

<script>
  $('.date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
</script>

<script>
let data1 = [];
$(function(){
  $('#sakha_pramukh_name').on('change', function() {
    if ($('#sakha_pramukh_name').val()!='') {
         let val = $('#sakha_pramukh_name').val();
         test(val);
         setTimeout(function(){
          if (jQuery.isEmptyObject(data1)) {
              $('#sakha_pramukh_position').val('')
            }
            else{
              $('#sakha_pramukh_position').val(data1.positions.name)
            }       
    }, 1000);
      }
  })

  $('#sakha_prawidhik_name').on('change', function() {
    if ($('#sakha_prawidhik_name').val()!='') {
         let val = $('#sakha_prawidhik_name').val();
         test(val);
         setTimeout(function(){
          console.log(data1);
          if (jQuery.isEmptyObject(data1)) {
              $('#sakha_prawidhik_position').val('')
            }
            else{
              $('#sakha_prawidhik_position').val(data1.positions.name)
            }
        }, 1000);
      }
  })
      
  $('#karylaya_pramukh_name').on('change', function() {
    if ($('#karylaya_pramukh_name').val()!='') {
      let val = $('#karylaya_pramukh_name').val();
          test(val);
          setTimeout(function(){
           if (jQuery.isEmptyObject(data1)) {
              $('#karylaya_pramukh_position').val('')
            }
            else{
              $('#karylaya_pramukh_position').val(data1.positions.name)
            } 
    }, 1000);
      }
  })
  
});
        function test(p) {
         axios.get("{{ route('getStaffServices') }}", {
                  params: {
                        id: p,
                        }
                }).then(function(response) {
                  data1 = response.data;
                }).catch(function(error){
                  console.log(error);
                })
         }
</script>

<script>
  
</script>

@endsection