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
<div class="card px-4 py-4 mt-4" style="width: 3500 px;">
    @if (session()->has('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('msg')}}</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

<section class="content">
     <!-- Content Header (Page header) -->
     <section class="content-header">
        <h1 class="pull-left">वर्गीकृत क्षेत्रहरुमा काम गरेको विवरण
        </h1>
    </section>
    <div class="row">
       
        <div class="col-md-12" id="right-col">
            <form method="post" enctype="multipart/form-data" action="{{route('page_14_submit')}}" autocomplete="off">
                @csrf
                @isset($is_admin)
                    <input type="hidden" name="is_admin" value="{{$is_admin}}">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                @endisset
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered" style="font-size: 11px;">
                        <thead>
                        <tr>
                            <td colspan="2" style="text-align: center;">अवधि</td>
                            <td rowspan="2" style="text-align: center;">पदस्थापना भएको स्थान वा क्षेत्र</td>
                            <td rowspan="2" style="text-align: center;">काम गरेको स्थान वा क्षेत्र</td>
                            <td colspan="5" style="text-align: center;">काम गरेको क्षेत्रको वर्ग जनाउने</td>
                            <td rowspan="2" style="text-align: center;">कैफियत</td>
                            <td rowspan="2"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">देखि</td>
                            <td style="text-align: center;">सम्म</td>
                            <td style="text-align: center;">क वर्ग</td>
                            <td style="text-align: center;">ख वर्ग</td>
                            <td style="text-align: center;">ग वर्ग</td>
                            <td style="text-align: center;">घ वर्ग</td>
                            <td style="text-align: center;">ङ वर्ग</td>
                        </tr>
                        </thead>
                        <tbody id="row_body">
                        @foreach ($data as $key=> $value)

                            <tr >
                                <td>
                                    <div class="col-md-12 ndp-custom">
                                        @if ($key+1>1)
                                        <input type="text" id="from_date[{{$key+1}}]" name="from_date[{{$key+1}}]" class="form-control date" value="{{isset($value->from_date) ? $value->from_date : '' }}">
                                        @else
                                        <input type="text" id="date" name="from_date[{{$key+1}}]"  class="form-control date" value="{{isset($value->from_date) ? $value->from_date : '' }}">
                                        @endif    

                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 ndp-custom">
                                        @if ($key+1>1)
                                        <input type="text" id="to_date[{{$key+1}}]" name="to_date[{{$key+1}}]" class="form-control date2" value="{{isset($value->to_date) ? $value->to_date : '' }}">
                                        @else
                                        <input type="text" id="date2" name="to_date[{{$key+1}}]"  class="form-control date2" value="{{isset($value->to_date) ? $value->to_date : '' }}">
                                        @endif  
                                </div>
                                </td>
                                <td>
                                   
                                    <input type="text" id="post_area" name="post_area[{{$key+1}}]" value="{{isset($value->post_area) ? $value->post_area : ''}}" class="form-control">
                                </td>
                                <td>
                                    <input type="text" id="work_area" name="work_area[{{$key+1}}]" value="{{isset($value->work_area) ? $value->work_area : ''}}" class="form-control">
                                </td>
                                <td>
                                    @if ($value->a_work==1)
                                    <input type="checkbox" id="a_work" name="a_work[{{$key+1}}]" value="1" checked>
                                    @else
                                    <input type="checkbox" id="a_work" name="a_work[{{$key+1}}]" value="1">
                                    @endif

                                </td>
                                <td>
                                    @if ($value->b_work==1)
                                    <input type="checkbox" id="b_work" name="b_work[{{$key+1}}]" value="1" checked>
                                    @else
                                    <input type="checkbox" id="b_work" name="b_work[{{$key+1}}]" value="1">
                                    @endif                                </td>
                                <td>
                                    @if ($value->c_work==1)
                                    <input type="checkbox" id="c_work" name="c_work[{{$key+1}}]" value="1" checked>
                                    @else
                                    <input type="checkbox" id="c_work" name="c_work[{{$key+1}}]" value="1">
                                    @endif                                 </td>
                                <td>
                                    @if ($value->d_work==1)
                                    <input type="checkbox" id="d_work" name="d_work[{{$key+1}}]" value="1" checked>
                                    @else
                                    <input type="checkbox" id="d_work" name="d_work[{{$key+1}}]" value="1">
                                    @endif                                 </td>
                                <td>
                                    @if ($value->e_work==1)
                                    <input type="checkbox" id="e_work" name="e_work[{{$key+1}}]" value="1" checked>
                                    @else
                                    <input type="checkbox" id="e_work" name="e_work[{{$key+1}}]" value="1">
                                    @endif                                 </td>
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
                                    <a id="remove_foreign_btn"  onclick="removeForeign(this)" class="btn btn btn-danger df"><i class="fa fa-times"></i></a>
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
                    <a href="{{route('leave-and-medicine-details')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save </button>
                </div>  
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
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

            $('#date2').nepaliDatePicker({
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

            let foreign_body = document.querySelector("#row_body");
            let i = 2;
        var app = @json($data, JSON_PRETTY_PRINT);
        let length = app.length
        let j=length+1;
    function addForeign(event) {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

        let from_date = clone.querySelector(".date");
        let to_date = clone.querySelector(".date2");

        let post_area = clone.querySelector("#post_area");
        let work_area = clone.querySelector("#work_area");
        let a_work = clone.querySelector("#a_work");
        let b_work = clone.querySelector("#b_work");
        let c_work = clone.querySelector("#c_work");
        let d_work = clone.querySelector("#d_work");
        let e_work = clone.querySelector("#e_work");
        let remarks = clone.querySelector("#remarks");
        
        from_date.name = 'from_date['+j+']';
        from_date.id= 'from_date'+j;
        from_date.value="";

        to_date.name = 'to_date['+j+']';
        to_date.id= 'to_date'+j;
        to_date.value="";

        post_area.name = 'post_area['+j+']';
        post_area.value='';
        work_area.name = 'work_area['+j+']';
        work_area.value='';


        a_work.name = 'a_work['+j+']';
        a_work.checked =false;
        b_work.name = 'a_work['+j+']';
        b_work.checked =false;
        c_work.name = 'a_work['+j+']';
        c_work.checked =false;
        d_work.name = 'a_work['+j+']';
        d_work.checked =false;
        e_work.name = 'a_work['+j+']';
        e_work.checked =false;

       
        remarks.name = 'remarks['+j+']';
        remarks.value="";

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
            $('.date2').nepaliDatePicker({
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
