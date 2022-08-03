<?php

namespace App\Http\Controllers\PisControllers;

use App\Http\Controllers\Controller;
use App\Http\Helper\MediaHelper;
use App\Helpers\GlobalHelper;
use App\Helpers\NepaliCalender;
use App\Models\PisModel\Notification;
use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffAddress;
use App\Models\PisModel\StaffAppointment;
use App\Models\PisModel\StaffAward;
use App\Models\PisModel\StaffDetail;
use App\Models\PisModel\StaffEducation;
use App\Models\PisModel\StaffLanguage;
use App\Models\PisModel\StaffLeave;
use App\Models\PisModel\StaffPrevAppointment;
use App\Models\PisModel\StaffProfile;
use App\Models\PisModel\StaffPunishment;
use App\Models\PisModel\StaffService;
use App\Models\PisModel\StaffTraining;
use App\Models\PisModel\StaffWork;
use App\Models\PisModel\settingLeave;
use App\Models\PisModel\SettingValues;
use App\Models\PisModel\StaffLeaveApplication;
use App\Models\SharedModel\District;
use App\Models\SharedModel\FiscalYear;
use App\Models\SharedModel\Municipality;
use App\Models\SharedModel\Province;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{

    private $_forms = array(
        'staff-form-1' => 'कर्मचारीको पूरा नाम र थर / प्रकार',
        'staff-form-2' => 'ठेगाना सम्बन्धी विवरण',
        'staff-form-3' => 'अन्य वैयक्तिक विवरण',
        'staff-form-4' => 'भाषाको दक्षता सम्बन्धी विवरण',
        'staff-form-5' => 'कर्मचारीको शुरु नियुक्तिको विवरण',
        'staff-form-6' => 'काम गरेको भए सोको विवरण',
        'staff-form-7' => 'अन्य विवरण',
        'staff-form-8' => 'सेवा सम्बन्धी विवरण',
        'staff-form-9' => 'शैक्षिक योग्यता',
        'staff-form-10' => 'तालिम / सेमिनार / सम्मेलेन सम्बन्धी विवरण',
        'staff-form-11' => 'विभूषण, प्रशांसा पत्र र पुरस्कारको विवरण',
        'staff-form-12' => 'विभागीय सजायको विवरण ',
        'staff-form-13' => 'विदा र औषधी उपचारको विवरण',
        'staff-form-14' => 'वर्गीकृत क्षेत्रहरुमा काम गरेको विवरण'
    );
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

    public function __construct()
    {
    }





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

    public function register_user(Request $request)
    {
        $inputs = request()->validate([
            'name' => 'required | min:6 | max: 20',
            'email' => 'required',
            'password' => 'required| min:8| max:10 |confirmed',
            'password_confirmation' => 'required| min:4'
        ]);

        $latest = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_verified' => 0
        ]);

        $role = [
            0 => config('pis_constant.PIS_ID'),
            1 => config('pis_constant.USER_ID')
        ];


        $latest->assignRole($role);

        Notification::create([
            'event_id' => $latest->id,
            'text' => $latest->name . 'को नया कर्मचारी दर्ता अनुरोध',
            'is_read' => 0,
            'role_id' => 9
        ]);

        // $credentials = $request->only('email', 'password');


        return redirect()->route('login')->with('msg', 'प्रयोग कर्ता दर्ता गर्न सफल भयो');
    }

    public function staff_form()
    {
        session(['active_app' => 'pis']);
        return $this->staff_form_page_1();
    }

    public function staff_detail_list(User $id)
    {

        return view(
            'pis.staff.staff_detail_list',
            [
                'user' => $id
            ]
        );
    }


    public function staff_form_page_1()
    {
        // $staff = Staff::where('user_id', auth()->user()->id)->first();
        // if ($staff != null) {
        //     if ($staff->is_approved == 1) {
        //         return redirect()->back()->with('msg', 'स्विक्र्त भैसक्यो');
        //     }
        // }
        $districts = District::select('id', 'name', 'nep_name')->get();
        $staff_categories = $this->get_setting($this->setup_staff_category);
        $occupations = $this->get_setting($this->setup_occupations);
        $user = auth()->user();
        $data = Staff::where('user_id', $user->id)->first();
        $staff_sub_cat = SettingValue::query()->where('setting_id', 5)->get();
        return view('pis.staff.staff_form_page_1', [
            'districts' => $districts,
            'staff_categories' => $staff_categories,
            'occupations' => $occupations,
            'data' => $data,
            'staff_sub_cat' => $staff_sub_cat
        ]);
    }

    public function staff_form_page_1_save(Request $request, MediaHelper $mediaHelper)
    {
        if ($request->has('user_id')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }
        $validate = $request->validate([
            'sanstha_darta_no' => 'required',
            'pyan_no' => 'required',
            'nep_name' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'cs_no' => 'required',
            'cs_district' => 'required',
            'nep_name' => 'required',
            'cs_issue' => 'required',
            'category_id' => 'required',
            'father_nep_name' => 'required',
            'father_name' => 'required',
            'g_father_nep_name' => 'required',
            'g_father_name' => 'required'
        ]);
        if ($request->hasFile('photo')) {
            $image =  $mediaHelper->uploadSingleImage($request->photo);
            $data_to_insert = $validate + [
                'user_id' => $user->id,
                'cs_district' => $request->cs_district,
                'cs_issue' => $request->cs_issue,
                'father_nep_name' => $request->father_nep_name,
                'father_name' => $request->father_name,
                'father_occupation' => $request->father_occupation,
                'g_father_nep_name' => $request->g_father_nep_name,
                'g_father_name' => $request->g_father_name,
                'g_father_occupation' => $request->g_father_occupation,
                'mother_name' => $request->mother_name,
                'mother_nep_name' => $request->mother_nep_name,
                'mother_occupation' => $request->mother_occupation,
                'spouse_name' => $request->spouse_name,
                'spouse_nep_name' => $request->spouse_nep_name,
                'spouse_occupation' => $request->spouse_occupation,
                'daughters_no' => $request->daughters_no,
                'sub_category_id' => $request->sub_category_id,
                'sons_no' => $request->sons_no,
                'photo' => $image,
            ];
        } else {
            $data_to_insert = $validate + [
                'user_id' => $user->id,
                'cs_district' => $request->cs_district,
                'cs_issue' => $request->cs_issue,
                'father_nep_name' => $request->father_nep_name,
                'father_name' => $request->father_name,
                'father_occupation' => $request->father_occupation,
                'g_father_nep_name' => $request->g_father_nep_name,
                'g_father_name' => $request->g_father_name,
                'g_father_occupation' => $request->g_father_occupation,
                'mother_name' => $request->mother_name,
                'mother_nep_name' => $request->mother_nep_name,
                'mother_occupation' => $request->mother_occupation,
                'spouse_name' => $request->spouse_name,
                'spouse_nep_name' => $request->spouse_nep_name,
                'spouse_occupation' => $request->spouse_occupation,
                'daughters_no' => $request->daughters_no,
                'sub_category_id' => $request->sub_category_id,
                'sons_no' => $request->sons_no,
                'photo' => null,
            ];
        }

        $staff = Staff::where('user_id', $user->id)->first();
        if (empty($staff)) {
            $db_response =  Staff::create($data_to_insert);
        } else {
            $db_response =  $staff->update($data_to_insert);
        }
        return redirect()->route('page_2_show')->with('msg', 'Data Inserted');
        // return $this->staff_form_page_2();
    }

    public function staff_form_page_2()
    {
        $provinces = Province::get();
        $districts = District::get();
        $municipalities = Municipality::get();
        $user = auth()->user();
        $data = StaffAddress::where('user_id', $user->id)->first();
        return view('pis.staff.staff_form_page_2', [
            'provinces' => $provinces,
            'districts' => $districts,
            'municipalities' => $municipalities,
            'data' => $data
        ]);
    }

    public function staff_form_page_2_save(Request $request)
    {
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user)->first();
        } else {
            $user = auth()->user();
        }
        $validate = $request->validate([
            'p_province' => 'required',
            't_province' => 'required',
            'p_district' => 'required',
            't_district' => 'required',
            'p_municipality' => 'required',
            't_municipality' => 'required',
            'p_ward' => 'required',
            't_ward' => 'required'
        ]);
        $data_to_insert = $validate + [
            'user_id' => $user->id,
            't_province' => $request->t_province,
            't_district' => $request->t_district,
            't_municipality' => $request->t_municipality,
            'p_ward' => $request->p_ward,
            't_ward' => $request->t_ward,
            'p_tole' => $request->p_tole,
            't_tole' => $request->t_tole,
            'p_ward_nep' => $request->p_ward_nep,
            't_ward_nep' => $request->t_ward_nep,
            'p_tole_nep' => $request->p_tole_nep,
            't_tole_nep' => $request->t_tole_nep,
            'p_house_no' => $request->p_house_no,
            't_house_no' => $request->t_house_no,
            'p_house_no_nep' => $request->p_house_no_nep,
            't_house_no_nep' => $request->t_house_no_nep,
            'p_contact' => $request->p_contact,
            't_contact' => $request->t_contact,
            'email' => $request->email
        ];

        $staff = StaffAddress::where('user_id', $user->id)->first();
        if (empty($staff)) {
            $db_response =  StaffAddress::create($data_to_insert);
        } else {
            $db_response =  $staff->update($data_to_insert);
        }
        return redirect()->route('page_3_show')->with('msg', 'Data Inserted');
    }


    public function staff_form_page_3()
    {
        $user = auth()->user();
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
        ]);
    }

    public function staff_form_page_3_save(Request $request)
    {
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }
        $validate = $request->validate([
            'gender' => 'required',
            'religion' => 'required',
            'ethnicity' => 'required',
            'janjati' => 'required',
            'source' => 'required',
            'madesi' => 'required',
            'dalit' => 'required',
            'low' => 'required',
            'disable' => 'required',
            'is_division' => 'required'
        ]);
        $data_to_insert = $validate + [
            'user_id' => $user->id,
            'face' => $request->face,
            'blood_group' => $request->blood_group,
            'source' => $request->source,
            'janjati' => $request->janjati,
            'janjati_other' => $request->janjati_other,
            'madesi' => $request->madesi,
            'madesi_other' => $request->madesi_other,
            'dalit' => $request->dalit,
            'dalit_other' => $request->dalit_other,
            'low' => $request->low,
            'low_other' => $request->low_other,
            'disable' => $request->disable,
            'disable_other' => $request->disable_other,
            'is_division' => $request->is_division
        ];
        $staff = StaffProfile::where('user_id', $user->id)->first();
        if (empty($staff)) {
            $db_response =  StaffProfile::create($data_to_insert);
        } else {
            $db_response =  $staff->update($data_to_insert);
        }
        return redirect()->route('page_4_show')->with('msg', 'Data Inserted');
    }

    public function staff_form_page_4()
    {
        $staffProfile = StaffProfile::where('user_id', auth()->user()->id)->first();
        if (empty($staffProfile)) {
            return redirect()->back()->with('msg', 'अन्य वैयक्तिक विवरण फारम भर्नुहोस्');
        }

        $languages = $this->get_setting($this->setup_languages);
        $foreign_languages = $this->get_setting($this->setup_f_languages);
        $foreign_data = StaffLanguage::query()->where('user_id', auth()->user()->id)->where('type', 'foreign')->get();
        $local_data = StaffLanguage::query()->where('user_id', auth()->user()->id)->where('type', 'local')->get();
        $data = StaffLanguage::query()->where('user_id', auth()->user()->id)->get();
        $staffLanguage = StaffProfile::query()->where('user_id', auth()->user()->id)->first();

        if (count($foreign_data) > 0) {
            return view('pis.staff.edit_staff_form_page_4', ['languages' => $languages, 'foreign_languages' => $foreign_languages, 'foreign_data' => $foreign_data, 'local_data' => $local_data, 'staffLanguage' => $staffLanguage]);
        }
        return view('pis.staff.staff_form_page_4', ['languages' => $languages, 'foreign_languages' => $foreign_languages, 'data' => $data, 'staffLanguage' => $staffLanguage]);
    }

    public function staff_form_page_4_save(Request $request)
    {
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }

        $request->validate([
            'local_language' => 'required',
            'language.*' => 'required',
            'language' => 'required',
            'writing.*' => 'required',
            'reading.*' => 'required',
            'speaking.*' => 'required'
        ]);

        $staffLang = StaffLanguage::query()->where('user_id', $user->id)->get();
        if (count($staffLang) > 0) {
            foreach ($staffLang as $key => $value) {
                $value->delete();
            }
        }

        DB::transaction(function () use ($request, $user) {
            if (isset($request->language)) {
                foreach ($request->language as $key => $value) {

                    StaffLanguage::create([
                        'user_id' => $user->id,
                        'language' => isset($request->language[$key]) ?  $request->language[$key] : null,
                        'type' => 'local',
                        'writing' => isset($request->writing[$key]) ? $request->writing[$key] : '',
                        'reading' => isset($request->reading[$key]) ? $request->reading[$key] : '',
                        'speaking' => isset($request->speaking[$key]) ? $request->speaking[$key] : ''
                    ]);
                }
            }
            if (isset($request->language2)) {

                foreach ($request->language2 as $key => $value) {
                    StaffLanguage::create([
                        'user_id' => $user->id,
                        'language' => isset($request->language2[$key]) ? $request->language2[$key] : null,
                        'type' => 'foreign',
                        'writing' => isset($request->writing2[$key]) ? $request->writing2[$key] : '',
                        'reading' => isset($request->reading2[$key]) ?  $request->reading2[$key] : '',
                        'speaking' => isset($request->speaking2[$key]) ? $request->speaking2[$key] : ''
                    ]);
                }
            }
            StaffProfile::query()->where('user_id', $user->id)->update([
                'local_language' => $request->local_language
            ]);
        });
        return redirect()->route('page_5_show')->with('msg', 'Data Inserted');
    }
    public function staff_form_page_5()
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups = $this->get_setting($this->setup_office_groups);
        $data = StaffAppointment::query()->where('user_id', auth()->user()->id)->get();
        return view('pis.staff.staff_form_page_5', ['services' => $services, 'levels' => $levels, 'positions' => $positions, 'officeGroups' => $officeGroups, 'data' => $data]);
    }


    public function staff_form_page_5_save(Request $request)
    {
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }
        $validate = $request->validate([
            'office_name_address' => 'required',
        ]);
        $data_to_insert = $validate + [
            'user_id' => $user->id,
            'appoint_date' => $request->appoint_date,
            'decision_date' => $request->decision_date,
            'attend_date' => $request->attend_date,
            'service' => $request->service,
            'office_group' => $request->office_group,
            'level' => $request->level,
            'position' => $request->position,
            'technical' => $request->technical,
        ];
        $staff = StaffAppointment::where('user_id', $user->id)->first();
        if (empty($staff)) {
            StaffAppointment::create($validate + $data_to_insert);
        } else {
            StaffAppointment::query()->where('user_id', $user->id)->update($data_to_insert);
        }

        return redirect()->route('page_6_show')->with('msg', 'Data Inserted');
    }
    public function staff_form_page_6()
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups = $this->get_setting($this->setup_office_groups);
        $data = StaffPrevAppointment::query()->where('user_id', auth()->user()->id)->get();
        return view('pis.staff.staff_form_page_6', ['services' => $services, 'levels' => $levels, 'positions' => $positions, 'officeGroups' => $officeGroups, 'data' => $data]);
    }

    public function staff_form_page_6_save(Request $request)
    {

        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }
        $validate = $request->validate([
            'office_name_address' => 'required',
        ]);
        $data_to_insert = $validate + [
            'user_id' => $user->id,
            'service' => $request->service,
            'office_group' => $request->office_gr,
            'level' => $request->level,
            'position' => $request->position,
            'technical' => $request->technical,
            "leave_date" => $request->leave_date,
            "leave_reason" => $request->leave_reason
        ];
        $staff = StaffPrevAppointment::where('user_id', $user->id)->first();
        if (empty($staff)) {
            StaffPrevAppointment::create($validate + $data_to_insert);
        } else {
            StaffPrevAppointment::query()->where('user_id', $user->id)->update($data_to_insert);
        }
        return redirect()->route('page_7_show')->with('msg', 'Data Inserted');
    }
    public function staff_form_page_7()
    {
        $data = StaffDetail::query()->where('user_id', auth()->user()->id)->get();
        return view('pis.staff.staff_form_page_7', ['countries' => $this->_countries, 'data' => $data]);
    }

    public function staff_form_page_7_save(Request $request)
    {
        $request->validate([
            'poly_marriage' => 'required',
            'loan' => 'required'
        ]);
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }

        if ($request->poly_marriage == 1) {
            $request->validate([
                'poly_spouse_name' => 'required',
            ]);
        }

        if ($request->loan == 1) {
            $request->validate([
                'loan_detail' => 'required',
            ]);
        }

        $data_to_insert = [
            'user_id' => $user->id,
            'poly_marriage' => $request->poly_marriage,
            'poly_spouse_name' => $request->poly_spouse_name,
            'foreign_spouse_apply' => $request->foreign_spouse_apply,
            'fa_country' => $request->fa_country,
            'fa_date' => $request->fa_date,
            'fa2_country' => $request->fa2_country,
            'fa2_date' => $request->fa2_date,
            'loan_detail' => $request->loan_detail,
            'loan' => $request->loan,
            'qualification' => $request->qualification,
        ];


        $staffDetail = StaffDetail::query()->where('user_id', $user->id)->first();
        if (empty($staffDetail)) {
            StaffDetail::create($data_to_insert);
        } else {
            $staffDetail->update($data_to_insert);
        }
        return redirect()->route('page_8_show')->with('msg', 'Data Inserted');
    }
    public function staff_form_page_8()
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups = $this->get_setting($this->setup_office_groups);
        $data = StaffService::query()->where('user_id', auth()->user()->id)->get();


        if (count($data) > 0) {
            return view('pis.staff.edit_staff_form_page_8', [
                'appoints' => $this->_appoinments,
                'services' => $services,
                'levels' => $levels,
                'positions' => $positions,
                'officeGroups' => $officeGroups,
                'data' => $data
            ]);
        } else {
            return view('pis.staff.staff_form_page_8', [
                'appoints' => $this->_appoinments,
                'services' => $services,
                'levels' => $levels,
                'positions' => $positions,
                'officeGroups' => $officeGroups,
                'data' => $data
            ]);
        }
    }

    public function staff_form_page_8_save(Request $request)
    {

        $request->validate([
            'service.*' => 'required',
            'office_group.*' => 'required',
            'position.*' => 'required',
            'level.*' => 'required',
            'office_name_address.*' => 'required',
            'office_name_address_english.*' => 'required',
            'new_appoint.*' => 'required',
            'decision_date.*' => 'required',
            'restoration_date.*' => 'required',
        ]);
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }

        if ($request->has('is_active')) {
            $length = count($request->is_active);
            if ($length == 0) {
                return redirect()->back()->with('msg', 'कृपया सकियमा चिन्न लाउनुहोस ');
            }
            if ($length > 1) {
                return redirect()->back()->with('msg', 'कृपया एकमात्र सकिय चिन्नमा लाउनुहोस');
                # code...
            }
        }
        $staffService = StaffService::query()->where('user_id', $user->id)->get();
        if (count($staffService) > 0) {
            foreach ($staffService as $key => $value) {
                $value->delete();
            }
        }
        if (isset($request->service)) {
            foreach ($request->service as $key => $value) {

                if ($request->service[$key] != null) {
                    StaffService::create([
                        'user_id' => $user->id,
                        'service' => isset($request->service[$key]) ? $request->service[$key] : '',
                        'office_group' => isset($request->office_group[$key]) ? $request->office_group[$key] : '',
                        'position' => isset($request->position[$key]) ? $request->position[$key] : '',
                        'level' =>  isset($request->level[$key]) ? $request->level[$key] : '',
                        'office_name_address' => isset($request->office_name_address[$key]) ? $request->office_name_address[$key] : '',
                        'office_name_address_english' => isset($request->office_name_address_english[$key]) ?  $request->office_name_address_english[$key] : '',
                        'new_appoint' => isset($request->new_appoint[$key]) ? $request->new_appoint[$key] : '',
                        'decision_date' => isset($request->decision_date[$key]) ?  $request->decision_date[$key] : '',
                        'restoration_date' => isset($request->restoration_date[$key]) ? $request->restoration_date[$key] : '',
                        'is_active' =>  isset($request->is_active[$key]) ? 1 : 0
                    ]);
                }
            }
        }


        return redirect()->route('page_9_show')->with('msg', 'Data Inserted');
    }
    public function staff_form_page_9()
    {
        $positions = $this->get_setting($this->setup_edu_positions);
        $subjects = $this->get_setting($this->setup_edu_subjects);
        $qualifications = $this->get_setting($this->setup_edu_qualifications);
        $institutes = $this->get_setting($this->setup_edu_institutes);
        $data = StaffEducation::query()->where('user_id', auth()->user()->id)->get();

        if (count($data) > 0) {
            return view('pis.staff.edit_staff_form_page_9', [
                'postitions' => $positions,
                'subjects' => $subjects, 'qualifications' => $qualifications, 'date' => $this->_bs, 'institutes' => $institutes, 'data' => $data
            ]);
        } else {
            return view('pis.staff.staff_form_page_9', ['postitions' => $positions, 'subjects' => $subjects, 'qualifications' => $qualifications, 'date' => $this->_bs, 'institutes' => $institutes]);
        }
    }

    public function staff_form_page_9_save(Request $request)
    {
        $request->validate([
            'qualification.*' => 'required',
            'subject.*' => 'required',
            'year.*' => 'required',
            'institute.*' => 'required'
        ]);
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }
        $staffEducation = StaffEducation::query()->where('user_id', $user->id)->get();
        if (count($staffEducation) > 0) {
            foreach ($staffEducation as $key => $value) {
                $value->delete();
            }
        }
        $key = 1;
        if (isset($request->subject)) {
            foreach ($request->subject as $key => $value) {
                StaffEducation::create([
                    'user_id' => $user->id,
                    'qualification' => isset($request->qualification[$key]) ? $request->qualification[$key] : '',
                    'subject' => isset($request->subject[$key]) ?  $request->subject[$key] : '',
                    'year' => isset($request->year[$key]) ?   $request->year[$key] : '',
                    'position' => isset($request->position[$key]) ?   $request->position[$key] : '',
                    'institute' => isset($request->institute[$key]) ? $request->institute[$key] : '',
                ]);
            }
        }


        return redirect()->route('page_10_show')->with('msg', 'Data Inserted');
    }

    public function staff_form_page_10()
    {
        $data = StaffTraining::query()->where('user_id', auth()->user()->id)->get();
        if (count($data) > 0) {
            return view('pis.staff.edit_staff_form_page_10', compact('data'));
        }
        return view('pis.staff.staff_form_page_10');
    }

    public function staff_form_page_10_save(Request $request)
    {
        // $request->validate([
        //     'detail.*' => 'required',
        //     'date.*' => 'required',
        //     'type.*' => 'required',
        //     'institute.*' => 'required'
        // ]);
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }

        $staffTraining = StaffTraining::query()->where('user_id', $user->id)->get();
        if (count($staffTraining) > 0) {
            foreach ($staffTraining as $key => $value) {
                $value->delete();
            }
        }
        if (isset($request->detail)) {
            foreach ($request->detail as $key => $value) {
                StaffTraining::create([
                    'user_id' => $user->id,
                    'detail' => isset($request->detail[$key]) ? $request->detail[$key] : '',
                    'date' => isset($request->date[$key]) ? $request->date[$key] : null,
                    'type' => isset($request->type[$key]) ? $request->type[$key] : '',
                    'institute' => isset($request->institute[$key]) ?  $request->institute[$key] : ''
                ]);
            }
        }

        return redirect()->route('page_11_show')->with('msg', 'Data Inserted');
    }

    public function staff_form_page_11()
    {
        $data = StaffAward::query()->where('user_id', auth()->user()->id)->get();
        if (count($data) > 0) {
            return view('pis.staff.edit_staff_form_page_11', compact('data'));
        }
        return view('pis.staff.staff_form_page_11');
    }

    public function staff_form_page_11_save(Request $request)
    {
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }
        $staffAward = StaffAward::query()->where('user_id', $user->id)->get();
        if (count($staffAward) > 0) {
            foreach ($staffAward as $key => $value) {
                $value->delete();
            }
        }

        if (isset($request->award_detail)) {
            foreach ($request->award_detail as $key => $value) {
                StaffAward::create([
                    'user_id' => $user->id,
                    'award_detail' => isset($request->award_detail[$key]) ? $request->award_detail[$key] : '',
                    'received_date' => isset($request->received_date[$key]) ?  $request->received_date[$key] : null,
                    'reason' => isset($request->reason[$key]) ?  $request->reason[$key] : '',
                    'convenience' => isset($request->convenience[$key]) ? $request->convenience[$key] : ''
                ]);
            }
        }

        return redirect()->route('page_12_show')->with('msg', 'Data Inserted');
    }

    public function staff_form_page_12()
    {
        $punishments = $this->get_setting($this->setup_punishments);
        $data = StaffPunishment::query()->where('user_id', auth()->user()->id)->get();
        if (count($data) > 0) {
            return view('pis.staff.edit_staff_form_page_12', ['punishments' => $punishments, 'data' => $data]);
        }
        return view('pis.staff.staff_form_page_12', ['punishments' => $punishments]);
    }
    public function staff_form_page_12_save(Request $request)
    {
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }

        $staffPunishment = StaffPunishment::query()->where('user_id', $user->id)->get();
        if (count($staffPunishment) > 0) {
            foreach ($staffPunishment as $key => $value) {
                $value->delete();
            }
        }
        if (isset($request->punishment)) {
            foreach ($request->punishment as $key => $value) {
                StaffPunishment::create([
                    'user_id' => $user->id,
                    'punishment' => isset($request->punishment[$key]) ? $request->punishment[$key] : '',
                    'ordered_date' => isset($request->ordered_date[$key]) ? $request->ordered_date[$key] : null,
                    'stopped' => isset($request->stopped[$key]) ? $request->stopped[$key] : '',
                    'stopped_date' => isset($request->stopped_date[$key]) ? $request->stopped_date[$key] : null,
                    'remarks' => isset($request->remarks[$key]) ? $request->remarks[$key] : ''
                ]);
            }
        }
        return redirect()->route('leave-and-medicine-details');
        //   return redirect()->route('page_13_show')->with('msg','Data Inserted');    
    }
    // public function staff_form_page_13()
    // {
    //     $fiscal_years= FiscalYear::query()->where('is_current',1)->first();
    //         return view('pis.staff.staff_form_page_13',['fiscalYear'=>$fiscal_years]);
    // }

    public function staff_form_page_13_save(Request $request)
    {

        $user = auth()->user();
        $staffLeaves = StaffLeave::query()->where('user_id', $user->id)->get();
        if (count($staffLeaves) > 0) {
            foreach ($staffLeaves as $key => $value) {
                $value->delete();
            }
        }
        if (isset($request->detail)) {
            foreach ($request->detail as $key => $value) {
                StaffLeave::create([
                    'user_id' => $user->id,
                    'detail' => isset($request->detail[$key]) ? $request->detail[$key] : '',
                    'session' => isset($request->session[$key]) ?  $request->session[$key] : '',
                    'home_new' => isset($request->home_new[$key]) ?  $request->home_new[$key] : '',
                    'home_prev_left' => isset($request->home_prev_left[$key]) ? $request->home_prev_left[$key] : null,
                    'home_total' => isset($request->home_total[$key]) ? $request->home_total[$key] : null,
                    'home_cost' => isset($request->home_cost[$key]) ? $request->home_cost[$key] : '',
                    'home_left' => isset($request->home_left[$key]) ? $request->home_left[$key] : null,
                    'sick_new' => isset($request->sick_new[$key]) ? $request->sick_new[$key] : '',
                    'sick_prev_left' => isset($request->sick_prev_left[$key]) ? $request->sick_prev_left[$key] : null,
                    'sick_total' => isset($request->sick_total[$key]) ? $request->sick_total[$key] : null,
                    'sick_cost' => isset($request->sick_cost[$key]) ? $request->sick_cost[$key] : '',
                    'sick_left' => isset($request->sick_left[$key]) ? $request->sick_left[$key] : null,
                    'delivery_total' => isset($request->delivery_total[$key]) ? $request->delivery_total[$key] : '',
                    'delivery_cost' => isset($request->delivery_cost[$key]) ? $request->delivery_cost[$key] : '',
                    'delivery_left' => isset($request->delivery_left[$key]) ? $request->delivery_left[$key] : null,
                    'study_total' => isset($request->study_total[$key]) ? $request->study_total[$key] : '',
                    'study_cost' => isset($request->study_total[$key]) ? $request->study_total[$key] : '',
                    'study_left' => isset($request->study_left[$key]) ? $request->study_left[$key] : null,
                    'uncommon_total' => isset($request->uncommon_total[$key]) ? $request->uncommon_total[$key] : '',
                    'uncommon_cost' => isset($request->uncommon_cost[$key]) ? $request->uncommon_cost[$key] : '',
                    'uncommon_left' => isset($request->uncommon_left[$key]) ? $request->uncommon_left[$key] : null,
                    'bedroom_total' => isset($request->bedroom_total[$key]) ? $request->bedroom_total[$key] : '',
                    'bedroom_cost' => isset($request->bedroom_cost[$key]) ?  $request->bedroom_cost[$key] : '',
                    'bedroom_left' => isset($request->bedroom_left[$key]) ? $request->bedroom_left[$key] : null,
                    'from_date' => isset($request->from_date[$key]) ? $request->from_date[$key] : null,
                    'to_date' => isset($request->to_date[$key]) ? $request->to_date[$key] : null,
                    'to_from_total' => isset($request->to_from_total[$key]) ? $request->to_from_total[$key] : null,
                    'kyabi_total' => isset($request->kyabi_total[$key]) ? $request->kyabi_total[$key] : '',
                    'kyabi_cost' => isset($request->kyabi_cost[$key]) ? $request->kyabi_cost[$key] : '',
                    'kyabi_left' => isset($request->kyabi_left[$key]) ? $request->kyabi_left[$key] : null,
                    'pabi_total' => isset($request->pabi_total[$key]) ? $request->pabi_total[$key] : '',
                    'pabi_cost' => isset($request->pabi_cost[$key]) ? $request->pabi_cost[$key] : '',
                    'pabi_left' => isset($request->pabi_left[$key]) ? $request->pabi_left[$key] : null,
                    'mc_amount' => isset($request->mc_amount[$key]) ? $request->mc_amount[$key] : '',
                    'remarks' => isset($request->remarks[$key]) ? $request->remarks[$key] : '',
                ]);
            }
        }

        return redirect()->route('page_14_show')->with('msg', 'Data Inserted');
    }
    public function staff_form_page_14()
    {
        $data = StaffWork::query()->where('user_id', auth()->user()->id)->get();

        if (count($data) > 0) {
            return view('pis.staff.edit_staff_form_page_14', compact('data'));
        }
        return view('pis.staff.staff_form_page_14');
    }

    public function staff_form_page_14_save(Request $request)
    {
        if ($request->has('is_admin')) {
            $user = User::query()->where('id', $request->user_id)->first();
        } else {
            $user = auth()->user();
        }
        $staffWork = StaffWork::query()->where('user_id', $user->id)->get();
        if (count($staffWork) > 0) {
            foreach ($staffWork as $key => $value) {
                $value->delete();
            }
        }

        foreach ($request->from_date as $key => $value) {
            $latest[$key] = StaffWork::create([
                'user_id' => $user->id,
                'from_date' => isset($request->from_date[$key]) ?  $request->from_date[$key] : null,
                'to_date' => isset($request->to_date[$key]) ? $request->to_date[$key] : null,
                'post_area' => isset($request->post_area[$key]) ? $request->post_area[$key] : '',
                'work_area' => isset($request->work_area[$key]) ? $request->work_area[$key] : '',
                'a_work' => $request->has('a_work') ? (isset($request->a_work[$key]) ? 1 : 0) : 0,
                'b_work' => $request->has('b_work') ? (isset($request->b_work[$key]) ? 1 : 0) : 0,
                'c_work' => $request->has('c_work') ? (isset($request->c_work[$key]) ? 1 : 0) : 0,
                'd_work' => $request->has('d_work') ? (isset($request->d_work[$key]) ? 1 : 0) : 0,
                'e_work' => $request->has('e_work') ? (isset($request->e_work[$key]) ? 1 : 0) : 0,
                'remarks' => isset($request->remarks[$key]) ? $request->remarks[$key] : '',
            ]);
        }

        if ($latest != null) {
            foreach ($latest as $key => $value) {
                $user = User::query()->where('id', $value->user_id)->first();
                $user_name = $user->name;
                Notification::create([
                    'event_id' => $value->id,
                    'text' => $user_name . 'को फारम भरिएको छ',
                    'is_read' => 0,
                    'role_id' => 9
                ]);
                break;
            }
        }
    }

    public function verify_all_form($staff)
    {

        $staff = Staff::query()->where('user_id', $staff)->first();
        $staff->update([
            'is_verified' => 1
        ]);

        Notification::create([
            'event_id' => $staff->id,
            'text' => $staff->nep_name . 'को डाटा स्वीकृत भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.CAO')
        ]);
        return redirect()->back()->with('msg', 'प्रमाणित गर्न सफल भयो |');
    }

    public function disprove_all_form($staff)
    {

        $staff = Staff::query()->where('user_id', $staff)->first();
        $staff->update([
            'is_verified' => 0
        ]);
        return redirect()->back()->with('msg', 'खण्डन गर्न सफल भयो |');
    }

    public function approve_all_form($staff)
    {
        $staff = Staff::query()->where('user_id', $staff)->first();
        $staff->update([
            'is_approved' => 1
        ]);


        return redirect()->back()->with('msg', 'स्वीकृत गर्न सफल भयो |');
    }

    public function decline_all_form($staff)
    {

        $staff = Staff::query()->where('user_id', $staff)->first();
        $staff->update([
            'is_approved' => 0
        ]);
        return redirect()->back()->with('msg', 'अस्वीकृत गर्न सफल भयो |');
    }

    public function leave_setting_form()
    {
        $fiscal_years = FiscalYear::query()->where('is_current', 1)->first();
        $leave = settingLeave::query()->get();
        return view('pis.staff.leave_setting', ['fiscal_years' => $fiscal_years, 'leaveSetting' => $leave]);
    }

    public function leave_setting_submit(Request $request)
    {
        $data = $request->validate([
            'fiscal_year' => 'required',
            'leave_type' => 'required',
            'total_leave' => 'required'
        ]);
        if ($request->applicable_for == null) {
            settingLeave::create($data + ['applicable_for' => 'दुबै']);
        } else {
            settingLeave::create($data + ['applicable_for' => $request->applicable_for]);
        }
        return redirect()->route('leave-setting')->with('msg', 'बिदाको किसिम थप्न सफल भयो !');
    }

    public function edit_leave_setting(Request $request)
    {
        $settingLeave = settingLeave::query()->where('id', $request->id)->first();
        if ($request->applicable_for == null) {
            $settingLeave->update([
                'fiscal_year' => $request->fiscal_year,
                'leave_type' => $request->leave_type,
                'applicable_for' => 'दुबै',
                'total_leave' => $request->total_leave,
            ]);
        } else {
            $settingLeave->update([
                'fiscal_year' => $request->fiscal_year,
                'leave_type' => $request->leave_type,
                'applicable_for' => $request->applicable_for,
                'total_leave' => $request->total_leave,
            ]);
        }
        return redirect()->route('leave-setting')->with('msg', 'बिदाको किसिम सच्याऊन सफल भयो !');
    }

    public function add_setting_prev_leave(Request $request)
    {
        $request->validate([
            'previous_leave_left' => 'required',
            'staff_id' => 'required',
            'leave_type' => 'required'
        ]);

        SettingValues::create([
            'previous_leave_left' => $request->previous_leave_left,
            'staff_id' => $request->staff_id,
            'leave_type' => $request->leave_type,
            'setting_id' => $request->id
        ]);
        return redirect()->back()->with('msg', 'बिदाको किसिम सच्याऊन सफल भयो !');
    }


    public function leave_application_form()
    {

        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();

        if ($staff != null) {
            if ($staff->is_approved == 0) {
                return redirect()->back()->with('msg', 'प्रमाणित हुन् बाकी');
            }
        } else {
            return redirect()->route('staff_form')->with('msg', 'कर्मचारी विवरण भर्नुहोस्');
        }

        $positions = $this->get_setting($this->setup_positions);

        $staffGender = StaffProfile::query()->where('user_id', auth()->user()->id)->first();


        if ($staff != null) {
            $staffGender = $staffGender->gender;
        }
        if ($staffGender == 'male') {
            $leaveTypes = settingLeave::query()->where('applicable_for', 'दुबै')->orwhere('applicable_for', 'पुरूष')->get();
        } elseif ($staffGender == 'female') {
            $leaveTypes = settingLeave::query()->where('applicable_for', 'दुबै')->orwhere('applicable_for', 'महिला')->get();
        } else {
            $leaveTypes = null;
        }

        $officeName = StaffService::query()->where('user_id', auth()->user()->id)->first();

        if ($officeName != null) {
            $officeName = $officeName->office_name_address_english;
        }
        $staffPositionId = StaffAppointment::query()->where('user_id', auth()->user()->id)->first();

        if ($staffPositionId != null) {
            $staffPositionId = $staffPositionId->position;
        }


        $fiscal_year = FiscalYear::query()->where('is_current', 1)->first();

        foreach ($positions as $key => $value) {

            if ($value->id == $staffPositionId) {
                $staffPosition = $value->name;
                break;
            } else {
                $staffPosition = null;
            }
        }

        // dd($staffPosition);

        return view('pis.staff.staff_leave_application', ['fiscal_year' => $fiscal_year, 'staff' => $staff, 'leaveTypes' => $leaveTypes, 'staffPosition' => $staffPosition, 'officeName' => $officeName]);
    }

    public function leave_application_form_submit(Request $request)
    {
        $data = $request->validate([
            'fiscal_year' => 'required',
            'staff_name' => 'required',
            'staff_s_no' => 'required',
            'staff_position' => 'required',
            'office_name' => 'sometimes',
            'leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'leave_reason' => 'required',
            'official_signature' => 'sometimes',
        ]);

        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();

        StaffLeaveApplication::create($data + ['is_approved' => 0, 'cao_approved' => 0]);

        Notification::create([
            'text' => $staff->nep_name . 'को विदाको निवेदन आएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.ADMIN_ID'),
        ]);


        Notification::create([
            'text' => 'तपाईको निवेदन एडमिनको ठाउमा छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $staff->id,
            'noti_type' => 'forms'
        ]);

        return redirect()->back()->with('msg', 'बिदाको निवेदन पठाउन सफल भयो !');
    }

    public function leave_approval()
    {
        $applications = StaffLeaveApplication::query()->where('is_approved', 0)->with('settingLeaves')->get();
        if (Auth::user()->hasRole('admin')) {
            $role = 'admin';
        } elseif (Auth::user()->hasRole('cao')) {
            $applications = StaffLeaveApplication::query()->where('cao_approved', 0)->with('settingLeaves')->get();
            $role = 'cao';
        } elseif (Auth::user()->hasRole('user')) {
            $role = 'user';
        } else {
            $role = null;
        }
        return view('pis.staff.staff_leave_approval', ['applications' => $applications, 'role' => $role]);
    }

    public function leave_approved($id)
    {
        $leave_application = StaffLeaveApplication::query()->where('id', $id)->first();
        $staff = Staff::query()->where('nep_name', $leave_application->staff_name)->first();

        $eng_from_date = convertBsToAd($leave_application->from_date);
        $eng_to_date = convertBsToAd($leave_application->to_date);

        $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $eng_from_date);
        $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $eng_to_date);
        $currentLeave = $to_date->diffInDays($from_date) + 1;


        $application = StaffLeaveApplication::query()->where('id', $id)->update([
            'is_approved' => 1
        ]);

        Notification::create([
            'text' => $leave_application->staff_name . 'को निवेदन एडमिनवाट' . $currentLeave . ' दिनको सिफारिश भएकोछ',
            'is_read' => 0,
            'role_id' => config('pis_constant.CAO'),
        ]);


        // Notification::create([
        //     'text' => 'तपाईको निवेदन एडमिनको ठाउमा छ',
        //     'is_read' => 0,
        //     'role_id' => config('pis_constant.USER_ID'),
        //     'staff_id' => $staff->id,
        //     'noti_type' => 'forms'
        // ]);

        Notification::create([
            'event_id' => $leave_application->id,
            'text' => $leave_application->staff_name . 'तपाईको निवेदन एडमिनवाट' . $currentLeave . ' दिनको सिफारिश भएकोछ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $staff->id,
            'noti_type' => 'forms'
        ]);
        return redirect()->back()->with('msg', 'बिदाको निवेदन स्वीकृत भयो!');
    }

    public function cao_leave_approved($id)
    {
        $leave_application = StaffLeaveApplication::query()->where('id', $id)->first();
        $staff = Staff::query()->where('nep_name', $leave_application->staff_name)->first();

        $eng_from_date = convertBsToAd($leave_application->from_date);
        $eng_to_date = convertBsToAd($leave_application->to_date);

        $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $eng_from_date);
        $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $eng_to_date);
        $currentLeave = $to_date->diffInDays($from_date) + 1;


        $application = StaffLeaveApplication::query()->where('id', $id)->update([
            'cao_approved' => 1
        ]);

        // Notification::create([
        //     'text' => 'तपाईको निवेदन एडमिनको ठाउमा छ',
        //     'is_read' => 0,
        //     'role_id' => config('pis_constant.USER_ID'),
        //     'staff_id' => $staff->id,
        //     'noti_type' => 'forms'
        // ]);

        Notification::create([
            'event_id' => $leave_application->id,
            'text' => $leave_application->staff_name . 'को निवेदन प्रा.प्र.अ वाट' . $currentLeave . ' दिनको सिफारिश भएकोछ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $staff->id,
            'noti_type' => 'forms'
        ]);
        return redirect()->back()->with('msg', 'बिदाको निवेदन स्वीकृत भयो!');
    }

    public function leave_approval_detail($id)
    {
        $application = StaffLeaveApplication::query()->where('id', $id)->with('settingLeaves')->first();
        $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $application->from_date);
        $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $application->to_date);
        $currentLeave = $to_date->diffInDays($from_date) + 1;

        $previousLeaves = StaffLeaveApplication::query()->where('leave_type', $application->leave_type)->where('is_approved', 1)->get();
        if (count($previousLeaves) == 0) {
            $previousTotal = settingLeave::where('id', $application->leave_type)->first()->total_leave;
            return view('pis.staff.staff_leave_approval_detail', ['applications' => $application, 'previousTotal' => $previousTotal, 'currentLeave' => $currentLeave]);
        } else {

            $diff_in_days = array();
            $previousTotal = 0;
            foreach ($previousLeaves as $key => $value) {
                $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                $diff_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                $previousTotal = $previousTotal + $diff_in_days[$key];
            }
            return view('pis.staff.staff_leave_approval_detail', ['applications' => $application, 'previousTotal' => $previousTotal, 'currentLeave' => $currentLeave]);
        }
    }

    public function edit_leave_application($leaveApplication)
    {
        $leaveApplication = StaffLeaveApplication::query()->where('id', $leaveApplication)->first();
        $staff = Staff::query()->where('nep_name', $leaveApplication->staff_name)->first();

        $staffGender = StaffProfile::query()->where('user_id', $staff->user_id)->first();
        $positions = $this->get_setting($this->setup_positions);


        if ($staff != null) {
            $staffGender = $staffGender->gender;
        }
        if ($staffGender == 'male') {
            $leaveTypes = settingLeave::query()->where('applicable_for', 'दुबै')->orwhere('applicable_for', 'पुरूष')->get();
        } elseif ($staffGender == 'female') {
            $leaveTypes = settingLeave::query()->where('applicable_for', 'दुबै')->orwhere('applicable_for', 'महिला')->get();
        } else {
            $leaveTypes = null;
        }

        $fiscal_year = FiscalYear::query()->where('is_current', 1)->first();

        $officeName = StaffService::query()->where('user_id', auth()->user()->id)->first();

        if ($officeName != null) {
            $officeName = $officeName->office_name_address_english;
        }
        $staffPositionId = StaffAppointment::query()->where('user_id', auth()->user()->id)->first();

        if ($staffPositionId != null) {
            $staffPositionId = $staffPositionId->position;
        }
        foreach ($positions as $key => $value) {

            if ($value->id == $staffPositionId) {
                $staffPosition = $value->name;
                break;
            } else {
                $staffPosition = null;
            }
        }

        // dd();
        return view(
            'pis.staff.edit_staff_leave_approval',
            [
                'leaveApplication' => $leaveApplication,
                'fiscal_year' => $fiscal_year, 'staff' => $staff, 'leaveTypes' => $leaveTypes, 'staffPosition' => $staffPosition, 'officeName' => $officeName
            ]
        );
    }

    public function update_leave_application(Request $request)
    {
        $data = $request->validate([
            'fiscal_year' => 'required',
            'staff_name' => 'required',
            'staff_s_no' => 'required',
            'staff_position' => 'required',
            'office_name' => 'sometimes',
            'leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'leave_reason' => 'required',
            'official_signature' => 'sometimes',
        ]);

        $staff = Staff::query()->where('id', $request->staff_id)->first();


        $leaveApplication = StaffLeaveApplication::query()->where('id', $request->leave_id)->first();
        $leaveApplication->update($data);
        Notification::create([
            'text' => $staff->nep_name . 'को विदाको निवेदन एडिट भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.ADMIN_ID'),
        ]);
        return redirect()->back()->with('msg', 'बिदाको निवेदन एडिट गर्न सफल भयो !');
    }

    public function leave_approval_details(Request $request)
    {
        $fiscal_year = $this->get__current_fiscal_year();
        $data = array();
        $application = StaffLeaveApplication::query()->where('id', $request->id)->with('settingLeaves')->first();
        $staffName = Staff::query()->where('user_id', $request->user_id)->first()->nep_name;
        $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $application->from_date);
        $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $application->to_date);
        $currentLeave = $to_date->diffInDays($from_date) + 1;

        $previousLeaves = StaffLeaveApplication::query()
            ->where('staff_name', $staffName)
            ->where('leave_type', $application->leave_type)
            ->where('is_approved', 1)
            ->where('fiscal_year', $fiscal_year->name)
            ->get();

        if (count($previousLeaves) == 0) {
            $previousTotal = settingLeave::where('id', $application->leave_type)->first()->total_leave;
            $data['flag'] = 0;
        } else {
            $diff_in_days = array();
            $previousTotal = 0;
            foreach ($previousLeaves as $key => $value) {
                $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                $diff_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                $previousTotal = $previousTotal + $diff_in_days[$key];
            }
            $data['flag'] = 1;
        }

        if ($application->settingLeaves->leave_type == 'घर बिदा' || $application->settingLeaves->leave_type == 'बिरामी बिदा') {
            $fiscal_year = FiscalYear::query()->where('id', config('pis_constant.PREVIOUS_FISCAL_YEAR_ID'))->first();
            $applications = StaffLeaveApplication::query()->where('leave_type', $application->leave_type)
                ->where('fiscal_year', $fiscal_year->name)
                ->where('staff_name', $staffName)
                ->where('is_approved', 1)
                ->get();
            $prev_leave_left = 0;
            if (count($applications) > 0) {
                foreach ($applications as $key => $value) {
                    $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                    $diff_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                    $prev_leave_left = $prev_leave_left + $diff_in_days[$key];
                }
                $prev_leave_left = $application->total_leave - $prev_leave_left;
                $previousTotal = $prev_leave_left + $previousTotal;
            }
        }
        $application = StaffLeaveApplication::query()->where('id', $request->id)->with('settingLeaves')->first();
        $data['previousTotal'] = $previousTotal;
        $data['currentLeave'] = $currentLeave;
        $data['application'] = $application;

        return response()->json($data, 200);
    }




    public function leave_approval_test(Request $request)
    {
        $data = array();
        $application = StaffLeaveApplication::query()->where('id', $request->id)->with('settingLeaves')->first();
        $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $application->from_date);
        $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $application->to_date);
        $currentLeave = $to_date->diffInDays($from_date) + 1;
        $previousLeaves = StaffLeaveApplication::query()
            ->where('leave_type', $application->leave_type)
            ->where('is_approved', 1)
            ->get();
        if (count($previousLeaves) == 0) {
            $previousTotal = settingLeave::where('id', $application->leave_type)->first()->total_leave;
            $data['flag'] = 0;
        } else {

            $diff_in_days = array();
            $previousTotal = 0;
            foreach ($previousLeaves as $key => $value) {
                $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                $diff_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                $previousTotal = $previousTotal + $diff_in_days[$key];
            }
            $data['flag'] = 1;
        }
        $application = StaffLeaveApplication::query()->where('id', $request->id)->with('settingLeaves')->first();
        $data['previousTotal'] = $previousTotal;
        $data['currentLeave'] = $currentLeave;
        $data['application'] = $application;

        return response()->json($data, 200);
    }


    public function leaveData(Request $request)
    {
        $fiscal_year = $this->get__current_fiscal_year();
        $leaveData = settingLeave::query()->where('id', $request->id)->first();
        $leaveDataId = $leaveData->id;
        $staffName = Staff::query()->where('user_id', $request->user_id)->first()->nep_name;

        $applications = StaffLeaveApplication::query()->where('leave_type', $leaveDataId)->where('is_approved', 1)
            ->where('staff_name', $staffName)
            ->where('fiscal_year', $fiscal_year->name)
            ->get();

        //calculating this fiscal year bida for all types of bida
        if (count($applications) == 0) {
            $leave_left = settingLeave::where('leave_type', $leaveData->leave_type)->first()->total_leave;
        } else {
            $diff_in_days = array();
            $leave_left = 0;
            foreach ($applications as $key => $value) {
                $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                $diff_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                $leave_left = $leave_left + $diff_in_days[$key];
            }
            $leave_left = $leaveData->total_leave - $leave_left;
        }

        // calculating previous fiscal year bida for Ghar bida and birami bida
        if ($leaveData->leave_type == 'घर बिदा' || $leaveData->leave_type == 'बिरामी बिदा') {
            $staff_id = Staff::query()->where('user_id', $request->user_id)->first()->id;
            $prevLeaves = SettingValues::query()->where('staff_id', $staff_id)->with('leaves')->get();

            foreach ($prevLeaves as $key => $value) {
                if ($value->leaves->leave_type == $leaveData->leave_type) {
                    $leave_left = $leave_left + $value->previous_leave_left;
                }
            }
        }
        $data = array();
        $data['leave_left'] = $leave_left;
        $data['leaveData'] = $leaveData;

        if ($leaveData != null) {
            return response()->json($data, 200);
        } else {
            return response()->json($data, 200);
        }
    }

    public function leaveDataTest($id)
    {
        $fiscal_year = $this->get__current_fiscal_year();
        $leaveData = settingLeave::query()->where('id', $id)->first();
        $leaveDataId = $leaveData->id;
        $staffName = Staff::query()->where('user_id', auth()->user()->id)->first()->nep_name;

        $applications = StaffLeaveApplication::query()->where('leave_type', $leaveDataId)->where('is_approved', 1)
            ->where('staff_name', $staffName)
            ->where('fiscal_year', $fiscal_year->name)
            ->get();

        //calculating this fiscal year bida for all types of bida
        if (count($applications) == 0) {
            $leave_left = settingLeave::where('leave_type', $leaveData->leave_type)->first()->total_leave;
        } else {
            $diff_in_days = array();
            $leave_left = 0;
            foreach ($applications as $key => $value) {
                $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
                $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
                $diff_in_days[$key] = $to_date->diffInDays($from_date) + 1;
                $leave_left = $leave_left + $diff_in_days[$key];
            }
            $leave_left = $leaveData->total_leave - $leave_left;
        }

        // calculating previous fiscal year bida for Ghar bida and birami bida
        if ($leaveData->leave_type == 'घर बिदा' || $leaveData->leave_type == 'बिरामी बिदा') {
            $staff_id = Staff::query()->where('user_id', auth()->user()->id)->first()->id;
            $prevLeaves = SettingValues::query()->where('staff_id', $staff_id)->with('leaves')->get();

            foreach ($prevLeaves as $key => $value) {
                if ($value->leaves->leave_type == $leaveData->leave_type) {
                    $leave_left = $leave_left + $value->previous_leave_left;
                }
            }

            // $fiscal_year = FiscalYear::query()->where('id', config('pis_constant.PREVIOUS_FISCAL_YEAR_ID'))->first();
            // $applications = StaffLeaveApplication::query()->where('leave_type', $leaveDataId)
            //     ->where('fiscal_year', $fiscal_year->name)
            //     ->where('staff_name', $staffName)
            //     ->where('is_approved', 1)
            //     ->get();
            // $prev_leave_left = 0;
            // if (count($applications) > 0) {
            //     foreach ($applications as $key => $value) {
            //         $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
            //         $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
            //         $diff_in_days[$key] = $to_date->diffInDays($from_date) + 1;
            //         $prev_leave_left = $prev_leave_left + $diff_in_days[$key];
            //     }
            //     $prev_leave_left = $leaveData->total_leave - $prev_leave_left;
            //     $leave_left = $prev_leave_left + $leave_left;
            // }
        }
        $data = array();
        $data['leave_left'] = $leave_left;
        $data['leaveData'] = $leaveData;

        if ($leaveData != null) {
            return response()->json($data, 200);
        }
    }

    public function leave_and_medicine_payment()
    {
        if (isset($this->identity)) {
            $staffName = Staff::query()->where('user_id', $this->identity)->first()->name;
        } else {

            $staffName = Staff::query()->where('user_id', auth()->user()->id)->first();
            if ($staffName == null) {
                return redirect()->route('staff_form')->with('msg', 'सुरुमा यो फारम भर्नुहोस्');
            } else {
                $staffName = $staffName->name;
            }
        }
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

        if (isset($this->identity)) {
            $staff = Staff::query()->where('user_id', $this->identity)->first();
            $staff_id = Staff::query()->where('user_id', $this->identity)->first()->id;
        } else {
            $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
            $staff_id = Staff::query()->where('user_id', auth()->user()->id)->first()->id;
        }

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

        if (isset($this->identity)) {
            $data =  [
                'current_fiscal_year' => isset($current_fiscal_year) ? $current_fiscal_year : null,

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

            ];
            return $data;
        }


        return view(
            'pis.staff.leave_details',
            [
                'current_fiscal_year' => isset($current_fiscal_year) ? $current_fiscal_year : null,

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


    public function staff_search()
    {
        $provinces = Province::all();
        $religions = $this->get_setting($this->setup_religions);
        $ethnicities = $this->get_setting($this->setup_ethnicities);
        return view(
            'pis.staff.staff_search',
            [
                'provinces' => $provinces,
                'religions' => $religions,
                'ethnicities' => $ethnicities,
                'genders' => $this->_genders,
            ]
        );
    }

    public function staff_search_submit(Request $request)
    {
        $user = User::selectRaw('*')
            ->leftJoin(env('DB_DATABASE_PIS') . '.staff_address', 'staff_address.user_id', '=', 'users.id')
            ->leftJoin(env('DB_DATABASE_PIS') . '.staff_profiles', 'staff_profiles.user_id', '=', 'users.id')
            ->join(env('DB_DATABASE_PIS') . '.staffs', 'staffs.user_id', '=', 'users.id')
            ->when($request->province, function ($query) use ($request) {
                $query->where('staff_address.p_province', $request->province);
            })

            ->when($request->district, function ($query) use ($request) {
                $query->where('staff_address.p_district', $request->district);
            })

            ->when($request->municiplaity, function ($query) use ($request) {
                $query->where('staff_address.p_municipality', $request->municiplaity);
            })

            ->when($request->ethnicities, function ($query) use ($request) {
                $query->where('staff_profiles.ethnicity', $request->ethnicities);
            })

            ->when($request->religions, function ($query) use ($request) {
                $query->where('staff_profiles.religion', $request->religions);
            })

            ->when($request->genders, function ($query) use ($request) {
                $query->where('staff_profiles.gender', $request->genders);
            })
            ->paginate(10);


        $provinces = Province::all();
        $religions = $this->get_setting($this->setup_religions);
        $ethnicities = $this->get_setting($this->setup_ethnicities);
        // dd($user);
        return view(
            'pis.staff.staff_search',
            [
                'provinces' => $provinces,
                'religions' => $religions,
                'ethnicities' => $ethnicities,
                'genders' => $this->_genders,
                'users' => $user
            ]
        );
    }

    public function sheetroll_show($id)
    {
        $temp = Staff::query()->where('user_id', $id)->first();

        if ($temp->is_approved == 0) {
            return redirect()->back()->with('msg', 'User not verified yet');
        }
        $user = User::selectRaw('*')
            ->join(env('DB_DATABASE_PIS') . '.staffs', 'staffs.user_id', '=', 'users.id')
            ->join(env('DB_DATABASE_PIS') . '.staff_address', 'staff_address.user_id', '=', 'users.id')
            ->join(env('DB_DATABASE_PIS') . '.staff_profiles', 'staff_profiles.user_id', '=', 'users.id')
            ->join(env('DB_DATABASE_PIS') . '.staff_appointments', 'staff_appointments.user_id', '=', 'users.id')
            ->join(env('DB_DATABASE_PIS') . '.staff_details', 'staff_details.user_id', '=', 'users.id')
            ->orWhere('staff_address.user_id', '=', $id)
            ->orWhere('staff_profiles.user_id', '=', $id)
            ->orWhere('staffs.user_id', '=', $id)
            ->orWhere('staff_appointments.user_id', '=', $id)
            ->orWhere('staff_details.user_id', '=', $id)
            ->with('services')
            ->with('officeGroups')
            ->with('levels')
            ->with('positions')
            ->first();


        $staff_prev_appointments = User::selectRaw('*')
            ->join(env('DB_DATABASE_PIS') . '.staff_prev_appointments', 'staff_prev_appointments.user_id', '=', 'users.id')
            ->orWhere('staff_prev_appointments.user_id', '=', $id)
            ->with('services')
            ->with('officeGroups')
            ->with('levels')
            ->with('officeSubGroups')
            ->with('positions')
            ->first();


        $languages = User::selectRaw('*')
            ->join(env('DB_DATABASE_PIS') . '.staff_languages', 'staff_languages.user_id', '=', 'users.id')
            ->orWhere('staff_languages.user_id', '=', $id)
            ->with('languages')
            ->get();

        $services = User::selectRaw('*')
            ->join(env('DB_DATABASE_PIS') . '.staff_services', 'staff_services.user_id', '=', 'users.id')
            ->orWhere('staff_services.user_id', '=', $id)
            ->with('services')
            ->with('officeGroups')
            ->with('levels')
            ->with('officeSubGroups')
            ->with('positions')
            ->get();

        $educations = User::selectRaw('*')
            ->join(env('DB_DATABASE_PIS') . '.staff_educations', 'staff_educations.user_id', '=', 'users.id')
            ->orWhere('staff_educations.user_id', '=', $id)
            ->with('positions')
            ->with('qualifications')
            ->with('subjects')
            ->with('institutes')
            ->get();

        $trainings = User::selectRaw('*')
            ->join(env('DB_DATABASE_PIS') . '.staff_trainings', 'staff_trainings.user_id', '=', 'users.id')
            ->orWhere('staff_trainings.user_id', '=', $id)
            ->get();

        $awards = User::selectRaw('*')
            ->join(env('DB_DATABASE_PIS') . '.staff_awards', 'staff_awards.user_id', '=', 'users.id')
            ->orWhere('staff_awards.user_id', '=', $id)
            ->get();

        $punishment_data = User::selectRaw('*')
            ->join(env('DB_DATABASE_PIS') . '.staff_punishments', 'staff_punishments.user_id', '=', 'users.id')
            ->orWhere('staff_punishments.user_id', '=', $id)
            ->with('punishments')
            ->get();

        $works = User::selectRaw('*')
            ->join(env('DB_DATABASE_PIS') . '.staff_works', 'staff_works.user_id', '=', 'users.id')
            ->orWhere('staff_works.user_id', '=', $id)
            ->get();


        $this->identity = $id;

        $data = $this->leave_and_medicine_payment();
        // dd($data);

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

        // dd($appoinments);


        return view(
            'pis.staff.sheetroll',
            [
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
                'languages' => $languages,
                'staff_prev_appointments' => $staff_prev_appointments,
                'countries' => $countries,
                'services' => $services,
                'appointments' => $appoinments,
                'educations' => $educations,
                'trainings' => $trainings,
                'awards' => $awards,
                'punishment_data' => $punishment_data,
                'leave_data' => $data,
                'works' => $works
            ]
        );
    }

    public function staff_reg_request_list()
    {
        $requests = User::query()->where('is_verified', 0)->paginate(3);
        return view('pis.staff.staff_reg_request_list', [
            'requests' => $requests,
        ]);
    }

    public function verify_request(User $user)
    {
        $user->update([
            'is_verified' => 1
        ]);
        Notification::create([
            'event_id' => $user->id,
            'text' => $user->name . ' लाइ कर्मचारी दर्ता गराऊन सफल भयो',
            'is_read' => 0,
            'role_id' => config('pis_constant.CAO')
        ]);
        return redirect()->back()->with('msg', 'नया कर्मचारी दर्ता सफल भयो');
    }

    public function reject_request(User $user)
    {
        $user->update([
            'is_verified' => 2
        ]);
        return redirect()->back()->with('msg', 'नया कर्मचारी दर्ता अस्वीकार गर्न सफल भयो');
    }

    public function registered_staffs()
    {
        $registered = User::query()->where('is_verified', 1)->paginate(5);
        return view('pis.staff.staff_reg_request_list', [
            'registered' => $registered
        ]);
    }

    public function decline_registered_staffs()
    {
        $rejected = User::query()->where('is_verified', 2)->paginate(3);
        return view('pis.staff.staff_reg_request_list', [
            'rejected' => $rejected
        ]);
    }

    public function delete_request(User $user)
    {
        $user->delete();
        return redirect()->back()->with('msg', 'कर्मचारी डिलिट गर्न सफल भयो');
    }

    public function adminNotifications()
    {
        $notifications = Notification::query()->where('role_id', 9)->where('is_read', 0)->get();
        return response()->json($notifications);
    }

    public function CAONotifications()
    {
        $notifications = Notification::query()->where('role_id', 4)->where('is_read', 0)->get();
        return response()->json($notifications);
    }

    public function taskNotifications()
    {
        $notifications = Notification::query()->where('role_id', config('pis_constant.USER_ID'))->where('is_read', 0)->with('staffs')->get();
        return response()->json($notifications);
    }

    public function markAsRead(Request $request)
    {
        Notification::query()->where('id', $request->id)->update([
            'is_read' => 1
        ]);
    }

    public function all_notification()
    {

        abort_if(Auth::user()->hasRole('user'), 403, 'NOT AUTHORISED');
        if (Auth::user()->hasRole('admin')) {
            $notifications = Notification::query()
                ->where('role_id', config('pis_constant.ADMIN_ID'))
                ->where('is_read', 0)->get();
        } elseif (Auth::user()->hasRole('cao')) {
            $notifications = Notification::query()
                ->where('role_id', config('pis_constant.CAO'))
                ->where('is_read', 0)->get();
        }

        return view('pis.staff.view_notification_list', [
            'notifications' => $notifications
        ]);
    }

    public function mark_as_read(Notification $notification)
    {
        $notification->update([
            'is_read' => 1
        ]);
        return redirect()->back();
    }

    public function localRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="tl_' . $r . '">';
            $html .= '<input type="hidden" name="local_ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="language_' . $r . '" name="language[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $languages = $this->get_setting($this->setup_languages);

            foreach ($languages as $language) {
                $html .= '<option value="' . $language->id . '">' . $language->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td><input type="radio" name="writing[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="writing[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="writing[' . $r . ']" value="3" ></td>';
            $html .= '<td><input type="radio" name="reading[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="reading[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="reading[' . $r . ']" value="3" ></td>';
            $html .= '<td><input type="radio" name="speaking[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="speaking[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="speaking[' . $r . ']" value="3" ></td>';
            $html .= '<td><a id="dl_' . $r . '" class="btn btn-sm btn-danger dl"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function foreignRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="tf_' . $r . '">';
            $html .= '<input type="hidden" name="foreign_ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="language2_' . $r . '" name="language2[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $languages = $this->get_setting($this->setup_f_languages);

            foreach ($languages as $language) {
                $html .= '<option value="' . $language->id . '">' . $language->name . '</option>';
            }
            $html .= '</select></td>';
            $html .= '<td><input type="radio" name="writing2[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="writing2[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="writing2[' . $r . ']" value="3" ></td>';
            $html .= '<td><input type="radio" name="reading2[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="reading2[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="reading2[' . $r . ']" value="3" ></td>';
            $html .= '<td><input type="radio" name="speaking2[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="speaking2[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="speaking2[' . $r . ']" value="3" ></td>';
            $html .= '<td><a id="df_' . $r . '" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function serviceRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="service_' . $r . '" name="service[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $services = $this->get_setting($this->setup_services);

            foreach ($services as $service) {
                $html .= '<option value="' . $service->id . '">' . $service->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;">';
            $html .= '<select id="office_group_' . $r . '" name="office_group[' . $r . ']" class="form-control select2"><option value="" data-eng="">समूह चयन</option>';
            $groups =  $this->get_setting($this->setup_office_groups);

            foreach ($groups as $group) {
                $html .= '<option value="' . $group->id . '">' . $group->name . '</option>';
            }

            $html .= '</select>';
            $html .= '<select id="office_subgroup_' . $r . '" name="office_subgroup[' . $r . ']" class="form-control select2"><option value="" data-eng="">उप समूह चयन</option>';
            $subgroups = $this->get_setting($this->setup_office_subgroups);

            foreach ($subgroups as $subgroup) {
                $html .= '<option value="' . $subgroup->id . '">' . $subgroup->name . '</option>';
            }

            $html .= '</select>';
            $html .= '</td>';
            $html .= '<td style="max-width: 200px;">';
            $html .= '<select id="position_' . $r . '" name="position[' . $r . ']" class="form-control select2"><option value="" data-eng="">पद चयन</option>';
            $positions = $this->get_setting($this->setup_positions);

            foreach ($positions as $position) {
                $html .= '<option value="' . $position->id . '">' . $position->name . '</option>';
            }

            $html .= '</select>';
            $html .= '<select id="level_' . $r . '" name="level[' . $r . ']" class="form-control select2"><option value="" data-eng="">श्रेणी चयन</option>';
            $levels = $this->get_setting($this->setup_levels);

            foreach ($levels as $level) {
                $html .= '<option value="' . $level->id . '">' . $level->name . '</option>';
            }

            $html .= '</select>';
            $html .= '</td>';
            $html .= '<td><input type="text" name="office_name_address[' . $r . ']" class="form-control" required></td>';
            $html .= '<td><input type="text" name="office_name_address_english[' . $r . ']" class="form-control" required></td>';
            $html .= '<td>';
            $a = 1;
            foreach ($this->_appoints as $v => $appoint) {
                if ($a == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                $a++;
                $html .= '<label style="font-weight: normal;"><input type="radio" name="appoint[' . $r . ']" value="' . $v . '" ' . $checked . '>' . $appoint . '</label>';
            }
            $html .= '</td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="decision_date_' . $r . '" name="decision_date[' . $r . ']" class="form-control nepaliDate ndp-custom"></div></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="restoration_date_' . $r . '" name="restoration_date[' . $r . ']" class="form-control nepaliDate ndp-custom"></div></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function educationRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $qualifications = $this->get_setting($this->setup_edu_qualifications);
            $subjects = $this->get_setting($this->setup_edu_subjects);
            $positions = $this->get_setting($this->setup_edu_positions);
            $institutes = $this->get_setting($this->setup_edu_institutes);
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="qualification_' . $r . '" name="qualification[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';

            foreach ($qualifications as $qualification) {
                $html .= '<option value="' . $qualification->id . '">' . $qualification->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;"><select id="subject_' . $r . '" name="subject[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';

            foreach ($subjects as $subject) {
                $html .= '<option value="' . $subject->id . '">' . $subject->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;"><select id="year_' . $r . '" name="year[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $latest_year = (int)date('Y') + 57;
            for ($year = $latest_year; $year >= 2040; $year--) {
                $html .= '<option value="' . $year . '">' . $year . '</option>';
            }
            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;"><select id="position_' . $r . '" name="position[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';

            foreach ($positions as $position) {
                $html .= '<option value="' . $position->id . '">' . $position->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;"><select id="institute_' . $r . '" name="institute[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';

            foreach ($institutes as $institute) {
                $html .= '<option value="' . $institute->id . '">' . $institute->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function trainingRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td><textarea id="detail_' . $r . '" name="detail[' . $r . ']" class="form-control" rows="3"></textarea></td>';
            $html .= '<td><input type="text" id="date_' . $r . '" name="date[' . $r . ']" class="form-control nepaliDate" value=""></td>';
            $html .= '<td><input type="text" id="type_' . $r . '" name="type[' . $r . ']" class="form-control" value=""></td>';
            $html .= '<td><input type="text" id="institute_' . $r . '" name="institute[' . $r . ']" class="form-control" value=""></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function awardRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td><input type="text" name="award_detail[' . $r . ']" class="form-control" required></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="received_date_' . $r . '" name="received_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><input type="text" name="reason[' . $r . ']" class="form-control"></td>';
            $html .= '<td><input type="text" name="convenience[' . $r . ']" class="form-control"></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function punishmentRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="punishment_' . $r . '" name="punishment[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $punishments = $this->get_setting($this->setup_punishments);

            foreach ($punishments as $punishment) {
                $html .= '<option value="' . $punishment->id . '">' . $punishment->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="ordered_date_' . $r . '" name="ordered_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><label><input type="radio" name="stopped[' . $r . '" value="1"> हो</label><label><input type="radio" name="stopped[' . $r . ']" checked value="0"> होइन</label></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="stopped_date_' . $r . '" name="stopped_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><textarea name="remarks[' . $r . ']" class="form-control"></textarea></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function dwRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="from_date_' . $r . '" name="form_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="to_date_' . $r . '" name="to_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><input type="text" name="post_area[' . $r . ']" class="form-control"></td>';
            $html .= '<td><input type="text" name="work_area[' . $r . ']" class="form-control"></td>';
            $html .= '<td><input type="checkbox" id="a_work_' . $r . '" name="a_work[' . $r . ']" value="1"></td>';
            $html .= '<td><input type="checkbox" id="b_work_' . $r . '" name="b_work[' . $r . ']" value="1"></td>';
            $html .= '<td><input type="checkbox" id="c_work_' . $r . '" name="c_work[' . $r . ']" value="1"></td>';
            $html .= '<td><input type="checkbox" id="d_work_' . $r . '" name="d_work[' . $r . ']" value="1"></td>';
            $html .= '<td><input type="checkbox" id="e_work_' . $r . '" name="e_work[' . $r . ']" value="1"></td>';
            $html .= '<td><textarea name="remarks[' . $r . ']" class="form-control"></textarea></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }
}
