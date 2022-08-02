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
        <h1 class="pull-left">विभूषण, प्रशांसा पत्र र पुरस्कारको विवरण
        </h1>
        
    </section>
    <!-- Main content -->
    <section class="content">
            
            <div class="col-md-12" id="right-col">
                <form method="post" enctype="multipart/form-data" action="{{route('page_11_submit')}}" autocomplete="off">
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
                                <td style="text-align: center;">विभूषण, प्रशंसा पत्रको विवरण</td>
                                <td style="text-align: center;">प्राप्त मिति</td>
                                <td style="text-align: center;">विभूषण,प्रशंसापत्र पाएको कारण</td>
                                <td style="text-align: center;">सहुलियत</td>
                                <td></td>
                            </tr>
                            </thead>
                                
                            <tbody id="row_body">
                            @foreach ($data as $key=> $value)
                                <tr>
                                    <td>
                                        <input type="text" id="award_detail" name="award_detail[{{$key+1}}]" class="form-control" value="{{isset($value->award_detail) ? $value->award_detail : '' }}" required>
                                    </td>
                                    <td>    
                                        <div class="col-md-12 ndp-custom">
                                            @if ($key+1>1)
                                            <input type="text" id="received_date[{{$key+1}}]" name="received_date[{{$key+1}}]" class="form-control date" value="{{isset($value->received_date) ? $value->received_date : '' }}">
                                            @else
                                            <input type="text" id="date" name="received_date[{{$key+1}}]"  class="form-control date" value="{{isset($value->received_date) ? $value->received_date : '' }}">
                                            @endif    
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" id="reason" name="reason[{{$key+1}}]" class="form-control" value="{{isset($value->reason) ? $value->reason : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" id="convenience" name="convenience[{{$key+1}}]" class="form-control" value="{{isset($value->convenience) ? $value->convenience : '' }}">
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
                        <a  href="{{route('page_10_show')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save & Next</button>
                        <a href="{{route('page_12_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
                    </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
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
    let foreign_body = document.querySelector("#row_body");
    var app = @json($data, JSON_PRETTY_PRINT);

let length = app.length
let j=length+1;
let k=0;
    function addForeign(event) {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

        let award_detail=clone.querySelector("#award_detail");
        let received_date = clone.querySelector(".date");
        let reason = clone.querySelector("#reason");
        let convenience = clone.querySelector("#convenience");
        
        award_detail.name = 'award_detail['+j+']';
        award_detail.value="";
        received_date.name = 'received_date['+j+']';
        received_date.id= 'date'+j;
        received_date.value="";

        reason.name = 'reason['+j+']';
        reason.value = '';
        convenience.name = 'convenience['+j+']';
        convenience.value = '';
        

        foreign_body.appendChild(clone);
        j++;
        $('.date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
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

