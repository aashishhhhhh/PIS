@extends('layout.layout')
@section('title', 'मर्मत आदेश फारम')
@section('menu_show_marmat_aadesh', 'menu-open')
@section('menu_show_anurodh', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_marmat', 'block')
@section('marmat_form', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('content')
<div>
    
</div>
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
        <h1 class="pull-left">मर्मत आदेश फारम
        </h1>
    </section>
        <div class="row" style="overflow-y: scroll">
            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
            <div class="col-md-12" id="right-col">
                <a class="btn btn-sm btn-primary text-white mb-0" id="addForm">
                    <i class="fas fa-plus-circle px-1"></i>{{ __('थप गर्नुहोस') }}</a>
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <form action="{{route('marmat-aadesh-form-submit')}}" method="POST">
                        @csrf
                    <div class="box-body">
                        <table class="table table-bordered" style="font-size: 13px;">
                            <thead>
                            <tr>
                                <td rowspan="2" style="text-align: center;">क्र.स.</td>
                                <td rowspan="2" style="text-align: center;">सामानको विवरण</td>
                                <td rowspan="2" style="text-align: center;">समान पहिचान न.</td>
                                <td rowspan="2" style="text-align: center;">अनुमति मर्मत लागत<!-- /उप समूह !--></td>
                                <td  style="text-align: center;">मर्मत गर्नुपर्ने कारण</td>
                                <td colspan="2" style="text-align: center;">मर्मत आवेद्नकर्ता नाम र सहि</td>
                                <td rowspan="2" style="text-align: center;">कैफियत</td>
                                <td rowspan="2" style="text-align: center;"></td>
                            </tr>
                            </thead>
                                <tbody id="row_body">
                                       <tr id="row1">
                                        <td>
                                            1
                                        </td>
                                        <td >
                                            <textarea name="saman_bibaran[]" id="" cols="30" rows="10"></textarea>
                                        </td>

                                        <td style="max-width: 200px;">
                                            <input type="number" id="saman_pahichan_no"  name="saman_pahichan_no[]">
                                        </td>

                                        <td>
                                                <input type="number" id="anumati_mamrmat_lagat" name="anumati_mamrmat_lagat[]" >
                                        </td>
                                        <td>
                                            <textarea name="reason[]" id="" cols="30" rows="10"></textarea>
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="applicant_name[]" value="{{$staff->nep_name}}" readonly>
                                        </td>
                                        <td style="width: 120px">
                                           
                                        </td>
                                        <td>
                                            <textarea name="remarks[]" id="" cols="30" rows="10"></textarea>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                            </tbody>

                           
                        </table>
                    
                       
                    </div>

                    <!-- /.box-body -->
                    <div class="card-footer" style="text-align: center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    <!-- /.content -->
<!-- /.content-wrapper -->
<!-- ./wrapper -->

@endsection
@section('scripts')
    <script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/convert_nepali.js') }}"></script>

<script>
$(document).ready(function(){

let i=2;
let j=2;
$('#addForm').on("click", function() {
var html = '<tr id="row' + i + '">' +
    '<td class="text-center">' +
    '<p> '+i+' </p>'+
    '</td>' +

    '<td style="max-width: 200px;">'+
    '<textarea name="saman_bibaran[]" id="" cols="30" rows="10"></textarea>'+
    '</td>'+
    
    '<td style="max-width: 200px;">'+
    '<input type="number" id="saman_pahichan_no'+i+'"  name="saman_pahichan_no[]">'+
    '</td>'+

    '<td style="max-width: 200px;">'+
    '<input type="number" id="anumati_mamrmat_lagat'+i+'"  name="anumati_mamrmat_lagat[]">'+
    '</td>'+

    '<td style="max-width: 200px;">'+
    '<textarea name="reason[]" id="" cols="30" rows="10"></textarea>'+
    '</td>'+
    
    '<td>'+
        '<input type="text" name="applicant_name[]" value="{{$staff->name}}" placeholder="{{$staff->nep_name}}" readonly>'+
    '</td>'+ 

    '<td style="width:120px;">' +

    '</td>'+

    '<td>'+
    '<textarea name="remarks[]" id="" cols="30" rows="10"></textarea>'+
    '</td>'+ 

    '<td>'+
    '<a id="remove_btn" onclick="removeBank(' + i +')"  class="btn btn-danger df"><i class="fa fa-times"></i></a>'+
    '</td>'+

    '</tr>'

    $("#row_body").append(html);
    i++;
    j++;
});
});
</script>

<script>
    function removeBank(index) {
       $('#row'+index).html('');
    }
</script>

@endsection