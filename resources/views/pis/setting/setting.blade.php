@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ $setting->name }}</h3>
            <button class="float-right btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#addModal" ><i class="fas fa-plus"></i></button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row"></div>
            <div class="row">
                <table id="table1" width="100%" class="table table-bordered">
                    <thead>
                        <tr>

                            @if (!empty($setting->cascading_parent_id))
                                @php
                                    $p_set = \App\Models\SharedModel\Setting::where(['id' => $setting->cascading_parent_id])->first();
                                @endphp
                                <th>{{ $p_set->name }}</th>
                            @endif
                            <th>{{$setting->name}}</th>
                            <th>स्पेसीफिकेसन</th>
                            <th>इकाई</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($setting_value as $item)
                            <tr>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->specification }}
                                </td>
                                <td>
                                    {{ $item->unit }}
                                </td>
                                <td>
                                    <button class=" btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#editModal{{$item->id}}" ><i class="fas fa-edit"></i></button>
                                </td>
                            </tr> 

                            <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">{{$setting->name}} थप्नुहोस</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="{{route('update-setting')}}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{$setting->name}}</span>
                                                </div> 
                                                <input type="text" name="name" class="form-control" value="{{$item->name}}" id="" >
                                                <input type="hidden" name="id" class="form-control" value="{{$setting->id}}" id="" >
                                                <input type="hidden" name="value_id" class="form-control" value="{{$item->id}}" id="" >
                                              
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
                                                    <input type="text" value="{{$item->specification}}" name="specification" class="form-control" id="leave_type">
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
                                                    <input type="text" value="{{$item->unit}}" name="unit" class="form-control" id="leave_type">
                                                </div>
                                                @error('leave_type')
                                                        {{$message}}
                                                @enderror
                                            </div>
                                        </div>

                                        

                                        
                            
                            
                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                  </form>
                                   
                                  </div>
                                </div>
                              </div>
                         @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.container-fluid -->

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$setting->name}} थप्नुहोस</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('add-setting')}}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{$setting->name}}</span>
                    </div> 
                    <input type="text" name="name" class="form-control" value="" id="" >
                    <input type="hidden" name="id" class="form-control" value="{{$setting->id}}" id="" >
                  
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
                        <input type="text" name="specification" class="form-control" id="leave_type">
                        
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
                        <input type="text" name="unit" class="form-control" id="leave_type">
                        
                    </div>
                    @error('leave_type')
                            {{$message}}
                    @enderror
                </div>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_kharcha" id="flexRadioDefault1" value="1">
                <label class="form-check-label" for="flexRadioDefault1">
                  खर्च हुने
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_kharcha" id="flexRadioDefault2" value="2">
                <label class="form-check-label" for="flexRadioDefault2">
                  खर्च नहुने
                </label>
              </div>



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        window.addEventListener(`{{$setting->slug}}_added`, function(evt) {
            location.reload();
        }, false);

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

        const toggleBudgetSourceModal = () => {
            $('.setting_modal').modal('toggle');
        }

        const onAdd = () => {
            $('#setting_id').val();
            $('#setting_name').val('');
            $('#setting_note').val('');

            @if (!empty($setting->cascading_parent_id))
             $('#setting_cascading_parent_id').val('');
            @endif
            $('#setting_header').html('{{ $setting->name }}' + ' थप्नुहोस');
            toggleBudgetSourceModal();
        }

        const onEdit = (item) => {
            $('#setting_id').val(item.id);
            $('#setting_name').val(item.name);
            $('#setting_note').val(item.note);
            @if (!empty($setting->cascading_parent_id))
                $('#setting_cascading_parent_id').val(item.cascading_parent_id);
            @endif
            $('#setting_header').html('{{ $setting->name }}' + ' सच्याउनुहोस');
            toggleBudgetSourceModal();
        }
    </script>
@endsection
