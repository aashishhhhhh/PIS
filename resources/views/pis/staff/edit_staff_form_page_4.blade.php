@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_faculty', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('new_staff', 'active')
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
            <section class="content-header">
                <h1 class="pull-left">भाषाको दक्षता सम्बन्धी विवरण
                </h1>
            </section>
            <form action="{{route('page_4_submit')}}" method="post">
                @csrf
                @isset($is_admin)
                <input type="hidden" name="is_admin" value="{{$is_admin}}">
                <input type="hidden" name="user_id" value="{{$user_id}}">
                @endisset
            <div class="card-body">
                <div class="col-md-6">
                    <strong>क) स्थानिय भाष सम्बन्धी ज्ञान</strong>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">मातृभाषा: <i class="reqq">*</i></span></div>
                        <select id="local_language" name="local_language" class="form-control select2">
                            @foreach ($languages as $key=> $item)
                                @if ($staffLanguage->local_language==$item->id)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                @endif
                            @endforeach
                            @foreach ($languages as$key=> $item)
                                @if ($staffLanguage->local_language!=$item->id)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                @endif
                            @endforeach
                    
                        </select>
                        @error('local_language')
                        <strong style="color: red">{{$message}}</strong>
                         @enderror
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td rowspan="2" style="text-align: center;">भाषाको नाम</td>
                        <td colspan="3" style="text-align: center;">लेखाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">पढाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">बोलाई क्षमता</td>
                        <td rowspan="2" span=""></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                    </tr>
                    </thead>
                    <tbody id="local_body">
                        @foreach ($local_data as $key=> $value)
                        {{-- @php
                        dd($value);
                        @endphp --}}
                       
                        <tr id="tl_1">
                            <td style="max-width: 200px;">
                                <select class="language" name="language[{{$key+1}}]" class="form-control select2">
                               @if (isset($value->language))
                               @foreach ($languages as $item)
                                @if ($value->language==$item->id)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                @endif
                                @endforeach

                                @foreach ($languages as $item)
                                @if ($value->language!=$item->id)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                @endif
                                @endforeach
                                   
                               @else
                               <option value="" data-eng="">चयन गर्नुहोस्</option>
                               @foreach ($languages as $item)
                                   <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                               @endforeach
                               @endif
                                     
                                </select>
                                @error('language')
                                <strong style="color: red">{{$message}}</strong>
                                 @enderror

                            </td>

                            @if (isset($value->writing))
                                @if ($value->writing==1)
                                <td>
                                    <input class="writing" type="radio" name="writing[{{$key+1}}]" value="1" checked>
                                </td>
                                <td>
                                    <input class="writing"  type="radio" name="writing[{{$key+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="writing"   type="radio" name="writing[{{$key+1}}]" value="3" >
                                </td>
                                @endif

                                @if ($value->writing==2)
                                <td>
                                    <input class="writing" type="radio" name="writing[{{$key+1}}]" value="1">
                                </td>
                                <td>
                                    <input class="writing"  type="radio" name="writing[{{$key+1}}]" value="2" checked>
                                </td>
                                <td>
                                    <input class="writing"   type="radio" name="writing[{{$key+1}}]" value="3" >
                                </td>
                                @endif

                                @if ($value->writing==3)
                                <td>
                                    <input class="writing" type="radio" name="writing[{{$key+1}}]" value="1">
                                </td>
                                <td>
                                    <input class="writing"  type="radio" name="writing[{{$key+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="writing"   type="radio" name="writing[{{$key+1}}]" value="3" checked>
                                </td>
                                @endif
                                
                                
                            @else
                                <td>
                                    <input class="writing" type="radio" name="writing[{{$key+1}}]" value="1" checked>
                                </td>
                                <td>
                                    <input class="writing"  type="radio" name="writing[{{$key+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="writing"   type="radio" name="writing[{{$key+1}}]" value="3" >
                                </td>
                            @endif
                            

                            @if (isset($value->reading))
                                @if ($value->reading==1)
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="1" checked>
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="3" >
                                </td>
                                @endif

                                @if ($value->reading==2)
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="1" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="2" checked>
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="3" >
                                </td>
                                @endif

                                @if ($value->reading==3)
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="1" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="3" checked>
                                </td>
                                @endif
                            @else
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="1" checked>
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading[{{$key+1}}]" value="3" >
                                </td>
                            @endif

                            @if (isset($value->speaking))

                                @if ($value->speaking==1)
                                <td>
                                    <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="1" checked>
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="3" >
                                </td>
                                @endif

                                @if ($value->speaking==2)
                                <td>
                                    <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="1" >
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="2" checked>
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="3" >
                                </td>
                                @endif

                                @if ($value->speaking==3)
                                <td>
                                    <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="1" >
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="3" checked>
                                </td>
                                @endif
                            @else

                           

                            @endif
                            <td>
                                @php
                                $length= count($local_data);
                             @endphp
                            @if ($key+1>=1 && $key+1>=$length)
                            <a id="add_foreign_btn" onclick="addLocal(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                            @endif
                                <a id="remove_local_btn"  onclick="removeLocal(this)" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach


                        <?php
                    ?>
                    </tbody>
                    <tfoot>
                    
                    </tfoot>
                </table>

                <div class="col-md-12">
                    <strong>ख) विदेशी भाषा सम्बन्धी ज्ञान</strong>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td rowspan="2" style="text-align: center;">भाषाको नाम</td>
                        <td colspan="3" style="text-align: center;">लेखाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">पढाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">बोलाई क्षमता</td>
                        <td rowspan="2" span=""></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                    </tr>
                    </thead>
                
                        
                    <tbody id="foreign_body">
                        @php
                        $i=0;
                    @endphp
                    @foreach ($foreign_data as $keyy => $value)

                    
                    @php
                    $i++;
                    @endphp
                        <tr>
                            <td style="max-width: 200px;">
                                <select class="language" name="language2[{{$keyy+1}}]" class="form-control select2">

                                    @if (isset($value->language))

                                        @foreach ($foreign_languages as $item)
                                            @if ($item->id==$value->language)
                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                            @endif
                                        @endforeach

                                        @foreach ($foreign_languages as $item)
                                            @if ($item->id!=$value->language)
                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                        
                                    @else
                                        <option value="" data-eng="">चयन गर्नुहोस्</option>
                                        @foreach ($foreign_languages as $item)
                                                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                        @endforeach
                                    @endif


                                </select>
                            </td>

                            @if (isset($value->writing))
                                @if ($value->writing==1)
                                    <td>
                                        <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="1" checked>
                                    </td>   
                                    <td>
                                        <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="2" >
                                    </td>
                                    <td>
                                        <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="3" >
                                    </td>
                                @endif

                                @if ($value->writing==2)
                                <td>
                                    <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="1" >
                                </td>   
                                <td>
                                    <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="2" checked>
                                </td>
                                <td>
                                    <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="3" >
                                </td>
                             @endif

                            @if ($value->writing==3)
                                <td>
                                    <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="1" >
                                </td>   
                                <td>
                                    <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="3" checked>
                                </td>
                            @endif
                                
                            @else
                                <td>
                                    <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="1" checked>
                                </td>   
                                <td>
                                    <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="writing" type="radio" name="writing2[{{$keyy+1}}]" value="3" >
                                </td>
                            @endif

                            @if (isset($value->reading))

                                @if ($value->reading==1)
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="1" checked>
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="3" >
                                </td>
                                    
                                @endif

                                @if ($value->reading==2)
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="1" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="2" checked>
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="3" >
                                </td>
                                    
                                @endif

                                @if ($value->reading==3)
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="1" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="3" checked>
                                </td>
                                    
                                @endif
                            
                            @else
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="1" checked>
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="reading" type="radio" name="reading2[{{$keyy+1}}]" value="3" >
                                </td>
                            @endif

                            @if (isset($value->speaking))

                                @if ($value->speaking==1)
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="1" checked>
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="3" >
                                </td>
                                @endif

                                @if ($value->speaking==2)
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="1" >
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="2" checked>
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="3" >
                                </td>
                                @endif

                                @if ($value->speaking==3)
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="1" >
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="3" checked>
                                @endif
                           
                            @else
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="1" checked>
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="2" >
                                </td>
                                <td>
                                    <input class="speaking" type="radio" name="speaking2[{{$keyy+1}}]" value="3" >
                                </td>
                            @endif

                            <td>
                                <td>
                                    @php
                                    $length= count($foreign_data);
                                 @endphp
                                @if ($keyy+1>=1 && $keyy+1>=$length)
                                <a id="add_foreign_btn" onclick="addForeign(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                @endif
                                <a id="remove_foreign_btn"  onclick="removeForeign(this)" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>   
                    @endforeach
                    </tbody>


                    <tfoot>
                    <tr>
                        <td colspan="10">
                        
                        </td>
                    </tr>
                    </tfoot>
                </table>
                

            </div>
           <div class="card-footer" style="text-align: center">
                <a  href="{{route('page_3_show')}}" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save & Next</button>
                <a href="{{route('page_5_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
            </div>
        </form>

        </div>


