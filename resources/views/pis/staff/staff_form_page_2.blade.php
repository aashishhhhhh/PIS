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
            <h3 class="pull-left">ठेगाना सम्बन्धी विवरण
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td colspan="3" style="text-align: center;"><strong>स्थायी ठेगाना</strong></td>
                        <td colspan="2" style="text-align: center;"><strong>अस्थायी ठेगाना <div class="form-check">
                            <input onclick="checkbox()" class="form-check-input" type="checkbox" value="" id="address">
                            <label class="form-check-label" for="address">
                                स्थायी ठेगाना प्रतिलिपि गर्नुहोस
                            </label>
                          </div></strong></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: center;">नेपालीमा</td>
                        <td style="text-align: center;">अंग्रेजीमा</td>
                        <td style="text-align: center;">नेपालीमा</td>
                        <td style="text-align: center;">अंग्रेजीमा</td>
                    </tr>
                </thead>
              @if (isset($data))
                  
                <tbody>
                    <form action="{{route('page_2_submit')}}" method="POST">
                        @csrf
                        @isset($is_admin)
                           <input type="hidden" name="user" value="{{$user->id}}">
                           <input type="hidden" name="is_admin" value="{{$is_admin}}">
                        @endisset
                    <tr>
                        <td>प्रदेश: <i class="reqq">*</i></td>
                        <td>
                            <select id="p_province" name="p_province" class="form-control select2">
                                @foreach ($provinces as $province)
                                    @if ($data->p_province==$province->id)
                                        <option value="{{ $province->id }}" data-eng="{{ $province->name }}">
                                        {{ $province->nep_name }}</option>
                                    @endif
                                @endforeach
                                
                                @foreach ($provinces as $province)
                                    @if ($data->p_province!=$province->id)
                                        <option value="{{ $province->id }}" data-eng="{{ $province->name }}">
                                            {{ $province->nep_name }}</option>
                                   @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                                @foreach ($provinces as $province)
                                    @if ($data->p_province==$province->id)
                                    <input type="text" id="p_province_eng" class="form-control" value="{{$province->name}}" readonly>
                                    @endif
                                @endforeach
                        </td>
                        <td>
                            <input type="text" class="form-control" id="hidden_t_province" name="" value="" readonly>
                            <input type="hidden" class="form-control" id="hidden_t_province_org" name="t_province" value="" readonly>
                            <select id="t_province" name="t_province" class="form-control select2">
                                @foreach ($provinces as $province)
                                    @if ($data->t_province==$province->id)
                                        <option value="{{ $province->id }}" data-eng="{{ $province->name }}">
                                            {{ $province->nep_name }}</option>
                                    @endif
                                @endforeach
                                @foreach ($provinces as $province)
                                @if ($data->t_province!=$province->id)
                                    <option value="{{ $province->id }}" data-eng="{{ $province->name }}">
                                        {{ $province->nep_name }}</option>
                                 @endif
                                 @endforeach

                            </select>
                        </td>
                        <td>
                            @foreach ($provinces as $province)
                                @if ($data->t_province==$province->id)
                                <input type="text" id="t_province_eng" class="form-control" value="{{$province->name}}" readonly>
                                @endif
                            @endforeach
                            
                        </td>
                    </tr>
                    <tr>
                        <td>जिल्ला: <i class="reqq">*</i></td>
                        <td>
                            <select id="p_district" name="p_district" class="form-control select2">
                                @foreach ($districts as $item)
                                @if ($data->p_district==$item->id)
                                    <option value="{{$item->id}}">{{$item->name}} </option>
                                @endif
                                @endforeach
                                @foreach ($districts as $item)
                                @if ($data->p_district!=$item->id)
                                    <option value="{{$item->id}}">{{$item->name}} </option>
                                @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            @foreach ($districts as $district)
                                @if ($data->p_district==$district->id)
                                <input type="text" id="p_district_eng" class="form-control" value="{{$district->name}}" readonly>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <input type="text" class="form-control" id="hidden_t_district" name="" value="" readonly>
                            <input type="hidden" class="form-control" id="hidden_t_district_org" name="t_district" value="" readonly>
                            <select id="t_district" name="t_district" class="form-control select2">
                                @foreach ($districts as $item)
                                    @if ($data->t_district==$item->id)
                                        <option value="{{$item->id}}">{{$item->name}} </option>
                                    @endif
                                @endforeach
                                @foreach ($districts as $item)
                                    @if ($data->t_district!=$item->id)
                                        <option value="{{$item->id}}">{{$item->name}} </option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            @foreach ($districts as $district)
                            @if ($data->t_district==$district->id)
                            <input type="text" id="t_district_eng" class="form-control" value="{{$district->name}}" readonly>
                            @endif
                        @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>न.पा./गा.वि.सं.: <i class="reqq">*</i></td>
                        <td>
                            <select id="p_municipality" name="p_municipality" class="form-control select2">
                                @foreach ($municipalities as $item)
                                @if ($data->p_municipality==$item->id)
                                    <option value="{{$item->id}}">{{$item->nep_name}} </option>
                                @endif
                            @endforeach
                            @foreach ($municipalities as $item)
                                @if ($data->p_municipality!=$item->id)
                                    <option value="{{$item->id}}">{{$item->nep_name}} </option>
                                @endif
                            @endforeach
                            </select>
                        </td>
                        <td>
                            @foreach ($municipalities as $item)
                                @if ($data->p_municipality==$item->id)
                            <input type="text" id="p_municipality_eng" class="form-control" value="{{$item->name}}" readonly>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <input type="text" class="form-control" id="hidden_t_municipality" name="" value="" readonly>
                            <input type="hidden" class="form-control" id="hidden_t_municipality_org" name="t_municipality" value="" readonly>
                            <select id="t_municipality" name="t_municipality" class="form-control select2">
                                @foreach ($municipalities as $item)
                                @if ($data->t_municipality==$item->id)
                                    <option value="{{$item->id}}">{{$item->nep_name}} </option>
                                @endif
                            @endforeach
                            @foreach ($municipalities as $item)
                                @if ($data->t_municipality!=$item->id)
                                    <option value="{{$item->id}}">{{$item->nep_name}} </option>
                                @endif
                            @endforeach
                            </select>
                        </td>
                        <td>
                            @foreach ($municipalities as $item)
                            @if ($data->t_municipality==$item->id)
                                <input type="text" id="t_municipality_eng" class="form-control" value="{{$item->name}}" readonly>
                            @endif
                             @endforeach
                        </td>
                        
                    </tr>
                    <tr>
                        <td>वडा नं.: </td>
                        <td>
                            <input type="text" id="p_ward_nep" name="p_ward_nep" class="form-control" value="{{isset($data->p_ward_nep ) ? $data->p_ward_nep : ''}}" readonly>
                        </td>
                        <td>
                            <input type="number" min="0" id="p_ward" name="p_ward" class="form-control" value="{{isset($data->p_ward ) ? $data->p_ward : ''}}">
                        </td>
                        <td>
                            <input type="text" id="t_ward_nep" name="t_ward_nep" class="form-control" value="{{isset($data->t_ward_nep ) ? $data->t_ward_nep : ''}}" readonly>
                        </td>
                        <td>
                            <input type="number" min="0" id="t_ward" name="t_ward" class="form-control" value="{{isset($data->t_ward ) ? $data->t_ward : ''}}">
                        </td>
                    </tr>
                    <tr>
                        <td>टोल/मार्ग: </td>
                        <td>
                            <input type="text" id="p_tole_nep" name="p_tole_nep" class="form-control" value="{{isset($data->p_tole_nep ) ? $data->p_tole_nep : ''}}">
                        </td>
                        <td>
                            <input type="text" id="p_tole" name="p_tole" class="form-control" value="{{isset($data->p_tole ) ? $data->p_tole : ''}}">
                        </td>
                        <td>
                            <input type="text" id="t_tole_nep" name="t_tole_nep" class="form-control" value="{{isset($data->t_tole_nep ) ? $data->t_tole_nep : ''}}">
                        </td>
                        <td>
                            <input type="text" id="t_tole" name="t_tole" class="form-control" value="{{isset($data->t_tole ) ? $data->t_tole : ''}}">
                        </td>
                    </tr>
                    <tr>
                        <td>घर/व्लक नं.: </td>
                        <td>
                            <input type="text" id="p_house_no_nep" name="p_house_no_nep" class="form-control" value="{{isset($data->p_house_no_nep ) ? $data->p_house_no_nep : ''}}">
                        </td>
                        <td>
                            <input type="text" id="p_house_no" name="p_house_no" class="form-control" value="{{isset($data->p_house_no ) ? $data->p_house_no : ''}}">
                        </td>
                        <td>
                            <input type="text" id="t_house_no_nep" name="t_house_no_nep" class="form-control" value="{{isset($data->t_house_no_nep ) ? $data->t_house_no_nep : ''}}">
                        </td>
                        <td>
                            <input type="text" id="t_house_no" name="t_house_no" class="form-control" value="{{isset($data->t_house_no ) ? $data->t_house_no : ''}}">
                        </td>
                    </tr>
                    <tr>
                        <td>सम्पर्क फोन/मो.नं.: </td>
                        <td colspan="2">
                            <input type="text" id="p_contact" name="p_contact" class="form-control" value="{{isset($data->p_contact ) ? $data->p_contact : ''}}">
                        </td>
                        <td colspan="2">
                            <input type="text" id="t_contact" name="t_contact" class="form-control" value="{{isset($data->t_contact ) ? $data->t_contact : ''}}">
                        </td>
                    </tr>
                    <tr>
                        <td>ईमेल ठेगाना: <span id="email_check"></span></td>
                        <td colspan="4">
                            <input type="text" id="email" name="email" class="form-control" value="{{isset($data->email ) ? $data->email : ''}}">
                        </td>
                    </tr>
                </tbody>

                @else

                <tbody>
                    <form action="{{route('page_2_submit')}}" method="POST">
                        @csrf
                    <tr>
                        <td>प्रदेश: <i class="reqq">*</i></td>
                        <td>
                            <select id="p_province" name="p_province" class="form-control select2">
                                <option value="" data-eng="">छान्नुहोस्</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" data-eng="{{ $province->name }}">
                                        {{ $province->nep_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" id="p_province_eng" class="form-control" value="" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="hidden_t_province" name="" value="" readonly>
                            <input type="hidden" class="form-control" id="hidden_t_province_org" name="t_province" value="" readonly>
                            
                            <select id="t_province" name="t_province" class="form-control select2">
                                <option value="" data-eng="">छान्नुहोस्</option>
                                @foreach ($provinces as $province)
                                <option value="{{ $province->id }}" data-eng="{{ $province->name }}">
                                    {{ $province->nep_name }}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" id="t_province_eng" class="form-control" value="" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>जिल्ला: <i class="reqq">*</i></td>
                        <td>
                            <select id="p_district" name="p_district" class="form-control select2">
                                <option value="" data-eng="">छान्नुहोस्</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" id="p_district_eng" class="form-control" value="" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="hidden_t_district" name="" value="" readonly>
                            <input type="hidden" class="form-control" id="hidden_t_district_org" name="t_district" value="" readonly>
                            <select id="t_district" name="t_district" class="form-control select2">
                                <option value="" data-eng="">छान्नुहोस्</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" id="t_district_eng" class="form-control" value="" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>न.पा./गा.वि.सं.: <i class="reqq">*</i></td>
                        <td>
                            <select id="p_municipality" name="p_municipality" class="form-control select2">
                                <option value="" data-eng="">छान्नुहोस्</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" id="p_municipality_eng" class="form-control" value="" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="hidden_t_municipality" name="" value="" readonly>
                            <input type="hidden" class="form-control" id="hidden_t_municipality_org" name="t_municipality" value="" readonly>
                            <select id="t_municipality" name="t_municipality" class="form-control select2">
                                <option value="" data-eng="">छान्नुहोस्</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" id="t_municipality_eng" class="form-control" value="" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>वडा नं.:<i class="reqq">*</i> </td>
                        <td>
                            <input type="text" id="p_ward_nep" class="form-control" value="" readonly>
                        </td>
                        <td>
                            <input type="number" min="0" id="p_ward" name="p_ward" class="form-control" value="">
                        </td>
                        <td>
                            <input type="text" id="t_ward_nep" class="form-control" value="" readonly>
                        </td>
                        <td>
                            <input type="number" min="0" id="t_ward" name="t_ward" class="form-control" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>टोल/मार्ग: </td>
                        <td>
                            <input type="text" id="p_tole_nep" name="p_tole_nep" class="form-control" value="" >
                        </td>
                        <td>
                            <input type="text" id="p_tole" name="p_tole" class="form-control" value="">
                        </td>
                        <td>
                            <input type="text" id="t_tole_nep" name="t_tole_nep" class="form-control" value="" >
                        </td>
                        <td>
                            <input type="text" id="t_tole" name="t_tole" class="form-control" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>घर/व्लक नं.: </td>
                        <td>
                            <input type="text" id="p_house_no_nep" name="p_house_no_nep" class="form-control" value="" readonly>
                        </td>
                        <td>
                            <input type="text" id="p_house_no" name="p_house_no" class="form-control" value="">
                        </td>
                        <td>
                            <input type="text" id="t_house_no_nep" name="t_house_no_nep" class="form-control" value="" readonly>
                        </td>
                        <td>
                            <input type="text" id="t_house_no" name="t_house_no" class="form-control" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>सम्पर्क फोन/मो.नं.: </td>
                        <td colspan="2">
                            <input type="text" id="p_contact" name="p_contact" class="form-control" value="">
                        </td>
                        <td colspan="2">
                            <input type="text" id="t_contact" name="t_contact" class="form-control" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>ईमेल ठेगाना: <span id="email_check"></span></td>
                        <td colspan="4">
                            <input type="text" id="email" name="email" class="form-control" value="">
                        </td>
                    </tr>
                </tbody>
                @endif

            </table>

        </div>
        <div class="card-footer" style="text-align: center">
            <a href="{{route('staff_form')}}"  class="btn btn-success"><i class="fas fa-angle-double-left"></i> Previous</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save & Next</button>
            <a href="{{route('page_3_show')}}" class="btn btn-warning"><i class="fas fa-angle-double-right"></i> Next</a>
        </div>
    </form>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('#hidden_t_province').hide();
            $('#hidden_t_district').hide();
            $('#hidden_t_municipality').hide();
            $(".select2").select2();

            function dataEngChange(ele_id) {
                var nep_ele = $('#' + ele_id).find(":selected");
                var nep = nep_ele.val();
                if (nep != '') {
                    var eng = nep_ele.attr('data-eng');
                    $('#' + ele_id + '_eng').val(eng);
                }
            }

            function pDistrictChange(type) {
                var province = '';
                if (type == 1) {
                    $('#p_district_eng').val('');
                    $('#p_municipality_eng').val('');
                    dataEngChange('p_province');
                    province = $('#p_province').val();
                } else {
                    $('#t_district_eng').val('');
                    $('#t_municipality_eng').val('');
                    dataEngChange('t_province');
                    province = $('#t_province').val();
                }
                if (province != '') {
                    axios.get("{{ route('address.district') }}", {
                            params: {
                                id: province
                            }
                        }).then(function(response) {
                            console.log(response);
                            var html = '<option value="">छान्नुहोस्</option>';
                            var selected = '';
                            var rows = response.data;
                            $.each(rows, function(key, value) {
                                html += '<option value="' + value.id + '" data-eng="' + value.name +
                                    '" ' + selected + '>' + value.nep_name +
                                    '</option>';
                            });
                            if (type == 1) {
                                $('#p_district').html(html);
                                $('#p_district').select2();
                            } else {
                                $('#t_district').html(html);
                                $('#t_district').select2();

                            }

                        })
                        .catch(function(error) {
                            console.log(error);;
                        });
                } else {
                    var html = '<option value="">छान्नुहोस्</option>';
                    if (type == 1) {
                        $('#p_district').html(html);
                        $('#p_district').select2();
                    } else {
                        $('#t_district').html(html);
                        $('#t_district').select2();
                    }
                }
            }

            function pMunicipalityChange(type) {
                var district = '';
                if (type == 1) {
                    $('#p_municipality_eng').val('');
                    dataEngChange('p_district');
                    var district = $('#p_district').val();
                } else {
                    $('#t_municipality_eng').val('');
                    dataEngChange('t_district');
                    var district = $('#t_district').val();
                }

                if (district != '') {
                    axios.get("{{ route('address.municipality') }}", {
                            params: {
                                id: district
                            }
                        }).then(function(response) {
                            console.log(response);
                            var html = '<option value="">छान्नुहोस्</option>';
                            var selected = '';
                            var rows = response.data;
                            $.each(rows, function(key, value) {
                                html += '<option value="' + value['id'] + '" data-eng="' + value[
                                        'name'] + '" ' + selected + '>' + value['nep_name'] +
                                    '</option>';
                            });
                            if (type == 1) {
                                $('#p_municipality').html(html);
                                $('#p_municipality').select2();
                            } else {
                                $('#t_municipality').html(html);
                                $('#t_municipality').select2();
                            }

                        })
                        .catch(function(error) {
                            console.log(error);;
                        });
                } else {
                    var html = '<option value="">छान्नुहोस्</option>';
                    if (type == 1) {
                        $('#p_municipality').html(html);
                        $('#p_municipality').select2();
                    } else {
                        $('#t_municipality').html(html);
                        $('#t_municipality').select2();
                    }
                }

            }

            $('#p_province').on('change', function() {
                pDistrictChange(1);
            });
            $('#t_province').on('change', function() {
                pDistrictChange(2);
            });

            $('#p_district').on('change', function() {
                pMunicipalityChange(1);
            });
            $('#t_district').on('change', function() {
                pMunicipalityChange(2);
            });
            $('#p_municipality').on('change', function() {
                dataEngChange('p_municipality');
            });
            $('#t_municipality').on('change', function() {
                dataEngChange('t_municipality');
            });

            function wardChange(ele_id) {
                var eng = $('#' + ele_id).val();
                if (eng != '') {
                    $('#' + ele_id + '_nep').val(convertToNepaliNumber(eng));
                } else {
                    $('#' + ele_id + '_nep').val('');
                }
            }

            $('#p_ward').on('input', function() {
                wardChange('p_ward');
            });

            $('#t_ward').on('input', function() {
                wardChange('t_ward');
            });

            
            // $('#p_tole').on('input', function() {
            //     wardChange('p_tole');
            // });

            // $('#t_tole').on('input', function() {
            //     wardChange('t_tole');
            // });

            
            $('#p_house_no').on('input', function() {
                wardChange('p_house_no');
            });

            $('#t_house_no').on('input', function() {
                wardChange('t_house_no');
            });

            
            $('#email').on('input', function() {
                $(this).val($(this).val().replace(/\s+/g, ''));
            });


        });
    </script>
    <script>
        function checkbox()
        {
            if($("#address").is(':checked'))
            {
               let p = $('#p_province').val();
                var app = @json($provinces, JSON_PRETTY_PRINT);
               if (p!='') {
                $.each(app, function(key, value) {
                            if (value.id==p) {
                                $('#t_province_eng').val(value.name);
                                $('#hidden_t_province').show();
                                $('#hidden_t_province').val(value.nep_name);
                                $('#hidden_t_province_org').val(p);
                                $("#t_province").select2().next().hide();
                                $("#t_province").removeAttr('name');
                                // options.append($("<option />").val(value.id).text(value.nep_name));
                            }
                            });
                        }
                        let district = $('#p_district').val();
            if (district!='') {
                axios.get("{{ route('address.district') }}", {
                    params: {
                        id: p
                    }
                        }).then(function(response) {
                            $.each(response.data, function(key, value) {
                                if (value.id==district) {
                                    $('#t_district_eng').val(value.name);
                                $('#hidden_t_district').show();
                                $('#hidden_t_district').val( value.nep_name);
                                $('#hidden_t_district_org').val(district);
                                $("#t_district").select2().next().hide();
                                $("#t_district").removeAttr('name');

                                
                                // options.append($("<option />").val(value.id).text(value.nep_name));
                            }
                            });
                            
                        })
            }
            let ward = $('#p_ward').val()
            if (ward!='') {
                ward_nep = $('#p_ward_nep').val();
                // $('#t_ward_nep').attr("placeholder", "Refine Your Search");
                $('#t_ward_nep').val(ward_nep);
                $('#t_ward').val(ward);
            }

            let tole = $('#p_tole').val();
            if (tole!='') {
                $('#t_tole').val(tole)
            }

            let tole_nep = $('#p_tole_nep').val();
            if (tole_nep!='') {
                $('#t_tole_nep').val(tole_nep)
            }


            p_house_no = $('#p_house_no').val();
            if (p_house_no!='') {
                p_house_no_nep = $('#p_house_no_nep').val();
                $('#t_house_no_nep').val(p_house_no_nep)
                $('#t_house_no').val(p_house_no)
            }

            let p_contact= $('#p_contact').val()
            if (p_contact!='') {
                $('#t_contact').val(p_contact);
            }
            

            let municipality = $('#p_municipality').val();
            if (municipality!='') {
                axios.get("{{ route('address.municipality') }}", {
                            params: {
                                id: district
                            }
                        }).then(function(response) {
                            $.each(response.data, function(key, value) {
                            if (value.id==municipality) {
                                $('#t_municipality_eng').val(value.name);
                                $('#hidden_t_municipality').show();
                                $('#hidden_t_municipality_org').val(municipality);
                                $('#hidden_t_municipality').val(value.nep_name);
                                jQuery("#t_municipality").select2().next().hide();
                                jQuery("#t_municipality").removeAttr('name');

                                
                                // options.append($("<option />").val(value.id).text(value.nep_name));
                            }
                            });
                        })
            }
           
        }
            else
            {
                
            }
        }

    </script>
@endsection
