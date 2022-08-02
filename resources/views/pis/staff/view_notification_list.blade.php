@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_faculty', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('notification_list', 'active')
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
            <h3>नोटिफिकेसन</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <div>
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                    <th>क्र.स.</th>
                    <th>नोटिफिकेसन सुची</th>
                    <th>कार्य</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($notifications as $key => $item)
                        <tr>
                        <td>{{nepali($key+1)}}</td>
                        <td>{{$item->text}}</td>
                        <td><a href="{{route('mark-as-read',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="दर्ता स्वीकार गर्नुहोस"> <i class="fa-solid fa-thumbs-up"></i></a>
                        </tr>
                    @endforeach

                    </tbody>
                    </table>
            </div>
            
            
            
            
            
                </div>
    </div>
@endsection