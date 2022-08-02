@extends('layout.layout')
@section('title', 'बिदाको निवेदन')
@section('menu_show_faculty', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('leave_application', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
    
@endsection

@section('content')

<div class="card px-4 py-4 mt-10" >

    <form method="POST" action="{{route('update-leave-application')}}" enctype="multipart/form-data">
        @csrf
            @if (session()->has('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('msg')}}</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card-body">
            <div class="card-header">
                <h3>एडिट बिदाको निवेदन</h3>
            </div>
            <div class="container py-3">
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">आर्थिक वर्ष</span></div>
                            <input type="text" min="0" id="s_no" name="fiscal_year" value="{{isset($fiscal_year->name) ? $fiscal_year->name : '' }}"  class="form-control" readonly>
                            <input type="hidden" name="staff_id" value="{{$staff->id}}">
                            <input type="hidden" name="leave_id" value="{{$leaveApplication->id}}">

                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">कर्मचारीको नाम </span></div>
                            <input type="text" min="0" id="s_no" name="staff_name" value="{{isset($staff->nep_name) ? $staff->nep_name : '' }}"  class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">कर्मचारी संकेत नम्बर </span></div>
                            <div class="input-group-prepend"><span class="input-group-text">अंग्रेजी अंकमा</span></div>
                            <input type="number" min="0" id="s_no" name="staff_s_no" value="{{$staff->s_no}}"  class="form-control" readonly>
                        </div>
                        
                    </div>
    
                    <div class="form-group col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">पद: </span></div>
                            <input type="text" min="0" id="test" name="staff_position" value="{{$staffPosition}}"  class="form-control" readonly>
                        </div>
                        
                    </div>
    
                    <div class="form-group col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">कार्यालयको नाम: </span></div>
                            <input type="text" min="0" id="s_no" name="office_name" value="{{$officeName}}" class="form-control" readonly>
                        </div>
                    </div>
                    {{-- @dd($leaveTypes) --}}

                   

                    <div class="form-group col-md-4">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text">बिदाको प्रकार: </span></div>
                        <select name="leave_type" class="custom-select" id="leave_type">
                        @foreach ($leaveTypes as $item)
                        @if($leaveApplication->leave_type==$item->id)
                        <option value="{{$item->id}}">{{$item->leave_type}}</option>
                        @endif
                        @endforeach
                        
                        @foreach ($leaveTypes as $item)
                        @if($leaveApplication->leave_type!=$item->id)
                        <option value="{{$item->id}}">{{$item->leave_type}}</option>
                        @endif
                        @endforeach

                        </select>
                        </div>
                    </div>
    
                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">जम्मा बिदा(यस आर्थिक बर्सको): </span></div>
                            <input type="text" min="0" id="total_leave"   class="form-control" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">बाकी बिदा(पहिलाको आर्थिक वर्सको बाकी भए समग्रमा): </span></div>
                            <input type="text" min="0" id="leave_left" value="{{$leaveApplication->leave_left}}"   class="form-control" readonly>
                        </div>
                    </div>
    
                    <div class="form-group col-md-8">
                        <label for="">बिदाको मिति: </label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">देखि: </span></div>
                            <input type="text" id="from_date" value="{{$leaveApplication->from_date}}" name="from_date" class="form-control from_date">
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">सम्म: </span></div>
                            <input type="text" id="to_date" value="{{$leaveApplication->to_date}}"  name="to_date" class="form-control to_date">
                        </div>
                    </div>
    
                    <div class="form-group col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend" id="dateSuccess"></div>
                        </div>
                    </div>
    
                    <div class="form-group col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">बिदाको कारण</span></div>
                            <textarea id="leave_reason" name="leave_reason" id="" cols="100" rows="10">{{$leaveApplication->leave_reason}}</textarea>
                        </div>
                    </div>
                </div>
            </div> 

            </div>
            <div class="card-footer" >
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit </button>
            </div>  
    </form>
</div>

@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/convert_nepali.js') }}"></script>
<script>
   $(function(){
    var leaveApplication = @json($leaveApplication, JSON_PRETTY_PRINT);
    var staff = @json($staff, JSON_PRETTY_PRINT);

    if (staff!=null) {
      axios.get("{{ route('get-total-leave') }}", {
      params: {
      id: leaveApplication.leave_type,
      user_id: staff.user_id
      }
      })
      .then(function(response) {
        $('#total_leave').val(total_leave);
        $('#leave_left').val(response.data.leave_left);
        $('#from_date').val(leaveApplication.from_date)
        $('#to_date').val(leaveApplication.to_date)
         
    })
        .catch(function(error){
        console.log(error);
      });
  }
   });
     $('#from_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
                disableDaysBefore: 0,
            });

            $('#to_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
                disableDaysBefore: 0,
            });

            $('#leave_type').on('change', function() {
                total_leave();
        });

        function total_leave()
        {
            $("#to_date").val('');
            $("#from_date").val('');            

            var leave = $('#leave_type').val();
            if (leave!='') {
                axios.get("{{ route('get-total-leave') }}", {
                        params: {
                        id: leave,
                        user_id: {{auth()->user()->id}}
                        }
                    })
                    .then(function(response) {
                        var total_leave=response.data.leaveData.total_leave
                        $('#total_leave').val(total_leave);
                        $('#leave_left').val(response.data.leave_left);

                        to_date.nepaliDatePicker({
                        onChange: function() {
                           

                        var from_date = $('#from_date').val();
                        var to_datee= to_date.value;

                        date1 = new Date(from_date);  
                        date2 = new Date(to_datee); 

                        var time_difference = date2.getTime() - date1.getTime();  
                        var days_difference = time_difference / (1000 * 60 * 60 * 24);  
                        let leave_left = $('#leave_left').val();
                        
                       if (leave_left<=days_difference) {
                        $("#to_date").val('');
                        $("#to_date").css('border-color', function(){
                            $('#dateSuccess').text('चयन गरेको जम्मा दिन: ..');
                            return '#FF0000';
                        });

                       }
                       else{
                        $("#to_date").css('border-color', function(){
                            var from_date = $('#from_date').val();
                            var to_datee = $('#to_date').val();

                            date1 = new Date(from_date);  
                            date2 = new Date(to_datee); 
                            var time_difference = date2.getTime() - date1.getTime();  
                            var days_difference = time_difference / (1000 * 60 * 60 * 24)+1; 
                            var days_difference = parseInt(days_difference);  

                            $('#dateSuccess').text('चयन गरेको जम्मा दिन: '+ days_difference);
                            return '#000000';
                        });
                       }
                    }
                 });

                 from_date.nepaliDatePicker({
                        onChange: function() {
                        var from_date = $('#from_date').val();
                        var to_datee = $('#to_date').val();
                        date1 = new Date(from_date);  
                        date2 = new Date(to_datee); 

                        var time_difference = date2.getTime() - date1.getTime();  
                        var days_difference = time_difference / (1000 * 60 * 60 * 24);  
                        let leave_left = $('#leave_left').val();
                        
                       if (leave_left<=days_difference) {
                        $("#from_date").val('');
                        $("#from_date").css('border-color', function(){
                            return '#FF0000';
                        });
                       }
                       else{
                        $("#from_date").css('border-color', function(){
                            var from_date = $('#from_date').val();
                            var to_datee = $('#to_date').val();
                            date1 = new Date(from_date);  
                            date2 = new Date(to_datee); 
                            var time_difference = date2.getTime() - date1.getTime();  
                            var days_difference = time_difference / (1000 * 60 * 60 * 24)+1;
                            return '#000000';
                        });
                       }
                    }
                 });

                    })
                    
                  
            }
            
        }

        function setDefault()
        {
            $('#from_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
                disableDaysBefore: 0,
            });

            $('#to_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
                disableDaysBefore: 0,
            });
            return 0;

        }


       

        // var from_date = $('#from_date').val();
        //      var to_date = $('#to_date').val();
        //      if (from_date !='' && to_date !='') {
        //       console.log('hello');
        //      }



</script>

<script>
                        $("#to_date").css('border-color', function(){
                            var leaveApplication = @json($leaveApplication, JSON_PRETTY_PRINT);
                            console.log(leaveApplication.from_date);
                            date1 = new Date(leaveApplication.from_date);  
                            date2 = new Date(leaveApplication.to_date); 
                            var time_difference = date2.getTime() - date1.getTime();  
                            var days_difference = time_difference / (1000 * 60 * 60 * 24)+1; 
                            var days_difference = parseInt(days_difference);  
                            $('#dateSuccess').text('चयन गरेको जम्मा दिन: '+ days_difference);
                            return '#000000';
                        });

</script>
@endsection

<script>
    
</script>