@extends('layout.layout')
@section('title', 'New Staff')
@section('menu_show_faculty', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('staff_details', 'active')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('content')
    <div class="text-right">
        <button id="printbtn" class="btn btn-primary"><i class="fas fa-print"></i></button>
        <a id="backBtn" href="{{route('staff-search')}}" class="btn btn-primary"><i class="fas fa-backspace"></i></a>
    </div>
    <div class="card" id="printdiv">
        <div class="card-header">
            <h3>{{isset($user->nep_name) ? $user->nep_name : ''}}</h3>
        </div>

        <div class="card-body">
            <h6 style="text-align: center"><b> अनुसूची ७</b>
            </h6>
            <h6 style="text-align: center">(नि.से.नि २०५० को नियम २२ सँग सम्बन्धित)
            </h6>
            <br>
            <h3 style="text-align: center"> <b> निजामती कर्मचारीको वैयक्तिक विवरण फारम</b>
            </h3>
            <h3 style="text-align: center"><b>(सिटरोल)</b>
            </h3>

            <p><b>संलग्न गर्नुपर्ने कागजातहरु :
            </b></p>
            <ul>
                <li> शैक्षिक योग्यता र नागरिकताको प्रमाणपत्रहरुको प्रमाणित प्रतिलिपि (सेवा प्रवेश गर्नु पूर्वको उमेर खुलेको शैक्षिक योग्यता र नागरिकता हुनुपर्ने) ।</li>
                <li> यस अघि सरकारी सेवामा रही स्थायी पदमा काम गरेको भए सो को विवरण स्पष्टसँग उल्लेख गरी ततसम्बन्धी कागजातहरुको प्रमाणित प्रतिलिपि ।</li>
                <li> सम्बन्धित कार्यालयबाट सिटरोल दर्ता गरी प्रमाणित गरी दिने भन्ने व्यहोराको पत्र ।</li>
                <li>कार्यालयमा शुरु स्थायी नियुक्ति हुँदाको हाजिरी भएको जानकारी पत्र ।</li>
                <li>स्थायी नियुक्ति हुँदा पेश गरेकोनिरोगीता रशपथग्रहणको प्रमाणित प्रतिलिपि ।</li>
                <li>लोकसेवा आयोगको सिफारिश पत्रको सक्कलै वा प्रमाणित प्रतिलिपि ।</li>
                <li>तालिमको प्रमाणपत्रको प्रतिलिपि र अन्य कागजातहरुको प्रतिलिपि ।</li>

            </ul>
            <table style="width: 100%;">
                <tbody><tr>
                    <td>
                        <div class="first_tab line-group">
                            <div class="line-group-addon"> कर्मचारीको नाम नेपालीमा (देवनागरी लिपी): </div>
                            <input class="line-control" value="{{isset($user->nep_name) ? $user->nep_name : ''}}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="first_tab line-group">
                            <div class="line-group-addon ">
                                अंगे्रजीमा (BLOCK LETTER)
                            </div>
                            <input class="line-control" value="{{isset($user->name) ? $user->name : ''}}">
                        </div>
                    </td>
                </tr>
            </tbody></table>

            <div style="margin-top: 35px;">
                <b> कर्मचारी संकेत नम्बर (निजामती कितावखानाले भर्ने) </b>
                            <table style="width: 100%; margin-top: 10px;">
                    <tbody><tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon"> नेपाली अंकमा </div>
                                     <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;">{{nepali(isset($user->s_no) ? $user->s_no : '')}}</div>
                                    </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    अंगे्रजी अंकमा
                                </div>
                                    <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;">{{isset($user->s_no) ? $user->s_no : ''}}</div>
                                    </div>
                        </td>
                    </tr>
                </tbody></table>

            </div>

            <div style="margin-top: 55px; font-weight: 600; font-style: italic; font-size: 14px;" class="page-break-after">
                द्रव्टव्य:कम्तिमा पनि साइजको नेपाली कागजमा वैयक्तिक विवरण छापिउनेको हुनु पर्नेछ ।
            </div>

            <div style="width: 80%; float: left; text-align: center; margin-top:5%">
                <div style="font-size: 20px;"> वैयक्तिक विवरण </div>
                <div style="font-size: 20px;"> नेपाल सरकार</div>
                <div><span> ...................</span> मन्त्रालय/सचिवालय/आयोग/विभाग/कार्यालय </div>
            </div>
            <div style="width: 10%; float: left; text-align: right;">
                फारम नं. ०१
                    <img src="{{ asset('storage/upload/' . $user->photo) }}" style="border: 1px solid #000; font-size: 12px; text-align: center; vertical-align: middle; width: 120px;">
             </div>
                
            <div>
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                        <td>
                            <b>१. निजामती कर्मचारीको पूरा नाम र थर</b>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    नेपालीमा ( देदनागरी लिपी)
                                </div>
                                <input class="line-control" value="{{isset($user->nep_name) ? $user->nep_name : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    अंग्रेजीमा (BLOCK LETTER)
                                </div>
                                <input class="line-control" value="{{isset($user->name) ? $user->name : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont">
                                    जन्म मिति विवरण: (बि.सं.)
                                </div>
                                <input class="line-control nepNum width80" value="">
                                <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    ई.सं.
                                </div>
                                <input class="line-control myfont" value="{{nepali(isset($user->dob) ? $user->dob : '') }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont">
                                    नगरीकता नं.
                                </div>
                                <input class="line-control nepNum width80" value="{{isset($user->cs_no) ? $user->cs_no : ''}}">
                                <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    जारी जिल्ला
                                </div>
                                @foreach ($districts as $item)
                                    @if (isset($user->cs_district))
                                        @if ($item->id==$user->cs_district)
                                            <input class="line-control myfont" value="{{ $item->nep_name}}">
                                        @endif       
                                    @else
                                        <input class="line-control myfont" value="">
                                    @endif

                                @endforeach

                                <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    जारी मिति
                                </div>
                                <input class="line-control myfont" value="{{nepali( isset($user->cs_issue) ? $user->cs_issue: '')}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont">
                                    बाबुको नाम (नेपालीमा)
                                </div>
                                <input class="line-control nepNum width80" value="{{isset($user->father_nep_name) ? $user->father_nep_name : ''}}">
                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    पेशा
                                </div>
                                @if (isset($user->father_occupation))
                                @foreach ($occupations as $item)
                                    @if ($item->id == $user->father_occupation)
                                         <input class="line-control myfont" value="{{$item->name}}">
                                    @endif
                                @endforeach
                                @else
                                <input class="line-control myfont" value="">
                                @endif

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon">
                                    बाबुको नाम (अंग्रेजीमा)
                                </div>
                                <input class="line-control" value="{{isset( $user->father_name) ? $user->father_name : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont">
                                    बाजेको नाम (नेपालीमा)
                                </div>
                                <input class="line-control nepNum width80" value="{{isset($user->g_father_nep_name) ? $user->g_father_nep_name : ''}}">
                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    पेशा
                                </div>
                                @if (isset($user->g_father_occupation))
                                        @foreach ($occupations as $item)
                                        @if ($item->id == $user->g_father_occupation)
                                            <input class="line-control myfont" value="{{$item->name}}">
                                        @endif
                                    @endforeach
                            @else
                            <input class="line-control myfont" value="">
                            @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    बाजेको नाम (अंग्रेजीमा)
                                </div>
                                <input class="line-control" value="{{isset($user->g_father_name) ? $user->g_father_name : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont">
                                    आमाको नाम (नेपालीमा)
                                </div>
                                <input class="line-control nepNum width80" value="{{isset($user->mother_nep_name) ? $user->mother_nep_name : ''}}">
                                     <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    पेशा
                                </div>
                                @if (isset($user->mother_occupation))
                                    @foreach ($occupations as $item)
                                        @if ($item->id == $user->mother_occupation)
                                            <input class="line-control myfont" value="{{$item->name}}">
                                        @endif
                                    @endforeach
                                @else
                                    <input class="line-control myfont" value="">
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    आमाको नाम (अंग्रेजीमा)
                                </div>
                                <input class="line-control" value="{{isset($user->mother_name) ? $user->mother_name : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont">
                                    विवाहित भए पति/पत्नीको नाम (नेपालीमा)
                                </div>
                                <input class="line-control" value="{{isset($user->spouse_nep_name) ? $user->spouse_nep_name : ''}}">
                                 <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    पेशा
                                </div>
                                @if (isset($user->spouse_occupation))
                                @foreach ($occupations as $item)
                                    @if ($item->id == $user->spouse_occupation)
                                        <input class="line-control myfont" value="{{$item->name}}">
                                    @endif
                                @endforeach
                                @else
                                    <input class="line-control myfont" value="">
                                @endif                           
                         </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    (अंग्रेजीमा)
                                </div>
                                <input class="line-control" value="{{isset($user->spouse_name) ? $user->spouse_name : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont">
                                    छोरीको खंख्या
                                </div>
                                <input class="line-control nepNum width80" value="{{isset($user->daughters_no) ? $user->daughters_no : ''}}">
                                <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    छोराको संख्या
                                </div>
                                <input class="line-control myfont" value="{{isset($user->sons_no) ? $user->sons_no : ''}}">
                            </div>
                        </td>
                    </tr>
                     <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon myfont">
                                         कर्मचारीको प्रकार
                                        </div>


                                        @if (isset($user->category_id))
                                            @foreach ($staff_categories as $item)
                                                @if ($item->id==$user->category_id)
                                                    <input class="line-control nepNum width80" value="{{$item->name}}">
                                                @endif
                                            @endforeach
                                            @else
                                                <input class="line-control nepNum width80" value="">
                                            @endif
                                        <div class="line-group-addon myfont" style="padding-left: 30px;">
                                          कर्मचारीको सह प्रकार
                                        </div>
                                        @if (isset($user->sub_category_id))
                                            @foreach ($staff_sub_cat as $item)
                                                @if ($item->id==$user->sub_category_id)
                                                    <input class="line-control nepNum width80" value="{{$item->name}}">
                                                @endif
                                            @endforeach
                                            @else
                                                <input class="line-control nepNum width80" value="">
                                            @endif                                        
                                    </div>
                                </td>
                            </tr>
                </tbody></table>
            </div>

            {{-- ठेगाना सम्बन्धी विवरण --}}

            <div style="margin-top: 30px">
                <b> २. ठेगाना सम्बन्धी विवरण </b>
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
                            @if (isset($user->p_province))
                                @foreach ($provinces as $item)
                                   @if ($item->id==$user->p_province)
                                       {{$item->nep_name}}
                                   @endif
                                @endforeach
                            @endif

                        </td>
                        <td> 
                            @if (isset($user->p_province))
                                @foreach ($provinces as $item)
                                @if ($item->id==$user->p_province)
                                    {{$item->name}}
                                @endif
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if (isset($user->t_province))
                                @foreach ($provinces as $item)
                                @if ($item->id==$user->t_province)
                                    {{$item->nep_name}}
                                @endif
                                @endforeach
                            @endif    
                        </td>
                        <td> 
                            @if (isset($user->t_province))
                                @foreach ($provinces as $item)
                                    @if ($item->id==$user->t_province)
                                        {{$item->name}}
                                    @endif
                                @endforeach
                            @endif  
                         </td>
                    </tr>
                                                            <tr>
                        <td> जिल्ला </td>
                        <td> 
                            @if (isset($user->p_district))
                                @foreach ($districts as $item)
                                    @if ($item->id==$user->p_district)
                                        {{$item->nep_name}}
                                    @endif
                                @endforeach
                            @endif  
                        </td>
                        <td> 
                            @if (isset($user->p_district))
                                @foreach ($districts as $item)
                                    @if ($item->id==$user->p_district)
                                        {{$item->name}}
                                    @endif
                                @endforeach
                            @endif                             
                        </td>

                        <td> 
                            @if (isset($user->t_district))
                                @foreach ($districts as $item)
                                    @if ($item->id==$user->t_district)
                                        {{$item->nep_name}}
                                    @endif
                                @endforeach
                            @endif                            
                        </td>
                        <td> 
                            @if (isset($user->t_district))
                                @foreach ($districts as $item)
                                    @if ($item->id==$user->t_district)
                                        {{$item->name}}
                                    @endif
                                @endforeach
                            @endif    
                        </td>
                    </tr>
                                                            <tr>
                        <td> न.पा. / गा.वि.स </td>
                        <td> 
                            @if (isset($user->p_municipality))
                                @foreach ($municipalities as $item)
                                   @if ($item->id == $user->p_municipality)
                                       {{$item->nep_name}}
                                   @endif
                                @endforeach
                            @endif

                        </td>
                        <td> 
                            @if (isset($user->p_municipality))
                                @foreach ($municipalities as $item)
                                    @if ($item->id == $user->p_municipality)
                                        {{$item->name}}
                                    @endif
                                @endforeach
                            @endif    
                        </td>
                        <td> 
                            @if (isset($user->t_municipality))
                                @foreach ($municipalities as $item)
                                   @if ($item->id == $user->t_municipality)
                                       {{$item->nep_name}}
                                   @endif
                                @endforeach
                            @endif                            
                        </td>
                        <td> 
                            @if (isset($user->t_municipality))
                            @foreach ($municipalities as $item)
                               @if ($item->id == $user->t_municipality)
                                   {{$item->name}}
                               @endif
                            @endforeach
                        @endif    
                        </td>
                    </tr>
                    <tr>
                        <td> वडा नं. </td>
                        <td> {{nepali(isset($user->p_ward) ? $user->p_ward : '')}} </td>
                        <td> {{isset($user->p_ward) ? $user->p_ward : ''}} </td>
                        <td> {{nepali(isset($user->t_ward) ? $user->t_ward : '')}} </td>
                        <td> {{isset($user->t_ward) ? $user->t_ward : ''}} </td>
                    </tr>
                    <tr>
                        <td> टोल / मार्ग </td>
                        <td>{{isset($user->p_tole_nep) ? $user->p_tole_nep : ''}}  </td>
                        <td> {{isset($user->p_tole) ? $user->p_tole : ''}} </td>
                        <td> {{isset($user->t_tole_nep) ? $user->t_tole_nep : ''}} </td>
                        <td> {{isset($user->t_tole) ? $user->t_tole : ''}} </td>
                    </tr>
                    <tr>
                        <td> घर / ब्लक नं. </td>
                        <td> {{isset($user->p_house_no_nep) ? $user->p_house_no_nep : ''}} </td>
                        <td> {{isset($user->p_house_no) ? $user->p_house_no : ''}} </td>
                        <td>  {{isset($user->t_house_no_nep) ? $user->t_house_no_nep : ''}}</td>
                        <td> {{isset($user->t_house_no) ? $user->t_house_no : ''}} </td>
                    </tr>
                    <tr>
                        <td> सम्पर्क / फोन मो.नं. </td>
                        <td colspan="2"> {{isset($user->p_contact) ? $user->p_contact : ''}} </td>
                        <td colspan="2">  {{isset($user->t_contact) ? $user->t_contact : ''}}</td>
                    </tr>
                    <tr>
                        <td> ईमेल ठेगाना </td>
                        <td colspan="4"> {{isset($user->email) ? $user->email : ''}} </td>
                    </tr>

                    </tbody>
                </table>
            </div>




            {{--अन्य वैयक्तिक विवरण --}}

            <div style="margin-top: 30px">
                <b> ३. अन्य वैयक्तिक विवरण </b>
                <table style="width:100%;">
                    <tbody><tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont">
                                    लिंग
                                </div>
                                @if (isset($user->gender))
                                @foreach ($genders as $key=> $item)
                                    @if ($user->gender==$key)
                                        <input class="line-control nepNum width80" value="{{$item}}">
                                    @endif
                                    @endforeach
                                    @else
                                        <input class="line-control nepNum width80" value="">
                                    @endif

                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    धर्म
                                </div>
                                @if (isset($user->religion))
                                    @foreach ($religions as $item)
                                        @if ($user->religion==$item->id)
                                            <input class="line-control myfont" value="{{$item->name}}">
                                        @endif
                                    @endforeach
                                @else
                                    <input class="line-control myfont" value="हिन्दु धर्म">
                                @endif

                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    जातजाती
                                </div>
                                @if (isset($user->ethnicity))
                                @foreach ($ethnicities as $item)
                                    @if ($user->ethnicity==$item->id)
                                        <input class="line-control myfont" value="{{$item->name}}">
                                    @endif
                                @endforeach
                                @else
                                    <input class="line-control myfont" value="">
                                @endif
                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    हुलिया
                                </div>

                                @if (isset($user->face))
                                @foreach ($faces as $item)
                                    @if ($user->face==$item->id)
                                        <input class="line-control myfont" value="{{$item->name}}">
                                    @endif
                                @endforeach
                                @else
                                    <input class="line-control myfont" value="">
                                @endif
                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    रक्त कमूह
                                </div>
                                @if (isset($user->blood_group))
                                @foreach ($bgroups as $item)
                                    @if ($user->blood_group==$item->id)
                                        <input class="line-control myfont" value="{{$item->name}}">
                                    @endif
                                @endforeach
                                @else
                                    <input class="line-control myfont" value="">
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left;"> मुल :</div>
                                @if ($user->source==1)
                                                <div class="line-group-addon myfont"><i class="fas fa-check"></i>  हिमाली </div>
                                                <div class="line-group-addon myfont">  पहाडी </div>
                                                <div class="line-group-addon myfont"> तराई/मधेश </div>
                                @endif

                                @if ($user->source==2)
                                <div class="line-group-addon myfont">  हिमाली </div>
                                <div class="line-group-addon myfont"><i class="fas fa-check"></i>  पहाडी </div>
                                <div class="line-group-addon myfont"> तराई/मधेश </div>
                                @endif

                                @if ($user->source==3)
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
                                    @if ($user->janjati==1)
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                         <div class="line-group-addon myfont">  होइन </div>
                                    @else
                                         <div class="line-group-addon myfont"> हो </div>
                                        <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                                    @endif

                                         <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    हो भने कुन जात
                                </div>
                                <input class="line-control myfont" value="{{isset($user->janjati_other) ? $user->janjati_other : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left;"> ख) मधेशी :</div>
                                @if ($user->madesi==1)
                                    <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                    <div class="line-group-addon myfont">  होइन </div>
                                @else
                                    <div class="line-group-addon myfont"> हो </div>
                                    <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                                @endif

                                 <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    हो भने विवरण
                                </div>
                                <input class="line-control myfont" value="{{isset($user->madesi_other) ? $user->madesi_other : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left;"> ग)  दलित:</div>
                                @if ($user->dalit==1)
                                    <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                    <div class="line-group-addon myfont">  होइन </div>
                                @else
                                    <div class="line-group-addon myfont"> हो </div>
                                    <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                                @endif
                                <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    हो भने कुन जात
                                </div>
                                <input class="line-control myfont" value="{{isset($user->dalit_other) ? $user->dalit_other : ''}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left;"> घ) पिछडिएको जिल्ला(क्षेत्र) :</div>
                                @if ($user->low==1)
                                <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                <div class="line-group-addon myfont">  होइन </div>
                            @else
                                <div class="line-group-addon myfont"> हो </div>
                                <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                            @endif
                            <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    हो भने कुन जिल्ला
                                </div>
                                <input class="line-control myfont" value="{{isset($user->low_other) ? $user->low_other : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left;"> ङ) अपांगता :</div>
                                @if ($user->dsiable==1)
                                <div class="line-group-addon myfont"> <i class="fas fa-check"></i> हो </div>
                                <div class="line-group-addon myfont">  होइन </div>
                            @else
                                <div class="line-group-addon myfont"> हो </div>
                                <div class="line-group-addon myfont"> <i class="fas fa-check"></i> होइन </div>
                            @endif
                                <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    हो भने कुन किसिमको
                                </div>
                                <input class="line-control myfont" value="{{isset($user->disable_other) ? $user->disable_other : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left;"> लोक सेवा आयोगको सिफारिश हुँदा कुन वर्गमा भएको हो ? </div>

                                @if ($user->is_division==1)
                                    <input class="line-control myfont" value="क">
                                @endif
                                @if ($user->is_division==2)
                                    <input class="line-control myfont" value="ख">
                                @endif
                                @if ($user->is_division==3)
                                    <input class="line-control myfont" value="ग">
                                @endif
                                @if ($user->is_division==4)
                                <input class="line-control myfont" value="घ">
                                @endif
                                @if ($user->is_division==5)
                                <input class="line-control myfont" value="ङ">
                                @endif
                                @if ($user->is_division==6)
                                <input class="line-control myfont" value="खुला">
                                @endif
                                @if ($user->is_division==7)
                                <input class="line-control myfont" value="महिला">
                                @endif
                            </div>
                        </td>
                    </tr>
                </tbody></table>
            </div>

            {{-- 4 --}}
            <div>
                <br>

                <b> ४. भाषाको दक्षता सम्बन्धी विवरण </b>
                                                    <div> <b style="padding-left:25px;">  क) स्थानिय  भाषा सम्बन्धी ज्ञान  <span style="margin-left:15%;"> </span></b> </div>
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

                        @foreach ($languages as $key=> $item)
                            @if ($item->type=='local')
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
                            @endif
                        @endforeach

                    </tbody>
                </table>
                <b style="padding-left:25px;">  ख) विदेशी भाषा सम्बन्धी ज्ञान  </b>
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

                        @foreach ($languages as $key=> $item)
                            @if ($item->type=='foreign')
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
                            @endif
                        @endforeach
                        </tbody>
                </table>
            </div>
            {{-- 4 end --}}

            {{-- 5 start --}}
            <br>
            <div>
                <b> ५. कर्मचारीको शुरु स्थायी नियुक्तिको विवरण </b>
                <table style="width:100%;">
                    <tbody><tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    कर्यालयको नाम र ठेगाना :
                                </div>
                                <input class="line-control" value="{{isset($user->office_name_address) ? $user->office_name_address : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>    
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    नियुक्ति मिति :
                                </div>
                                <input class="line-control" value="{{nepali(isset($user->appoint_date) ? $user->appoint_date : '')}}">
                                <div class="line-group-addon ">
                                    निर्णय मिति :
                                </div>
                                <input class="line-control" value="{{nepali(isset($user->decision_date) ? $user->decision_date : '')}}">
                                <div class="line-group-addon ">
                                    हजिरी मिति :
                                </div>
                                <input class="line-control" value="{{nepali(isset($user->attend_date) ? $user->attend_date : '')}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    सेवा :
                                </div>
                                <input class="line-control" value="{{isset($user->services->name) ? $user->services->name : ''}}">
                                <div class="line-group-addon ">
                                    समुह  :
                                </div>
                                <input class="line-control" value="{{isset($user->officeGroups->name) ? $user->officeGroups->name : ''}}">
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
                                <input class="line-control" value="{{isset($user->levels->name) ? $user->levels->name : ''}}">
                                    <div class="line-group-addon ">
                                    पद :
                                </div>
                                <input class="line-control" value="{{isset($user->positions->name) ? $user->positions->name : ''}}">
                                <div class="line-group-addon myfont">@if($user->technical==1) <i class="fa fa-check"></i> @endif प्राविधिक </div>
                                <div class="line-group-addon myfont">@if($user->technical==0) <i class="fa fa-check"></i> @endif अप्राविधिक </div>
                            </div>
                        </td>
                    </tr>
                </tbody></table>
            </div>
            {{-- 5 end --}}

            {{-- 6--}}

            <br>
            <div>
                <b> ६. यस अघि सरकारी सेवामा रही स्थायी पदमा काम गरेको भए सोको विवरण  </b>
                <table style="width:100%;">
                    <tbody><tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    कर्यालयको नाम र ठेगाना :
                                </div>
                                <input class="line-control" value="{{isset($staff_prev_appointments->office_name_address) ? $staff_prev_appointments->office_name_address : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    सेवा :
                                </div>
                                <input class="line-control" value="{{isset($staff_prev_appointments->services->name) ? $staff_prev_appointments->services->name : ''}}">
                                <div class="line-group-addon ">
                                    समुह  :
                                </div>
                                <input class="line-control" value="{{isset($staff_prev_appointments->officeGroups->name) ? $staff_prev_appointments->officeGroups->name : '' }}">
                                <div class="line-group-addon ">
                                    उप-समुह :
                                </div>
                                <input class="line-control" value="{{isset($staff_prev_appointments->officeSubGroups->name) ? $staff_prev_appointments->officeSubGroups->name : '' }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    श्रेणी/तह :
                                </div>
                                <input class="line-control" value="{{isset($staff_prev_appointments->levels->name) ? $staff_prev_appointments->levels->name : '' }}">
                                <div class="line-group-addon ">
                                    पद :
                                </div>
                                <input class="line-control" value="{{isset($staff_prev_appointments->positions->name) ? $staff_prev_appointments->positions->name : '' }}">
                                <div class="line-group-addon myfont">@if($user->technical==1) <i class="fa fa-check"></i> @endif प्राविधिक </div>
                                <div class="line-group-addon myfont">@if($user->technical==0) <i class="fa fa-check"></i> @endif अप्राविधिक </div>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon ">
                                    छाडेको मिति:
                                </div>
                                <input class="line-control" value="{{nepali(isset($staff_prev_appointments->leave_date) ? $staff_prev_appointments->leave_date : '' )}}">
                                <div class="line-group-addon ">
                                    छाड्नुको कारण :
                                </div>
                                <input class="line-control" value="{{nepali(isset($staff_prev_appointments->leave_reason) ? $staff_prev_appointments->leave_reason : '' )}}">
                            </div>
                        </td>
                    </tr>
                </tbody></table>
            </div>
            {{-- 6 end--}}

            {{-- 7 start--}}
            <br>
            <div>
                <b> ७. अन्य विवरण  </b>
                <table style="width:100%;">
                    <tbody><tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left;"> (क) बहु विवाह  बाल विवाह गरेको</div>
                                            <div class="line-group-addon myfont"> @if ($user->poly_marriage==1)<i class="fa fa-check"></i>@endif  छ </div>
                                            <div class="line-group-addon myfont"> @if ($user->poly_marriage==0)<i class="fa fa-check"></i>@endif  छैन </div>
                                            <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    छ भने पत्नीको नाम लेख्नुहोस्
                                </div>
                                <input class="line-control myfont" value="{{isset($user->poly_spouse_name) ? $user->poly_spouse_name : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left;"> (ख) पति वा पत्नीले विदेश मुलुकको स्थायी आबासीय अनुसीय अनुमति (DV/PR  वा अन्य ) लिए नलिएको वा सोको लागि दरखास्त दिए नदिएको विवरण </div>
                                    <div class="line-group-addon myfont"> @if ($user->foreign_spouse_apply==1)<i class="fa fa-check"></i>@endif छ </div>
                                    <div class="line-group-addon myfont"> @if ($user->foreign_spouse_apply==0)<i class="fa fa-check"></i>@endif छैन </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left; left; padding-left:55px;"> १. स्थायी आवसीय अनुमति लिएको भए देशको नाम </div>
                                @foreach ($countries as $key=> $item)
                                  @if ($key==$user->fa_country)
                                    <input class="line-control myfont" value="{{$item}}">
                                  @endif
                                @endforeach
                                <div class="line-group-addon myfont" style="text-align: left;"> र लिएको मिति </div>
                                <input class="line-control myfont" value="{{nepali($user->fa_date)}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left; padding-left:55px;"> २. स्थायी आवासीय अनुमतिका लागि दरखास्त दिएको भए देशको नामः </div>
                                @foreach ($countries as $key=> $item)
                                  @if ($key==$user->fa2_country)
                                    <input class="line-control myfont" value="{{$item}}">
                                  @endif
                                @endforeach
                                <div class="line-group-addon myfont" style="text-align: left;"> दरखास्त दिएको मिति </div>
                                <input class="line-control myfont" value="{{nepali($user->fa2_date)}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left;"> (ग) कुनै सरकारी बक्यौता तिर्न बाँकी </div>
                                    <div class="line-group-addon myfont"> @if ($user->loan==1)<i class="fa fa-check"></i>@endif छ </div>
                                    <div class="line-group-addon myfont"> @if ($user->loan==0)<i class="fa fa-check"></i>@endif छ</div>
                                    <div class="line-group-addon myfont" style="padding-left: 30px;">
                                    बाँकी भए सोको विवरण
                                </div>
                                <input class="line-control myfont" value="{{isset($user->loan_detail) ? $user->loan_detail : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="first_tab line-group">
                                <div class="line-group-addon myfont" style="text-align: left; "> (घ) सम्बन्धित कर्मचारीको बिशेष योग्यता र क्षमता </div>
                                <input class="line-control myfont" value="{{isset($user->qualification) ? $user->qualification : ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            माथि लेखिएको विवरण ठीक छ । सरकारी सेवाको निमित अयोग्य हुने गरी मलाई कुनै सजाय भएको छैन । कुनै कुरा द्मुठो लेखिएको वा जानाजानी साँचो कुरा दबाउने लुकाउने उद्देश्यले लेखिएको ठहरे कानून बमोजिम सजाय स्वीकार गर्नेछु, साथै कर्मचारी आचार संहिता पालना गर्न प्रतिबध्द छु भनी सहीछाप गर्ने :
                        </td>
                    </tr>
                </tbody></table>
                <!--       footer sign and footpritn         -->
                <div style="margin-top:15px;">
                    <div style="width:26%; float:left; text-align:center; margin:2%;">
                        <div> कर्मचारीको  </div>
                        <div> (बुढी औलाको छाप)  </div>
                        <div>
                            <table class="table table_bordered table-bordered" style="width:50%; margin-left:24%;">
                                <tbody><tr>
                                    <td> दायाँ </td> 
                                    <td> बायाँ </td>
                                </tr>
                                <tr>
                                    <td style="height:100px;"> &nbsp; </td>
                                    <td> &nbsp;  </td>
                                </tr>
                            </tbody></table>
                        </div>
                    </div>
                    <div style="width:26%; float:left; text-align:center; margin:2%; padding-top:150px;">
                        <div style="border-top: 1px dotted #000; padding-top:8px;display: initial; "> (कर्मचारीको दस्तखत) </div>
                    </div>
                    <div style="width:26%; float:left; margin:2%; margin-left:8%;">
                        <div> प्रमाणित गर्ने कार्यालय </div>
                        <div class="first_tab line-group">
                            <div class="line-group-addon myfont" style="text-align: left; "> प्रमुखको नाम, थर : </div>
                            <input class="line-control myfont" value=" ">
                        </div>
                        <div class="first_tab line-group">
                            <div class="line-group-addon myfont" style="text-align: left; "> दस्तखत : </div>
                            <input class="line-control myfont" value=" ">
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div style="text-align:right; padding-right:25px;">
                    कार्यालयको छाप
                </div>
            </div>
            {{-- 7 end--}}

            <!--      कर्मचारी संकेत नम्बर (निजामती कितावखानाले मात्र प्रयोग गर्ने)      -->

            <div style="border-top:2px solid #000; padding-top:10px;">
                <strong> कर्मचारी संकेत नम्बर (निजामती कितावखानाले मात्र प्रयोग गर्ने) </strong>
                <div>
                    <div style="width:50%; float:left;">
                        <table style="width: 100%; margin-top: 10px;">
                            <tbody><tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon"> नेपाली अंकमा </div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="first_tab line-group">
                                        <div class="line-group-addon ">
                                            अंगे्रजी अंकमा
                                        </div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                        <div style="padding: 18px 26px; border: 1px solid #000; display: inline-block;"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div style="width:50%; float:left;">
                        <strong> विभागीय प्रमुख वा अधिकार प्राप्त </strong>
                        <div class="first_tab line-group">
                            <div class="line-group-addon myfont" style="text-align: left; "> अधिकृतको दसतखत : </div>
                            <input class="line-control myfont" value=" ">
                        </div>
                        <div class="first_tab line-group">
                            <div class="line-group-addon myfont" style="text-align: left; "> नाम : </div>
                            <input class="line-control myfont" value=" ">
                        </div>
                        <div class="first_tab line-group">
                            <div class="line-group-addon myfont" style="text-align: left; "> पद : </div>
                            <input class="line-control myfont" value=" ">
                        </div>
                        <div class="first_tab line-group">
                            <div class="line-group-addon myfont" style="text-align: left; "> मिति : </div>
                            <input class="line-control myfont" value=" ">
                        </div>
                        <div class="first_tab line-group">
                            <div class="line-group-addon myfont" style="text-align: left; "> कार्यालयको छाप : </div>

                        </div>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>

            <!--    क ) सेवा सम्बन्धी विवरण        -->

            <div>
                <strong> क ) सेवा सम्बन्धी विवरण </strong>
                <p style="text-align:right; float:right;"> फारम नं. ०१ </p>
                <table class="table table_bordered">
                    <thead>
                    <tr>
                        <td> क्र सं </td>
                        <td> सेवा </td>
                        <td> उमूह उप समूह </td>
                        <td> पद र श्रेणी </td>
                        <td> कार्यालयको नाम र ठेगाना </td>
                        <td> नयाँ नियुक्ति सरुवा बढुवा  </td>
                        <td> निर्णय मिति </td>
                        <td> बहाली मिति (हाजिरी मिति) </td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $key =>  $item)
                        {{-- @dd($item); --}}
                            <tr>
                                <td>{{nepali($key+1)}}</td>
                                <td>{{$item->services->name}}</td>
                                <td><br>{{$item->officeSubGroups}}</td>
                                <td><br>{{$item->positions->name}}</td>
                                <td>{{$item->office_name_address}}</td>
                                <td>
                                    @foreach ($appointments as $key => $value)
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

            <!--    ख ) शैक्षिक योग्यता       -->
            <div>
                <strong> ख ) शैक्षिक योग्यता </strong>
                <p style="text-align:right; float:right;"> फारम नं. ०३ </p>
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
                    @foreach ($educations as $key=> $item)
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

            <!--    ग) तालिम सेमिनार सम्मेलन सम्बन्धी विवरण       -->

            <div>
                <strong> ग ) तालिम / सेमिनार / सम्मेलन सम्बन्धी विवरण </strong>
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
                        @foreach ($trainings as $key => $item)
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

            <!--    घ) विभूषण, प्रशंसा पत्र र पुरस्कारको विवरण        -->
            <br>
            <div>
                <strong> घ) विभूषण, प्रशंसा पत्र र पुरस्कारको विवरण  </strong>
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
                    @foreach ($awards as $key => $item)
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

            <!--    ङ) विभागीय सजायको विवरण         -->
            <br>

            <div>
                <strong> ङ) विभागीय सजायको विवरण  </strong>
                <p style="text-align:right; float:right;"> फारम नं. ०५ </p>
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
                        @foreach ($punishment_data as $key => $item)
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

            <!--    च) बिदा र औषधी एपचारको विवरण        -->
            <br>
            <div style="overflow-y: scroll">
                <strong>च) बिदा र औषधी एपचारको विवरण  </strong>
                <p style="text-align:right; float:right;"> फारम नं. ०६ </p>
                {{-- <table class="table table_bordered">
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
                            <td>#</td>
                            <td> {{nepali( $leave_data["current_fiscal_year"]->name)}}</td>

                           <td>{{nepali( $leave_data['prev_ghar_leave_left'])}}</td>
                             <td>{{nepali($leave_data['total_ghar_bida_setting'])}}</td>
                            @php
                                $total_ghar_bida= $leave_data['prev_ghar_leave_left']+$leave_data['total_ghar_leave_left'];
                            @endphp
                            <td>{{nepali( $total_ghar_bida)}}</td>
                            <td>{{nepali($leave_data["current_ghar_bida_used"])}}</td>
                            <td>{{nepali($total_ghar_bida-$leave_data["current_ghar_bida_used"])}}</td>
                        
                            <td>{{nepali( $leave_data['total_birami_leave_left'])}}</td>
                            <td>{{nepali( $leave_data['total_birami_bida_setting'])}}</td>
                            @php
                                $total_birami_bida= $leave_data['total_birami_bida_setting']+$leave_data['total_birami_leave_left'];
                            @endphp
                            <td>{{nepali($total_birami_bida)}}</td>
                            <td>{{nepali($leave_data['current_birami_bida_used'])}}</td>  
                            <td>{{nepali($total_birami_bida-$leave_data['current_birami_bida_used'])}}</td>
                            <td>{{nepali($leave_data['total_prasuti_bida_setting'] )}}</td>
                            <td>{{nepali($leave_data['current_prasuti_bida_used'])}}</td>
                            <td>{{nepali($leave_data['total_prasuti_bida_setting']-$leave_data['current_prasuti_bida_used'] )}}</td>
                            <td>{{nepali($leave_data['total_adhyan_bida_setting'])}}</td>
                            <td>{{nepali($leave_data['current_adhyan_bida_used'])}}</td>
                            <td>{{nepali($leave_data['total_adhyan_bida_setting']-$leave_data['current_adhyan_bida_used'] )}}</td>
                            <td>{{nepali($leave_data['total_ashadharan_bida_setting'])}}</td>
                            <td>{{nepali($leave_data['current_asadharan_bida_used'])}}</td>
                            <td>{{nepali($leave_data['total_ashadharan_bida_setting']-$leave_data['current_asadharan_bida_used'] )}}</td>
                            <td>{{nepali($leave_data['total_betalawi_bida_setting'] )}}</td>
                            <td>{{nepali($leave_data['current_betalawi_bida_used'])}}</td>
                            <td>{{nepali($leave_data['total_betalawi_bida_setting']-$leave_data['current_betalawi_bida_used'] )}}</td>
                            <td>{{nepali($leave_data['total_gayal_bida_setting'])}}</td>
                            <td>{{nepali($leave_data['current_gayal_bida_used'])}}</td>
                            <td>{{nepali($leave_data['total_gayal_bida_setting']-$leave_data['current_gayal_bida_used'] )}}</td>    
                            <td>{{nepali($leave_data['total_kyabi_bida_setting'])}}</td>
                            <td>{{nepali($leave_data['current_kyabi_bida_used'])}}</td>
                            <td>{{nepali($leave_data['total_kyabi_bida_setting']-$leave_data['current_kyabi_bida_used'] )}}</td>
                            <td>{{nepali($leave_data['total_pabi_bida_setting'])}}</td>
                            <td>{{nepali($leave_data['current_pabi_bida_used'])}}</td>
                            <td>{{nepali($leave_data['total_pabi_bida_setting']-$leave_data['current_pabi_bida_used'] )}}</td>
                            <td></td>
                        </tr>
                   
                    
                    </tbody>
                </table> --}}

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
                                <td> {{nepali( $leave_data["current_fiscal_year"]->name)}}</td>
                                <td>{{nepali($leave_data ['prev_ghar_leave_left'])}}</td>
                                <td>{{nepali($leave_data['total_ghar_bida_setting'])}}</td>
                                @php
                                    $total_ghar_bida= $leave_data ['prev_ghar_leave_left'] + $leave_data['total_ghar_bida_setting'];
                                    @endphp
                                <td>{{nepali($total_ghar_bida)}}</td>
                                 <td>{{nepali($leave_data['current_ghar_bida_used'])}}</td>
                                <td>{{nepali($total_ghar_bida-$leave_data['current_ghar_bida_used'])}}</td>
                                <td>{{nepali($leave_data['prev_birami_leave_left'])}}</td>
                                <td>{{nepali($leave_data['total_birami_bida_setting'] )}}</td>
                                @php
                                    $total_birami_bida= $leave_data ['prev_birami_leave_left'] + $leave_data['total_birami_bida_setting'];
                                @endphp
                                <td>{{nepali($total_birami_bida)}}</td>
                               <td>{{nepali($leave_data['current_birami_bida_used'])}}</td>
                                <td>{{nepali($total_birami_bida-$leave_data['current_birami_bida_used'])}}</td>
                             <td>{{nepali($leave_data['total_prasuti_bida_setting'])}}</td>
                                <td>{{nepali($leave_data['current_prasuti_bida_used'])}}</td>
                                <td>{{nepali($leave_data['total_prasuti_bida_setting']-$leave_data['current_prasuti_bida_used'])}}</td>
                                 <td>{{nepali($leave_data['total_adhyan_bida_setting'])}}</td>
                                <td>{{nepali($leave_data['current_adhyan_bida_used'])}}</td>
                                <td>{{nepali($leave_data['total_adhyan_bida_setting']-$leave_data['current_adhyan_bida_used'] )}}</td>
                                   <td>{{nepali($leave_data['total_ashadharan_bida_setting'])}}</td>
                                <td>{{nepali($leave_data['current_asadharan_bida_used'])}}</td>
                                <td>{{nepali($leave_data['total_ashadharan_bida_setting']-$leave_data['current_asadharan_bida_used'] )}}</td>
                               <td>{{nepali($leave_data['total_betalawi_bida_setting'])}}</td>
                                <td>{{nepali($leave_data['current_betalawi_bida_used'])}}</td>
                                <td>{{nepali($leave_data['total_betalawi_bida_setting']-$leave_data['current_betalawi_bida_used'] )}}</td>
                                 <td>{{nepali($leave_data['total_gayal_bida_setting'])}}</td>
                                <td>{{nepali($leave_data['current_gayal_bida_used'])}}</td>
                                <td>{{nepali($leave_data['total_gayal_bida_setting']-$leave_data['current_gayal_bida_used'] )}}</td>   
                                <td>{{nepali($leave_data['total_kyabi_bida_setting'])}}</td>
                                <td>{{nepali($leave_data['current_kyabi_bida_used'])}}</td>
                                <td>{{nepali($leave_data['total_kyabi_bida_setting']-$leave_data['current_kyabi_bida_used'] )}}</td>
                               <td>{{nepali($leave_data['total_pabi_bida_setting'])}}</td>
                                <td>{{nepali($leave_data['current_pabi_bida_used'])}}</td>
                                <td>{{nepali($leave_data['total_pabi_bida_setting']-$leave_data['current_pabi_bida_used'] )}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                             
                            </tbody>
                </table>
            </div>

            <!--    छ) वर्गीकृत क्षेत्रहरुमा काम गरेको विवरण         -->
            <br>

            <div>
                <strong> छ) वर्गीकृत क्षेत्रहरुमा काम गरेको विवरण  </strong>
                <p style="text-align:right; float:right;"> फारम नं. ०७ </p>
                <table class="table table_bordered">
                    <thead>
                    <tr>
                        <td rowspan="2"> क्र सं </td>
                        <td colspan="2"> अवधि  </td>
                        <td rowspan="2"> पदस्थापना भएको स्थान वा क्षेत्र  </td>
                        <td rowspan="2"> काम गरेको स्थान वा क्षेत्र </td>
                        <td colspan="5"> यो चिन्ह (  ) दिई काम गरेको क्षेत्रको वर्ग जनाउने   </td>
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
                    @foreach ($works as $key => $item)
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

            <!--    ज ) माथि उल्लेख भए देखि बाहेकका विवरणहरु थपघट गर्नु पर्ने भए निजामती किताबखानाले भर्ने-->
            <div>
                <strong> ज ) माथि उल्लेख भए देखि बाहेकका विवरणहरु थपघट गर्नु पर्ने भए निजामती किताबखानाले भर्ने   </strong>
                <p style="text-align:right; float:right;"> फारम नं. ०८ </p>
                <div style="clear:both;">
                    <div style="height:100px; margin-left:25px;"> १) ठेगाना परिवर्तन सम्बन्धी विवरण </div>
                    <div style="height:100px; margin-left:25px;"> २) इच्छाइएको व्यक्ति परिवर्तन भएमा सो को विवरण  </div>
                    <div style="height:100px; margin-left:25px;"> ३) अन्य कुनै विवरण थपघट भएमा सो को विवरण  </div>
                </div>

            </div>



        </div>

       

    </div>
@endsection

@section('scripts')
<script>
    $("#printbtn").click(function () {
        $('#printbtn').hide();
        $('#backBtn').hide();
        window.print();
        $('#printbtn').show();
        $('#backBtn').show();
});
</script>
@endsection