@endsection

@section('scripts')
<script>
        
</script>
<script>
    let foreign_body = document.querySelector("#foreign_body");
  
    var app = @json($foreign_data, JSON_PRETTY_PRINT);
    var local = @json($local_data, JSON_PRETTY_PRINT);
    let localLength = local.length
    let length = app.length
    let j=length+1;
    let k=localLength+1;
    function addForeign(event) {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

        let language=clone.querySelectorAll(".language");
        let writing = clone.querySelectorAll(".writing");
        let reading = clone.querySelectorAll(".reading");
        let speaking = clone.querySelectorAll(".speaking");

        for (let index = 0; index < language.length; index++) {
            const element = language[index];
            element.setAttribute('name', 'language2['+j+']');
            let name= element.getAttribute('name');
            // var inputVal = document.getElementsByName(name).value;
            // console.log(inputVal);
           
        }

        for (let index = 0; index < writing.length; index++) {
            const element = writing[index];
            element.setAttribute('name', 'writing2['+j+']');
            element.checked=true;
        }
        for (let index = 0; index < reading.length; index++) {
            const element = reading[index];
            element.setAttribute('name', 'reading2['+j+']');
            element.checked=true;
        }
        for (let index = 0; index < speaking.length; index++) {
            const element = speaking[index];
            element.setAttribute('name', 'speaking2['+j+']');
            element.checked=true;
        }
        foreign_body.appendChild(clone);
        j++;
    }

    function removeForeign(event) {
        let tr = event.closest('tr');
        let td = event.closest('td');
        var children = td.children;
        var is_hidden = true;

        let add_btn = td.querySelector("#add_foreign_btn");
        let remove_btn = td.querySelector("#remove_foreign_btn");
      
        tr.remove();
    }

   
</script>
<script>
     let local_body = document.querySelector("#local_body");
  
    function addLocal(event)
    {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

        let language=clone.querySelectorAll(".language");
        let writing = clone.querySelectorAll(".writing");
        let reading = clone.querySelectorAll(".reading");
        let speaking = clone.querySelectorAll(".speaking");

        for (let index = 0; index < language.length; index++) {
            const element = language[index];
            element.setAttribute('name', 'language['+k+']');
        }

        for (let index = 0; index < writing.length; index++) {
            const element = writing[index];
            element.setAttribute('name', 'writing['+k+']');
        }
        for (let index = 0; index < reading.length; index++) {
            const element = reading[index];
            element.setAttribute('name', 'reading['+k+']');
        }
        for (let index = 0; index < speaking.length; index++) {
            const element = speaking[index];
            element.setAttribute('name', 'speaking['+k+']');
        }
        local_body.appendChild(clone);
        k++;
    }

    function removeLocal(event)
    {
        let tr = event.closest('tr');
        let td = event.closest('td');
        var children = td.children;
        var is_hidden = true;

        let add_btn = td.querySelector("#add_local_btn");
        let remove_btn = td.querySelector("#remove_local_btn");
       
        tr.remove();
    }
</script>
   
@endsection
