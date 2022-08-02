@extends('layout.layout')
@section('title', 'कार्य सुची')
@section('menu_show_task', 'menu-open')
@section('menu_open', 'menu-open')
{{-- @section('s_child_task', 'block') --}}
@section('task_list', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            कार्य सुची
            <div class="card-tools">
                <a href="{{route('task-add')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <table id="table1" width="100%" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>क्र.स</th>
                            <th>मिति</th>
                            <th>कार्यको नाम</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $key => $item)
                            <tr>
                                <td>{{nepali($key+1)}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->task_name}}</td>
                                <td>
                                    @hasrole('cao')
                                    <button type="button" id="myBtn" onclick="show({{$item->id}})" data-target=".bd-example-modal-lg" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-arrow-alt-right"></i> कार्य प्रदान गर्नुहोस </button>
                                    <a href="{{route('assigned-task-list',$item->id)}}" type="button" id="myBtn"  class="btn btn-primary"><i class="fas fa-eye"></i>कर्मचारी सुची </a>
                                    @endrole
                                    
                                    @hasanyrole('admin|user')
                                    <a href="{{route('assigned-task-list',$item->id)}}" type="button" id="myBtn"  class="btn btn-primary"><i class="fas fa-eye"></i>पुरा विवरण हेर्नुहोस </a>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">कार्य प्रदान</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('assign-task')}}" method="POST">
              @csrf
            <div class="modal-body">
            
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">कार्यको नाम:</label>
                  <input type="text" class="form-control" id="task_name" readonly>
                </div>
                {{-- <div class="form-group">
                  <select id="sel">
                    <option value="">-- Select --</option>
                </select>
                </div> --}}
                <input type="hidden" name="staff_task_id" id="staff_task">
                <div class="form-group">
                <select id="sel" class="form-control js-example-tokenizer" name="user_id[]" multiple="multiple">
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
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

    <script>
        function show(id) {
        $("#myModal").modal();
        assignTask(id);
        }

        function assignTask(id)
        { 
          var auth = @json($auth, JSON_PRETTY_PRINT);
              axios.get("{{route('api.getUsersAccordingly')}}", {
                params: {
                  task_id:id,
                  auth:auth
                }
                })
                .then(function (response) {
                  $('#task_name').val(response.data.task.task_name);
                  $('#staff_task').val(response.data.task.id)
                  $.each(response.data.user,function(index,value){
                      $.each(value.staffs, function (i,values){
                        $('#sel').append('<option value="' + values.id + '">' + values.nep_name + '</option>');
                      });
                  });
                })
          }

    </script>

    <script>

    $(".js-example-tokenizer").select2({
        tags: true,
        tokenSeparators: [' ', ' ']
    })
    </script>
    
@endsection