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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="pull-left">विभागीय सजायको विवरण
        </h1>
        
    </section>
    <!-- Main content -->
    <section class="content">            
            <div class="col-md-12" id="right-col">
                <form method="post" enctype="multipart/form-data" action="{{route('page_12_submit')}}" autocomplete="off">
                    @csrf
                    @isset($is_admin)
                    <input type="hidden" name="is_admin" value="{{$is_admin}}">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    @endisset
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <td rowspan="2" style="text-align: center;">सजायको प्रकार</td>
                                    <td rowspan="2" style="text-align: center;">सजायको <br/>आदेश मिति</td>
                                    <td colspan="2" style="text-align: center;">पुनरावेदनको</td>
                                    <td rowspan="2" style="text-align: center;">कैफियत</td>
                                    <td rowspan="2"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">ठहर</td>
                                    <td style="text-align: center;">मिति</td>
                                </tr>
                            </thead>
                            <tbody id="row_body">
                                @foreach ($data as $key=> $value)


                                <tr>
                                    <td style="max-width: 200px;">
                                        <select id="punishment" name="punishment[{{$key+1}}]" class="form-control select2" required>
                                            @if (isset($value->punishment))
                                                @foreach ($punishments as $item)
                                                    @if ($value->punishment==$item->id)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach

                                                @foreach ($punishments as $item)
                                                    @if ($value->punishment!=$item->id)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                          
                                            @else   
                                            <option value="" data-eng="">चयन गर्नुहोस्</option>
                                                @foreach ($punishments as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </td>
                                    <td>
                                        <div class="col-md-12 ndp-custom">
                                            @if ($key+1>1)
                                            <input type="text" id="ordered_date[{{$key+1}}]" name="ordered_date[{{$key+1}}]" class="form-control date" value="{{isset($value->ordered_date) ? $value->ordered_date : '' }}">
                                            @else
                                            <input type="text" id="date" name="ordered_date[{{$key+1}}]"  class="form-control date" value="{{isset($value->ordered_date) ? $value->ordered_date : '' }}">
                                            @endif    
                                        </div>
                                    </td>
                                    <td>
                                        @if (isset($value->stopped))
                                            @if ($value->stopped==1)
                                                <label>
                                                    <input class="stopped" type="radio" name="stopped[{{$key+1}}]"  value="1" checked> हो
                                                </label>
                                                <label>
                                                    <input class="stopped" type="radio" name="stopped[{{$key+1}}]" value="0"> होइन
                                                </label>
                                            @else
                                                <label>
                                                    <input class="stopped" type="radio" name="stopped[{{$key+1}}]"  value="1" > हो
                                                </label>
                                                <label>
                                                    <input class="stopped" type="radio" name="stopped[{{$key+1}}]" value="0" checked> होइन
                                                </label>
                                            @endif

                                        @else
                                            <label>
                                                <input class="stopped" type="radio" name="stopped[{{$key+1}}]"  value="1" > हो
                                            </label>
                                            <label>
                                                <input class="stopped" type="radio" name="stopped[{{$key+1}}]" value="0" checked> होइन
                                            </label>
                                        @endif

                                    </td>
                                    <td>
                                        <div class="col-md-12 ndp-custom">
                                        </div>
                                        @if ($key+1>1)
                                        <input type="text" id="stopped_date[{{$key+1}}]" name="stopped_date[{{$key+1}}]" value="{{isset($value->stopped_date) ? $value->stopped_date : ''}}" class="form-control date2">
                                        @else
                                        <input type="text" id="date2" name="stopped_date[{{$key+1}}]"  class="form-control date" value="{{isset($value->stopped_date) ? $value->stopped_date : '' }}">
                                        @endif    
                                    </td>
                                    <td>
                                        <textarea id="remarks" name="remarks[{{$key+1}}]" class="form-control">{{isset($value->remarks) ? $value->remarks : ''}}</textarea>
                                    </td>

                                <td>
                                    @php
                                    $length= count($data);
                                @endphp
                                @if ($key+1>=1 && $key+1>=$length)
                                <a id="add_foreign_btn" onclick="addForeign(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                @endif
                                <a id="remove_foreign_btn"  onclick="removeForeign(this)" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a>
                                </td>
                                </tr>
                                @endforeach

                        </tbody>
                            <tfoot>
                               
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="card-footer" style="text-align: center">
                        <a  href="{{route('page_11_show')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('leave-and-medicine-details')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
                    </div>
                    </form>
                </div>
                <!-- /.box -->
         
    <!-- /.content -->
</div>

@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/convert_nepali.js') }}"></script>
<script>

            $('#date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

            $('.date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

            
            $('.date2').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

            $('#date2').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
        let foreign_body = document.querySelector("#row_body");
        var app = @json($data, JSON_PRETTY_PRINT);
        let length = app.length
        let j=length+1;
    function addForeign(event) {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

        let punishment=clone.querySelector("#punishment");
        let ordered_date = clone.querySelector(".date");
        let stopped=clone.querySelectorAll(".stopped");
        let stopped_date=clone.querySelector(".date2");
        let convenience = clone.querySelector("#convenience");
        let remarks = clone.querySelector("#remarks");

        
        punishment.name = 'punishment['+j+']';
        ordered_date.name = 'ordered_date['+j+']';
        ordered_date.id= 'ordered_date'+j;
        ordered_date.value="";

        for (let index = 0; index < stopped.length; index++) {
            const element = stopped[index];
            element.setAttribute('name', 'stopped['+j+']');
            element.checked=false;

        }
        stopped_date.name = 'stopped_date['+j+']';
        stopped_date.id= 'stopped_date'+j;
        stopped_date.value="";
         
        remarks.name = 'remarks['+j+']';
        remarks.value="";

        foreign_body.appendChild(clone);
        $('.date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
            $('.date2').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

        j++;

          
    }

    function removeForeign(event) {
        let tr = event.closest('tr');
        let td = event.closest('td');
        var children = td.children;
        var is_hidden = true;

        let add_btn = td.querySelector("#add_foreign_btn");
        let remove_btn = td.querySelector("#remove_foreign_btn");
        tr.remove();
    }

   
</script>
@endsection

