@extends('layout.layout')
@section('title', 'New Staff')
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
    <div class="card">
        <div class="card-header">
            <h3>कर्मचारी विवरण सूची
            </h3>
        </div>
        <div class="card-body">
                <div class="container">
                    <div class="row">
                       <div class="col-md-2">
                        <a class="btn btn-light" >कर्मचारीको पूरा नाम र थर</a>
                       </div>
                       <div class="col-md-2">
                        <button class="btn btn-light">ठेगाना सम्बन्धी विवरण</button>
                       </div><div class="col-md-2">
                        <button class="btn btn-light">अन्य वैयक्तिक विवरण</button>
                       </div ><div class="col-md-2">
                        <button class="btn btn-light">भाषाको दक्षता सम्बन्धी विवरण</button>
                       </div><div class="col-md-2">
                        <button class="btn btn-light">कर्मचारीको शुरु स्थायी नियुक्तिको विवरण</button>
                       </div>
                        <div class="col-md-2">
                        <button class="btn btn-light">काम गरेको भए सोको विवरण</button>
                       </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-2">
                            <button class="btn btn-light">अन्य विवरण</button>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-light">सेवा सम्बन्धी विवरण</button>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-light"> शैक्षिक योग्यता</button>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-light"> तालिम / सेमिनार / सम्मेलन सम्ब्धी विवरण</button>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-light"> विभूषण, प्रशंसा पत्र र पुरस्कारको विवरण</button>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-light"> विभागीय सजायको विवरण
                            </button>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-light"> बिदा र औषधी उपचारको विवरण
                            </button>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-light"> वर्गीकृत क्षेत्रहरुमा काम गरेको विवरण
                            </button>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="card">
        
    </div>
@endsection