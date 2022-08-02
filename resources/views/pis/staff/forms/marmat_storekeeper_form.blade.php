@extends('layout.layout')
@section('title', 'मर्मत आदेश फारम')
@section('menu_show_marmat_aadesh', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('marmat_form', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')
<div class="card">
    <div class="card-header">
    <h3>स्टोरकिकिपर/फाटवाला फारम</h3>
    </div>
    <div class="card-body">
        <table  class="table table-bordered" style="font-size: 13px;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center;">जिन्सी संकेत न.</td>
                    <td rowspan="2" style="text-align: center;">वारेन्टी अवधि भए/ नभएको</td>
                    <td rowspan="2" style="text-align: center;">आगाडी मर्मत गरिएको पटक</td>
                    <td rowspan="2" style="text-align: center;">आगाडी मर्मत गरिएको मिति<!-- /उप समूह !--></td>
                    <td  style="text-align: center;">अगाडी मर्मत गरिएको रकम</td>
                </tr>
                </thead>
                <form action="{{route('marmat-storekeeper-form-submit')}}" method="post">
                    @csrf

            <tbody id="row_body">
                <tr>
                 
                 <td style="max-width: 200px;">
                     <input type="number" id="sanket_no" name="sanket_no" >
                 </td>
                 <td>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="has_warranty" id="flexRadioDefault1" value="1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          वारेन्टी भएको
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="has_warranty" id="flexRadioDefault2" value="0" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            वारेन्टी नभएको
                        </label>
                      </div>
                 </td>
                 <td>
                    <input type="number" name="before_marmat_times">
                 </td>
                 <td>
                     <input type="text"   class="form-control" value="" name="before_marmat_date" id="before_marmat_date">
                 </td> 
                 <td>
                     <input type="number" name="before_marmat_price">
                     <input type="hidden" name="marmat_no" value="{{$marmat->marmat_form_no}}">
                 </td>
                 <td>
                 </td>
             </tr>
        </tbody>

        </table>
    </div>

    <div class="card-footer text-center">
        <button type="submit" class="btn btn-primary">submit</button>
    </div>
</form>

</div>
@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
        $('#before_marmat_date').nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 70,
            readOnlyInput: true,
            ndpTriggerButton: false,
            ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
            ndpTriggerButtonClass: 'btn btn-primary',
        });
</script>
@endsection
