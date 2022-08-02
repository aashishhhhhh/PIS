@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_bhramad', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('bhramad_form', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<form action="{{route('bhraman_pratiwedan_form_submit')}}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
           <h3> भ्रमण प्रतिवेदन</h3>
        </div>
        <div class="container">

            <div class="row" >
                <div class="col-md-3 m-4">
                    <div class="input-group input">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-lg">भ्रमण आदेश न:</span>
                        </div>
                       <input type="text" class="form-control" name="aadesh_no" value="{{$visit->aadesh_no}}" readonly>
                    </div>
                </div>
            </div>

            <div class="row" >
                <div class="col-md-3 m-4">
                    <div class="input-group input">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-lg">भ्रमण टोलि प्रमुख</span>
                        </div>
                        <input type="text" class="form-control" name="team_leader" value="{{$staff_name}}" readonly>
                        {{-- <select name="team_leader" id="">
                            <option  class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="">क्षन्निहोस्</option>
                            @foreach ($staffs as $item)
                            <option  class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{$item->id}}">{{$item->nep_name}}</option>
                            @endforeach
                        </select> --}}
                    </div>
                </div>
            </div>

            <div class="row">
              

                <div class="col-md-3 m-4">
                    <div class="input-group input">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-lg"> भ्रमण अवधि</span>
                        <input type="text" name="visit_duration" class="form-control" value="{{nepali($difference_in_days)}}" readonly>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-4">
                    <label for="">भ्रमणको उद्स्य</label>
                        <div style="border: 2px solid black; padding:5px;">
                            <input type="hidden" name="visit_udasya" value="{{$visit->visit_aim}}">
                            <p> {{$visit->visit_aim}} </p>
                        </div>
                </div>
                <div class="col-md-12 m-4">
                    <label for="">सम्पादित मुख्य मुख्य काम</label>
                    <textarea name="mukhya_kaam" class="ckeditor form-control" name="description"></textarea>
                </div>

                <div class="col-md-12 m-4">
                    <label for="">सिकाई तथा उपलब्दी</label>
                    <textarea name="sikai_upalabdi" class="ckeditor form-control" name="description"></textarea>
                </div>

                <div class="col-md-12 m-4">
                    <label for="">सारास तथा सुजावहरु</label>
                    <textarea name="suggestion" class="ckeditor form-control" name="description"></textarea>
                </div>

                <div class="col-md-12 m-4">
                    <label for="">भ्रमण पुस्टि गर्ने संलग्न कागजातको विवरण</label>
                    <textarea name="visit_paper_details" class="ckeditor form-control" name="description"></textarea>
                </div>
            </div>
        </div>

        <div class="card-footer"  style="text-align: center">
            <button class="btn btn-primary"> Submit </button>
        </div>
    </div>

</form>


@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/convert_nepali.js') }}"></script>
<script>
    $('.date').nepaliDatePicker({
                  ndpYear: true,
                  ndpMonth: true,
                  ndpYearCount: 70,
                  ndpTriggerButton: false,
                  ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                  ndpTriggerButtonClass: 'btn btn-primary',
              });
  </script>
@endsection
