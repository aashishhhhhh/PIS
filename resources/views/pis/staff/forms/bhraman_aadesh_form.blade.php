@extends('layout.layout')
@section('title', 'भ्रमण सुची')
@section('menu_show_anurodh', 'menu-open')
@section('menu_show_bhramad', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_bhraman', 'block')
@section('bhramad_aadesh_list', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<form action="{{route('bhraman-addesh-submit')}}" method="POST">
@csrf
    <div class="card">
        <div class="card-header">
          <h3>भ्रमण आदेश</h3>
        </div>
        <div class="container">
            <div class="row m-4">

                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">मिति:</span>
                        </div>
                        <input type="text" class="form-control date" name="date"  aria-describedby="basic-addon1" readonly>
                      </div>
                      @error('date')
                         <span style="color: red">{{$message}}</span> 
                      @enderror
                </div>

                <div class="col-md-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">कर्मचारी संकेत न:</span>
                        </div>
                        <input type="text" class="form-control" name="s_no" value=" {{ $staff->s_no }}" aria-describedby="basic-addon1" readonly>
                      </div>
                      @error('s_no')
                      <span style="color: red">{{$message}}</span> 
                   @enderror
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">भ्रमण गर्ने पदाधिकारी वा कर्मचारीको नाम:</span>
                        </div>
                        <select name="staff" id="staff">
                            <option value="">क्षन्नुहोस्</option>
                            @foreach ($staffs as $item)
                            <option value="{{$item->id}}">{{$item->nep_name}}</option>
                            @endforeach
                        </select>
                      </div>
                      @error('staff')
                      <span style="color: red">{{$message}}</span> 
                   @enderror
                </div>

            </div>

            <div class="row m-4">
                

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">पद:</span>
                        </div>
                        <input type="text" id="position" name="position" class="form-control" aria-describedby="basic-addon1">
                    </div>
                    @error('position')
                    <span style="color: red">{{$message}}</span> 
                 @enderror
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">कार्यलय:</span>
                        </div>
                        <input id="office" type="text" name="office" class="form-control" value="{{ Config::get('pis_constant.OFFICE')}}" aria-describedby="basic-addon1">
                    </div>
                    @error('office')
                    <span style="color: red">{{$message}}</span> 
                 @enderror
                </div>

              
            </div>

            <div class="row m-4">
                <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">भ्रमणको उद्स्य:</span>
                            </div>
                            <textarea name="visit_aim" id="" cols="200" rows="10"></textarea>
                        </div>
                        @error('visit_aim')
                        <span style="color: red">{{$message}}</span> 
                     @enderror
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
                        <input type="text" class="date" name="from_date" aria-label="Large" aria-describedby="inputGroup-sizing-sm" readonly>
                    </div>

                </div>
                @error('from_date')
                <span style="color: red">{{$message}}</span> 
             @enderror
            </div>
            <div class="col-md-6">
                <div class="input-group input">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-lg">सम्म</span>
                    </div>
                    <input type="text" class="date" name="to_date" aria-label="Large" aria-describedby="inputGroup-sizing-sm" readonly>
                </div>
                @error('to_date')
                    <span style="color: red">{{$message}}</span> 
                @enderror
            </div>
            </div>  

            <div class="row m-4">
                <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">भ्रमण गर्ने स्थान (विदेश भए मुलुक र सहर खुलाउने):</span>
                            </div>
                            <input type="text" name="visit_place_name" class="form-control" aria-describedby="basic-addon1">
                        </div>
                        @error('visit_place_name')
                        <span style="color: red">{{$message}}</span> 
                    @enderror
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
                            <tr>
                                <td>
                                    <input type="text" name="departure_place[]">
                                    @error('departure_place')
                                    <span style="color: red">{{$message}}</span> 
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="date" name="departure_date[]">
                                    @error('departure_date')
                                    <span style="color: red">{{$message}}</span> 
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" name="destination_place[]">
                                    @error('departure_date')
                                    <span style="color: red">{{$message}}</span> 
                                    @enderror</td>
                                <td>
                                    <input type="text" class="date" name="destination_date[]">
                                    @error('destination_date')
                                    <span style="color: red">{{$message}}</span> 
                                    @enderror
                                </td>
                                <td>
                                    <select name="visit_vehicle[]" id="" class="form-select form-select-lg mb-3" aria-label="Default select example">
                                        <option value="">भ्रमण गर्ने साधन: </option>
                                        <option value="1">कार्यलयको</option>
                                        <option value="2">सार्वजनिक</option>
                                        <option value="3">भाडाको</option>
                                    </select>
                                    @error('visit_vehicle')
                                    <span style="color: red">{{$message}}</span> 
                                    @enderror
                                </td>
                                <td><a class="btn btn-primary" id="addRow" onclick="addRow()"><i class="fa fa-plus" aria-hidden="true"></i>
                                </a></td>
                            </tr>
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
                            <input type="number" name="visit_expense" class="form-control" aria-describedby="basic-addon1">
                        </div>
                </div>
            </div>

            <div class="row m-4">
                <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" name='visit_detail' id="basic-addon1">भ्रमण सम्बन्धि आवस्यक विवरण:</span>
                            </div>
                            <textarea name="visit_details" id="" cols="200" rows="10"></textarea>
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
                    '<td><input type="text" class="date" name="departure_date[]"></td>'+
                    '<td><input type="text" name="destination_place[]"></td>'+
                    '<td><input type="text" class="date" name="destination_date[]"></td>'+
                   '<td>    <select name="visit_vehicle[]" id="" class="form-select form-select-lg mb-3" aria-label="Default select example">'+
                            '<option value="">भ्रमण गर्ने साधन: </option>'+
                            '<option value="1">कार्यलयको</option>'+
                            '<option value="2">सार्वजनिक</option>'+
                            '<option value="3">भाडाको</option>'+
                            '</select></td>'+
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

@endsection