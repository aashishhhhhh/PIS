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
<!-- Content Wrapper. Contains page content -->
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
        <h1 class="pull-left">तालिम / सेमिनार / सम्मेलेन सम्बन्धी विवरण
        </h1>
        
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
                {{-- <div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>=$this->session->flashdata('msg_scc')</div>
                <div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>=$msg_err</div> --}}
            <div class="col-md-12" id="right-col">
                <form method="post" enctype="multipart/form-data" action="{{route('page_10_submit')}}" autocomplete="off">
                    @csrf

                    @isset($is_admin)
                        <input type="hidden" name="is_admin" value="{{$is_admin}}"> 
                        <input type="hidden" name="user_id" value="{{$user->id}}"> 
                    @endisset
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" style="font-size: 13px">
                            <thead>
                            <tr>
                                <td style="text-align: center">तालिमको विवरण</td>
                                <td style="text-align: center">तालिम लिएको मिति</td>
                                <td style="text-align: center">तालिमको स्तर</td>
                                <td style="text-align: center">तालिम प्रदान गर्ने निकाय</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody id="row_body">
                                @foreach ($data as $key=> $value)
                                    <tr id="t_{{$key+1}}">
                                        <td>
                                            <textarea id="detail" name="detail[{{$key+1}}]" class="form-control" rows="3" required>{{isset($value->detail) ? $value->detail : '' }}</textarea>
                                        </td>
                                        <td>
                                            @if ($key+1>1)
                                            <input type="text" id="date{{$key+1}}" name="date[{{$key+1}}]" value="{{isset($value->date) ? $value->date : ''}}" class="form-control date">
                                            @else
                                            <input type="text" id="date" name="date[{{$key+1}}]" value="{{isset($value->date) ? $value->date : ''}}" class="form-control date">
                                            @endif                                        </td>
                                        <td>
                                            <input type="text" id="type" name="type[{{$key+1}}]" class="form-control" value="{{isset($value->type) ? $value->type : '' }}">
                                        </td>
                                        <td>
                                            <input type="text" id="institute" name="institute[{{$key+1}}]" class="form-control" value="{{isset($value->institute) ? $value->institute : '' }}">
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
                        <a  href="{{route('page_9_show')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save & Next</button>
                        <a href="{{route('page_11_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
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
<!-- /.content-wrapper -->
<!-- ./wrapper -->

<!-- Bootstrap 3.3.6 -->
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

        let detail=clone.querySelector("#detail");
        let date = clone.querySelector(".date");
        let type = clone.querySelector("#type");
        let institute = clone.querySelector("#institute");

        detail.name = 'detail['+j+']';
        detail.value="";
        date.name = 'date['+j+']';
        date.id= 'date'+j;
        date.value="";

        type.name = 'type['+j+']';
        type.value = '';
        institute.name = 'institute['+j+']';
        institute.value = '';
        

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

</body>
</html>
@endsection
