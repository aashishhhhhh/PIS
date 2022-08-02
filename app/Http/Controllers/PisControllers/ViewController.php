<?php

namespace App\Http\Controllers\PisControllers;

use App\Http\Controllers\Controller;
use App\Models\PisModel\settingLeave;
use App\Models\PisModel\SettingValues;
use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffAddress;
use App\Models\PisModel\StaffAppointment;
use App\Models\PisModel\StaffAward;
use App\Models\PisModel\StaffDetail;
use App\Models\PisModel\StaffEducation;
use App\Models\PisModel\StaffLanguage;
use App\Models\PisModel\StaffLeaveApplication;
use App\Models\PisModel\StaffPrevAppointment;
use App\Models\PisModel\StaffProfile;
use App\Models\PisModel\StaffPunishment;
use App\Models\PisModel\StaffService;
use App\Models\PisModel\StaffTraining;
use App\Models\PisModel\StaffWork;
use App\Models\SharedModel\District;
use App\Models\SharedModel\FiscalYear;
use App\Models\SharedModel\Municipality;
use App\Models\SharedModel\Province;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    private $_bs = array(
        // 0 => array(2000, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 1 => array(2001, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 2 => array(2002, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 3 => array(2003, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 4 => array(2004, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 5 => array(2005, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 6 => array(2006, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 7 => array(2007, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 8 => array(2008, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31),
        // 9 => array(2009, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 10 => array(2010, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 11 => array(2011, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 12 => array(2012, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        // 13 => array(2013, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 14 => array(2014, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 15 => array(2015, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 16 => array(2016, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        // 17 => array(2017, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 18 => array(2018, 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 19 => array(2019, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 20 => array(2020, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        // 21 => array(2021, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 22 => array(2022, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        // 23 => array(2023, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 24 => array(2024, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        // 25 => array(2025, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 26 => array(2026, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 27 => array(2027, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 28 => array(2028, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 29 => array(2029, 31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30),
        // 30 => array(2030, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 31 => array(2031, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 32 => array(2032, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 33 => array(2033, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 34 => array(2034, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 35 => array(2035, 30, 32, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31),
        // 36 => array(2036, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 37 => array(2037, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 38 => array(2038, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 39 => array(2039, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        40 => array(2040, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        41 => array(2041, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        42 => array(2042, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        43 => array(2043, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        44 => array(2044, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        45 => array(2045, 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        46 => array(2046, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        47 => array(2047, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        48 => array(2048, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        49 => array(2049, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        50 => array(2050, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        51 => array(2051, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        52 => array(2052, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        53 => array(2053, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        54 => array(2054, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        55 => array(2055, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        56 => array(2056, 31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30),
        57 => array(2057, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        58 => array(2058, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        59 => array(2059, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        60 => array(2060, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        61 => array(2061, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        62 => array(2062, 30, 32, 31, 32, 31, 31, 29, 30, 29, 30, 29, 31),
        63 => array(2063, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        64 => array(2064, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        65 => array(2065, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        66 => array(2066, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31),
        67 => array(2067, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        68 => array(2068, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        69 => array(2069, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        70 => array(2070, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        71 => array(2071, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        72 => array(2072, 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        73 => array(2073, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        74 => array(2074, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        75 => array(2075, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        76 => array(2076, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        77 => array(2077, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        78 => array(2078, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        79 => array(2079, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        80 => array(2080, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        // 81 => array(2081, 31, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        // 82 => array(2082, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        // 83 => array(2083, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
        // 84 => array(2084, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
        // 85 => array(2085, 31, 32, 31, 32, 30, 31, 30, 30, 29, 30, 30, 30),
        // 86 => array(2086, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        // 87 => array(2087, 31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30),
        // 88 => array(2088, 30, 31, 32, 32, 30, 31, 30, 30, 29, 30, 30, 30),
        // 89 => array(2089, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        // 90 => array(2090, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30)
    );

    private $_genders = array('female' => 'महिला', 'male' => 'पुरुष');
    private $_sources = array('1' => 'हिमाली', '2' => 'पहाडी', '3' => 'तराई/मधेश');
    private $_divisions = array('1' => 'क', '2' => 'ख', '3' => 'ग', '4' => 'घ', '5' => 'ङ', '6' => 'खुला', '7' => 'महिला');
    private $_technicals = array('1' => 'प्राविधिक', '2' => 'अप्राविधिक');
    private $_countries = array('usa' => 'आमेरिका', 'japan' => 'जापान', 'canada' => 'क्यानेडा', 'uk' => 'बेलायत');
    private $_appoints = array('1' => 'नयाँ नियुक्ति', '2' => 'सरुवा', '3' => 'बढुवा');
    private $_yns = array('1' => 'छ', '0' => 'छैन');
    private $_yn2s = array('1' => 'हो', '0' => 'होइन');
    private $_appoinments = array('1' => 'नयाँ नियुक्ति', '2' => 'नयाँ नियुक्ति सरुवा ', '3' => ' सरुवा बढुवा', '4' => 'बढुवा');





    private $setup_office_groups = 'setup_office_groups';
    private $setup_office_subgroups = 'setup_office_subgroups';
    private $setup_ethnicities = 'setup_ethnicities';
    private $setup_staff_category = 'setup_staff_category';
    private $setup_staff_subcategory = 'setup_staff_subcategory';
    private $setup_religions = 'setup_religions';
    private $setup_physicals = 'setup_physicals';
    private $setup_faces = 'setup_faces';
    private $setup_bgroups = 'setup_bgroups';
    private $setup_occupations = 'setup_occupations';
    private $setup_languages = 'setup_languages';
    private $setup_f_languages = 'setup_f_languages';
    private $setup_services = 'setup_services';
    private $setup_levels = 'setup_levels';
    private $setup_positions = 'setup_positions';
    private $setup_edu_qualifications = 'setup_edu_qualifications';
    private $setup_edu_subjects = 'setup_edu_subjects';
    private $setup_edu_positions = 'setup_edu_positions';
    private $setup_edu_institutes = 'setup_edu_institutes';
    private $setup_punishments = 'setup_punishments';


    private function get__current_fiscal_year()
    {
        return FiscalYear::query()->where('is_current', 1)->first();
    }

    private function get_setting($slug)
    {
        $setting = Setting::where(['slug' => $slug, 'is_deleted' => false])->first();
        return SettingValue::where(['setting_id' => $setting->id, 'is_deleted' => false])->get();
    }

    public function get_setup_staff_sub_category(Request $request)
    {
        $id = $request->id;
        $data = SettingValue::where(['cascading_parent_id' => $id, 'is_deleted' => false])->get();
        return response()->json($data);
    }

    public function get_local_lang()
    {
        $languages = $this->get_setting($this->setup_languages);
        return response()->json($languages);
    }

    public function view_form1(User $user)
    {
        // if (auth()->user()->hasRole('cao') == false && auth()->user()->hasRole('admin') == false) {
        //     return redirect()->back()->with('msg', 'स्वीकृत भैसक्यो');
        // }

        $staff_form1 = Staff::query()->where('user_id', $user->id)->first();
        $appoinments = $this->_appoinments;
        $countries = $this->_countries;
        $districts = District::all();
        $occupations = $this->get_setting($this->setup_occupations);
        $staff_sub_cat = SettingValue::query()->where('setting_id', 5)->get();
        $staff_categories = $this->get_setting($this->setup_staff_category);
        $provinces = Province::all();
        $municipalities = Municipality::all();
        $physicals = $this->get_setting($this->setup_physicals);
        $religions = $this->get_setting($this->setup_religions);
        $ethnicities = $this->get_setting($this->setup_ethnicities);
        $faces = $this->get_setting($this->setup_faces);
        $bgroups = $this->get_setting($this->setup_bgroups);
        $genders = $this->_genders;
        return view('pis.staff.staff_detail_list', [
            'staff_form1' => $staff_form1,
            'user' => $user,
            'districts' => $districts,
            'occupations' => $occupations,
            'staff_categories' => $staff_categories,
            'staff_sub_cat' => $staff_sub_cat,
            'municipalities' => $municipalities,
            'provinces' => $provinces,
            'physicals' => $physicals,
            'municiplalities' => $municipalities,
            'religions' => $religions,
            'ethnicities' => $ethnicities,
            'faces' => $faces,
            'bgroups' => $bgroups,
            'genders' => $genders,
        ]);
    }

    public function edit_form1($id)
    {

        $is_admin = 1;
        $staff = Staff::where('user_id', $id)->first();
        if ($staff != null) {
            if ($staff->is_approved == 1) {
                return redirect()->back()->with('msg', 'स्विक्र्त भैसक्यो');
            }
        }
        $districts = District::select('id', 'name', 'nep_name')->get();
        $staff_categories = $this->get_setting($this->setup_staff_category);
        $occupations = $this->get_setting($this->setup_occupations);
        $user = auth()->user();
        $data = Staff::where('user_id', $id)->first();
        $staff_sub_cat = SettingValue::query()->where('setting_id', 5)->get();
        return view('pis.staff.staff_form_page_1', [
            'districts' => $districts,
            'staff_categories' => $staff_categories,
            'occupations' => $occupations,
            'data' => $data,
            'staff_sub_cat' => $staff_sub_cat,
            'is_admin' => $is_admin,
            'user_id' => $id
        ]);
    }

    public function view_form2(User $user)
    {
        $provinces = Province::get();
        $districts = District::get();
        $municipalities = Municipality::get();
        $staff_form2 = StaffAddress::where('user_id', $user->id)->first();
        return view('pis.staff.staff_detail_list', [
            'provinces' => $provinces,
            'districts' => $districts,
            'municipalities' => $municipalities,
            'staff_form2' => $staff_form2,
            'user' => $user
        ]);
    }

    public function edit_form2($id)
    {
        $provinces = Province::get();
        $districts = District::get();
        $municipalities = Municipality::get();
        $user = User::query()->where('id', $id)->first();
        $data = StaffAddress::where('user_id', $user->id)->first();
        return view('pis.staff.staff_form_page_2', [
            'provinces' => $provinces,
            'districts' => $districts,
            'municipalities' => $municipalities,
            'data' => $data,
            'user' => $user,
            'is_admin' => 1
        ]);
    }

    public function view_form3(User $user)
    {
        $physicals = $this->get_setting($this->setup_physicals);
        $religions = $this->get_setting($this->setup_religions);
        $ethnicities = $this->get_setting($this->setup_ethnicities);
        $faces = $this->get_setting($this->setup_faces);
        $bgroups = $this->get_setting($this->setup_bgroups);
        $staff_form_page_3_data = '';
        $staff_form3 = StaffProfile::where('user_id', $user->id)->first();
        return view('pis.staff.staff_detail_list', [
            'religions' => $religions,
            'ethnicities' => $ethnicities,
            'faces' => $faces,
            'bgroups' => $bgroups,
            'physicals' => $physicals,
            'genders' => $this->_genders,
            'sources' => $this->_sources,
            'divisions' => $this->_divisions,
            'user' => $user,
            'staff_form3' => $staff_form3,
            'staff_form_page_3_data' => $staff_form_page_3_data,
        ]);
    }

    public function edit_form3($id)
    {
        $user = User::query()->where('id', $id)->first();
        $physicals = $this->get_setting($this->setup_physicals);
        $religions = $this->get_setting($this->setup_religions);
        $ethnicities = $this->get_setting($this->setup_ethnicities);
        $faces = $this->get_setting($this->setup_faces);
        $bgroups = $this->get_setting($this->setup_bgroups);
        $staff_form_page_3_data = '';
        $data = StaffProfile::where('user_id', $user->id)->first();
        return view('pis.staff.staff_form_page_3', [
            'religions' => $religions,
            'ethnicities' => $ethnicities,
            'faces' => $faces,
            'bgroups' => $bgroups,
            'physicals' => $physicals,
            'genders' => $this->_genders,
            'sources' => $this->_sources,
            'divisions' => $this->_divisions,
            'data' => $data,
            'staff_form_page_3_data' => $staff_form_page_3_data,
            'user' => $user,
            'is_admin' => 1
        ]);
    }

    public function view_form4(User $user)
    {
        $languages = $this->get_setting($this->setup_languages);
        $foreign_languages = $this->get_setting($this->setup_f_languages);
        $foreign_data = StaffLanguage::query()->where('user_id', $user->id)->with('languages')->where('type', 'foreign')->get();
        $local_data = StaffLanguage::query()->where('user_id', $user->id)->with('languages')->where('type', 'local')->get();
        $data = StaffLanguage::query()->where('user_id', $user->id)->get();
        $staffLanguage = StaffProfile::query()->with('languages')->where('user_id', $user->id)->first();

        return view('pis.staff.staff_detail_list', [
            'languages' => $languages,
            'foreign_languages' => $foreign_languages,
            'foreign_data' => $foreign_data,
            'local_data' => $local_data,
            'staffLanguage' => $staffLanguage,
            'staff_form4' => 1,
            'user' => $user
        ]);
    }

    public function edit_form4($id)
    {
        $user = User::query()->where('id', $id)->first();
        $languages = $this->get_setting($this->setup_languages);
        $foreign_languages = $this->get_setting($this->setup_f_languages);
        $foreign_data = StaffLanguage::query()->where('user_id', $id)->with('languages')->where('type', 'foreign')->get();
        $local_data = StaffLanguage::query()->where('user_id', $id)->with('languages')->where('type', 'local')->get();
        $data = StaffLanguage::query()->where('user_id', $id)->get();
        $staffLanguage = StaffProfile::query()->where('user_id', $id)->first();

        return view('pis.staff.edit_staff_form_page_4', [
            'languages' => $languages,
            'foreign_languages' => $foreign_languages,
            'foreign_data' => $foreign_data,
            'local_data' => $local_data,
            'staffLanguage' => $staffLanguage,
            'is_admin' => 1,
            'user_id' => $user->id
        ]);
    }

    public function view_form5(User $user)
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups = $this->get_setting($this->setup_office_groups);
        $staff_form5 = StaffAppointment::query()
            ->with([
                'services', 'levels', 'positions'
            ])
            ->where('user_id', $user->id)->first();
        return view('pis.staff.staff_detail_list', [
            'services' => $services,
            'levels' => $levels,
            'positions' => $positions,
            'officeGroups' => $officeGroups,
            'staff_form5' => $staff_form5,
            'user' => $user
        ]);
    }

    public function edit_form5($id)
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups = $this->get_setting($this->setup_office_groups);
        $data = StaffAppointment::query()->where('user_id', $id)->get();
        $user = User::query()->where('id', $id)->first();
        return view('pis.staff.staff_form_page_5', [
            'services' => $services,
            'levels' => $levels,
            'positions' => $positions,
            'officeGroups' => $officeGroups,
            'data' => $data,
            'user' => $user,
            'is_admin' => 1
        ]);
    }

    public function view_form6(User $user)
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups = $this->get_setting($this->setup_office_groups);
        $staff_form6 = StaffPrevAppointment::query()
            ->with([
                'services', 'levels', 'positions',
                'officeGroups',
                'officeSubGroups'
            ])
            ->where('user_id', $user->id)->first();
        return view('pis.staff.staff_detail_list', [
            'services' => $services, 'levels' => $levels, 'positions' => $positions, 'officeGroups' => $officeGroups, 'staff_form6' => $staff_form6, 'user' => $user
        ]);
    }

    public function edit_form6($id)
    {
        $user = User::query()->where('id', $id)->first();
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups = $this->get_setting($this->setup_office_groups);
        $data = StaffPrevAppointment::query()->where('user_id', $id)->get();
        return view('pis.staff.staff_form_page_6', [
            'services' => $services,
            'levels' => $levels,
            'positions' => $positions,
            'officeGroups' => $officeGroups,
            'data' => $data,
            'is_admin' => 1,
            'user' => $user
        ]);
    }

    public function view_form7(User $user)
    {
        $staff_form7 = StaffDetail::query()->where('user_id', $user->id)->first();
        return view('pis.staff.staff_detail_list', ['countries' => $this->_countries, 'staff_form7' => $staff_form7, 'user' => $user]);
    }

    public function edit_form7($id)
    {
        $user = User::query()->where('id', $id)->first();
        $staff_form8 = StaffDetail::query()->where('user_id', $user->id)->get();
        dd($staff_form8);
        return view(
            'pis.staff.staff_form_page_7',
            [
                'countries' => $this->_countries,
                'staff_form8' => $staff_form8,
                'is_admin' => 1,
                'user' => $user
            ]
        );
    }

    public function view_form8(User $user)
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroup = $this->get_setting($this->setup_office_groups);
        $staff_form8 = StaffService::query()->where('user_id', $user->id)
            ->with([
                'officeGroups',
                'levels',
                'positions',
                'services'
            ])
            ->get();

        return view('pis.staff.staff_detail_list', [
            'appoints' => $this->_appoinments,
            'services' => $services,
            'levels' => $levels,
            'positions' => $positions,
            'officeGroup' => $officeGroup,
            'staff_form8' => $staff_form8,
            'user' => $user
        ]);
    }

    public function edit_form8($id)
    {
        $user = User::query()->where('id', $id)->first();
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups = $this->get_setting($this->setup_office_groups);
        $data = StaffService::query()->where('user_id', $user->id)->get();


        return view('pis.staff.edit_staff_form_page_8', [
            'appoints' => $this->_appoinments,
            'services' => $services,
            'levels' => $levels,
            'positions' => $positions,
            'officeGroups' => $officeGroups,
            'data' => $data,
            'is_admin' => 1,
            'user' => $user
        ]);
    }

    public function view_form9(User $user)
    {
        $staff_form9 = StaffEducation::query()
            ->with([
                'qualifications',
                'subjects',
                'positions',
                'institutes'
            ])
            ->where('user_id', $user->id)
            ->get();

        return view('pis.staff.staff_detail_list', [
            'staff_form9' => $staff_form9,
            'user' => $user
        ]);
    }

    public function edit_form9($id)
    {
        $user = User::query()->where('id', $id)->first();
        $positions = $this->get_setting($this->setup_edu_positions);
        $subjects = $this->get_setting($this->setup_edu_subjects);
        $qualifications = $this->get_setting($this->setup_edu_qualifications);
        $institutes = $this->get_setting($this->setup_edu_institutes);
        $data = StaffEducation::query()->where('user_id', $id)->get();

        return view('pis.staff.edit_staff_form_page_9', [
            'postitions' => $positions,
            'subjects' => $subjects, 'qualifications' => $qualifications, 'date' => $this->_bs, 'institutes' => $institutes, 'data' => $data,
            'is_admin' => 1,
            'user' => $user
        ]);
    }

    public function view_form10(User $user)
    {
        $staff_form10 = StaffTraining::query()->where('user_id', $user->id)->get();
        return view('pis.staff.staff_detail_list', [
            'staff_form10' => $staff_form10,
            'user' => $user
        ]);
    }

    public function edit_form10($id)
    {
        $user = User::query()->where('id', $id)->first();
        $data = StaffTraining::query()->where('user_id', $id)->get();
        return view(
            'pis.staff.edit_staff_form_page_10',
            [
                'data' => $data,
                'is_admin' => 1,
                'user' => $user
            ]
        );
    }

    public function view_form11(User $user)
    {
        $staff_form11 = StaffAward::query()->where('user_id', $user->id)->get();
        return view('pis.staff.staff_detail_list', [
            'staff_form11' => $staff_form11,
            'user' => $user
        ]);
    }

    public function edit_form11($id)
    {
        $user = User::query()->where('id', $id)->first();
        $data = StaffAward::query()->where('user_id', $id)->get();
        return view('pis.staff.edit_staff_form_page_11', [
            'data' => $data,
            'is_admin' => 1,
            'user' => $user
        ]);
    }

    public function view_form12(User $user)
    {
        $staff_form12 = StaffPunishment::query()->with('punishments')->where('user_id', auth()->user()->id)->get();
        return view(
            'pis.staff.staff_detail_list',
            [
                'staff_form12' => $staff_form12,
                'user' => $user
            ]
        );
    }

    public function edit_form12($id)
    {
        $user = User::query()->where('id', $id)->first();
        $punishments = $this->get_setting($this->setup_punishments);
        $data = StaffPunishment::query()->where('user_id', $id)->get();
        return view('pis.staff.edit_staff_form_page_12', ['punishments' => $punishments, 'data' => $data, 'is_admin' => 1, 'user' => $user]);
    }

    public function view_form13(User $user)
    {
        $staffName = Staff::query()->where('user_id', $user->id)->first()->nep_name;
        $current_fiscal_year = $this->get__current_fiscal_year();
        $fiscal_years = FiscalYear::all();
        $leave_datas = StaffLeaveApplication::query()->where('staff_name', $staffName)
            ->where('is_approved', 1)
            ->with('settingLeaves')
            ->get();

        $prev_fiscal_year = FiscalYear::query()->where('id', config('pis_constant.PREVIOUS_FISCAL_YEAR_ID'))->first();
        $prev_birami_leave_left = 0;
        $prev_ghar_leave_left = 0;
        $total_birami_bida_per_fiscal = settingLeave::query()->where('leave_type', 'बिरामी बिदा')->first()->total_leave;
        $total_ghar_per_fiscal = settingLeave::query()->where('leave_type', 'घर बिदा')->first()->total_leave;

        $current_birami_bida_used = 0;
        $current_ghar_bida_used = 0;
        $current_prasuti_bida_used = 0;
        $current_adhyan_bida_used = 0;
        $current_asadharan_bida_used = 0;
        $current_betalawi_bida_used = 0;
        $current_gayal_bida_used = 0;
        $current_kyabi_bida_used = 0;
        $current_pabi_bida_used = 0;



        $staff_id = Staff::query()->where('user_id', $user->id)->first()->id;
        $prevLeaves = SettingValues::query()->where('staff_id', $staff_id)->with('leaves')->get();
        foreach ($prevLeaves as $key => $value) {
            if ($value->leaves->leave_type == 'घर बिदा') {
                $prev_ghar_leave_left = $value->previous_leave_left;
            }

            if ($value->leaves->leave_type == 'बिरामी बिदा') {
                $prev_birami_leave_left = $value->previous_leave_left;
            }
        }

        foreach ($leave_datas as $key => $value) {

            // if ($value->settingLeaves->leave_type == 'बिरामी बिदा') {
            //     if ($value->fiscal_year == $prev_fiscal_year->name) {
            //         # code...
            //         $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
            //         $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
            //         $differentt_in_days[$key] = $to_date->diffInDays($from_date) + 1;
            //         $prev_birami_leave_left = $prev_birami_leave_left + $differentt_in_days[$key];
            //     }
            // }
            $total_birami_leave_left = $total_birami_bida_per_fiscal - $prev_birami_leave_left;

            if ($value->settingLeaves->leave_type == 'बिरामी बिदा') {
                if ($value->fiscal_year == $current_fiscal_year->name) {
                    # code...
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $differentt_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $current_birami_bida_used = $current_birami_bida_used + $differentt_in_days[$key];
                }
            }


            // if ($value->settingLeaves->leave_type == 'घर बिदा') {
            //     if ($value->fiscal_year == $prev_fiscal_year->name) {
            //         # code...
            //         $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
            //         $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
            //         $differentt_in_days[$key] = $to_date->diffInDays($from_date) + 1;
            //         $prev_ghar_leave_left = $prev_ghar_leave_left + $differentt_in_days[$key];
            //     }
            // }

            if ($value->settingLeaves->leave_type == 'घर बिदा') {
                if ($value->fiscal_year == $current_fiscal_year->name) {
                    # code...
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $differentt_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $current_ghar_bida_used = $current_ghar_bida_used + $differentt_in_days[$key];
                }
            }
            $total_ghar_leave_left = $total_ghar_per_fiscal - $prev_ghar_leave_left;

            if ($value->settingLeaves->leave_type == 'प्रसुति / प्रसुति स्याहार विदा') {
                if ($value->fiscal_year == $current_fiscal_year->name) {
                    # code...
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $difference_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $current_prasuti_bida_used = $current_prasuti_bida_used + $difference_in_days[$key];
                }
            }

            if ($value->settingLeaves->leave_type == 'अध्ययन विदा') {
                if ($value->fiscal_year == $current_fiscal_year->name) {
                    # code...
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $differencee_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $current_adhyan_bida_used = $current_adhyan_bida_used + $differencee_in_days[$key];
                }
            }

            if ($value->settingLeaves->leave_type == 'असाधारण विदा') {
                if ($value->fiscal_year == $current_fiscal_year->name) {
                    # code...
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $gap_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $current_asadharan_bida_used = $current_asadharan_bida_used + $gap_in_days[$key];
                }
            }

            if ($value->settingLeaves->leave_type == 'बेतलवी विदा') {
                if ($value->fiscal_year == $current_fiscal_year->name) {
                    # code...
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $gapp_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $current_betalawi_bida_used = $current_betalawi_bida_used + $gapp_in_days[$key];
                }
            }

            if ($value->settingLeaves->leave_type == 'गयल अवधि') {
                if ($value->fiscal_year == $current_fiscal_year->name) {
                    # code...
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $variation_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $current_gayal_bida_used = $current_gayal_bida_used + $variation_in_days[$key];
                }
            }

            if ($value->settingLeaves->leave_type == 'क्याबी बिदा') {
                if ($value->fiscal_year == $current_fiscal_year->name) {
                    # code...
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $differentiation_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $current_kyabi_bida_used = $current_kyabi_bida_used + $differentiation_in_days[$key];
                }
            }

            if ($value->settingLeaves->leave_type == 'पबी बिदा') {
                if ($value->fiscal_year == $current_fiscal_year->name) {
                    # code...
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $differentiation_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $current_pabi_bida_used = $current_pabi_bida_used + $differentiation_in_days[$key];
                }
            }
        }




        $total_birami_bida_setting = settingLeave::query()->where('leave_type', 'बिरामी बिदा')->first()->total_leave;
        $total_ghar_bida_setting = settingLeave::query()->where('leave_type', 'घर बिदा')->first()->total_leave;
        $total_prasuti_bida_setting = settingLeave::query()->where('leave_type', 'प्रसुति / प्रसुति स्याहार विदा')->first()->total_leave;
        $total_adhyan_bida_setting = settingLeave::query()->where('leave_type', 'अध्ययन विदा')->first()->total_leave;
        $total_ashadharan_bida_setting = settingLeave::query()->where('leave_type', 'असाधारण विदा')->first()->total_leave;
        $total_betalawi_bida_setting = settingLeave::query()->where('leave_type', 'बेतलवी विदा')->first()->total_leave;
        $total_gayal_bida_setting = settingLeave::query()->where('leave_type', 'गयल अवधि')->first()->total_leave;
        $total_kyabi_bida_setting = settingLeave::query()->where('leave_type', 'क्याबी बिदा')->first()->total_leave;
        $total_pabi_bida_setting = settingLeave::query()->where('leave_type', 'पबी बिदा')->first()->total_leave;


        return view(
            'pis.staff.staff_detail_list',
            [
                'current_fiscal_year' => isset($current_fiscal_year) ? $current_fiscal_year : null,
                'user' => $user,
                'staff_form_13' => 1,
                'total_birami_leave_left' => isset($total_birami_leave_left) ? $total_birami_leave_left : null,
                'total_birami_bida_setting' => isset($total_birami_bida_setting) ? $total_birami_bida_setting : null,
                'current_birami_bida_used' => isset($current_birami_bida_used) ? $current_birami_bida_used : null,


                'total_ghar_leave_left' => isset($total_ghar_leave_left) ? $total_ghar_leave_left : null,
                'total_ghar_bida_setting' => isset($total_ghar_bida_setting) ? $total_ghar_bida_setting : null,
                'current_ghar_bida_used' => isset($current_ghar_bida_used) ? $current_ghar_bida_used : null,

                'current_prasuti_bida_used' => isset($current_prasuti_bida_used) ? $current_prasuti_bida_used : null,
                'total_prasuti_bida_setting' => isset($total_prasuti_bida_setting) ? $total_prasuti_bida_setting : null,

                'current_adhyan_bida_used' => isset($current_adhyan_bida_used) ? $current_adhyan_bida_used : null,
                'total_adhyan_bida_setting' => isset($total_adhyan_bida_setting) ? $total_adhyan_bida_setting : null,

                'current_asadharan_bida_used' => isset($current_asadharan_bida_used) ? $current_asadharan_bida_used : null,
                'total_ashadharan_bida_setting' => isset($total_ashadharan_bida_setting) ? $total_ashadharan_bida_setting : null,

                'current_betalawi_bida_used' => isset($current_betalawi_bida_used) ? $current_betalawi_bida_used : null,
                'total_betalawi_bida_setting' => isset($total_betalawi_bida_setting) ? $total_betalawi_bida_setting : null,

                'current_gayal_bida_used' => isset($current_gayal_bida_used) ? $current_gayal_bida_used : null,
                'total_gayal_bida_setting' => isset($total_gayal_bida_setting) ? $total_gayal_bida_setting : null,

                'current_kyabi_bida_used' => isset($current_kyabi_bida_used) ? $current_kyabi_bida_used : null,
                'total_kyabi_bida_setting' => isset($total_kyabi_bida_setting) ? $total_kyabi_bida_setting : null,

                'current_pabi_bida_used' => isset($current_pabi_bida_used) ? $current_pabi_bida_used : null,
                'total_pabi_bida_setting' => isset($total_pabi_bida_setting) ? $total_pabi_bida_setting : null,
                'prev_ghar_leave_left' => isset($prev_ghar_leave_left) ? $prev_ghar_leave_left : null,
                'prev_birami_leave_left' => isset($prev_birami_leave_left) ? $prev_birami_leave_left : null


            ]
        );
    }

    public function view_form14($id)
    {
        $user = User::query()->where('id', $id)->first();
        $staff_form_14 = StaffWork::query()->where('user_id', $id)->get();
        return view('pis.staff.staff_detail_list', [
            'user' => $user,
            'staff_form_14' => $staff_form_14
        ]);
    }

    public function edit_form13($id)
    {
        $data = StaffWork::query()->where('user_id', $id)->get();
        $user = User::query()->where('id', $id)->first();
        if (count($data) == 0) {
            return view(
                'pis.staff.staff_form_page_14',
                [
                    'data' => $data,
                    'is_admin' => 1,
                    'user' => $user
                ]
            );
        }
        return view(
            'pis.staff.edit_staff_form_page_14',
            [
                'data' => $data,
                'is_admin' => 1,
                'user' => $user
            ]
        );
    }
}
