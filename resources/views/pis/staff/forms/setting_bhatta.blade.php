@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card ">
        @if (session()->has('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session('msg')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
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
                            <th>पद</th>
                            <th>भत्ता</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($setting_bhatta as $item)
                            <tr>
                                <td>{{$item->positions->name}}</td>
                                <td>{{$item->bhatta}}</td>
                                <td>
                                    <button class=" btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#editModal{{$item->id}}" ><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">बिदाको किसिम साच्याउनुहोस्</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="{{route('edit-bhatta-setting')}}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-group">
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <input type="hidden" name="bhatta_id" value="{{$item->id}}">
                                                        <span class="input-group-text">पद :</span>
                                                    </div> 
                                                    <select name="position" id="">
                                                        @foreach ($positions as $value)
                                                            @if ($value->id == $item->position)
                                                                <option value="{{$value->id}}"> {{$value->name}} </option>
                                                            @endif
                                                        @endforeach
                                                            
                                                        @foreach ($positions as $data)
                                                            @if ($data->id != $item->position)
                                                                <option value="{{$data->id}}"> {{$data->name}} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('applicable_for')
                                                    {{$message}}
                                                @enderror
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">जम्मा भत्ता :</span>
                                                    </div> 
                                                    <input type="number" name="bhatta" class="form-control" value="{{$item->bhatta}}" id="leave_type">
                                                </div>
                                                @error('total_leave')
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">भत्ता थप्नुहोस</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('add-bhatta-setting')}}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">पद :</span>
                        </div> 
                        <select name="position" id="">
                            <option value=""> छान्नुहोस् </option>
                            @foreach ($positions as $item)
                                <option value="{{$item->id}}"> {{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('applicable_for')
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">जम्मा भत्ता :</span>
                        </div> 
                        <input type="number" name="bhatta" class="form-control" id="leave_type">
                    </div>
                    @error('total_leave')
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
@endsection
