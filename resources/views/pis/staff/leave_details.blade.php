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
<div class="card-footer" style="text-align: center">
    <a href="{{route('page_12_show')}}"  class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save & Next</button>
    <a href="{{route('page_14_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
</div>
</div>

@endsection
