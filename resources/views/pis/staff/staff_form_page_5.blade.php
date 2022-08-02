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
        <h1 class="pull-left">कर्मचारीको शुरु नियुक्तिको विवरण
        </h1>
    </section>

@if (count($data)>0)
@foreach ($data as $item)
    
<form action="{{route('page_5_submit')}}" method="POST">
    @csrf

    @isset($is_admin)
        <input type="hidden" name="is_admin" value="{{$is_admin}}">
        <input type="hidden" name="user_id" value="{{$user->id}}">
    @endisset
<div class="row">
    <div class="form-group col-md-12">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">कार्यालयको नाम र ठेगाना:  <i class="reqq">*</i></span></div>
            <input type="text" id="office_name_address" name="office_name_address" class="form-control" value="{{isset($item->office_name_address) ? $item->office_name_address: '' }}"  required>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">नियुक्ति मिति: </span></div>
            <input type="text" id="appoint_date" name="appoint_date" class="form-control" value="{{isset($item->appoint_date) ? $item->appoint_date: '' }}" required>

        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">निर्णय मिति:  </span> </div>
            {{-- <input type="text" id="decision_date" name="decision_date" class="form-control nepaliDate"> --}}
            <input type="text" id="decision_date" name="decision_date" class="form-control" value="{{isset($item->decision_date) ? $item->decision_date: '' }}" required>
            
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">हजिरी मिति: </span></div>
            <input type="text" id="attend_date" name="attend_date" class="form-control" value="{{isset($item->attend_date) ? $item->attend_date: '' }}" required>

        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">सेवा: </span> </div>
            <select id="service" name="service" class="form-control select2">
                @if (isset($item->service))
                    @foreach ($services as $data)
                        @if ($item->service==$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                    @foreach ($services as $data)
                        @if ($item->service!=$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                @else
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($services as $data)
                    @if ($item->service!=$data->id)
                        <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                    @endif
                 @endforeach
                @endif
               
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">समूह: </span> </div>
            <select id="office_group" name="office_group" class="form-control select2">
                @if (isset($item->office_group))
                    @foreach ($officeGroups as $data)
                        @if ($item->office_group==$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                    @foreach ($officeGroups as $data)
                        @if ($item->office_group!=$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                @else
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                    @foreach ($officeGroups as $data)
                        @if ($item->office_group!=$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                @endif

            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">श्रेणी/तह: </span> </div>
            <select id="level" name="level" class="form-control select2">
                @if (isset($item->level))
                    @foreach ($levels as $data)
                        @if ($data->id==$item->level)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                    @foreach ($levels as $data)
                        @if ($data->id!=$item->level)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                @else
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                    @foreach ($levels as $data)
                    <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                    @endforeach
                @endif

            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">पद: </span> </div>
            <select id="position" name="position" class="form-control select2">
                @if(isset($item->position))
                    @foreach ($positions as $data)
                        @if ($data->id==$item->position)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                    @foreach ($positions as $data)
                    @if ($data->id!=$item->position)
                        <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                    @endif
                @endforeach
                @else
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                    @foreach ($positions as $data)
                        <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                    @endforeach

                @endif

            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">

            <div class="input-group-prepend"> <span class="input-group-text">लोक सेवा आयोगको सिफारिश हुँदा कुन वर्गमा भएको हो ? </span> </div>
            @if (isset($item->technical))
                 @if ($item->technical==0)
                    <div class="input-group-text">
                        <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="0" checked> अप्राविधिक
                    </div>
                    <div class="input-group-text">
                        <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="1" >  प्राविधिक 
                    </div>
                @else   
                    <div class="input-group-text">
                        <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="0" > अप्राविधिक
                    </div>
                    <div class="input-group-text">
                        <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="1" checked>  प्राविधिक 
                    </div>
                @endif
            @else
                <div class="input-group-text">
                    <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="0" > अप्राविधिक
                </div>
                <div class="input-group-text">
                    <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="1" >  प्राविधिक 
                </div>
            @endif

        </div>
    </div>
</div>
<div class="card-footer" style="text-align: center">
    <a  href="{{route('page_4_show')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
    <button type="submit" class="btn btn-primary">Save & Next</button>
    <a href="{{route('page_6_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
</div>
</div>


</form>
@endforeach
@else
    

<form action="{{route('page_5_submit')}}" method="POST">
    @csrf
<div class="row">
    <div class="form-group col-md-12">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">कार्यालयको नाम र ठेगाना:  <i class="reqq">*</i></span></div>
            <input type="text" id="office_name_address" name="office_name_address" class="form-control"  required>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">नियुक्ति मिति: </span></div>
            <input type="text" id="appoint_date" name="appoint_date" class="form-control" value="" required>

        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">निर्णय मिति:  </span> </div>
            {{-- <input type="text" id="decision_date" name="decision_date" class="form-control nepaliDate"> --}}
            <input type="text" id="decision_date" name="decision_date" class="form-control" value="" required>

        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">हजिरी मिति: </span></div>
            <input type="text" id="attend_date" name="attend_date" class="form-control" value="" required>

        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">सेवा: </span> </div>
            <select id="service" name="service" class="form-control select2">
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($services as $item)
                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">समूह: </span> </div>
            <select id="office_group" name="office_group" class="form-control select2">
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($officeGroups as $item)
                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">श्रेणी/तह: </span> </div>
            <select id="level" name="level" class="form-control select2">
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($levels as $item)
                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">पद: </span> </div>
            <select id="position" name="position" class="form-control select2">
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($positions as $item)
                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">लोक सेवा आयोगको सिफारिश हुँदा कुन वर्गमा भएको हो ? </span> </div>
            <div class="input-group-text">
            <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="0"> अप्राविधिक
            </div>
            <div class="input-group-text">
                <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="1">  प्राविधिक
                </div>

        </div>
    </div>
</div>
<div class="card-footer" style="text-align: center">
    <a  href="{{route('page_4_show')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save & Next</button>
    <a href="{{route('page_6_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
</div>
</div>

</form>
@endif


@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
          $('#appoint_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

            $('#decision_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

            $('#attend_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
    </script>

@endsection
