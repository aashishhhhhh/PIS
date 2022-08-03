@extends('layout.layout')
@section('title', 'माग फारम सुचि')
@section('menu_show_anurodh', 'menu-open')
@section('menu_show_maag_form', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_maag', 'block')
@section('search_maag_form', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<div class="container-fluid">
    @if (session()->has('msg'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{session('msg')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"></h3>
            <button class="float-right btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#addModal" ><i class="fas fa-plus"></i></button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row"></div>
            <div class="row">
                <table id="table1" width="100%" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>माग न.</th>
                            <th>नाम</th>
                            <th>मिति</th>
                            <th>स्थिति</th>
                            <th>विवरण</th>
                            <th>कार्य</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maag as $key => $item)
                            <tr>
                                <td>{{nepali($item->maag_no)}}</td>
                                <td>
                                    @foreach ($item->maags as $value)
                                            @isset($value->staff)
                                            {{$value->staff->nep_name}}
                                            @endisset
                                        @break
                                    @endforeach    

                                </td>
                                <td>{{nepali($item->print_date)}}</td>
                                <td>
                                    {{-- @dd($item) --}}
                                    @if ($item->is_verified==0 && $item->is_approved==2)
                                    rejected
                                    @endif
                                    
                                        @if ($item->is_verified==0 && $item->is_approved==0)
                                           pending
                                        @endif

                                        @if ($item->is_verified==1 && $item->is_approved==0)
                                        approved by admin
                                        @endif

                                        @if ($item->is_verified==1 && $item->is_approved==1)
                                        approved by cao
                                        @endif

                                        @if ($item->is_verified==2 || $item->is_verified==2)
                                        rejected
                                        @endif

                                </td>

                                <td>
                                    <button  type="button" id="myBtn" onclick="show({{$item->id}})" data-target=".bd-example-modal-lg" class="btn btn-primary"><i class="fas fa-eye"></i>विवरण हेर्नुहोस</button>
                                </td>
                                <td>
                                    @if($item->is_approved==1)
                                    @foreach ($item->maags as $data)
                                        @if ($data->maag_details==null)
                                        <a href="{{route('fill-maag-details', $item->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        @else
                                        <a href="{{route('view-maag-details', $data->maag_details->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        @endif
                                    @endforeach
                                    @endif
                                    @hasrole('admin')
                                    @if ($item->is_verified==0 || $item->is_verified==2)
                                    <a href="{{route('verify-maag-details', $item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title=" सिफारिस गर्नुहोस"><i class="fa-solid fa-thumbs-up"></i>सिफारिस गर्नुहोस</a>
                                    @else
                                    <a href="{{route('decline-maag-details', $item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="रद्ध गर्नुहोस"><i class="fa-solid fa-thumbs-down"></i>रद्ध गर्नुहोस</a>
                                    @endif
                                    @endrole
                                    @hasrole('cao')
                                    @if ($item->is_approved==0 || $item->is_approved==2)
                                    <a href="{{route('approve-maag-details',$item->id)}}" class="btn btn-primary" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="स्वीकृति गर्नुहोस"><i class="fas fa-thumbs-up"></i> स्वीकृति गर्नुहोस</a>
                                    @else
                                    <a href="{{route('disapprove-maag-details',$item->id)}}" class="btn btn-primary" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="रद्ध गर्नुहोस"><i class="fas fa-thumbs-down"></i> रद्ध गर्नुहोस</a>
                                    @endif
                                    @endrole
                                
                                </td>
                                <td>
                                    @if($item->is_approved!=1 || $item->is_verified!=1)
                                    <a href="{{route('edit-maag-form',$item->id)}}"><i class="fas fa-edit"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="width: 300%">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">माग विवरण</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
            <th> समानको नाम</th>
            <th>स्पेचिफिकेसन</th>
            <th>एकाई</th>
            <th>परिमाण
            </th>
            <th>कैफियत</th>

            </tr>
            </thead>
            <tbody>
                <tr>
                <td id="saman_name"></td>
                <td id="specification"></td>
                <td id="unit"></td>
                <td id="quantity"></td>
                <td id="remarks"></td>
                </td>
                </tr>
            </tbody>
            </table>
      </div>
    </div>
  </div>

@endsection 

@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    @yield('setting_scripts')
    <script>
    
        $(function() {
            $('#table1').DataTable({
                "paging": true,
                "lengthChange": true,1`
                "searching": true,1`
                "ordering": true,1`
                "info": true,1`
                "autoWidth": false,1`
                "responsive": true,1`
            });1`
            $('#table1_wrapper').css("width", "100%");1`
        });


   

     
    </script>
    
    <script>
            $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            })
    </script>

    <script>
        function show(id)
        {
            $("#myModal").modal();
            if (id!='') {
             maag_details(id)
            }
        }
    </script>

    <script>
        function maag_details(id) {
            axios.get("{{ route('api.get-saman-detail') }}", {
                  params: {
                        id: id,
                        }
                })
                .then(function(response) {
                    // console.log(response.data.maags);

                    $.each( response.data.maags, function( index, value ){
                        // console.log(value.saman_name);
                        var saman = @json($saman, JSON_PRETTY_PRINT);
                        $.each(saman,function(i,v){
                            if (value.saman_name==v.id) {
                                $('#saman_name').text(v.name);
                            }
                        })
                        $('#specification').text(value.specification);
                        $('#unit').text(value.unit);
                        $('#quantity').text(value.quantity);
                        $('#remarks').text(value.remarks);
                    });

                })
        }
    </script>
@endsection