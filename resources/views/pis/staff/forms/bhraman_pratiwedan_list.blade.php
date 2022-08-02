@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_bhramad', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('bhramad_list', 'active')
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
                            <th>आदेश न.</th>
                            <th>नाम</th>
                            <th>भ्रमण अवधि</th>
                            <th>विवरणहेर्नुहोस</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffVisit as $key => $item)
                            <tr>
                                <td>{{nepali($item->aadesh_no)}}</td>
                                <td>
                                      {{$item->staff->nep_name}}
                                </td>
                                <td>
                                  @foreach ($difference as $keyy => $value)
                                    @if ($item->id== $keyy)
                                        {{nepali($value)}} दिन
                                    @endif
                                  @endforeach
                                </td>
                                <td><a href="{{route('view-bhraman-details', $item->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a></td>
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