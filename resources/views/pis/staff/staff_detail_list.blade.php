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
        @if (session()->has('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session('msg')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card-header">
            <h3>कर्मचारी विवरण सूची
            </h3>
        </div>

        <div class="card-body">
                <div class="container">
                    <div class="row">
                       <div class="col-md-2">
                        <a href="{{route('view-form1',$user->id)}}" class="btn btn-light" >कर्मचारीको पूरा नाम र थर</a>
                       </div>
                       <div class="col-md-2">
                        <a href="{{route('view-form2',$user->id)}}" class="btn btn-light">ठेगाना सम्बन्धी विवरण</a>
                       </div><div class="col-md-2">
                        <a href="{{route('view-form3',$user->id)}}" class="btn btn-light">अन्य वैयक्तिक विवरण</a>
                       </div ><div class="col-md-2">
                        <a href="{{route('view-form4',$user->id)}}" class="btn btn-light">भाषाको दक्षता सम्बन्धी विवरण</a>
                       </div><div class="col-md-2">
                        <a href="{{route('view-form5',$user->id)}}" class="btn btn-light">कर्मचारीको शुरु स्थायी नियुक्तिको विवरण</a>
                       </div>
                        <div class="col-md-2">
                        <a href="{{route('view-form6',$user->id)}}" class="btn btn-light">काम गरेको भए सोको विवरण</a>
                       </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-2">
                            <a href="{{route('view-form7',$user->id)}}" class="btn btn-light">अन्य विवरण</a>
                        </div>

                        <div class="col-md-2">
                            <a href="{{route('view_form8',$user->id)}}" class="btn btn-light">सेवा सम्बन्धी विवरण</a>
                        </div>

                        <div class="col-md-2">
                            <a href="{{route('view_form9',$user->id)}}" class="btn btn-light"> शैक्षिक योग्यता</a>
                        </div>

                        <div class="col-md-2">
                            <a href="{{route('view_form10',$user->id)}}" class="btn btn-light"> तालिम / सेमिनार / सम्मेलन सम्ब्धी विवरण</a>
                        </div>

                        <div class="col-md-2">
                            <a href="{{route('view_form11',$user->id)}}" class="btn btn-light"> विभूषण, प्रशंसा पत्र र पुरस्कारको विवरण</a>
                        </div>

                        <div class="col-md-2">
                            <a href="{{route('view_form12',$user->id)}}" class="btn btn-light"> विभागीय सजायको विवरण
                            </a>
                        </div>

                        <div class="col-md-2">
                            <a href="{{route('view_form13',$user->id)}}" class="btn btn-light"> बिदा र औषधी उपचारको विवरण
                            </a>
                        </div>

                        <div class="col-md-2">
                            <a href="{{route('view_form14',$user->id)}}" class="btn btn-light"> वर्गीकृत क्षेत्रहरुमा काम गरेको विवरण
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @isset($staff_form1)
        
    <div class="card">
        <div class="card-body">
            <div class="box box-primary" style="margin-top: auto;">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        १. निजामती कर्मचारीको पूरा नाम र थर</h3>
                    {{-- <a class="pull-right btn btn-info" id="print" onclick="printdiv('print_content1)"> <i class="fa fa-print"></i>
                    </a> --}}

                    <a href="{{route('edit-form1',$staff_form1->user_id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                        <i class="fa fa-edit"></i>
                        <span class="wtooltiptext">एडिट</span>
                    </a>
                </div>
                <div class="box-body">
                    <div id="print_content1">

                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="first_tab line-group">
                                            <div class="line-group-addon ">
                                                कर्मचारी संकेत नम्बर
                                            </div>
                                            <input class="line-control" value="{{nepali($staff_form1->s_no)}}">
                                        </div>
                                    </td>
                                </tr>    

                                <tr>
                                    <td>
                                        <div class="first_tab line-group">
                                            <div class="line-group-addon ">
                                                पान नम्बर
                                            </div>
                                            <input class="line-control" value="{{nepali($staff_form1->pyan_no)}}">
                                        </div>
                                    </td>
                                </tr>    
                                <tr>
                                    <td>
                                        <div class="first_tab line-group">
                                            <div class="line-group-addon ">
                                                पान नम्बर
                                            </div>
                                            <input class="line-control" value="{{nepali($staff_form1->pyan_no)}}">
                                        </div>
                                    </td>
                                </tr>    
                                <tr>
                                    <td>
                                        <div class="first_tab line-group">
                                            <div class="line-group-addon ">
                                                संस्था दर्ता नम्बर
                                            </div>
                                            <input class="line-control" value="{{nepali($staff_form1->sanstha_darta_no)}}">
                                        </div>
                                    </td>
                                </tr>    
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon ">
                                            नेपालीमा ( देदनागरी लिपी)
                                        </div>
                                        <input class="line-control" value="{{$staff_form1->nep_name}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon ">
                                            अंग्रेजीमा (BLOCK LETTER)
                                        </div>
                                        <input class="line-control" value="{{$staff_form1->name}}">
                                    </div>
                                </td>
                            </tr>
                            {{-- @dd($staff_form1) --}}
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                            जन्म मिति विवरण: (बि.सं.)
                                        </div>
                                        <input class="line-control nepNum width80" value="{{nepali($staff_form1->dob)}}">
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            ई.सं.
                                        </div>
                                        <input class="line-control myfont" value="{{nepali($staff_form1->dob)}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                            नगरीकता नं.
                                        </div>
                                        <input class="line-control nepNum width80" value="{{nepali($staff_form1->cs_no)}}">
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            जारी जिल्ला
                                        </div>
                                        @foreach ($districts as $item)
                                        @if (isset($staff_form1->cs_district))
                                            @if ($item->id==$staff_form1->cs_district)
                                                <input class="line-control myfont" value="{{ $item->nep_name}}">
                                            @endif       
                                        @else
                                            <input class="line-control myfont" value="">
                                        @endif
    
                                    @endforeach                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            जारी मिति
                                        </div>
                                        <input class="line-control myfont" value="{{nepali( isset($staff_form1->cs_issue) ? $staff_form1->cs_issue: '')}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                            बाबुको नाम (नेपालीमा)
                                        </div>
                                        <input class="line-control nepNum width80" value="{{$staff_form1->father_nep_name}}">
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            पेशा
                                        </div>
                                        @if (isset($staff_form1->father_occupation))
                                        @foreach ($occupations as $item)
                                            @if ($item->id == $staff_form1->father_occupation)
                                                 <input class="line-control myfont" value="{{$item->name}}">
                                            @endif
                                        @endforeach
                                        @else
                                        <input class="line-control myfont" value="">
                                        @endif                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon">
                                            बाबुको नाम (अंग्रेजीमा)
                                        </div>
                                        <input class="line-control" value="{{$staff_form1->father_name}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                            बाजेको नाम (नेपालीमा)
                                        </div>
                                        <input class="line-control nepNum width80" value="{{isset($staff_form1->g_father_nep_name) ? $staff_form1->g_father_nep_name : ''}}">
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            पेशा
                                        </div>
                                        @if (isset($staff_form1->g_father_occupation))
                                        @foreach ($occupations as $item)
                                        @if ($item->id == $staff_form1->g_father_occupation)
                                            <input class="line-control myfont" value="{{$item->name}}">
                                        @endif
                                    @endforeach
                            @else
                            <input class="line-control myfont" value="">
                            @endif                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon ">
                                            बाजेको नाम (अंग्रेजीमा)
                                        </div>
                                        <input class="line-control" value="{{isset($staff_form1->g_father_name) ? $staff_form1->g_father_name : ''}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                            आमाको नाम (नेपालीमा)
                                        </div>
                                        <input class="line-control nepNum width80" value="{{isset($staff_form1->mother_nep_name) ? $staff_form1->mother_nep_name : ''}}">
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            पेशा
                                        </div>
                                        <input class="line-control myfont" value="कृषी">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon ">
                                            आमाको नाम (अंग्रेजीमा)
                                        </div>
                                        <input class="line-control" value="{{isset($staff_form1->mother_name) ? $staff_form1->mother_name : ''}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                            विवाहित भए पति/पत्नीको नाम (नेपालीमा)
                                        </div>
                                        <input class="line-control nepNum width80" value="{{isset($staff_form1->spouse_nep_name) ? $staff_form1->spouse_nep_name : ''}}">
                                         <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            पेशा
                                        </div>
                                        <input class="line-control myfont" value="{{isset($staff_form1->spouse_nep_name) ? $staff_form1->spouse_nep_name : ''}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon ">
                                            (अंग्रेजीमा)
                                        </div>
                                        <input class="line-control" value="{{isset($staff_form1->spouse_name) ? $staff_form1->spouse_name : ''}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                            छोरीको खंख्या
                                        </div>
                                        <input class="line-control nepNum width80" value="{{isset($staff_form1->daughters_no) ? $staff_form1->daughters_no : ''}}">
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            छोराको संख्या
                                        </div>
                                        <input class="line-control myfont" value="{{isset($staff_form1->sons_no) ? $staff_form1->sons_no : '' }}">
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                         कर्मचारीको प्रकार
                                        </div>
                                        
                                        @if (isset($staff_form1->category_id))
                                            @foreach ($staff_categories as $item)
                                                @if ($item->id==$staff_form1->category_id)
                                                    <input class="line-control nepNum width80" value="{{$item->name}}">
                                                @endif
                                            @endforeach
                                            @else
                                                <input class="line-control nepNum width80" value="">
                                            @endif                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                          कर्मचारीको सह प्रकार
                                        </div>
                                        @if (isset($staff_form1->sub_category_id))
                                            @foreach ($staff_sub_cat as $item)
                                                @if ($item->id==$staff_form1->sub_category_id)
                                                    <input class="line-control nepNum width80" value="{{$item->name}}">
                                                @endif
                                            @endforeach
                                            @else
                                                <input class="line-control nepNum width80" value="">
                                            @endif                                       </div>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset

    @isset($staff_form2)
        <div class="card">
            <div class="card-body">
                <div class="box box-primary" style="margin-top: auto;">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            २. ठेगाना सम्बन्धी विवरण </h3>
                        {{-- <a class="pull-right btn btn-info" id="print" onclick="printdiv('print_content2')"> <i class="fa fa-print"></i> --}}
                        </a>
                        <a href="{{route('edit-form2',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                            <i class="fa fa-edit"></i>
                            <span class="wtooltiptext">एडिट</span>
                        </a>
                    </div>
                    <div class="box-body">
                        <div id="print_content2">
                            <table class="table table_bordered ">
                                <thead>
                                <tr>
                                    <td colspan="3" style="text-align:center"> स्थायी ठेगाना </td>
                                    <td colspan="2" style="text-align:center"> अस्थायी ठेगाना </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td style="text-align:center"> नेपालीमा </td>
                                    <td style="text-align:center"> अंग्रेजीमा </td>
                                    <td style="text-align:center"> नेपालीमा </td>
                                    <td style="text-align:center"> अंग्रेजीमा </td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> प्रदेश </td>
                                    <td>
                                        @if (isset($staff_form2->p_province))
                                        @foreach ($provinces as $item)
                                           @if ($item->id==$staff_form2->p_province)
                                               {{$item->nep_name}}
                                           @endif
                                        @endforeach
                                    @endif
                                    </td>
                                    <td>
                                        @if (isset($staff_form2->p_province))
                                        @foreach ($provinces as $item)
                                           @if ($item->id==$staff_form2->p_province)
                                               {{$item->name}}
                                           @endif
                                        @endforeach
                                    @endif    
                                    </td>
                                        <td>
                                            @if (isset($staff_form2->t_province))
                                            @foreach ($provinces as $item)
                                               @if ($item->id==$staff_form2->t_province)
                                                   {{$item->nep_name}}
                                               @endif
                                            @endforeach
                                            @endif    
                                    </td>
                                    <td> 
                                        @if (isset($staff_form2->t_province))
                                        @foreach ($provinces as $item)
                                           @if ($item->id==$staff_form2->t_province)
                                               {{$item->name}}
                                           @endif
                                        @endforeach
                                    @endif        
                                    </td>
                                </tr>
                                <tr>
                                    <td> जिल्ला </td>
                                    <td>
                                        @if (isset($staff_form2->p_district))
                                        @foreach ($districts as $item)
                                            @if ($item->id==$staff_form2->p_district)
                                                {{$item->nep_name}}
                                            @endif
                                        @endforeach
                                    @endif
                                    </td>
                                    <td>
                                        @if (isset($staff_form2->p_district))
                                        @foreach ($districts as $item)
                                            @if ($item->id==$staff_form2->p_district)
                                                {{$item->name}}
                                            @endif
                                        @endforeach
                                    @endif        
                                    </td>
                                    <td> 
                                        @if (isset($staff_form2->t_district))
                                        @foreach ($districts as $item)
                                            @if ($item->id==$staff_form2->t_district)
                                                {{$item->nep_name}}
                                            @endif
                                        @endforeach
                                    @endif      
                                    </td>
                                    <td> 
                                        @if (isset($staff_form2->t_district))
                                        @foreach ($districts as $item)
                                            @if ($item->id==$staff_form2->t_district)
                                                {{$item->name}}
                                            @endif
                                        @endforeach
                                    @endif        
                                    </td>
                                </tr>
                                                                                <tr>
                                    <td> न.पा. / गा.वि.स </td>
                                    <td> 
                                        @if (isset($staff_form2->p_municipality))
                                        @foreach ($municipalities as $item)
                                           @if ($item->id == $staff_form2->p_municipality)
                                               {{$item->nep_name}}
                                           @endif
                                        @endforeach
                                    @endif    
                                    </td>
                                    <td> 
                                        @if (isset($staff_form2->p_municipality))
                                        @foreach ($municipalities as $item)
                                           @if ($item->id == $staff_form2->p_municipality)
                                               {{$item->name}}
                                           @endif
                                        @endforeach
                                    @endif    
                                    </td>
                                    <td> 
                                        @if (isset($staff_form2->t_municipality))
                                        @foreach ($municipalities as $item)
                                           @if ($item->id == $staff_form2->t_municipality)
                                               {{$item->nep_name}}
                                           @endif
                                        @endforeach
                                    @endif    
                                    </td>
                                    <td> 
                                        @if (isset($staff_form2->t_municipality))
                                        @foreach ($municipalities as $item)
                                           @if ($item->id == $staff_form2->t_municipality)
                                               {{$item->name}}
                                           @endif
                                        @endforeach
                                    @endif    
                                    </td>
                                </tr>
                                <tr>
                                    <td> वडा नं. </td>
                                    <td> {{nepali(isset($staff_form2->p_ward) ? $staff_form2->p_ward : '')}} </td>
                                    <td> {{isset($staff_form2->p_ward) ? $staff_form2->p_ward : ''}} </td>
                                    <td> {{nepali(isset($staff_form2->t_ward) ? $staff_form2->t_ward : '')}} </td>
                                    <td> {{isset($staff_form2->t_ward) ? $staff_form2->t_ward : ''}} </td>
                                </tr>
                                <tr>
                                    <td> टोल / मार्ग </td>
                                    <td>{{isset($staff_form2->p_tole_nep) ? $staff_form2->p_tole_nep : ''}}  </td>
                                    <td> {{isset($staff_form2->p_tole) ? $staff_form2->p_tole : ''}} </td>
                                    <td> {{isset($staff_form2->t_tole_nep) ? $staff_form2->t_tole_nep : ''}} </td>
                                    <td> {{isset($staff_form2->t_tole) ? $staff_form2->t_tole : ''}} </td>
                                </tr>
                                <tr>
                                    <td> घर / ब्लक नं. </td>
                                    <td> {{isset($staff_form2->p_house_no_nep) ? $staff_form2->p_house_no_nep : ''}} </td>
                                    <td> {{isset($staff_form2->p_house_no) ? $staff_form2->p_house_no : ''}} </td>
                                    <td>  {{isset($staff_form2->t_house_no_nep) ? $staff_form2->t_house_no_nep : ''}}</td>
                                    <td> {{isset($staff_form2->t_house_no) ? $staff_form2->t_house_no : ''}} </td>
                                </tr>
                                <tr>
                                    <td> सम्पर्क / फोन मो.नं. </td>
                                    <td colspan="2"> {{isset($staff_form2->p_contact) ? $staff_form2->p_contact : ''}} </td>
                                    <td colspan="2">  {{isset($staff_form2->t_contact) ? $staff_form2->t_contact : ''}}</td>
                                </tr>
                                <tr>
                                    <td> ईमेल ठेगाना </td>
                                    <td colspan="4"> {{isset($staff_form2->email) ? $staff_form2->email : ''}} </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    @endisset

    @isset($staff_form3)
        <div class="card">
            <div class="box box-primary" style="margin-top: auto;">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        ३. अन्य वैयक्तिक विवरण</h3>
                    {{-- <a class="pull-right btn btn-info" id="print" onclick="printdiv('print_content3')"> <i class="fa fa-print"></i> --}}
                    </a>
                    <a href="{{route('edit-form3',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                        <i class="fa fa-edit"></i>
                        <span class="wtooltiptext">एडिट</span>
                    </a>
                </div>

                <div class="box-body">
                    <div id="print_content3">
                     <table style="width:100%;">
                            <tbody><tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                            लिंग
                                        </div>
                                        @if (isset($staff_form3->gender))
                                        @foreach ($genders as $key=> $item)
                                            @if ($staff_form3->gender==$key)
                                                <input class="line-control nepNum width80" value="{{$item}}">
                                            @endif
                                            @endforeach
                                            @else
                                                <input class="line-control nepNum width80" value="">
                                            @endif                                                                                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            धर्म
                                        </div>
                                        @if (isset($staff_form3->religion))
                                        @foreach ($religions as $item)
                                            @if ($staff_form3->religion==$item->id)
                                                <input class="line-control myfont" value="{{$item->name}}">
                                            @endif
                                        @endforeach
                                            @else
                                                <input class="line-control myfont" value="">
                                            @endif
                                           <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            जातजाती
                                        </div>
                                        @if (isset($staff_form3->ethnicity))
                                        @foreach ($ethnicities as $item)
                                            @if ($user->staff_form3==$item->id)
                                                <input class="line-control myfont" value="{{$item->name}}">
                                            @endif
                                        @endforeach
                                        @else
                                            <input class="line-control myfont" value="">
                                        @endif                                        
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            हुलिया
                                        </div>
                                        @if (isset($staff_form3->face))
                                        @foreach ($faces as $item)
                                            @if ($staff_form3->face==$item->id)
                                                <input class="line-control myfont" value="{{$item->name}}">
                                            @endif
                                        @endforeach
                                        @else
                                            <input class="line-control myfont" value="">
                                        @endif                                                                                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            रक्त कमूह
                                        </div>
                                        @if (isset($staff_form3->blood_group))
                                        @foreach ($bgroups as $item)
                                            @if ($staff_form3->blood_group==$item->id)
                                                <input class="line-control myfont" value="{{$item->name}}">
                                            @endif
                                        @endforeach
                                        @else
                                            <input class="line-control myfont" value="">
                                        @endif                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont" style="text-align: left;"> मुल :</div>
                                        @if ($staff_form3->source==1)
                                            <div class="line-group-addon myfont"><i class="fas fa-check"></i>  हिमाली </div>
                                            <div class="line-group-addon myfont">  पहाडी </div>
                                            <div class="line-group-addon myfont"> तराई/मधेश </div>
                                        @endif

                                        @if ($staff_form3->source==2)
                                            <div class="line-group-addon myfont">  हिमाली </div>
                                            <div class="line-group-addon myfont"><i class="fas fa-check"></i>  पहाडी </div>
                                            <div class="line-group-addon myfont"> तराई/मधेश </div>
                                        @endif

                                        @if ($staff_form3->source==3)
                                            <div class="line-group-addon myfont">  हिमाली </div>
                                            <div class="line-group-addon myfont">  पहाडी </div>
                                            <div class="line-group-addon myfont"><i class="fas fa-check"></i> तराई/मधेश </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont" style="text-align: left;"> क) आदिवासी जनजाती :</div>
                                        @if ($staff_form3->janjati==1)
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                         <div class="line-group-addon myfont">  होइन </div>
                                        @else
                                            <div class="line-group-addon myfont"> हो </div>
                                            <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                                        @endif
                                            हो भने कुन जात
                                        </div>
                                        <input class="line-control myfont" value="{{isset($staff_form3->janjati_other) ? $staff_form3->janjati_other : ''}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont" style="text-align: left;"> ख) मधेशी :</div>
                                        @if ($staff_form3->madesi==1)
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                        <div class="line-group-addon myfont">  होइन </div>
                                    @else
                                        <div class="line-group-addon myfont"> हो </div>
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                                    @endif
    
                                     <div class="line-group-addon myfont" style="padding-left: 30px;">
                                        हो भने विवरण
                                    </div>
                                    <input class="line-control myfont" value="{{isset($staff_form3->madesi_other) ? $staff_form3->madesi_other : ''}}">
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont" style="text-align: left;"> ग) दलिती :</div>
                                        @if ($staff_form3->dalit==1)
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                        <div class="line-group-addon myfont">  होइन </div>
                                    @else
                                        <div class="line-group-addon myfont"> हो </div>
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                                    @endif
                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                        हो भने कुन जात
                                    </div>
                                    <input class="line-control myfont" value="{{isset($staff_form3->dalit_other) ? $staff_form3->dalit_other : ''}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont" style="text-align: left;"> घ) पिछडिएको जिल्ला(क्षेत्र) :</div>
                                        @if ($staff_form3->low==1)
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                        <div class="line-group-addon myfont">  होइन </div>
                                    @else
                                        <div class="line-group-addon myfont"> हो </div>
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                                    @endif
                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            हो भने कुन जिल्ला
                                        </div>
                                        <input class="line-control myfont" value="{{isset($staff_form3->low_other) ? $staff_form3->low_other : ''}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont" style="text-align: left;"> ङ) अपांगता :</div>
                                        @if ($staff_form3->dsiable==1)
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                        <div class="line-group-addon myfont">  होइन </div>
                                    @else
                                        <div class="line-group-addon myfont"> हो </div>
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                                    @endif
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                            हो भने कुन किसिमको
                                        </div>
                                        <input class="line-control myfont" value="{{isset($staff_form3->disable_other) ? $staff_form3->disable_other : ''}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont" style="text-align: left;"> लोक सेवा आयोगको सिफारिश हुँदा कुन वर्गमा भएको हो ? </div>

                                        @if ($staff_form3->is_division==1)
                                        <input class="line-control myfont" value="क">
                                    @endif
                                    @if ($staff_form3->is_division==2)
                                        <input class="line-control myfont" value="ख">
                                    @endif
                                    @if ($staff_form3->is_division==3)
                                        <input class="line-control myfont" value="ग">
                                    @endif
                                    @if ($staff_form3->is_division==4)
                                    <input class="line-control myfont" value="घ">
                                    @endif
                                    @if ($staff_form3->is_division==5)
                                    <input class="line-control myfont" value="ङ">
                                    @endif
                                    @if ($staff_form3->is_division==6)
                                    <input class="line-control myfont" value="खुला">
                                    @endif
                                    @if ($staff_form3->is_division==7)
                                    <input class="line-control myfont" value="महिला">
                                    @endif                                    
                                </div>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>

        </div>
        </div>
    @endisset

    @isset($staff_form4)
        <div class="card">
            <div class="box box-primary" style="margin-top: auto;">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        ४. भाषाको दक्षता सम्बन्धी विवरण</h3>
                    {{-- <a class="pull-right btn btn-info" id="print" onclick="printdiv('print_content4')"> <i class="fa fa-print"></i> --}}
                    </a>
                    <a href="{{route('edit-form4',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                        <i class="fa fa-edit"></i>
                        <span class="wtooltiptext">एडिट</span>
                    </a>
                </div>
                <div class="box-body">
                    <div id="print_content4">
                    <div> <b style="padding-left:25px;">मातृभाषा <input class="line-control myfont" value="{{$staffLanguage->languages->name}}"></b> </div>
                        <table class="table table_bordered table-bordered">
                            <thead>
                            <tr>
                                <td rowspan="2"> क्र सं </td>
                                <td rowspan="2"> भाषाको नाम </td>
                                <td colspan="3"> लेखाइ क्षमता</td>
                                <td colspan="3"> पढाई क्षमता  </td>
                                <td colspan="3"> बोलाई क्षमता  </td>
                            </tr>
                            <tr>
                                <td> अति उत्तम </td>
                                <td> उत्तम </td>
                                <td> सामान्य </td>
                                <td> अति उत्तम </td>
                                <td> उत्तम </td>
                                <td> सामान्य </td>
                                <td> अति उत्तम </td>
                                <td> उत्तम </td>
                                <td> सामान्य </td>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach ($local_data as $key=> $item)
                                    <tr>
                                        <td>{{nepali($key+1)}}</td>
                                        <td>{{$item->languages->name}}</td>
                                            <td>@if ($item->writing==1)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->writing==2)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->writing==3)<i class="fa fa-check">@endif</i></td>
    
                                            <td>@if ($item->reading==1)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->reading==2)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->reading==3)<i class="fa fa-check">@endif</i></td>
    
                                            <td>@if ($item->speaking==1)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->speaking==2)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->speaking==3)<i class="fa fa-check">@endif</i></td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <b style="padding-left:25px;">   विदेशी भाषा सम्बन्धी ज्ञान  </b>
                        <table class="table table_bordered table-bordered">
                            <thead>
                            <tr>
                                <td rowspan="2"> क्र सं </td>
                                <td rowspan="2"> भाषाको नाम </td>
                                <td colspan="3"> लेखाइ क्षमता</td>
                                <td colspan="3"> पढाई क्षमता  </td>
                                <td colspan="3"> बोलाई क्षमता  </td>
                            </tr>
                            <tr>
                                <td> अति उत्तम </td>
                                <td> उत्तम </td>
                                <td> सामान्य </td>
                                <td> अति उत्तम </td>
                                <td> उत्तम </td>
                                <td> सामान्य </td>
                                <td> अति उत्तम </td>
                                <td> उत्तम </td>
                                <td> सामान्य </td>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($foreign_data as $key=> $item)
                                    <tr>
                                        <td>{{nepali($key+1)}}</td>
                                        <td>{{$item->languages->name}}</td>
                                            <td>@if ($item->writing==1)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->writing==2)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->writing==3)<i class="fa fa-check">@endif</i></td>
    
                                            <td>@if ($item->reading==1)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->reading==2)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->reading==3)<i class="fa fa-check">@endif</i></td>
    
                                            <td>@if ($item->speaking==1)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->speaking==2)<i class="fa fa-check">@endif</i></td>
                                            <td>@if ($item->speaking==3)<i class="fa fa-check">@endif</i></td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    @endisset
    @isset($staff_form5)
    <div class="card">
        <div class="card-body">
            <b> ५. कर्मचारीको शुरु स्थायी नियुक्तिको विवरण </b>
            <a href="{{route('edit-form5',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                <i class="fa fa-edit"></i>
                <span class="wtooltiptext">एडिट</span>
            </a>
            <table style="width:100%;">
                <tbody><tr>
                    <td>
                        <div class="first_tab line-group">
                            <div class="line-group-addon ">
                                कर्यालयको नाम र ठेगाना :
                            </div>
                            <input class="line-control" value="{{isset($staff_form5->office_name_address) ? $staff_form5->office_name_address : ''}}">
                        </div>
                    </td>
                </tr>
                <tr>    
                    <td>
                        <div class="first_tab line-group">
                            <div class="line-group-addon ">
                                नियुक्ति मिति :
                            </div>
                            <input class="line-control" value="{{nepali(isset($staff_form5->appoint_date) ? $staff_form5->appoint_date : '')}}">
                            <div class="line-group-addon ">
                                निर्णय मिति :
                            </div>
                            <input class="line-control" value="{{nepali(isset($staff_form5->decision_date) ? $staff_form5->decision_date : '')}}">
                            <div class="line-group-addon ">
                                हजिरी मिति :
                            </div>
                            <input class="line-control" value="{{nepali(isset($staff_form5->attend_date) ? $staff_form5->attend_date : '')}}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="first_tab line-group">
                            <div class="line-group-addon ">
                                सेवा :
                            </div>
                            <input class="line-control" value="{{isset($staff_form5->services->name) ? $staff_form5->services->name : ''}}">
                            <div class="line-group-addon ">
                                समुह  :
                            </div>
                            <input class="line-control" value="{{isset($staff_form5->officeGroups->name) ? $staff_form5->officeGroups->name : ''}}">
                            <div class="line-group-addon ">
                                उप-समुह :
                            </div>
                            <input class="line-control" value="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="first_tab line-group">
                            <div class="line-group-addon ">
                                श्रेणी/तह :
                            </div>
                            <input class="line-control" value="{{isset($staff_form5->levels->name) ? $staff_form5->levels->name : ''}}">
                                <div class="line-group-addon ">
                                पद :
                            </div>
                            <input class="line-control" value="{{isset($staff_form5->positions->name) ? $staff_form5->positions->name : ''}}">
                            <div class="line-group-addon myfont">@if($staff_form5->technical==1) <i class="fa fa-check"></i> @endif प्राविधिक </div>
                            <div class="line-group-addon myfont">@if($staff_form5->technical==0) <i class="fa fa-check"></i> @endif अप्राविधिक </div>
                        </div>
                    </td>
                </tr>
            </tbody></table>
        </div>
    </div>
    @endisset

    @isset($staff_form6)
        <div class="card">
            <div class="card-body">
                <div>
                    <b> ६. यस अघि सरकारी सेवामा रही स्थायी पदमा काम गरेको भए सोको विवरण</b>
                    <a href="{{route('edit-form6',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                        <i class="fa fa-edit"></i>
                        <span class="wtooltiptext">एडिट</span>
                    </a>
                    <table style="width:100%;">
                        <tbody><tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon ">
                                        कर्यालयको नाम र ठेगाना :
                                    </div>
                                    <input class="line-control" value="{{isset($staff_form6->office_name_address) ? $staff_form6->office_name_address : ''}}">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon ">
                                        सेवा :
                                    </div>
                                    <input class="line-control" value="{{isset($staff_form6->services->name) ? $staff_form6->services->name : ''}}">
                                    <div class="line-group-addon ">
                                        समुह  :
                                    </div>
                                    <input class="line-control" value="{{isset($staff_form6->officeGroups->name) ? $staff_form6->officeGroups->name : '' }}">
                                    <div class="line-group-addon ">
                                        उप-समुह :
                                    </div>
                                    <input class="line-control" value="{{isset($staff_form6->officeSubGroups->name) ? $staff_form6->officeSubGroups->name : '' }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon ">
                                        श्रेणी/तह :
                                    </div>
                                    <input class="line-control" value="{{isset($staff_form6->levels->name) ? $staff_form6->levels->name : '' }}">
                                    <div class="line-group-addon ">
                                        पद :
                                    </div>
                                    <input class="line-control" value="{{isset($staff_form6->positions->name) ? $staff_form6->positions->name : '' }}">
                                    <div class="line-group-addon myfont">@if($staff_form6->technical==1) <i class="fa fa-check"></i> @endif प्राविधिक </div>
                                    <div class="line-group-addon myfont">@if($staff_form6->technical==0) <i class="fa fa-check"></i> @endif अप्राविधिक </div>
                                    </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon ">
                                        छाडेको मिति:
                                    </div>
                                    <input class="line-control" value="{{nepali(isset($staff_form6->leave_date) ? $staff_form6->leave_date : '' )}}">
                                    <div class="line-group-addon ">
                                        छाड्नुको कारण :
                                    </div>
                                    <input class="line-control" value="{{nepali(isset($staff_form6->leave_reason) ? $staff_form6->leave_reason : '' )}}">
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                </div>
            </div>
        </div>
    @endisset

    @isset($staff_form7)
        <div class="card">
            <div class="card-header">
                <div>
                    <b> ७. अन्य विवरण  </b>
                    <a href="{{route('edit-form7',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                        <i class="fa fa-edit"></i>
                        <span class="wtooltiptext">एडिट</span>
                    </a>
                    <table style="width:100%;">
                        <tbody><tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon myfont" style="text-align: left;"> (क) बहु विवाह  बाल विवाह गरेको</div>
                                                <div class="line-group-addon myfont"> @if ($staff_form7->poly_marriage==1)<i class="fa fa-check"></i>@endif  छ </div>
                                                <div class="line-group-addon myfont"> @if ($staff_form7->poly_marriage==0)<i class="fa fa-check"></i>@endif  छैन </div>
                                                <div class="line-group-addon myfont" style="padding-left: 30px;">
                                        छ भने पत्नीको नाम लेख्नुहोस्
                                    </div>
                                    <input class="line-control myfont" value="{{isset($staff_form7->poly_spouse_name) ? $staff_form7->poly_spouse_name : ''}}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon myfont" style="text-align: left;"> (ख) पति वा पत्नीले विदेश मुलुकको स्थायी आबासीय अनुसीय अनुमति (DV/PR  वा अन्य ) लिए नलिएको वा सोको लागि दरखास्त दिए नदिएको विवरण </div>
                                        <div class="line-group-addon myfont"> @if ($staff_form7->foreign_spouse_apply==1)<i class="fa fa-check"></i>@endif छ </div>
                                        <div class="line-group-addon myfont"> @if ($staff_form7->foreign_spouse_apply==0)<i class="fa fa-check"></i>@endif छैन </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon myfont" style="text-align: left; left; padding-left:55px;"> १. स्थायी आवसीय अनुमति लिएको भए देशको नाम </div>
                                    @foreach ($countries as $key=> $item)
                                      @if ($key==$staff_form7->fa_country)
                                        <input class="line-control myfont" value="{{$item}}">
                                      @endif
                                    @endforeach
                                    <div class="line-group-addon myfont" style="text-align: left;"> र लिएको मिति </div>
                                    <input class="line-control myfont" value="{{nepali($staff_form7->fa_date)}}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon myfont" style="text-align: left; padding-left:55px;"> २. स्थायी आवासीय अनुमतिका लागि दरखास्त दिएको भए देशको नामः </div>
                                    @foreach ($countries as $key=> $item)
                                      @if ($key==$staff_form7->fa2_country)
                                        <input class="line-control myfont" value="{{$item}}">
                                      @endif
                                    @endforeach
                                    <div class="line-group-addon myfont" style="text-align: left;"> दरखास्त दिएको मिति </div>
                                    <input class="line-control myfont" value="{{nepali($staff_form7->fa2_date)}}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon myfont" style="text-align: left;"> (ग) कुनै सरकारी बक्यौता तिर्न बाँकी </div>
                                        <div class="line-group-addon myfont"> @if ($staff_form7->loan==1)<i class="fa fa-check"></i>@endif छ </div>
                                        <div class="line-group-addon myfont"> @if ($staff_form7->loan==0)<i class="fa fa-check"></i>@endif छ</div>
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                        बाँकी भए सोको विवरण
                                    </div>
                                    <input class="line-control myfont" value="{{isset($staff_form7->loan_detail) ? $staff_form7->loan_detail : ''}}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="first_tab line-group">
                                    <div class="line-group-addon myfont" style="text-align: left; "> (घ) सम्बन्धित कर्मचारीको बिशेष योग्यता र क्षमता </div>
                                    <input class="line-control myfont" value="{{isset($staff_form7->qualification) ? $staff_form7->qualification : ''}}">
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                    <!--       footer sign and footpritn         -->
                </div>
            </div>
        </div>
    @endisset

    @isset($staff_form8)
    <div class="card">
        <div class="card-body">
            <div>
                <strong> क ) सेवा सम्बन्धी विवरण </strong>
                <a href="{{route('edit-form8',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                    <i class="fa fa-edit"></i>
                    <span class="wtooltiptext">एडिट</span>
                </a>
                {{-- <p style="text-align:right; float:right;"> फारम नं. ०१ </p> --}}
                <table class="table table_bordered">
                    <thead>
                    <tr>
                        <td> क्र सं </td>
                        <td> सेवा </td>
                        <td> पद र श्रेणी </td>
                        <td> कार्यालयको नाम र ठेगाना </td>
                        <td> कार्यालयको नाम र अंग्रेजीमा </td>
                        <td> नयाँ नियुक्ति सरुवा बढुवा  </td>
                        <td> निर्णय मिति </td>
                        <td> बहाली मिति (हाजिरी मिति) </td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff_form8 as $key =>  $item)
                            <tr>
                                <td>{{nepali($key+1)}}</td>
                                <td>{{$item->services->name}}</td>
                                <td><br>{{$item->positions->name}}</td>
                                <td>{{$item->office_name_address}}</td>
                                <td>{{$item->office_name_address_english}}</td>
                                <td>
                                    @foreach ($appoints as $key => $value)
                                        @if ($key==$item->new_appoint)
                                            {{$value}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{nepali($item->decision_date)}}</td>
                                <td>{{nepali($item->restoration_date)}}</td>
                            </tr>
                        @endforeach
                            
                    </tbody>
                </table>
            </div>
        </div>

    </div>
        
    @endisset

    @isset($staff_form9)

    <div class="card">
        <div class="card-header">
            <div>
                <strong> ख) शैक्षिक योग्यता </strong>
                <a href="{{route('edit-form9',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                    <i class="fa fa-edit"></i>
                    <span class="wtooltiptext">एडिट</span>
                </a>
                {{-- <p style="text-align:right; float:right;"> फारम नं. ०३ </p> --}}
                <table class="table table_bordered">
                    <thead>
                    <tr>
                        <td> क्र सं </td>
                        <td> शैक्षिक योग्यता वा उपाधि </td>
                        <td> अध्ययनको विषय वा संकाय </td>
                        <td> उतीर्ण गरेको साल </td>
                        <td> प्राप्त श्रेणी  </td>
                        <td> संस्था /परिषद /विश्वविद्यालयको नाम र देश </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($staff_form9 as $key=> $item)
                            <tr>
                                <td>{{nepali($key+1)}}</td>
                                <td>{{$item->qualifications->name}}</td>
                                <td>{{$item->subjects->name}}</td>
                                <td>{{nepali($item->year)}}</td>
                                <td>{{$item->positions->name}}</td>
                                <td>{{$item->institutes->name}}</td>
                            </tr>
                    @endforeach
        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endisset

    @isset($staff_form10)
        <div class="card">
            <div class="card-header">
                
            <div>
                <strong> ग ) तालिम / सेमिनार / सम्मेलन सम्बन्धी विवरण </strong>
                <a href="{{route('edit-form10',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                    <i class="fa fa-edit"></i>
                </a>
                <p style="text-align:right; float:right;"> फारम नं. ०३ </p>
                <table class="table table_bordered">
                    <thead>
                    <tr>
                        <td> क्र सं </td>
                        <td> तालिमको विवरण </td>
                        <td> तालिम लिएको मिति </td>
                        <td> तालिमको स्तर </td>
                        <td> तालिम प्रदान गर्ने निकाय </td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff_form10 as $key => $item)
                            <tr>
                                <td>{{nepali($key+1)}}</td>
                                <td>{{$item->detail}}</td>
                                <td>{{nepali($item->date)}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->institute}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            </div>
        </div>
    @endisset

    @isset($staff_form11)
        <div class="card">
            <div class="card-header">
                <div>
                    <strong> घ) विभूषण, प्रशंसा पत्र र पुरस्कारको विवरण  </strong>
                    <a href="{{route('edit-form11',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                        <i class="fa fa-edit"></i>
                    </a>
                    <p style="text-align:right; float:right;"> फारम नं. ०४ </p>
                    <table class="table table_bordered">
                        <thead>
                        <tr>
                            <td> क्र सं </td>
                            <td> विभूषण, पशंसा पत्रको विवरण  </td>
                            <td> प्राप्त मिति  </td>
                            <td> विभूषण प्रशंसापत्र पाएको कारण </td>
                            <td> सहुलियत  </td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($staff_form11 as $key => $item)
                        <tr>
                            <td>{{nepali($key+1)}}</td>
                            <td>{{$item->award_detail}}</td>
                            <td>{{ nepali($item->received_date)}}</td>
                            <td>{{$item->reason}} </td>
                            <td>{{$item->convenience}} </td>
                        </tr>
                        @endforeach
    
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endisset

    @isset($staff_form12)
       <div class="card">
            <div class="card-header">
                <div>
                    <strong> ङ) विभागीय सजायको विवरण  </strong>
                    <a href="{{route('edit-form12',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                        <i class="fa fa-edit"></i>
                    </a>
                    <table class="table table_bordered">
                        <thead>
                        <tr>
                            <td rowspan="2"> क्र सं </td>
                            <td rowspan="2"> सजायको प्रकार   </td>
                            <td rowspan="2"> सजायको आदेश मिति </td>
                            <td colspan="2"> पुनरावेदनको  </td>
                            <td rowspan="2"> कैफियत  </td>
                        </tr>
                        <tr>
                            <td> ठहर </td>
                            <td> मिति </td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($staff_form12 as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->punishments->name}}</td>
                                    <td>{{nepali($item->ordered_date)}}</td>
                                    <td>@if ($item->stopped==1) छ  @else छैन @endif</td>
                                    <td>{{nepali($item->stopped_date)}}</td>
                                    <td>{{$item->remarks}}</td>
                                </tr>
                            @endforeach
    
                          </tbody>
                    </table>
                </div>
            </div>
       </div>
    @endisset

    @isset($staff_form_13)
        <div class="card">
            <div class="card-header">
                <div class="container-fluid py-2" >
                    <div class="d-flex flex-row flex-nowrap">
                        <div class="card card-body"  style="overflow-y: scroll">
                            <div class="box box-primary" style="margin-top: auto;">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                        १३. बिदा र औषधी उपचारको विवरण   </h3>
                                    {{-- <a class="pull-right btn btn-info" id="print" onclick="printdiv('print_content13')"> <i class="fa fa-print"></i>
                                    </a>
                                    <a href="http://localhost/pis/admin-staff-form/staff-form-13/25" class="btn btn-sm btn-info wtooltip pull-right">
                                        <i class="fa fa-edit"></i>
                                        <span class="wtooltiptext">एडिट</span>
                                    </a> --}}
                                </div>
                                <div class="box-body">
                                    <div id="print_content13">
                        
                                        <p style="text-align:right; float:right;"> फारम नं. ०६ </p>
                                        <table class="table table-bordered">
                                            {{-- <thead>
                                            <tr>
                                                <td rowspan="2"> विवरण </td>
                                                <td rowspan="2"> आर्थिक वर्ष </td>
                                                <td colspan="5"> घर विदा   </td>
                                                <td colspan="5"> बिरामी विदा </td>
                                                <td colspan="3"> प्रसुति / प्रसुति स्याहार विदा  </td>
                                                <td colspan="3"> अध्ययन विदा  </td>
                                                <td colspan="3"> असाधारण विदा  </td>
                                                <td colspan="3"> बेतलवी विदा  </td>
                                                <td colspan="3"> गयल अवधि  </td>
                                                <td colspan="3"> क्याबी बिदा </td>
                                                <td colspan="3"> पबी बिदा </td>
                                                <td rowspan="2"> उपचार खर्च लिएको रकम </td>
                                                <td rowspan="2"> कैफियत  </td>
                                            </tr>
                                            <tr>
                                                <td> पहिलेको बाँकी	</td>
                                                <td>विदा</td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> पहिलेको बाँकी	</td>
                                                <td>विदा</td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> देखि   </td>
                                                <td> सम्म   </td>
                                                <td> जम्मा  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                        <td></td>
                                                        <td> {{nepali( $current_fiscal_year->name)}}</td>
                                                        <td>{{nepali( $total_ghar_leave_left)}}</td>
                                                        <td>{{nepali($total_ghar_bida_setting)}}</td>
                                                        @php
                                                            $total_ghar_bida= $total_ghar_bida_setting+$total_ghar_leave_left;
                                                        @endphp
                                                        <td>{{nepali( $total_ghar_bida)}}</td>
                                                        <td>{{nepali($current_ghar_bida_used)}}</td>
                                                        <td>{{nepali($total_ghar_bida-$current_ghar_bida_used)}}</td>
                
                                                        <td>{{nepali( $total_birami_leave_left)}}</td>
                                                        <td>{{nepali( $total_birami_bida_setting)}}</td>
                                                        @php
                                                            $total_birami_bida= $total_birami_bida_setting+$total_birami_leave_left;
                                                        @endphp
                                                        <td>{{nepali($total_birami_bida) }}</td>
                                                        <td>{{nepali($current_birami_bida_used)}}</td>  
                                                        <td>{{nepali($total_birami_bida-$current_birami_bida_used)}}</td>
                                                        <td>{{nepali($total_prasuti_bida_setting)}}</td>
                                                        <td>{{nepali($current_prasuti_bida_used)}}</td>
                                                        <td>{{nepali($total_prasuti_bida_setting-$current_prasuti_bida_used )}}</td>
                                                        <td>{{nepali($total_adhyan_bida_setting)}}</td>
                                                        <td>{{nepali($current_adhyan_bida_used)}}</td>
                                                        <td>{{nepali($total_adhyan_bida_setting-$current_adhyan_bida_used )}}</td>
                                                        <td>{{nepali($total_ashadharan_bida_setting)}}</td>
                                                        <td>{{nepali($current_asadharan_bida_used)}}</td>
                                                        <td>{{nepali($total_ashadharan_bida_setting-$current_asadharan_bida_used )}}</td>
                                                        <td>{{nepali($total_betalawi_bida_setting)}}</td>
                                                        <td>{{nepali($current_betalawi_bida_used)}}</td>
                                                        <td>{{nepali($total_betalawi_bida_setting-$current_betalawi_bida_used )}}</td>
                                                        <td>{{nepali($total_gayal_bida_setting)}}</td>
                                                        <td>{{nepali($current_gayal_bida_used)}}</td>
                                                        <td>{{nepali($total_gayal_bida_setting-$current_gayal_bida_used )}}</td>    
                                                        <td>{{nepali($total_kyabi_bida_setting)}}</td>
                                                        <td>{{nepali($current_kyabi_bida_used)}}</td>
                                                        <td>{{nepali($total_kyabi_bida_setting-$current_kyabi_bida_used )}}</td>
                                                        <td>{{nepali($total_pabi_bida_setting)}}</td>
                                                        <td>{{nepali($current_pabi_bida_used)}}</td>
                                                        <td>{{nepali($total_pabi_bida_setting-$current_pabi_bida_used )}}</td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody> --}}
                                        </table>

                                        <table class="table table_bordered">
                                            <thead>
                                            <tr>
                                                <td rowspan="2"> विवरण </td>
                                                <td rowspan="2"> आर्थिक वर्ष </td>
                                                <td colspan="5"> घर विदा   </td>
                                                <td colspan="5"> बिरामी विदा </td>
                                                <td colspan="3"> प्रसुति / प्रसुति स्याहार विदा  </td>
                                                <td colspan="3"> अध्ययन विदा  </td>
                                                <td colspan="3"> असाधारण विदा  </td>
                                                <td colspan="3"> बेतलवी विदा  </td>
                                                <td colspan="3"> गयल अवधि  </td>
                                                <td colspan="3"> क्याबी बिदा </td>
                                                <td colspan="3"> पबी बिदा </td>
                                                <td rowspan="2"> उपचार खर्च लिएको रकम </td>
                                                <td rowspan="2"> कैफियत  </td>
                                            </tr>
                                            <tr>
                                                <td> पहिलेको बाँकी	</td>
                                                <td>विदा</td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> पहिलेको बाँकी	</td>
                                                <td>विदा</td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> देखि   </td>
                                                <td> सम्म   </td>
                                                <td> जम्मा  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                                <td> जम्मा  </td>
                                                <td> खर्च  </td>
                                                <td> बाँकी  </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                        <td></td>
                                                        <td> {{nepali( $current_fiscal_year->name)}}</td>
                                                        <td>{{nepali($prev_ghar_leave_left)}}</td>
                                                        <td>{{nepali( $total_ghar_bida_setting)}}</td>
                                                        @php
                                                            $total_ghar_bida= $prev_ghar_leave_left + $total_ghar_bida_setting;
                                                            @endphp
                                                        <td>{{nepali($total_ghar_bida)}}</td>
                                                        <td>{{nepali($current_ghar_bida_used)}}</td>
                                                        <td>{{nepali($total_ghar_bida-$current_ghar_bida_used)}}</td>
                                                        <td>{{nepali($prev_birami_leave_left)}}</td>
                                                        <td>{{nepali($total_birami_bida_setting)}}</td>
                                                        @php
                                                            $total_birami_bida= $prev_birami_leave_left + $total_birami_bida_setting;

                                                        @endphp
                                                        <td>{{nepali($total_birami_bida)}}</td>
                                                        <td>{{nepali($current_birami_bida_used)}}</td>
                                                        <td>{{nepali($total_birami_bida-$current_birami_bida_used)}}</td>
                                                        <td>{{nepali($total_prasuti_bida_setting)}}</td>
                                                        <td>{{nepali($current_prasuti_bida_used)}}</td>
                                                        <td>{{nepali($total_prasuti_bida_setting-$current_prasuti_bida_used )}}</td>
                                                        <td>{{nepali($total_adhyan_bida_setting)}}</td>
                                                        <td>{{nepali($current_adhyan_bida_used)}}</td>
                                                        <td>{{nepali($total_adhyan_bida_setting-$current_adhyan_bida_used )}}</td>
                                                        <td>{{nepali($total_ashadharan_bida_setting)}}</td>
                                                        <td>{{nepali($current_asadharan_bida_used)}}</td>
                                                        <td>{{nepali($total_ashadharan_bida_setting-$current_asadharan_bida_used )}}</td>
                                                        <td>{{nepali($total_betalawi_bida_setting)}}</td>
                                                        <td>{{nepali($current_betalawi_bida_used)}}</td>
                                                        <td>{{nepali($total_betalawi_bida_setting-$current_betalawi_bida_used )}}</td>
                                                        <td>{{nepali($total_gayal_bida_setting)}}</td>
                                                        <td>{{nepali($current_gayal_bida_used)}}</td>
                                                        <td>{{nepali($total_gayal_bida_setting-$current_gayal_bida_used )}}</td>   
                                                        <td>{{nepali($total_kyabi_bida_setting)}}</td>
                                                        <td>{{nepali($current_kyabi_bida_used)}}</td>
                                                        <td>{{nepali($total_kyabi_bida_setting-$current_kyabi_bida_used )}}</td>
                                                        <td>{{nepali($total_pabi_bida_setting)}}</td>
                                                        <td>{{nepali($current_pabi_bida_used)}}</td>
                                                        <td>{{nepali($total_pabi_bida_setting-$current_pabi_bida_used )}}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                     
                                                    </tbody>
                                        </table>
                                    </div>
                                </div>
                        
                            </div>
                        </div>
                   
                    
                </div>
                </div>
            </div>
        </div>
    @endisset

    @isset($staff_form_14)
        <div class="card">
            <div class="card-header">
                <div>
                    <strong> छ) वर्गीकृत क्षेत्रहरुमा काम गरेको विवरण  </strong>
                    <a href="{{route('edit-form13',$user->id)}}" class="btn btn-sm btn-info wtooltip pull-right">
                    <i class="fa fa-edit"></i>
                    </a>
                    <table class="table table_bordered">
                        <thead>
                        <tr>
                            <td rowspan="2"> क्र सं </td>
                            <td colspan="2"> अवधि  </td>
                            <td rowspan="2"> पदस्थापना भएको स्थान वा क्षेत्र  </td>
                            <td rowspan="2"> काम गरेको स्थान वा क्षेत्र </td>
                            <td colspan="5"> यो चिन्ह ( ) दिई काम गरेको क्षेत्रको वर्ग जनाउने   </td>
                            <td rowspan="2"> कैफियत  </td>
                        </tr>
                        <tr>
                            <td> देखि </td>
                            <td> सम्म </td>
                            <td> क वर्ग </td>
                            <td> ख वर्ग </td>
                            <td> ग वर्ग </td>
                            <td> घ वर्ग </td>
                            <td> ङ वर्ग </td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($staff_form_14 as $key => $item)
                         <tr>
                                    <td>{{nepali($key+1)}}</td>
                                    <td>{{nepali($item->from_date)}}</td>
                                    <td>{{nepali($item->to_date)}}</td>
                                    <td>{{$item->post_area}}</td>
                                    <td>{{$item->work_area}}</td>
                                    <td>@if($item->a_work==1)<i class="fas fa-check"></i> @endif</td>
                                    <td>@if($item->b_work==1)<i class="fas fa-check"></i> @endif</td>
                                    <td>@if($item->c_work==1)<i class="fas fa-check"></i> @endif</td>
                                    <td>@if($item->d_work==1)<i class="fas fa-check"></i> @endif</td>
                                    <td>@if($item->e_work==1)<i class="fas fa-check"></i> @endif</td>
                                    <td>{{$item->remarks}}</td>
                        </tr>
                        @endforeach
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endisset


@endsection