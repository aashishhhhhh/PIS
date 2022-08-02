@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_faculty', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('staff_new_reg', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('content')
<div class="card">
    @if (session()->has('msg'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{session('msg')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card-header">
    <h3 class="card-title">
        
    @isset($requests)
    नया कर्मचारी दर्ता अनुरोध
    @endisset
    
    @isset($registered)
    दर्ता भइसकेका कर्मचारी
    @endisset

    @isset($rejected)
        दर्ता अस्विकार भएका कर्मचारी
    @endisset
    </h3>
    
    <div class="card-tools">
        <a href="{{route('registered-staffs')}}" class="btn btn-primary">दर्ता भैसकेका कर्मचारी</a>
        <a href="{{route('decline-registered-staffs')}}" class="btn btn-primary">दर्ता अस्विकार भएका कर्मचारी</a>
        <a href="{{route('staff-reg-request-list')}}" class="btn btn-primary">नया दर्ता अनुरोध सुची</a>
    </div>
    </div>
    <div class="card-body table-responsive p-0">
@isset($requests)
        <div>
     <table class="table table-hover text-nowrap">
    <thead>
    <tr>
    <th>क्र.स.</th>
    <th>नाम</th>
    <th>ईमेल</th>
    <th>कार्य</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($requests as $key => $item)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->email}}</td>
    <td><a href="{{route('verify-reg-request',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="दर्ता स्वीकार गर्नुहोस"> <i class="fa-solid fa-thumbs-up"></i></a>
    <a href="{{route('reject-reg-request',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="दर्ता अस्विकार गर्नुहोस"> <i class="fa-solid fa-thumbs-down"></i></a>
    <a href="{{route('delete-reg-request',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="डीलिट गर्नुहोस"> <i class="fas fa-trash"></i></a></td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
@endisset

@isset($registered)
<div>
    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
        <th>क्र.स.</th>
        <th>नाम</th>
        <th>ईमेल</th>
        <th>कार्य</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($registered as $key => $item)
        <tr>
        <td>{{$registered->firstItem() + $key }}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>
        <a  href="{{route('reject-reg-request',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="दर्ता अस्विकार गर्नुहोस"> <i class="fa-solid fa-thumbs-down"></i></a>
        <a href="{{route('delete-reg-request',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="डीलिट गर्नुहोस"> <i class="fas fa-trash"></i></a></td>
        </tr>
        @endforeach
    
        </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $registered->links() }}
        </div>
</div>
@endisset


@isset($rejected)
    
<div>
    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
        <th>क्र.स.</th>
        <th>नाम</th>
        <th>ईमेल</th>
        <th>कार्य</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rejected as $key => $item)
        <tr>
        <td>{{$key+1}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td><a href="{{route('verify-reg-request',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="दर्ता स्वीकार गर्नुहोस"> <i class="fa-solid fa-thumbs-up"></i></a>
        <a href="{{route('delete-reg-request',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="डीलिट गर्नुहोस"> <i class="fas fa-trash"></i></a></td>
        </tr>
        @endforeach
    
        </tbody>
        </table>
</div>
@endisset





    </div>
    
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
