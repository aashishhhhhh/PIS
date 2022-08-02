@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_task', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_task', 'block')
@section('task_list', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<form action="{{route('task-store')}}" method="POST">
    @csrf

    <div class="card">
        <div class="card-header">
            कार्य दिनुहोस
            <div class="card-tools">
                <a href="{{route('task-list')}}" class="btn btn-primary"><i class="fa-solid fa-circle-arrow-left"></i> पछाडी जानुहोस</a>
            </div>      
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">कार्य तोकेको मिति</span>
                            </div>
                            <input type="text" name="date" class="form-control date" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-10">
                        <div class="input-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="has_deadline" onchange='handleChange(1);' id="has_deadline" value="1">
                            <label class="form-check-label" for="has_deadline" >
                               म्याद भएको
                            </label>
                        </div>
                        <div class="form-check">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="has_deadline" onchange='handleChange(0);' id="no_deadline" value="0" checked>
                                <label class="form-check-label" for="no_deadline">
                                    म्याद नभएको
                              </label>
                            </div>
                      </div>
                    </div>
                    @error('has_deadline')
                        <strong style="color: red">{{ $message }}</strong>
                    @enderror
                </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">कार्यको नाम</span>
                            </div>
                            <input type="text" name="task_name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                          @error('task_name')
                          <strong style="color: red">{{ $message }}</strong>
                      @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">कार्य विवरण</span>
                            </div>
                            <textarea name="task_description" id="" cols="200" rows="10"></textarea>
                          </div>
                          @error('task_description')
                          <strong style="color: red">{{ $message }}</strong>
                      @enderror
                    </div>
                </div>

                <div class="row" id="deadline">
                    <div class="col-md-10">
                        <div class="input-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input"  type="radio" name="deadline_type" onchange='deadlineType(1);' value="1" id="date_deadline">
                            <label class="form-check-label" for="date_deadline" >
                               मिति म्याद
                            </label>
                        </div>
                        <div class="form-check">
                            <div class="form-check">
                                <input class="form-check-input" type="radio"  name="deadline_type" onchange='deadlineType(0);' value="0" id="time_deadline">
                                <label class="form-check-label" for="time_deadline">
                                    समय म्याद
                              </label>
                            </div>
                      </div>
                    </div>
                </div>
                </div>

                <div class="row" id="time_div">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">कार्य सुरु गर्नुपर्ने समय</span>
                            </div>
                            <input type="time" name="start_time" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">कार्य सम्पन्न गर्नुपर्ने समय</span>
                            </div>
                            <input type="time" name="finish_time" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                    </div>
                </div>

                <div class="row" id="date_div">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">कार्य सुरु गर्नुपर्ने मिति</span>
                            </div>
                            <input type="text" name="start_date" class="form-control date" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">कार्य सम्पन्न गर्नुपर्ने मिति</span>
                            </div>
                            <input type="text" name="finish_date" class="form-control date" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                    </div>
                </div>


                {{-- <div class="row" id="time_div">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">कार्य सम्पन्न गरिसक्नुपर्ने मिति </span>
                            </div>
                            <input type="text" name="finish_date" class="form-control date" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">कार्य सम्पन्न गरिसक्नुपर्ने समय</span>
                            </div>
                            <input type="text" name="finish_time" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                          </div>
                    </div>
                </div> --}}


            </div>
        </div>

        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
    </div>
</form>
@endsection


@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
          $('.date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

    </script>

    <script>
        function handleChange(p) {
           if (p==0) {
                $('#deadline').hide();
            }
            else{
                $('#deadline').show();
            }
        }
        </script>

<script>
    function deadlineType(p) {
        if (p==0) {
            $('#time_div').show();
            $('#date_div').hide();
        }
    else{
        $('#time_div').hide();
            $('#date_div').show();        }
    }
    </script>
    <script>
        $('#time_div').hide();
        $('#deadline').hide();
        $('#date_div').hide();
        $('#time_div').hide();
    </script>
@endsection
