@extends('layout.layout')
@section('title', 'माग फारम')
@section('menu_show_anurodh', 'menu-open')
@section('menu_show_maag_form', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_maag', 'block')
@section('maag_form', 'active')
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
        <h1 class="pull-left">माग फारम
        </h1>
    </section>
        <div class="row" style="overflow-y: scroll">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="col-md-12" id="right-col">
                <a class="btn btn-sm btn-primary text-white mb-0" id="addBank">
                    <i class="fas fa-plus-circle px-1"></i>{{ __('थप गर्नुहोस') }}</a>
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <form action="{{route('maag_form_submit')}}" method="POST">
                        @csrf
                    <div class="box-body">
                        <table class="table table-bordered" style="font-size: 13px;">
                            <thead>
                            <tr>
                                <td rowspan="2" style="text-align: center;">आ. व</td>
                                <td rowspan="2" style="text-align: center;">सामानको नाम <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-plus"></i></a>
                                <td rowspan="2" style="text-align: center;">स्पेसीफिकेसन <!-- /उप समूह !--></td>
                                <td colspan="2" style="text-align: center;">माग गरिएको</td>
                                <td rowspan="2" style="text-align: center;">कैफियत</td>
                                <td rowspan="2" style="text-align: center;"></td>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">समानको नाम थप्नुहोस्</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">समान</span>
                                                    </div> 
                                                    <input type="text" name="name" class="form-control" value="" id="name" >
                                                    <input type="hidden" name="id" class="form-control" value="1" id="" >
                                                </div>
                                                @error('fiscal_year')
                                                {{$message}}
                                                @enderror
                                            </div>
                                
                                            <div class="form-group">
                                                <div>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">स्पेसीफिकेसन</span>
                                                        </div> 
                                                        <input type="text" name="specification" class="form-control" id="specification">
                                                        
                                                    </div>
                                                    @error('leave_type')
                                                            {{$message}}
                                                    @enderror
                                                </div>
                                            </div>
                                
                                            <div class="form-group">
                                                <div>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">इकाई</span>
                                                        </div> 
                                                        <input type="text" name="unit" class="form-control" id="unit">
                                                        
                                                    </div>
                                                    @error('leave_type')
                                                            {{$message}}
                                                    @enderror
                                                </div>
                                            </div>
                                
                                            <div class="form-check" id="">
                                                <input class="form-check-input" type="radio" onchange="is_kharchaa(1)" name="is_kharcha" id="is_kharcha1" value="1" >
                                                <label class="form-check-label">
                                                  खर्च हुने
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" onchange="is_kharchaa(2)" name="is_kharcha" id="is_kharcha2" value="2">
                                                <label class="form-check-label">
                                                  खर्च नहुने
                                                </label>
                                              </div>
                                          </form>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="button" onclick="add_saman()" class="btn btn-primary">submit</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </tr>
                            <tr>
                                <td>एकाई</td>
                                <td>परिमाण</td>
                            </tr>
                            </thead>
                                <tbody id="row_body">
                                       <tr id="rem_bank1">
                                        <td>
                                            <input type="text" name="fiscal_year[]" value="{{$fiscal_year->name}}" readonly>
                                        </td>
                                        <td style="max-width: 200px;">
                                            <select id="saman_name" class="saman_name" onchange="test(1)" name="saman_name[]" >
                                                <option value="" data-eng="">समूह चयन</option>
                                                @foreach ($saman as $item)
                                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td style="max-width: 200px;">
                                            <input type="text" id="specificationn"  name="specification[]" readonly>
                                        </td>

                                        <td>
                                                <input class="unit" id="unitt" name="unit[]" readonly>
                                        </td>
                                        <td>
                                            <input type="number" id="office_name_address" name="quantity[]" class="form-control" value="" >
                                        </td> 
                                        <td>
                                            <input type="text" id="office_name_address" name="remarks[]" class="form-control" value="" >
                                        </td>
                                       
                                        <td>
                                            <a id="remove_btn" onclick='removeBank(1)' class="btn btn-danger df"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>

                    <div class="col-md-4">
                        <p> <input type="radio" class="radio" name="radio" value="1"> क.) बजारबाट खरिद गरि दिनु </p>
                        <p> <input type="radio" class="radio" name="radio" value="2">  ख.) मौज्दातबाट दिनु</p>
                    </div>

                    
                    <!-- /.box-body -->
                    <div class="card-footer" style="text-align: center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
                </div>
                <!-- /.box -->
            </div>
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
         $('#maag_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

        $('#sifarish_date').nepaliDatePicker({
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
            let rows=0;
            var saman;
            let k =0;
        $(document).ready(function(){
            let i=2;
            let j=2;
            $('#addBank').on("click", function() {
                k=i;
                var html = '<tr id="rem_bank' + i + '">' +
                '<td class="text-center">' +
                '<input type="text" name="fiscal_year[]" value="{{$fiscal_year->name}}" readonly>' +
                '</td>' +
                
                '<td style="max-width: 200px;">'+
                '<select class="saman_name" id="saman_name'+i+'" onchange="test('+i+')" name="saman_name[]" >'+
                   
                '</select>'+
               
                '</td>'+

                '<td style="max-width: 200px;">'+
                '<input type="text" id="specification'+i+'"  name="specification[]">'+
                '</td>'+

                '<td style="max-width: 200px;">'+
                '<input class="unit" id="unit'+i+'" name="unit[]" >'+
                '</select>'+
                '</td>'+
                
                '<td>'+
                '<input type="text" id="quantity'+i+'" name="quantity[]" class="form-control" value="" >'+
                '</td>'+ 

                '<td>'+
                '<input type="text" id="remarks'+i+'" name="remarks[]" class="form-control" value="" >'+
                '</td>'+ 

                '<td>'+
                '<a id="remove_btn" onclick="removeBank(' + i +')"  class="btn btn-danger df"><i class="fa fa-times"></i></a>'+
                '</td>'+

                '</tr>'
                $("#row_body").append(html);
                  axios.get("{{ route('api.get-saman-name') }}", {
                })
                .then(function(response){
                    $('#saman_name'+k).append('<option> समुह चयन</option>');
                    $.each(response.data,function(index,value){
                        $('#saman_name'+k).append('<option value="' + value.id + '">' + value.name + '</option>');
                    })
                })
                rows = i;
                i++;
                j++;
        });
        });

         // submit-saman-name
    let kharcha = 0
    function is_kharchaa(p)
    {
        kharcha = p
    }

    function add_saman()
    {
       let specification = $('#specification').val();
       let name = $('#name').val();
       let unit = $('#unit').val();

       if (specification!='' && name!='' && unit!='' && kharcha !='') {
        axios.get("{{ route('api.submit-saman-name') }}", {
                  params: {
                    specification: specification,
                    name: name,
                    unit: unit,
                    kharcha: kharcha
                }
                })
                .then(function(response) {
                    if (response.data!=null) {
                        $('#exampleModal').modal('hide')
                        getSamanName(rows);

                    }
                })
       }
       else{
        if (specification=='') {
            alert('कृपया स्पेसीफिकेसन लेख्नुहोस')
        }

        else if(name=='') {
            alert('कृपया समानको नाम लेख्नुहोस')
        }
        else if(unit=='')
            alert('कृपया इकाई नाम लेख्नुहोस')
       }
    }
    </script>

    <script>
        function removeBank(index) {
           $('#rem_bank'+index).html('');
        }
    </script>

    <script>
        $('#saman_name').on('change', function(){
            var saman_name = $('#saman_name').val();
            if (saman_name!='') {
                var saman = @json($saman, JSON_PRETTY_PRINT);

                $.each(saman,function(index,value) {
                    if (value.id==saman_name) {
                        $('#specificationn').val(value.specification);
                        $('#unitt').val(value.unit);
                    }
                });
               
            }

            else{
                $('#specification').val('');
                $('#unit').val('');
            }
        });
    </script>

    <script>
        function test(i) {
            var saman_name = $('#saman_name'+i).val();
            if (saman_name!='') {
                var saman = @json($saman, JSON_PRETTY_PRINT);

                $.each(saman,function(index,value) {
                    if (value.id==saman_name) {
                        $('#specification'+i).val(value.specification);
                        $('#unit'+i).val(value.unit);
                    }
                });
            }
            else{
                $('#specification'+i).val('');
                $('#unit'+i).val('');
            }
        }
    </script>

<script>
   
</script>

<script>
    function getSamanName(rows)
    {
        axios.get("{{ route('api.get-saman-name') }}", {
                })
                .then(function(response){
                    $('#saman_name').html('');
                    $('#saman_name').append('<option> समुह चयन</option>');
                    $.each(response.data,function(i,v){
                        $('#saman_name').append('<option value="' + v.id + '">' + v.name + '</option>');
                  });
                    for (let index = 1; index <= rows; index++) {
                        $('#saman_name'+index).html('');
                        $('#saman_name'+index).append('<option> समुह चयन</option>');
                        $.each(response.data,function(i,v){
                        $('#saman_name'+index).append('<option value="' + v.id + '">' + v.name + '</option>');
                  });
                    }
                })
    }
</script>
@endsection