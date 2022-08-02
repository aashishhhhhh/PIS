@extends('layout.layout')
@section('title', 'कर्मचारी खोज')
@section('menu_show_faculty', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('staff_search', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<div>
<form action="{{route('search-staff-submit')}}" method="GET">
    @csrf
    @if (session()->has('msg'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{session('msg')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
<div class="card">
    <div class="card-header">
        <h3 class="card-title">कर्मचारी खोज
        </h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="form-group col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">प्रदेश</label>
                    </div>
                    <select class="custom-select" name="province" id="province">
                    <option value=""> क्षान्नुहोस्</option>
                    @foreach ($provinces as $item)
                    <option value="{{$item->id}}">{{$item->nep_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">जिल्ला</label>
                    </div>
                    <select class="custom-select" name="district" id="district">
                        <option value=""> प्रदेश क्षान्नुहोस् </option>
                 
                    </select>
                </div>
            </div>

            <div class="form-group col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">न.पा./गा.वि.स</label>
                    </div>
                    <select class="custom-select" name="municiplaity" id="municipality">
                        <option value=""> जिल्ला क्षान्नुहोस् </option>
                    </select>
                </div>
            </div>
            
                
  
</div>


<div class="row" id="rowAdvanced">
    <div class="form-group col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">जात/जाती
            </label>
            </div>
            <select class="custom-select" name="ethnicities" id="ethnicities">
            <option value=""> क्षान्नुहोस्</option>
            @foreach ($ethnicities as $item)
            <option value="{{$item->id}}">{{$item->name}} </option>
            @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">धर्म
            </label>
            </div>
            <select class="custom-select" name="religions" id="religions">
                <option value=""> क्षान्नुहोस्</option>
                @foreach ($religions as $item)
                <option value="{{$item->id}}">{{$item->name}} </option>
                @endforeach
            </select>
        </div>
    </div>  

    <div class="form-group col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">लिङ्ग</label>
            </div>
            <select class="custom-select" name="genders" id="genders">
                <option value=""> क्षान्नुहोस्</option>
                @foreach ($genders as $key =>$item)
                <option value="{{$key}}">{{$item}} </option>
                @endforeach
            </select>
        </div>
    </div>
    
        

</div>

<div class="row" id="showAdvancedBtn" >
    <div class="form-group col-md-12">
        <button onclick="showAdvanced()" type="button" class="btn btn-primary btn-lg btn-block"><i class="fas fa-eye"></i> Advance Search</button>
    </div>
</div>

<div class="row" id="hideAdvancedBtn" >
    <div class="form-group col-md-12">  
        <button onclick="hideAdvanced()" type="button" class="btn btn-primary btn-lg btn-block"><i class="fas fa-ban"></i> Advance Search</button>
    </div>
</div>

    <div class="row" id="rowAdvanced">
        <div class="form-group col-md-4">
            <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> खोज</button>
        </div>
    </div>
</div>
</form>
</div>

@if (isset($users))
    
<div class="card">
    <div class="card-header">
    <h3 class="card-title"></h3>
    </div>
    
    <div class="card-body">
    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
    <thead>
    <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">क्र.स.</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">नाम</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">नागरिता न.</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">जन्म मिति</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">रवाना/अवकास</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">#</th></tr>
    </thead>
    <tbody>
       
        @foreach ($users as $key=> $item)
    <tr class="odd">
    <td class="dtr-control sorting_1" tabindex="0">{{nepali($key+1)}}</td>
    <td>{{isset($item->nep_name) ? $item->nep_name : ''}}</td>
    <td>{{  nepali(isset($item->cs_no) ? $item->cs_no : '')}}</td>
    <td>{{nepali(isset($item->dob) ? $item->dob : '')}}</td>
    <td><a class="btn btn-primary">रवाना</a>
        <a class="btn btn-success">अवकास</a>
    </td>
    <td>

        <a href="{{route('staff-detail-list',$item->user_id)}}" class="btn btn-primary"><i class="fas fa-list"></i></a>
        <a href="{{route('sheetroll-show',$item->user_id)}}" class="btn btn-success"><i class="fas fa-eye"></i></a>
        <a class="btn btn-danger"><i class="fas fa-trash"></i></a>

        @hasanyrole('admin')
        @if ($item->is_verified==0)
        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="प्रमाणित गर्नुहोस" href="{{route('verify-all-form',$item->user_id)}}"><i class="fa-solid fa-thumbs-up"></i></a>
        @else
        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="खण्डन गर्नुहोस्" href="{{route('disprove-all-form',$item->user_id)}}"><i class="fa-solid fa-thumbs-down"></i></a>
        @endif
        @endrole

        @hasanyrole('cao')
        @if ($item->is_approved==0)
        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="प्रमाणित गर्नुहोस" href="{{route('approve-all-form',$item->user_id)}}"><i class="fa-solid fa-thumbs-up"></i></a>
        @else
        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="खण्डन गर्नुहोस्" href="{{route('decline-all-form',$item->user_id)}}"><i class="fa-solid fa-thumbs-down"></i></a>
        @endif
        @endrole

    </td>
    
    </tr>
    @endforeach
    
</tbody>
{{ $users->links() }}

 
    {{-- <tfoot>
    </tfoot>
    </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div> --}}
    </div>
    
    </div>

@endif





@endsection

@section('scripts')
    <script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/convert_nepali.js') }}"></script>
    <script>
        $(function() {
            $('#hideAdvancedBtn').hide();
            $('#rowAdvanced').hide();

            $('#province').on('change', function() {
                var province = $('#province').val();
                if (province!='') {
                    axios.get("{{ route('address.district') }}", {
                            params: {
                                id: province
                            }
                        }).then(function(response) {
                            console.log(response);
                            var html = '<option value="">छान्नुहोस्</option>';
                            var selected = '';
                            var rows = response.data;
                            $.each(rows, function(key, value) {
                                html += '<option value="' + value.id + '" data-eng="' + value.name +
                                    '" ' + selected + '>' + value.nep_name +
                                    '</option>';
                            });
                                $('#district').html(html);
                                var district = $('#district').val();
                        })  
                }
                else {
                    var html = '<option value="">छान्नुहोस्</option>';
                        $('#district').html(html);
                }

                 if (district != '') {
                    axios.get("{{ route('address.municipality') }}", {
                            params: {
                                id: district
                            }
                        }).then(function(response) {
                            console.log(response);
                            var html = '<option value="">छान्नुहोस्</option>';
                            var selected = '';
                            var rows = response.data;
                            $.each(rows, function(key, value) {
                                html += '<option value="' + value['id'] + '" data-eng="' + value[
                                        'name'] + '" ' + selected + '>' + value['nep_name'] +
                                    '</option>';
                            });
                                $('#municipality').html(html);
                              
                        })
                        .catch(function(error) {
                            console.log(error);;
                        });
                }

            });
            $('#district').on('change', function() {
                DistrictChange();
            });

            function DistrictChange() {
                var district = $('#district').val();

                if (district != '') {
                    axios.get("{{ route('address.municipality') }}", {
                            params: {
                                id: district
                            }
                        }).then(function(response) {
                            console.log(response);
                            var html = '<option value="">छान्नुहोस्</option>';
                            var selected = '';
                            var rows = response.data;
                            $.each(rows, function(key, value) {
                                html += '<option value="' + value['id'] + '" data-eng="' + value[
                                        'name'] + '" ' + selected + '>' + value['nep_name'] +
                                    '</option>';
                            });
                                $('#municipality').html(html);
                          

                        })
                        .catch(function(error) {
                            console.log(error);;
                        });
                }
                
            }

          
           


        });
    </script>
    <script>
          function showAdvanced()
            {
                $('#rowAdvanced').show();
                $('#showAdvancedBtn').hide();
                $('#hideAdvancedBtn').show();
            }

            function hideAdvanced()
            {
                $('#hideAdvancedBtn').hide();
                $('#showAdvancedBtn').show();
                $('#rowAdvanced').hide();
            }
    </script>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            })
    </script>
@endsection

