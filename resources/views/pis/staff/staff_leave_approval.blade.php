@extends('layout.layout')
@section('title', 'बिदाको निवेदनको सुची')
@section('menu_show_anurodh', 'menu-open')
@section('menu_show_bida','menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('leave_approval', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection

@section('content')
<div class="card">
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
    <div class="card-tools">
    <div class="input-group input-group-sm" style="width: 150px;">
    <div class="input-group-append">
      
    </div>
    </div>
    </div>
    </div>
    <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
    <thead>
    <tr>
    <th>क.स.</th>
    <th>निवेदकको नाम</th>
    <th>बिदाको प्रकार</th>
    <th>स्थिति</th>
    <th>स्वीकृति</th>
    <th>#</th>

    </tr>
    </thead>
    <tbody>
        @foreach ($applications as $key=> $item)
        <tr>
        <td>{{$key+1}}</td>
        <td>{{$item->staff_name}}</td>
        <td>{{$item->settingLeaves->leave_type}}</td>
        <td>{{$item->is_approved ? 'स्वीकृत' : 'स्वीकृत भाको छैन'}}</td>
        
        <td>
            <button type="button" id="myBtn" onclick="show({{$item->id}})" data-target=".bd-example-modal-lg" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-eye"></i> पुरै विवरण हेर्नुहोस </button>
        </td>
        <td>
          <a href="{{route('edit-leave-application',$item->id)}}" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-edit"></i></a>
          </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    </div>
    
    </div>
    <!-- Button trigger modal -->
  <!-- Modal -->
  <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="width: 300%">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
            <th> बिदाको प्रकार</th>
            <th>देखि</th>
            <th>सम्म</th>
            <th>अगिको बाकी
            </th>
            <th>हाल मागेको</th>
            <th>अब रहन आउने
            </th>
            <th>बिदाको कारण
            </th>
            <th>स्वीकृति</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                <td id="leave_type"></td>
                <td id="from_date"></td>
                <td id="to_date"></td>
                <td id="previous_left"></td>
                <td id="current_leave"></td>
                <td id="now_left"></td>
                <td id="leave_reason"></td>
                <td id="submitBtn">
                    
                </td>
                </tr>
            </tbody>
            </table>
      </div>
    </div>
  </div>
@endsection

@section('scripts')

<script>

  function show(id)
  {
    $("#myModal").modal();
    leave_details(id)
  }

  function leave_details(id)
  {
    axios.get("{{ route('leave-approval-details') }}", {
                  params: {
                        id: id,
                        user_id: {{auth()->user()->id}}
                        }
                })
                .then(function(response) {
                    $('#leave_type').text(response.data.application.setting_leaves.leave_type);
                    
                    var total_leave=parseInt( response.data.application.setting_leaves.total_leave)
                    var previousTotal= parseInt( response.data.previousTotal)
                    var currentLeave= parseInt( response.data.currentLeave)
                    if (response.data.flag==0) {
                        var previous_left=previousTotal;
                        var now_left = total_leave-currentLeave;
                    }
                    else
                    {
                        var previous_left=total_leave-previousTotal;
                        var now_left =total_leave-(previousTotal+currentLeave)
                    }
                    var from_date=response.data.application.from_date;
                    var to_date=response.data.application.to_date;
                    $('#previous_left').text(previous_left+' दिन');
                    $('#current_leave').text(currentLeave+' दिन');
                    $('#now_left').text(now_left+' दिन')
                    $('#leave_reason').text(response.data.application.leave_reason)
                    $('#from_date').text(from_date)
                    $('#to_date').text(to_date)
                    var url = '{{ route("leave-approved", ":id") }}'
                    var caourl = '{{ route("cao-leave-approved", ":id") }}'
                    url = url.replace(':id', id);
                    caourl = caourl.replace(':id', id);
                    var role = @json($role, JSON_PRETTY_PRINT);
                    if(role=='admin')
                    {
                      var button = $("<a href='"+url+"' class='btn btn-success'><i class='fas fa-thumbs-up'></i> सिफारिश गर्नुहोस</a>");
                    }
                    else if(role=='cao')
                    {
                      var button = $("<a href='"+caourl+"' class='btn btn-success'><i class='fas fa-thumbs-up'></i> सिफारिश गर्नुहोस</a>");
                    }
                    button.appendTo("#submitBtn");
                })    
  }


</script>

@endsection