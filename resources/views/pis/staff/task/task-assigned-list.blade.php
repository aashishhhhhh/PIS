@extends('layout.layout')
@section('title', 'कर्मचारी सुची')
@section('menu_show_task', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_task', 'block')
@section('task_list', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        @hasanyrole('admin|user')
        <h3>{{$staff->nep_name}}लाई प्रदान कार्य</h3>
        @endrole
        @hasanyrole('cao')
        <h3>कर्मचारी सुची</h3>
        @endrole
    </div>
    <div class="card-body">
        <table class="table table-hover text-nowrap">
            <thead>
             <tr>
            <th>क्र.स</th>
            <th>कर्मचारी नाम</th>
            <th>कार्य हेर्नुहोस</th>
            <th>कार्य सुरु गरेको मिति/समय</th>
            <th>कार्य सम्पन्न गर्नुपर्ने मिति/समय</th>
            <th>स्थिति</th>
            <th>टिप्पणी</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
                
            @foreach ($tasked->stafftasks as $key => $item)
            {{-- @dd() --}}
            {{-- @dd($tasked) --}}
            {{-- @dd() --}}
                <tr>
                <td>{{nepali($key+1)}}</td>
                <td>{{$item->nep_name}}</td>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                    कार्य विवरण हेर्नुहोस
                  </button>
                  <a  href="{{route('view-task-description',$item->pivot->id)}}" class="btn btn-success">
                    कार्य विवरण हेर्नुहोस
                  </a>
                </td>
                @if ($tasked->deadline_type==1)
                <td>{{$tasked->start_date}}</td>
                <td>{{$tasked->finish_date}}</td>
                @else
                <td>{{$tasked->start_time}}</td>
                <td>{{$tasked->finish_time}}</td>
                @endif
                <td>
                  
                  @hasanyrole('admin|user')
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#status{{$item->pivot->id}}">
                    स्थिति
                </button>
                @endrole
                  
                @hasanyrole('cao')
                  
                @if($item->pivot->staff_task_status==1)
                टास्क प्राप्त गरेको
                @endif

                @if($item->pivot->staff_task_status==2)
                विवरण तयार गर्दै गरेको
                @endif

                @if($item->pivot->staff_task_status==3)
                टिप्पणी/प्रतिवेदन/पत्र तयार तयार गर्दै गरेको
                @endif

                @if($item->pivot->staff_task_status==4)
                काम सम्पन्न गरेको
                @endif
              @if ($item->pivot->staff_task_status==0)
                  कम सुरु गर्न वाकी
              @endif
                
                @endrole
              </td></td>
                <td><a href="{{route('assigned-task-comments',$item->pivot->id)}}" class="btn btn-primary"><i class="fas fa-comment-alt-medical"></i>टिप्पणीहरु</a></td>
                </tr>

                <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">कार्य विवरण</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         {!!$tasked->task_description!!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="status{{$item->pivot->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">स्थिति</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('submit-task-status')}}" method="POST">
          @csrf
        <div class="modal-body" >
          {{-- @dd() --}}

          
          <div class="form-check">
            <input type="hidden" name="task_id" value="{{$item->pivot->id}}">
            <input class="form-check-input" type="radio" name="task_status" id="flexRadioDefault1" value="1" @if($item->pivot->staff_task_status==1) checked @endif>
            <label class="form-check-label" for="flexRadioDefault1">
            टास्क प्राप्त गरेको
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="task_status" id="flexRadioDefault2" value="2" @if($item->pivot->staff_task_status==2) checked @endif>
            <label class="form-check-label" for="flexRadioDefault2">
              विवरण तयार गर्दै गरेको
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="task_status" id="flexRadioDefault3" value="3" @if($item->pivot->staff_task_status==3) checked @endif>
            <label class="form-check-label" for="flexRadioDefault3">
              टिप्पणी/प्रतिवेदन/पत्र तयार तयार गर्दै गरेको
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="task_status" id="flexRadioDefault4" value="4" @if($item->pivot->staff_task_status==4) checked @endif>
            <label class="form-check-label" for="flexRadioDefault4">
              काम सम्पन्न गरेको
            </label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>

      </div>
    </div>
  </div>
            @endforeach
            </tbody>
            </table>
    </div>

    <div class="card-footer">

    </div>
</div>
    
@endsection
