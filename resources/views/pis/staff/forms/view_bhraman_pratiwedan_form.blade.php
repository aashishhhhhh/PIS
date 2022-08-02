
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

    <div class="card p-4">

     
       
    <div class="container">

        <div class="row">
            <div class="col-md-4 text-left">
                <img src="{{ asset('storage/upload/gov.jpg') }}" alt=""
                class="px-1" height="150" width="300">
            </div>
            <div class="col-md-4 text-center">
                {{-- todo --}}
                <p>याङवरक  गाउपलिका</p>
                <h3>गाउ कार्यपालिकाको कार्यलय</h3>
                <p>थर्पु, पांचथर</p>
                <p>१ न. प्रदेश, नेपाल</p>
                <p> <b> कार्यलय कोड न.:</b></p>
                <p> <b> भ्रमण प्रतिवेदन</b></p>
            </div>

            <div class="col-md-4 text-right">
                <p>म.ले.प फारम न: ९०९</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 text-left">
               <p>भ्रमण आडेश न: </p>
               <p>भ्रमण टोलि प्रमुख: <select name="" id="">
                <option value="">छान्नुहोस्</option>       
            </select> </p>
               <p>भ्रमण अवधि: </p>
            </div>
        </div>

        <div class="row"> 
            <div class="col-md-12">
                <label for="">भ्रमणको उदस्य</label>
                <div style="border: 2px solid black; padding:5px;">
                    <p> </p>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <label for="">सम्पादित मुख्य मुख्य काम</label>
                <div style="border: 2px solid black; padding:5px;">
                    <p> </p>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <label for="">सारास तथा सुजावहरु</label>
                <div style="border: 2px solid black; padding:5px;">
                    <p> </p>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <label for="">भ्रमण पुस्टि गर्ने संलग्न कागजातको विवरण</label>
                <div style="border: 2px solid black; padding:5px;">
                    <p> </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text:left">
                ...........................
                <p>नाम:</p>
                <p>पद:</p>
            </div>
        </div>
    </div>
</div>

@endsection