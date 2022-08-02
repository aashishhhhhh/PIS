@extends('layout.layout')
@section('title', 'भ्रमण सुची')
@section('menu_show_anurodh', 'menu-open')
@section('menu_show_bhramad', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_bhraman', 'block')
@section('bhramad_aadesh_list', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<div class="container-fluid">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"></h3>
            <a class="float-right btn btn-primary btn-sm" href="{{route('bhraman-aadesh-form')}}"><i class="fas fa-plus"></i></a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row"></div>
            <div class="row">
                <table id="table1" width="100%" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>आदेश न.</th>
                            <th>नाम</th>
                            <th>मिति</th>
                            <th>स्थिति</th>
                            <th>कार्य</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visit_aadesh as $key => $item)
                            <tr>
                                <td>{{nepali($item->aadesh_no)}}</td>
                                <td>
                                      {{$item->staffs->nep_name}}
                                </td>
                                <td>
                                    {{nepali($item->date)}}
                                </td>
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
                                    <a href="{{route('bhraman-aadesh-edit', $item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title=""><i class="fas fa-eye"></i></a>
                                        @hasrole('admin')
                                            @if ($item->is_approved==0 || $item->is_approved==2)
                                            <a href="{{route('approve-bhraman', $item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="स्वीकृत गर्नुहोस"><i class="fas fa-thumbs-up"></i></a>
                                            @else
                                            <a href="{{route('reject-bhraman', $item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="अस्वीकृत गर्नुहोस"><i class="fas fa-thumbs-down"></i></a>
                                            @endif
                                        @endrole
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
    <script>
            $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
@endsection