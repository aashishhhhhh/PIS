@extends('layout.layout')
@section('title', 'मर्मत आदेश सुची')
@section('menu_show_anurodh', 'menu-open')
@section('menu_show_marmat_aadesh', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_marmat', 'block')
@section('marmat_form_list', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')

@endsection
@section('content')
<div class="container-fluid">
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
                            <th>मर्मत न.</th>
                            <th>नाम</th>
                            <th>मिति</th>
                            <th>स्थिति</th>
                            <th>विवरणहेर्नुहोस</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marmat as $key => $item)
                            <tr>
                                <td>{{nepali($item->marmat_form_no)}}</td>
                                <td>
                                    @foreach ($item->marmats as $value)
                                      {{$value->staff->nep_name}}
                                        @break
                                    @endforeach
                                </td>
                                <td>{{nepali($item->date)}}</td>
                                <td>
                                        
                                    @if ($item->is_verified==0 && $item->is_approved==1)
                                    approved by admin
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
                                    @if ($item->marmatStoreKeeper!=null)
                                        @foreach ($item->marmats as $value)
                                        @if (count($value->marmatDetails)==0)
                                        <a href="{{route('fill-marmat-details', $item->id)}}" class="btn btn-primary"><i class="fas fa-file-edit"></i></a>
                                        @else
                                        @foreach ($value->marmatDetails as $info)
                                        <a href="{{route('view-marmat-details', $info->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        @break
                                        @endforeach
                                        @endif
                                        @break
                                        @endforeach
                                    @else
                                    @endif

                                    @hasanyrole('admin')
                                    @if ($item->marmatStoreKeeper==null)
                                    <a href="{{route('marmat-storekeeper-form',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="फातवाला/स्तोरेकिपरले भर्ने"><i class="fas fa-file"></i></a>
                                    @endif
                                    @if ($item->is_verified==0 || $item->is_verified==2)
                                        @if ($item->marmatStoreKeeper==null)
                                            <a href="{{route('marmat-storekeeper-form',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="फातवाला/स्तोरेकिपरले भर्ने"><i class="fas fa-file"></i></a>
                                        @endif
                                        <a href="{{route('verify-marmat-details', $item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title=" सिफारिस गर्नुहोस"><i class="fa-solid fa-thumbs-up"></i>सिफारिस गर्नुहोस</a>
                                    @else
                                        <a href="{{route('decline-marmat-details', $item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title=" रद्ध गर्नुहोस"><i class="fa-solid fa-thumbs-down"></i>रद्ध गर्नुहोस</a>
                                    @endif

                                    @endhasanyrole

                                    @hasrole('cao')
                                    @if ($item->is_approved==0 || $item->is_approved==2)
                                    <a href="{{route('approve-marmat-details',$item->id)}}" class="btn btn-primary" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="स्वीकृत गर्नुहोस"><i class="fas fa-thumbs-up"></i> स्वीकृत गर्नुहोस</a>
                                    @else
                                    
                                    <a href="{{route('disapprove-marmat-details',$item->id)}}" class="btn btn-primary" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="रद्ध गर्नुहोस"><i class="fas fa-thumbs-down"></i> रद्ध गर्ने</a>
                                    @endif
                                    @endrole

                                   
                                </td>
                                <td>
                                    @if($item->is_approved!=1 || $item->is_verified!=1)
                                    <a href="{{route('edit-marmat-form',$item->id)}}"><i class="fas fa-edit"></i></a>
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
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#table1_wrapper').css("width", "100%");
        });


   

     
    </script>
@endsection