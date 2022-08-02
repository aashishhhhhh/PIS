@extends('layout.layout')
@section('title', 'New Staff')
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
    <div class="card-header">
    <h3 class="card-title">बिदाको निवेदन</h3>
    </div>
    <div class="card-body">
        @php
            // dd();    
        @endphp
        <div class="form-group col-md-8">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">बिरामी बिदा </span></div>
                <input type="text" min="0" id="s_no" name="staff_name" value="{{$applications->settingLeaves->leave_type }}"  class="form-control" readonly>
            </div>
        </div>

        <div class="form-group col-md-8">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">अगिको बाकी </span></div>
                <input type="text" min="0" id="s_no" name="staff_name" value="{{$applications->settingLeaves->total_leave-$previousTotal }}"  class="form-control" readonly>
            </div>
        </div>
        <div class="form-group col-md-8">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">हाल मागेको </span></div>
                <input type="text" min="0" id="s_no" name="staff_name" value="{{$currentLeave}}"  class="form-control" readonly>
            </div>
        </div>
        <div class="form-group col-md-8">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">अब रहन आउने </span></div>
                <input type="text" min="0" id="s_no" name="staff_name" value="{{$applications->settingLeaves->total_leave-($previousTotal+$currentLeave) }}"  class="form-control" readonly>
            </div>
        </div>

        <div class="form-group col-md-8">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">बिदाको कारण </span></div>
                <textarea name="" id="" cols="80" rows="10" readonly>{{$applications->leave_reason}}</textarea>
            </div>
        </div>
   
    
    </div>
    
    <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
@endsection