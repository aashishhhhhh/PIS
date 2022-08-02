@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_maag_form', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('maag_form', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<form action="{{route('maag-form-print')}}" method="GET">

<div class="card">

    <div class="card-header text-right">
    </div>
    <div class="container">

        <div class="row">
            <div class="col-md-4 text-left">
                <img src="{{ asset('storage/upload/gov.jpg') }}" alt=""
                class="px-1" height="100" width="200">
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
                <p>आ. व.: {{$fiscal_year->name}}</p>
                <input type="hidden" name="fiscal_year" value="{{$fiscal_year->name}}">

                @foreach ($latest as $value)
                    
                @endforeach
                <p id="maag_no">माग न: {{nepali($value->maag_no)}}</p>
              </div>
            
              <div class="col-md-12 text-right" style="width:20%">
               <p>मिति: <input type="text" name="date" id="date" class="date"></p> 
              </div>

            <div class="col-md-12 mt-5">
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
                <p> नाम: {{$staff_name}} </p>
                <div class="input-group input-group-sm mb-3" style="width: 50%">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">मिति</span>
                    </div>
                    <input type="text" id="maag_date" name="maag_date"  class="form-control date" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                  </div>

                  <div class="input-group input-group-sm mb-3" style="width: 50%">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">प्रयोजन:</span>
                    </div>
                    <input type="text" id="prayojan" name="prayojan" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                  </div>
            </div>
    
            <div class="col-md-4">
                <p> सिफारिस गर्नेको: </p>
                <p> नाम:
                <select name="sifarish_garneko_name" id="sifarish_garneko_name">
                @foreach ($staffs as $item)
                    <option value="{{$item->nep_name}}"> {{$item->nep_name}} </option>
                @endforeach  
                </select>  
                </p>
                <div class="input-group input-group-sm mb-3" style="width: 50%">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">मिति</span>
                    </div>
                    <input type="text" id="sifarish_date" name="sifarish_date" class="form-control date" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                  </div>
                
                </p>
            </div>
            
            <div class="col-md-4">
                <p> @if($kharid_type == 1) <i class="fas fa-check"></i> @endif क.) सिफारिस गर्नेको </p>
                <p>  @if($kharid_type == 2) <i class="fas fa-check"></i> @endif ख.) मौज्दातबाट दिनु</p>

                @if ($kharid_type==1)
                <input type="hidden" name="kharid_type" value="1">
                @else
                <input type="hidden" name="kharid_type" value="2">
                @endif
            </div>

           
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4">
            <p>आदेश दिनेको दस्तखत: </p>
                <div class="input-group input-group-sm mb-3" style="width: 50%">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">मिति</span>
                    </div>
                    <input type="text" id="aadesh_date" name="aadesh_date" class="form-control date"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                  </div>
                
                </p>
        </div>

        <div class="col-md-4">
          <p>माल सामान बुजिलिनेको दस्तखत: </p>
              <div class="input-group input-group-sm mb-3" style="width: 50%">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">मिति</span>
                  </div>
                  <input type="text" id="maal_saman_bujeko" name="maal_saman_bujeko" class="form-control date" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>
              
              </p>
      </div>

      <div class="col-md-4">
        <p>जिन्सी खातामा चडाउनेको दस्तखत</p>
            <div class="input-group input-group-sm mb-3" style="width: 50%">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">मिति</span>
                </div>
                <input type="text" id="maal_saman_chadako" name="maal_saman_chadako" class="form-control date" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
              </div>
            </p>
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
    function prints() {

      if ($('#date').val()!= '') {
        var date = $('#date').val();
      }


      var latest = @json($latest, JSON_PRETTY_PRINT);
      var maag_name = @json($staff_name, JSON_PRETTY_PRINT);

      if ($('#sifarish_name').val()!= '') {
        var sifarish_name = $('#sifarish_garneko_name').val();
      }
      
      if ($('#maag_date').val()!='') {
        var maag_date = $('#maag_date').val();
      }

      if ($('#sifarish_date').val()!='') {
        var sifarish_date = $('#sifarish_date').val();
      }

      if ($('#prayojan').val()!='') {
        var prayojan = $('#prayojan').val();
      }

      if ($('#aadesh_date').val()!='') {
        var aadesh_date = $('#aadesh_date').val();
      }

      if ($('#maal_saman_bujeko').val()!='') {
        var maal_saman_bujeko = $('#maal_saman_bujeko').val();
      }

      if ($('#maal_saman_chadako').val()!='') {
        var maal_saman_chadako = $('#maal_saman_chadako').val();
      }

      console.log(date);
      console.log(latest);
      console.log(maag_name);
      console.log(maag_date);
      console.log(sifarish_date);
      console.log(sifarish_name);
      console.log(prayojan);
      console.log(aadesh_date);
      console.log(maal_saman_bujeko);
      console.log(maal_saman_chadako);

      axios.get("{{ route('print-maag-details') }}", {
                  params: {
                        date: date,
                        latest: latest,
                        maag_name : maag_name,
                        sifarish_date : sifarish_date,
                        sifarish_name : sifarish_name,
                        prayojan : prayojan,
                        aadesh_date : aadesh_date,
                        maal_saman_bujeko : maal_saman_bujeko,
                        maal_saman_chadako : maal_saman_chadako
                        }
                }).then(function(response) {
                  if (jQuery.isEmptyObject(data1.positions.name)) {
                    $('#position').val('')
                    }
                    else{
                      $('#position').val(data1.positions.name)
                    }
                        })

    }
</script>


@endsection