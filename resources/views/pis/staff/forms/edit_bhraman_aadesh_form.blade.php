@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_bhramad', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('bhramad_aadesh_form', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<form action="{{route('bhraman-addesh-update')}}" method="POST">
@csrf
    <div class="card">
        <div class="card-header">
            <div class="container">
              <div class="row">
                  <div class="col-md-4">
                      <a href="{{route('bhraman-kharcha-form',$visit->id)}}" class="btn btn-light">भ्रमण खर्च बिल</a>
                  </div>
                  <div class="col-md-4">
                      <a href="{{route('bhraman-pratiwedan-form',$visit->id)}}" class="btn btn-light">भ्रमण प्रतिवेदन </a>
                  </div>
              </div>
            </div>
          </div>
        <div class="container">
            <div class="row m-4">

                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">मिति:</span>
                        </div>
                        <input type="text" class="form-control date" name="date" value="{{$visit->date}}"  aria-describedby="basic-addon1" readonly>
                        <input type="hidden" name="aadesh_no" value="{{$visit->aadesh_no}}"> 
                      </div>
                </div>

                <div class="col-md-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">कर्मचारी संकेत न:</span>
                        </div>
                        
                        <input type="text" class="form-control" name="s_no" value=" {{ isset($staff->s_no) ? $staff->s_no : '' }}" aria-describedby="basic-addon1" readonly>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">भ्रमण गर्ने पदाधिकारी वा कर्मचारीको नाम:</span>
                        </div>
                        <select name="staff" id="staff">
                            @foreach ($staffs as $item)
                                @if ($item->id==$visit->staff)
                                <option value="{{$item->id}}">{{$item->nep_name}}</option>
                                @endif
                            @endforeach
                            <option value="">क्षन्नुहोस्</option>
                            @foreach ($staffs as $item)
                            @if ($item->id!=$visit->staff)
                            <option value="{{$item->id}}">{{$item->nep_name}}</option>
                            @endif
                            @endforeach
                        </select>
                      </div>
                </div>

            </div>

            <div class="row m-4">
                

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">पद:</span>
                        </div>
                        <input type="text" id="position" name="position" value="{{$visit->position}}" class="form-control" aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">कार्यलय:</span>
                        </div>
                        <input type="text" name="office" class="form-control" value="{{ Config::get('pis_constant.OFFICE')}}" aria-describedby="basic-addon1">
                    </div>
                </div>

              
            </div>

            <div class="row m-4">
                <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">भ्रमणको उद्स्य:</span>
                            </div>
                            <textarea name="visit_aim" id="" cols="200" rows="10">{{$visit->visit_aim}}</textarea>
                        </div>
                </div>
            </div>

            <div class="row m-4">
                <div class="col-md-6">
                    <div class="input-group input">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-lg"> भ्रमण अवधि</span>
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-lg"> देखि</span>
                        </div>
                        <input type="text" class="date" name="from_date" value="{{$visit->from_date}}" aria-label="Large" aria-describedby="inputGroup-sizing-sm" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-lg">सम्म</span>
                    </div>
                    <input type="text" class="date" name="to_date" aria-label="Large" value="{{$visit->to_date}}"  aria-describedby="inputGroup-sizing-sm" readonly>
                </div>
            </div>
            </div>  


            <div class="row m-4">
                <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">भ्रमण गर्ने स्थान (विदेश भए मुलुक र सहर खुलाउने):</span>
                            </div>
                            <input type="text" name="visit_place_name" value="{{$visit->visit_place_name}}" class="form-control" aria-describedby="basic-addon1">
                        </div>
                </div>

            </div>

            <div class="row m-4">
                <div class="col-md-12">
                    <table class="table table_bordered">
                        <thead>
                                <tr>
                                    <th colspan="2">प्रस्थान</th>
                                    <th colspan="2">पहुच</th>
                                    <th rowspan="2">भ्रमण साधन</th>
                                    <th rowspan="2"></th>
                                </tr>

                                <tr>
                                    <td>स्थान</td>
                                    <td>मिति</td>
                                    <td>स्थान</td>
                                    <td>मिति</td>
                                </tr>
                        </thead>

                        <tbody id="row_body">
                            @foreach ($visit->staffVisitAadeshDetail as $key => $item)
                            <tr id='row{{$key}}'>
                                <td>
                                    <input type="hidden" name="destination_no[]" id="destination_no{{$key}}" value="{{$item->destination_no}}">
                                    <input type="hidden" name="is_approved[]" id="is_approved{{$key}}" value="{{$item->is_approved}}">
                                    <input type="text" name="departure_place[]" id="departure_place{{$key}}" value="{{$item->departure_place}}"></td>
                                <td><input type="text" class="date" name="departure_date[]" id="departure_date{{$key}}" value="{{$item->departure_date}}"></td>
                                <td><input type="text" name="destination_place[]" id="destination_place{{$key}}" value="{{$item->destination_place}}"></td>
                                <td><input type="text" class="datee" name="destination_date[]" id="destination_date{{$key}}" value="{{$item->destination_date}}"></td>
                                <td>
                                    <select name="visit_vehicle[]" id="visit_vehicle{{$key}}" class="form-select form-select-lg mb-3" aria-label="Default select example">
                                        
                                        @if ($item->visit_vehicle==1)
                                        <option value="1">कार्यलयको</option>
                                        <option value="2">सार्वजनिक</option>
                                        <option value="3">भाडाको</option>
                                        @endif
                                        @if ($item->visit_vehicle==2)
                                        <option value="2">सार्वजनिक</option>
                                        <option value="1">कार्यलयको</option>
                                        <option value="3">भाडाको</option>
                                        @endif

                                        @if ($item->visit_vehicle==3)
                                        <option value="3">भाडाको</option>
                                        <option value="1">कार्यलयको</option>
                                        <option value="2">सार्वजनिक</option>
                                        @endif
                                    </select>
                                </td>
                                @hasrole('admin')
                                <td>
                                    @if($item->is_approved==0)
                                    <a href="{{route('approve-particular-destination',$item->id)}}" class="btn btn-primary"><i class="fas fa-thumbs-up"></i></a>
                                    @else
                                    <a href="{{route('decline-particular-destination',$item->id)}}" class="btn btn-primary"><i class="fas fa-thumbs-down"></i></a>
                                    @endif
                                </td>
                                @endrole

                                <td>
                                @if ($key>=1)
                                <a id="remove_btn" onclick="removeBank({{$key}})"  class="btn btn-danger df"><i class="fa fa-times"></i></a>
                                @else
                                <a class="btn btn-primary" id="addRow" onclick="addRow()"><i class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>




