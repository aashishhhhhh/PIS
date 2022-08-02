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
                                <!-- /resources/views/post/create.blade.php -->
 
                                    
                         
                                    
                                    <!-- Create Post Form -->
                                    <tr id="t_">
                                        <td>
                                            <textarea id="detail" name="detail[1]" class="form-control" rows="3" required></textarea>
                                            @error('detail.*')
                                                <strong style="color: red">{{$message}} </strong>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" id="date" name="date[1]" class="form-control nepaliDate" >
                                            @error('date.*')
                                            <strong style="color: red">{{$message}} </strong>
                                             @enderror
                                        </td>
                                        <td>
                                            <input type="text" id="type" name="type[1]" class="form-control">
                                            @error('type.*')
                                            <strong style="color: red">{{$message}} </strong>
                                             @enderror
                                        </td>
                                        <td>
                                            <input type="text" id="institute" name="institute[1]" class="form-control">
                                            @error('institute.*')
                                            <strong style="color: red">{{$message}} </strong>
                                             @enderror
                                        </td>
                                        <td>
                                                <a id="add_foreign_btn" onclick="addForeign(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                                <a id="remove_foreign_btn"  onclick="removeForeign(this)" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    
                           
                            
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
    let foreign_body = document.querySelector("#row_body");
    let i = 2;
    let j = 2;
    function addForeign(event) {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

        let detail=clone.querySelector("#detail");
        let date = clone.querySelector(".nepaliDate");
        let type = clone.querySelector("#type");
        let institute = clone.querySelector("#institute");
        
        detail.name = 'detail['+j+']';
        detail.value="";
        date.name = 'date['+j+']';
        date.id= 'myDate'+j;
        date.value="";

        type.name = 'type['+j+']';
        type.value = '';
        institute.name = 'institute['+j+']';
        institute.value = '';
        

        foreign_body.appendChild(clone);
        $('.nepaliDate').nepaliDatePicker({
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
        if (add_btn.style.display != 'none') {
            is_hidden = false;
        }
        if (!is_hidden) {
            let prevTr = tr.previousElementSibling;
            if (prevTr == null) {
               return;
            }
            let prev_add_btn = prevTr.querySelector("#add_foreign_btn");
            prev_add_btn.style.display = 'inline';
            let cells = prevTr.cells;
        }
        tr.remove();
    }

   
</script>
@endsection

</body>
</html>
@endsection
