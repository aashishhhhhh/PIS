
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
    <div class="card">
        <div class="card-body">
            <div class="container">
                <table class="">

                </table>
            <div class="table-responsive">
                <input type="text" id="nepali-date-picker" />
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/convert_nepali.js') }}"></script>
    <script>$(document).ready(function () {
        // Initialize Nepali Date Picker
        $("#nepali-date-picker").nepaliDatePicker();
      });</script>
@endsection