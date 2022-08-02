@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_faculty', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('new_staff', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
 @if (count($data)>0)
     
<div class="card px-4 py-4 mt-4" style="width: 2000px">
    @if (session()->has('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('msg')}}</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
    <section class="content-header">
        <h1 class="pull-left">सेवा सम्बन्धी विवरण
        </h1>
   
    </section>
        <div class="row">
         
            <div class="col-md-12" id="right-col">
                    <input type="hidden" name="req_field" value="111">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <form action="{{route('page_8_submit')}}" method="POST">
                        @csrf

                        @isset($is_admin)
                            <input type="hidden" name="is_admin" value="{{$is_admin}}">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                        @endif  
                    <div class="box-body">
                        <table class="table table-bordered responsive" style="font-size: 13px;">
                            <thead>
                            <tr>
                                <td style="text-align: center;">सेवा</td>
                                <td style="text-align: center;">समूह <!-- /उप समूह !--></td>
                                <td style="text-align: center;">पद र श्रेणी</td>
                                <td style="text-align: center;">कार्यालयको / बिद्यालयको नाम र ठेगाना</td>
                                <td style="text-align: center;">कार्यालयको / बिद्यालयको नाम र ठेगाना अंग्रजीमा</td>
                                <td style="text-align: center;">नयाँ नियुक्ति/सरुवा/बढुवा</td>
                                <td style="text-align: center;">निर्णय मिति</td>
                                <td style="text-align: center;">बहाली मिति<br/>( हाजिरी मिति)</td>
                                <td style="text-align: center;">सक्रिय</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody id="row_body">
                                 @foreach ($data as $index => $value)

                                       <tr class="tableRow{{$index+1}}">
                                        <td>
                                            <div  class="form-control">
                                            <select class="service" id="service" name="service[{{$index+1}}]" >
                                                @if (isset($value->service))

                                                    @foreach ($services as $item)
                                                        @if ($value->service==$item->id)
                                                        <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($services as $item)
                                                        @if ($value->service!=$item->id)
                                                        <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($services as $item)
                                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            </div>
                                            @error('service.*')
                                            <strong style="color: red">{{$message}}</strong>
                                            @enderror
                                        </td>
                                        <td style="max-width: 200px;">
                                            <div class="form-control">

                                            <select class="office_group" id="office_group" name="office_group[{{$index+1}}]" >
                                                    @if (isset($value->office_group))
                                                        @foreach ($officeGroups as $item)
                                                            @if ($value->office_group==$item->id)
                                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                        @foreach ($officeGroups as $item)
                                                            @if ($value->office_group!=$item->id)
                                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach ($officeGroups as $item)
                                                                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                        @endforeach
                                                    @endif
                                             
                                            </select>
                                            </div>
                                            @error('office_group.*')
                                            <strong style="color: red">{{$message}}</strong>
                                            @enderror
                                            <!--
                                            <select id="office_subgroup_" name="office_subgroup[]" class="form-control select2">
                                                <option value="" data-eng="">उप समूह चयन</option>
                                             
                                            </select>
                                            !-->
                                        </td>
                                        <td style="max-width: 200px;">
                                            <div class="form-control">

                                            <select class="position" id="position_1"  name="position[{{$index+1}}]">
                                                @if (isset($value->position))
                                                    @foreach ($positions as $item)
                                                        @if ($value->position==$item->id)
                                                        <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                        @endif
                                                    @endforeach

                                                    @foreach ($positions as $item)
                                                    @if ($value->position!=$item->id)
                                                        <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                                @else
                                                        @foreach ($positions as $item)
                                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                        @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @error('position.*')
                                        <strong style="color: red">{{$message}}</strong>
                                        @enderror
                                        <div class="form-control">
                                            <select class="level" id="level" name="level[{{$index+1}}]" >
                                              @if (isset($value->level))
                                                    @foreach ($levels as $item)
                                                    @if ($value->level==$item->id)
                                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                    @endif
                                                    @endforeach

                                                    @foreach ($levels as $item)
                                                    @if ($value->level!=$item->id)
                                                    <h1>asldn</h1>
                                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                    @endif
                                                    @endforeach

                                              @else
                                                @foreach ($levels as $item)
                                                        <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                @endforeach
                                              @endif

                                            </select>
                                            @error('level.*')
                                            <strong style="color: red">{{$message}}</strong>
                                            @enderror
                                        </div>
                                       

                                        </td>
                                        <td>
                                            <input type="text" id="office_name_address" name="office_name_address[{{$index+1}}]" class="form-control" value="{{isset($value->office_name_address) ? $value->office_name_address : ''}}" >
                                            @error('office_name_address.*')
                                            <strong style="color: red">{{$message}}</strong>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" id="office_name_address_english" name="office_name_address_english[{{$index+1}}]" class="form-control" value="{{isset($value->office_name_address_english) ? $value->office_name_address_english : ''}}" >
                                            @error('office_name_address_english.*')
                                            <strong style="color: red">{{$message}}</strong>
                                            @enderror
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                @if (isset($value->new_appoint))
                                                        @foreach ($appoints as $key=> $item)
                                                            @if ($value->new_appoint==1)
                                                                <div class="input-group-text ml-2">
                                                                    <input  class="new_appoint" name="new_appoint[{{$index+1}}]" type="radio" aria-label="Radio button for following text input" value="{{$key}}" checked> {{$item}}
                                                                </div>
                                                            @endif
                                                            @if ($value->new_appoint==2)
                                                                <div class="input-group-text ml-2">
                                                                    <input  class="new_appoint" name="new_appoint[{{$index+1}}]" type="radio" aria-label="Radio button for following text input" value="{{$key}}" checked> {{$item}}
                                                                </div>
                                                            @endif
                                                            @if ($value->new_appoint==3)
                                                                <div class="input-group-text ml-2">
                                                                    <input  class="new_appoint" name="new_appoint[{{$index+1}}]" type="radio" aria-label="Radio button for following text input" value="{{$key}}" checked> {{$item}}
                                                                </div>
                                                            @endif
                                                            @if ($value->new_appoint==4)
                                                                <div class="input-group-text ml-2">
                                                                    <input  class="new_appoint" name="new_appoint[{{$index+1}}]" type="radio" aria-label="Radio button for following text input" value="{{$key}}" checked> {{$item}}
                                                                </div>
                                                            @endif
                                                            @endforeach
                                                        @else
                                                            @foreach ($appoints as $key=> $item)
                                                                <div class="input-group-text ml-2">
                                                                    <input  class="new_appoint" name="new_appoint[{{$index+1}}]" type="radio" aria-label="Radio button for following text input" value="{{$key}}">  {{$item}}
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        @error('new_appoint.*')
                                                        <strong style="color: red">{{$message}}</strong>
                                                        @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 ndp-custom" style="max-width: 400px;">
                                                @if ($index+1>1)
                                                <input type="text" style="width:100px"   id="decision_date{{$index+1}}" name="decision_date[{{$index+1}}]" value="{{isset($value->decision_date) ? $value->decision_date : ''}}" class="form-control decision_date">
                                                @else
                                                <input type="text"  style="width:100px"    id="decision_date" name="decision_date[{{$index+1}}]" value="{{isset($value->decision_date) ? $value->decision_date : ''}}" class="form-control decision_date">
                                                @endif
                                                @error('decision_date.*')
                                                <strong style="color: red">{{$message}}</strong>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 ndp-custom">
                                                @if ($index+1>1)
                                                <input type="text" style="width:100px"  id="restoration_date{{$index+1}}" name="restoration_date[{{$index+1}}]" value="{{isset($value->restoration_date) ? $value->restoration_date : ''}}" class="form-control restoration_date">
                                                @else
                                                <input type="text" style="width:100px"  id="restoration_date" name="restoration_date[{{$index+1}}]" value="{{isset($value->restoration_date) ? $value->restoration_date : ''}}" class="form-control restoration_date">
                                                @endif
                                                @error('restoration_date.*')
                                                <strong style="color: red">{{$message}}</strong>
                                                @enderror
                                            </div>
                                        </td>

                                        <td>
                                            <div class="col-md-12 ndp-custom">
                                                
                                                <div class="form-check">
                                                    @if ($value->is_active==1)
                                                    <input class="form-check-input" name="is_active[{{$index+1}}]" type="checkbox" value="1" id="flexCheckDefault" checked>
                                                    @else
                                                    <input class="form-check-input" name="is_active[{{$index+1}}]" type="checkbox" value="1" id="flexCheckDefault">
                                                    @endif
                                                  </div>
                                            </div>
                                        </td>
                                        <td id="addBtnId{{$index+1}}">
                                            @php
                                                $length=count($data);
                                            @endphp
                                            @if ($index+1>=$length)
                                            <a id="add_btn" onclick="addDetails(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                            @endif
                                            <hr>
                                            <?php
                                                $i=$index+1;
                                                $length=count($data);

                                            ?>
                                            @if ($index+1>$length && $index+1<$length)
                                            <a id="remove_btn"  onclick="removeeDetails({{$i}})" class="btn btn-danger df"><i class="fa fa-times"></i></a>
                                            @else
                                            <a id="remove_btn"  onclick="removeDetails(this)" class="btn btn-danger df"><i class="fa fa-times"></i></a>
                                            @endif
                                            {{-- <a id="remove_btn"  onclick="removeDetails(this,{{$i}})" class="btn btn-danger df"><i class="fa fa-times"></i></a> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="card-footer" style="text-align: center">
                        <a  href="{{route('page_7_show')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save & Next</button>
                        <a href="{{route('page_9_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
                    </div>
                </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </div>
    @endif
    
        
        <!-- /.row -->
    <!-- /.content -->
<!-- /.content-wrapper -->
<!-- ./wrapper -->


</body>
</html>
@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/convert_nepali.js') }}"></script>
    <script>

        
    $('#decision_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

     $('#restoration_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

            $('.decision_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
            $('.restoration_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
        
        let row_body = document.querySelector("#row_body");
        
    
        var app = @json($data, JSON_PRETTY_PRINT);

        let length = app.length
        let j=length+1;
        let k=0;

    function addDetails(event) {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';
       let service= clone.querySelector(".service");
       let office_group=clone.querySelector(".office_group");
       let position=clone.querySelector('.position');
       let level=clone.querySelector('.level');
       let office_name_address=clone.querySelector('#office_name_address');
       let office_name_address_english=clone.querySelector('#office_name_address_english');
       let decision_date=clone.querySelector('.decision_date');
       let restoration_date=clone.querySelector('.restoration_date');
       let new_appoint=clone.querySelectorAll('.new_appoint');
       
       
       service.name = 'service['+j+']';

       office_group.name = 'office_group['+j+']';
       position.name = 'position['+j+']';
       level.name = 'level['+j+']';
       office_name_address.name = 'office_name_address['+j+']';
       office_name_address.value="";
       office_name_address_english.name = 'office_name_address_english['+j+']';
       office_name_address_english.value="";
       decision_date.name = 'decision_date['+j+']';
       decision_date.id = 'decisionDate'+j;
       decision_date.value="";
       restoration_date.name = 'restoration_date['+j+']';
       restoration_date.id = 'restoration_date'+j;
       restoration_date.value="";

       for (let index = 0; index < new_appoint.length; index++) {
            const element = new_appoint[index];
            element.setAttribute('name', 'new_appoint['+j+']');
        }

        row_body.appendChild(clone);
        // $("#row_body").appendChild(clone);
        j++;
        k++;

        $('.decision_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
            $('.restoration_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
    }

    
    function removeDetails(event) {
        console.log(event);
        let tr = event.closest('tr');
        let td = event.closest('td');
        var children = td.children;
        var is_hidden = true;
        let add_btn = td.querySelector("#add_btn");
        let remove_btn = td.querySelector("#remove_btn");
       
        tr.remove();
    }

    function removeeDetails(i)
    {
        console.log(i);
        $('.tableRow'+i).html('');
        // $('#addBtnId'+i-1).append('kjasndkj');
    }
    </script>

@endsection
