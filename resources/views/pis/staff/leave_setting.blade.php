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
                            <th>आर्थिक बर्ष</th>
                            <th>बिदाको किसिम</th>
                            <th>लागु हुने</th>
                            <th>जम्मा बिदा</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaveSetting as $item)
                            <tr>
                                <td>{{$item->fiscal_year}}</td>
                                <td>{{$item->leave_type}}</td>
                                <td>{{$item->applicable_for}}</td>
                                <td>{{$item->total_leave}}</td>
                                <td>
                                    @if ($item->leave_type!='बिरामी बिदा' && $item->leave_type!='घर बिदा'  )
                                    <button class=" btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#editModal{{$item->id}}" ><i class="fas fa-edit"></i></button>
                                    @endif

                                    @if($item->updated_at==null && $item->leave_type=='घर बिदा')
                                    <button class=" btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#editModal{{$item->id}}" ><i class="fas fa-edit"></i></button>
                                    @endif

                                    @if($item->updated_at==null && $item->leave_type=='बिरामी बिदा')
                                    <button class=" btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#editModal{{$item->id}}" ><i class="fas fa-edit"></i></button>
                                    @endif

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
                                    <form action="{{route('edit-leave-setting')}}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">आर्थिक बर्ष :</span>
                                                </div> 
                                                <input type="text" name="fiscal_year" class="form-control" value="{{$item->fiscal_year}}" id="fiscal_year" readonly>
                                                <input type="hidden" value="{{$item->id}}" name='id'>
                                            </div>
                                            @error('fiscal_year')
                                            {{$message}}
                                            @enderror
                                        </div>
                            
                                        <div class="form-group">
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">बिदाको किसिम :</span>
                                                    </div> 
                                                    <input type="text" name="leave_type" class="form-control" value="{{$item->leave_type}}" id="leave_type">
                                                    
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
                                                        <span class="input-group-text">लागु हुने (कुनै पनि क्षान्नु भएन भने दुवै को लागि लागु हुने छ !):</span>
                                                    </div> 
                                                    
                                                    <select name="applicable_for" id="">
                                                        @if ($item->applicable_for=='पुरूष')
                                                            <option value="पुरूष"> पुरूष </option>
                                                            <option value="महिला"> महिला </option>
                                                             <option value=""> छान्नुहोस् </option>
                                                        @endif

                                                        @if ($item->applicable_for=='महिला')
                                                            <option value="महिला"> महिला </option>
                                                            <option value="पुरूष"> पुरूष </option>
                                                             <option value="दुबै"> छान्नुहोस् </option>
                                                        @endif
                                                        
                                                        @if ($item->applicable_for=='दुबै')
                                                            <option value=""> छान्नुहोस् </option>
                                                            <option value="महिला"> महिला </option>
                                                            <option value="पुरूष"> पुरूष </option>
                                                        @endif
                                                       
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
                                                        <span class="input-group-text">जम्मा बिदा :</span>
                                                    </div> 
                                                    <input type="number" name="total_leave" value="{{$item->total_leave}}" class="form-control" id="leave_type">
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
          <h5 class="modal-title" id="exampleModalLabel">बिदाको किसिम थप्नुहोस</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('add-leave-setting')}}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">आर्थिक बर्ष :</span>
                    </div> 
                    <input type="text" name="fiscal_year" class="form-control" value="{{$fiscal_years->name}}" id="fiscal_year" readonly>
                  
                </div>
                @error('fiscal_year')
                {{$message}}
                @enderror
            </div>

            <div class="form-group">
                <div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">बिदाको किसिम :</span>
                        </div> 
                        <input type="text" name="leave_type" class="form-control" id="leave_type">
                        
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
                            <span class="input-group-text">लागु हुने (कुनै पनि क्षान्नु भएन भने दुवै को लागि लागु हुने छ !) :</span>
                        </div> 
                        <select name="applicable_for" id="">
                            <option value=""> छान्नुहोस् </option>
                            <option value="पुरूष"> पुरूष </option>
                            <option value="महिला"> महिला </option>
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
                            <span class="input-group-text">जम्मा बिदा :</span>
                        </div> 
                        <input type="number" name="total_leave" class="form-control" id="leave_type">
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
