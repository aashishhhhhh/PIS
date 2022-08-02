@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_faculty', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('new_staff', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')

@if (count($data)>0)

@foreach ($data as $item)
    
<div class="card px-4 py-4 mt-4">
    @if (session()->has('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('msg')}}</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
    <section class="content-header">
        <h1 class="pull-left">अन्य विवरण
        </h1>"
    </section>
        <div class="row">
                <form method="post" enctype="multipart/form-data" action="{{route('page_7_submit')}}">
                    @csrf

                    @isset($is_admin)
                        <input type="hidden" name="is_admin" value="{{$is_admin}}"> 
                        <input type="hidden" name="user_id" value="{{$user->id}}"> 
                    @endisset
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> बहु विवाह / बाल विवाह गरेको </div>
                                            @if (isset($item->poly_marriage))
                                            <div class="input-group-text ml-2">
                                                @if ($item->poly_marriage==1)
                                                    <input class="same" onclick="polyMarriage(1)" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="1" checked> छ
                                                    <input class="same" name="poly_marriage" onclick="polyMarriage(0)" type="radio" aria-label="Radio button for following text input" value="0"> छैन

                                                </div>
                                                @else
                                                    <div class="input-group-text ml-2">
                                                    <input class="same" name="poly_marriage" onclick="polyMarriage(1)" type="radio" aria-label="Radio button for following text input" value="1" > छ
                                                        <input class="same" name="poly_marriage" onclick="polyMarriage(0)" type="radio" aria-label="Radio button for following text input" value="0" checked> छैन
                                                    </div>
                                                @endif

                                            @else
                                            <div class="input-group-text ml-2">
                                                <input class="same" name="poly_marriage" onclick="polyMarriage(1)" type="radio" aria-label="Radio button for following text input" value="1"> छ
                                                </div>
                                                <div class="input-group-text ml-2">
                                                    <input class="same" name="poly_marriage" onclick="polyMarriage(0)" type="radio" aria-label="Radio button for following text input" value="0"checked> छैन
                                                    </div>
                                            @endif

                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group" id="poly_marriage_y">
                                            <div class="input-group-prepend"><span class="input-group-text">छ भने पत्नीको नाम लेखुहोस् </div>
                                            <input type="text" id="poly_spouse_name" name="poly_spouse_name" value="{{isset($item->poly_spouse_name) ? $item->poly_spouse_name : '' }}" class="form-control"  >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" id="poly_other_dv">
                                        <div class="input-group">
                                            <div class="input-group-prepend">पति वा पत्नीले विदेशी मुलुलको स्थायी आवासीय अनुमति (DV/PR वा अन्य ) लिए / नलिएको वा सोको लागि दरखास्त दिए / नदिएको विवरण :</div>

                                            @if (isset($item->foreign_spouse_apply))
                                                @if ($item->foreign_spouse_apply==1)
                                                <div class="input-group-text ml-2">
                                                    <input class="same" name="foreign_spouse_apply" onclick="foreignSpouse(1)" id="foreign_spouse_1" type="radio" aria-label="Radio button for following text input" value="1" checked> छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                        <input class="same" name="foreign_spouse_apply" onclick="foreignSpouse(0)" id="foreign_spouse_2" type="radio" aria-label="Radio button for following text input" value="0"> छैन
                                                        </div>
                                                @else
                                                <div class="input-group-text ml-2">
                                                    <input class="same" name="foreign_spouse_apply" onclick="foreignSpouse(1)" id="foreign_spouse_1" type="radio" aria-label="Radio button for following text input" value="1" > छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                        <input class="same" name="foreign_spouse_apply" onclick="foreignSpouse(0)"  id="foreign_spouse_2" type="radio" aria-label="Radio button for following text input" value="0" checked> छैन
                                                        </div>
                                                @endif
                                                
                                            @else
                                            <div class="input-group-text ml-2">
                                                <input class="same" name="foreign_spouse_apply" onclick="foreignSpouse(1)" id="foreign_spouse_1" type="radio" aria-label="Radio button for following text input" value="1"> छ
                                                </div>
                                                <div class="input-group-text ml-2">
                                                    <input class="same" name="foreign_spouse_apply" onclick="foreignSpouse(0)" id="foreign_spouse_2" type="radio" aria-label="Radio button for following text input" value="0"> छैन
                                                    </div>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                                <tr id="temporary_country1">
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend" style="padding-left: 20px;"><span class="input-group-text">१. स्थायी आवासीय अनुमति लिएको भए देशको नाम : <i> </i></div>
                                            <select id="fa_country" name="fa_country" class="form-control select2">
                                                @if (isset($item->fa_country))
                                                    @foreach ($countries as $key=> $value)
                                                        @if ($item->fa_country==$key)
                                                        <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($countries as $key=> $value)
                                                    @if ($item->fa_country!=$key)
                                                    <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                    @endif
                                                @endforeach
                                                @else
                                                    <option value="" data-eng="">चयन गर्नुहोस्</option>
                                                    @foreach ($countries as $key=> $value)
                                                        <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                    @endforeach
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">र लिएको मिति: <i class="reqq"></i></div>
                                            {{-- <input type="text" id="fa_date" name="fa_date" class="form-control nepaliDate"> --}}
                                             <input type="text" id="fa_date" name="fa_date" class="form-control" value="{{isset($item->fa_date) ? $item->fa_date : '' }}" >

                                        </div>
                                    </td>
                                </tr>
                                <tr id="temporary_country2">
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend" style="padding-left: 20px;"><span class="input-group-text">२. स्थायी आवासीय अनुमतिका लागि दरखास्त दिएको भए देशको नाम:   <i class="reqq"></i></div>
                                            <select id="fa2_country" name="fa2_country" class="form-control select2">
                                                @if (isset($item->fa2_country))
                                                @foreach ($countries as $key=> $value)
                                                    @if ($item->fa2_country==$key)
                                                    <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                    @endif
                                                @endforeach
                                                @foreach ($countries as $key=> $value)
                                                @if ($item->fa2_country!=$key)
                                                <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                @endif
                                            @endforeach
                                            @else
                                                <option value="" data-eng="">चयन गर्नुहोस्</option>
                                                @foreach ($countries as $key=> $value)
                                                    <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                @endforeach
                                            @endif
                                               
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                    <div class="form-group col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">दरखास्त दिएको मिति:  <i class="reqq"></i> </div>
                                            <input type="text" id="fa2_date" name="fa2_date" class="form-control" value="{{isset($item->fa2_date) ? $item->fa2_date : '' }}" >
                                        </div>
                                    </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> कुनै सरकारी बक्यौता तिर्न बाँकी <i class="reqq">*</i></div>
                                            @if (isset($item->loan))
                                                @if ($item->loan==1)
                                                <div class="input-group-text ml-2">
                                                
                                                    <input type="radio" name="loan" value="1" checked> छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                    <input type="radio" name="loan" value="0" > छैन
                                                        </div>
                                                @else
                                                <div class="input-group-text ml-2">
                                                
                                                    <input type="radio" name="loan" value="1" > छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                    <input type="radio" name="loan" value="0" checked> छैन
                                                        </div>
                                                @endif

                                                @else
                                           
                                                <div class="input-group-text ml-2">
                                                
                                                    <input type="radio" name="loan" value="1" > छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                    <input type="radio" name="loan" value="0" > छैन
                                                        </div>
                                            @endif
                                          
                                           
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group" id="load_y">
                                            <div class="input-group-prepend"><span class="input-group-text">बाँकी भए सोको विवरण </div>
                                            <input type="text" id="loan_detail" name="loan_detail" value="{{isset($item->loan_detail) ? $item->loan_detail : ''}}" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend"><span class="input-group-text">सम्बन्धित कर्मचारीको बिशेष योग्यता र क्षमताः</div>
                                            <input type="text" id="qualification" name="qualification" value="{{isset($item->qualification) ? $item->qualification : ''}}"  class="form-control" >
                                            @error('qualification')
                                            <strong style="margin-left: 2%"> {{$message}}* </strong>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="card-footer" style="text-align: center">
                            <a  href="{{route('page_6_show')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save & Next</button>
                            <a href="{{route('page_8_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
                        </div>
                </form>
            </div>
            <!-- /.box -->
        </div>

        @endforeach
        @else
        <div class="card px-4 py-4 mt-4">
            @if (session()->has('msg'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{session('msg')}}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
            <section class="content-header">
                <h1 class="pull-left">अन्य विवरण
                </h1>
            </section>
                <div class="row">
                        <form method="post" enctype="multipart/form-data" action="{{route('page_7_submit')}}">
                            @csrf
                            <div class="box box-primary">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> बहु विवाह / बाल विवाह गरेको </div>
                                                    @if (isset($item->poly_marriage))
                                                    <div class="input-group-text ml-2">
                                                        @if ($item->poly_marriage==1)
                                                        <input class="same" onclick="polyMarriage(1)" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="1" > छ
                                                        <input class="same" name="poly_marriage" onclick="polyMarriage(0)" type="radio" aria-label="Radio button for following text input" value="0"checked> छैन
    
        
                                                        </div>
                                                        @else
                                                            <div class="input-group-text ml-2">
                                                                <input class="same" onclick="polyMarriage(1)" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="1" > छ
                                                                <input class="same" name="poly_marriage" onclick="polyMarriage(0)" type="radio" aria-label="Radio button for following text input" value="0"checked> छैन
            
                                                            </div>
                                                        @endif
        
                                                    @else
                                                    <div class="input-group-text ml-2">
                                                        <input class="same" onclick="polyMarriage(1)" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="1" > छ
                                                            </div>
                                                        <div class="input-group-text ml-2">
                                                            <input class="same" name="poly_marriage" onclick="polyMarriage(0)" type="radio" aria-label="Radio button for following text input" value="0" checked> छैन
                                                        </div>
                                                    @endif
        
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="poly_marriage_y">
                                                    <div class="input-group-prepend"><span class="input-group-text">छ भने पत्नीको नाम लेखुहोस् </div>
                                                    <input type="text" id="poly_spouse_name" name="poly_spouse_name" value="{{isset($item->poly_spouse_name) ? $item->poly_spouse_name : '' }}" class="form-control"  >
                                                </div>
                                                @error('poly_spouse_name')
                                                    <strong style="color: red"> </strong>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="input-group" id="poly_other_dv">
                                                    <div class="input-group-prepend">पति वा पत्नीले विदेशी मुलुलको स्थायी आवासीय अनुमति (DV/PR वा अन्य ) लिए / नलिएको वा सोको लागि दरखास्त दिए / नदिएको विवरण :</div>
        
                                                    @if (isset($item->foreign_spouse_apply))
                                                        @if ($item->foreign_spouse_apply==1)
                                                        <div class="input-group-text ml-2">
                                                            <input class="same" name="foreign_spouse_apply" onclick="foreignSpouse(1)" id="foreign_spouse_1" type="radio" aria-label="Radio button for following text input" value="1" checked> छ
                                                            </div>
                                                            <div class="input-group-text ml-2">
                                                                <input class="same" name="foreign_spouse_apply" onclick="foreignSpouse(0)" type="radio" id="foreign_spouse_2" aria-label="Radio button for following text input" value="0"> छैन
                                                                </div>
                                                        @else
                                                        <div class="input-group-text ml-2">
                                                            <input class="same" name="foreign_spouse_apply" type="radio" onclick="foreignSpouse(1)" id="foreign_spouse_1" aria-label="Radio button for following text input" value="1" > छ
                                                            </div>
                                                            <div class="input-group-text ml-2">
                                                                <input class="same" name="foreign_spouse_apply"  type="radio" onclick="foreignSpouse(0)" id="foreign_spouse_2" aria-label="Radio button for following text input" value="0" checked> छैन
                                                                </div>
                                                        @endif
                                                    @else
                                                    <div class="input-group-text ml-2">
                                                        <input class="same" name="foreign_spouse_apply" type="radio" onclick="foreignSpouse(1)" id="foreign_spouse_1" aria-label="Radio button for following text input" value="1"> छ
                                                        </div>
                                                        <div class="input-group-text ml-2">
                                                            <input class="same" name="foreign_spouse_apply" type="radio" onclick="foreignSpouse(0)" id="foreign_spouse_2" aria-label="Radio button for following text input" value="0"> छैन
                                                            </div>
                                                    @endif
        
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="temporary_country1">
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend" style="padding-left: 20px;"><span class="input-group-text">१. स्थायी आवासीय अनुमति लिएको भए देशको नाम : <i> </i></div>
                                                    <select id="fa_country" name="fa_country" class="form-control select2">
                                                        @if (isset($item->fa_country))
                                                            @foreach ($countries as $key=> $value)
                                                                @if ($item->fa_country==$key)
                                                                <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                                @endif
                                                            @endforeach
                                                            @foreach ($countries as $key=> $value)
                                                            @if ($item->fa_country!=$key)
                                                            <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                            @endif
                                                        @endforeach
                                                        @else
                                                            <option value="" data-eng="">चयन गर्नुहोस्</option>
                                                            @foreach ($countries as $key=> $value)
                                                                <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                            @endforeach
                                                        @endif
                                                        
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> <span class="input-group-text">र लिएको मिति:</div>
                                                    {{-- <input type="text" id="fa_date" name="fa_date" class="form-control nepaliDate"> --}}
                                                     <input type="text" id="fa_date" name="fa_date" class="form-control" value="{{isset($item->fa_date) ? $item->fa_date : '' }}" >
        
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="temporary_country2">
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend" style="padding-left: 20px;"><span class="input-group-text">२. स्थायी आवासीय अनुमतिका लागि दरखास्त दिएको भए देशको नाम:   <i class="reqq"></i></div>
                                                    <select id="fa2_country" name="fa2_country" class="form-control select2">
                                                        @foreach ($countries as $key=> $value)
                                                        <option value="" data-eng="">चयन गर्नुहोस्</option>
                                                            <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                        @endforeach

                                                       
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                            <div class="form-group col-md-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">दरखास्त दिएको मिति:  <i class="reqq"></i> </div>
                                                    <input type="text" id="fa2_date" name="fa2_date" class="form-control" value="{{isset($item->fa2_date) ? $item->fa2_date : '' }}" >
                                                </div>
                                            </div>
        
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> कुनै सरकारी बक्यौता तिर्न बाँकी  <i class="reqq">*</i></div>
                                                        <div class="input-group-text ml-2">
                                                        
                                                            <input type="radio" name="loan" value="1" > छ
                                                            </div>
                                                            <div class="input-group-text ml-2">
                                                            <input type="radio" name="loan" value="0" checked> छैन
                                                    </div>
                                                
                                                </div>

                                            </td>
                                            <td>
                                                <div class="input-group" id="load_y">
                                                    <div class="input-group-prepend"><span class="input-group-text">बाँकी भए सोको विवरण </div>
                                                    <input type="text" id="loan_detail" name="loan_detail" value="{{isset($item->loan_detail) ? $item->loan_detail : ''}}" class="form-control">
                                                </div>
                                                @error('loan_detail')
                                                <strong style="color: red"> {{$message}} </strong>
                                                @enderror
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="2">
                                                <div class="input-group col-md-12">
                                                    <div class="input-group-prepend"><span class="input-group-text">सम्बन्धित कर्मचारीको बिशेष योग्यता र क्षमताः </div>
                                                    <input type="text" id="qualification" name="qualification" value="{{isset($item->qualification) ? $item->qualification : ''}}"  class="form-control" >
                                                    @error('qualification')
                                                    <strong style="margin-left: 2%"> {{$message}}* </strong>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="card-footer" style="text-align: center">
                                    <a  href="{{route('page_6_show')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save & Next</button>
                                    <a href="{{route('page_8_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
                                </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
        @endif

<!-- /.row -->
<!-- /.content -->

@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
            $('#fa_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
    </script>
    <script>
        $('#fa2_date').nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 70,
            readOnlyInput: true,
            ndpTriggerButton: false,
            ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
            ndpTriggerButtonClass: 'btn btn-primary',
        });
</script>
<script>

   function polyMarriage(p) {
       if (p==1) {
                $('#poly_marriage_y').show();
                $('#poly_other_dv').show();
                $('#temporary_country1').show();
                $('#temporary_country2').show();
            }
        else{
                $('#poly_marriage_y').hide();
                $('#poly_other_dv').hide();
                $('#temporary_country1').hide();
                $('#temporary_country2').hide();
        }
    }

    function foreignSpouse(value)
    {
            if (value==1) {
                $('#temporary_country1').show();
                $('#temporary_country2').show();            }
            else{
                $('#temporary_country1').hide();
                $('#temporary_country2').hide();
            }
    }
</script>
<script>
        var app = @json($data, JSON_PRETTY_PRINT);
        if (app.length>0) {
            $.each(app,function(index,value){
                if (poly_marriage==1) {
                    $('#poly_marriage_y').show();
                }
                else{
                $('#poly_marriage_y').hide();
            }
        })
    }

        else{
            $('#poly_marriage_y').hide();
            $('#poly_other_dv').hide();
            $('#temporary_country1').hide();
            $('#temporary_country2').hide();
        }
</script>
@endsection