{{-- 
            <div class="row m-4">
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"  id="basic-addon1">भ्रमण गर्ने साधन:</span>
                        </div>                        
                    </div>
                </div>
                <div class="col-md-3"> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="visit_vehicle" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            कार्यलयको
                        </label>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="visit_vehicle" value="2" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            सार्वजनिक
                        </label>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="visit_vehicle" value="3" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            भाडाको
                        </label>
                      </div>
                </div>
            </div> --}}

            <div class="row m-4">
                <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" name='peski_expense' id="basic-addon1">भ्रमणको निमित्त माग गरको पेस्की खर्च :</span>
                            </div>
                            <input type="number" name="visit_expense" value="{{$visit->visit_expense}}" class="form-control" aria-describedby="basic-addon1">
                        </div>
                </div>
            </div>

            <div class="row m-4">
                <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" name='visit_detail' id="basic-addon1">भ्रमण सम्बन्धि आवस्यक विवरण:</span>
                            </div>
                            <textarea name="visit_details" id="" cols="200" rows="10">{{$visit->visit_details}}</textarea>
                        </div>
                </div>
            </div>

            {{-- <div class="row m-4">
                <div class="col-md-6">
                    <br>
                    <hr>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">भ्रमण गर्ने पदाधिकारी :</span>
                            </div>
                            <input type="text" name="visit_staff" class="form-control" aria-describedby="basic-addon1">
                        </div>
                </div>
                <div class="col-md-6">
                    <br>
                    <hr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">भ्रमण स्वीकृत गर्ने पदाधिकारी:</span>
                        </div>
                        <select name="visit_approver" id="">
                            <option value="">क्षान्नुहोस्</option>
                            @foreach ($staffs as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row m-4">
                <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">मिति:</span>
                            </div>
                            <input type="text" name="visit_staff_date" class="form-control date" aria-describedby="basic-addon1" readonly>
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">मिति:</span>
                        </div>
                        <input type="text" name="approved_date" class="form-control date" aria-describedby="basic-addon1" readonly>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="card-footer text-center">
            <button class="btn btn-primary">Submit</button>
        </div>
        
    </div>

</form>

@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

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
    $('#staff').on('change', function() {
       let val = $('#staff').val();
       if (val != '') {
        axios.get("{{ route('getStaffServices') }}", {
                  params: {
                        id: val,
                        }
                }).then(function(response) {
                  console.log(response.data);

                  $('#position').val(response.data.positions.name)
                })
       }
       
    })
</script>

<script>
     let i=2;
    let j=2;
    function addRow() {
        var html ='<tr id=row'+i+'>'+
                   '<td><input type="text" name="departure_place[]"></td>'+
                   '<td><input type="text" class="date" id="departure_date'+i+'" name="departure_date[]"></td>'+
                   '<td><input type="text" name="destination_place[]"></td>'+
                   '<td><input type="text" class="date" id="destination_date'+i+'" name="destination_date[]"></td>'+
                  '<td>    <select name="visit_vehicle[]" id="" class="form-select form-select-lg mb-3" aria-label="Default select example">'+
                           '<option value="">भ्रमण गर्ने साधन: </option>'+
                           '<option value="1">कार्यलयको</option>'+
                           '<option value="2">सार्वजनिक</option>'+
                           '<option value="3">भाडाको</option>'+
                           '</select></td>'+
                           '@hasrole("admin")'+
                               '<td>'+
                                   '<a href="{{route("approve-particular-destination",$item->id)}}" class="btn btn-primary"><i class="fas fa-thumbs-up"></i></a>'+
                               '</td>'+
                           '@endrole'+
                   '<td><a id="remove_btn" onclick="removeBank('+i+')"  class="btn btn-danger df"><i class="fa fa-times"></i></a></td>'+
               '</tr>'   
               
                
        $("#row_body").append(html);
        $('.date').nepaliDatePicker({
                  ndpYear: true,
                  ndpMonth: true,
                  ndpYearCount: 70,
                  ndpTriggerButton: false,
                  ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                  ndpTriggerButtonClass: 'btn btn-primary',
              });

        i++;
        j++;
        
    }
</script>

<script>
    function removeBank(i) {
       $('#row'+i).html('');
    }
</script>

<script>
    var visit = @json($visit, JSON_PRETTY_PRINT);
    console.log(visit);

    $.each(visit.staff_visit_aadesh_detail, function( index, value ) {
        if (value.is_approved==1) {
            $('#departure_place'+index).prop("disabled", 'disabled');
            $('#departure_date'+index).prop("disabled", 'disabled');
            $('#destination_place'+index).prop('disabled', 'disabled');
            $('#destination_date'+index).prop("disabled", 'disabled');
            $("#visit_vehicle"+index).prop('disabled', 'disabled');
            $("#destination_no"+index).prop('disabled', 'disabled');
            $("#is_approved"+index).prop('disabled', 'disabled');
            }
      });

</script>

@endsection