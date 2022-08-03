<?php

namespace App\Http\Controllers\PisControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SharedControllers\RoleController;
use App\Models\PisModel\Notification;
use App\Models\PisModel\settingLeave;
use App\Models\PisModel\Settings;
use App\Models\PisModel\SettingsBhatta;
use App\Models\PisModel\SettingValues;
use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffAddress;
use App\Models\PisModel\StaffDetail;
use App\Models\PisModel\StaffMaag;
use App\Models\PisModel\StaffMaagDetails;
use App\Models\PisModel\StaffMaagno;
use App\Models\PisModel\StaffMarmat;
use App\Models\PisModel\StaffMarmatDetails;
use App\Models\PisModel\StaffMarmatno;
use App\Models\PisModel\StaffMarmatStoreKeeper;
use App\Models\PisModel\StaffService;
use App\Models\PisModel\StaffVisit;
use App\Models\PisModel\StaffVisitAadesh;
use App\Models\PisModel\StaffVisitBill;
use App\Models\SharedModel\FiscalYear;
use App\Models\PisModel\StaffVisitAadeshDetails;
use App\Models\PisModel\StaffVisitPratiwedan;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Spatie\Permission\Contracts\Role;

class FormController extends Controller
{
    public $setup_goods = 'setup_goods';
    public $maag_latest = array();

    public function test()
    {
        Auth::logout();
    }


    private function get_shared_setting($slug)
    {
        $setting = Setting::where(['slug' => $slug, 'is_deleted' => false])->first();
        return SettingValue::where(['setting_id' => $setting->id, 'is_deleted' => false])->get();
    }


    private function get_setting($slug)
    {
        $setting = Settings::where(['slug' => $slug])->first();
        return SettingValues::where(['setting_id' => $setting->id])->get();
    }

    public function maag_form_show()
    {
        $fiscal_year = FiscalYear::query()->where('is_current', 1)->first();
        $user = auth()->user();
        $staff = Staff::query()->where('user_id', $user->id)->first();
        if ($staff != null) {
            if ($staff->is_approved == 0) {
                return redirect()->back()->with('msg', 'प्रमाणित हुन् वाकी');
            }
        } else {
            return redirect()->route('staff_form')->with('msg', ',कर्मचारी विवरण भर्नुहोस्');
        }
        $saman = $this->get_setting($this->setup_goods);

        return view(
            'pis.staff.forms.maag_form',
            [
                'fiscal_year' => $fiscal_year,
                'staff' => $staff,
                'saman' => $saman
            ]
        );
    }

    public function maag_form_submit(Request $request)
    {
        $approval = Staff::query()->where('user_id', auth()->user()->id)->first()->is_approved;
        if ($approval == 0) {
            return redirect()->back()->with('msg', 'स्वीकृत हुन् बाकी');
        }

        $request->validate([
            'fiscal_year.*' => 'required',
            'saman_name.*' => 'required',
            'specification.*' => 'required',
            'unit.*' => 'required',
            'quantity.*' => 'required',
            'remarks.*' => 'required'
        ]);
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();

        $staff_maag_no = StaffMaagno::all();
        if (count($staff_maag_no) > 0) {
            $maag_no = StaffMaagno::query()->latest()->first()->maag_no;
            $latest_maag_no = StaffMaagno::create([
                'maag_no' => $maag_no + 1,
                'is_approved' => 0,
                'is_verified' => 0,
                'staff_id' => $staff->id
            ]);
        } else {
            $latest_maag_no = StaffMaagno::create([
                'maag_no' => 1,
                'is_approved' => 0,
                'is_verified' => 0,
                'staff_id' => $staff->id
            ]);
        }


        $id = array();


        foreach ($request->fiscal_year as $key => $value) {
            $id[$key] = StaffMaag::create([
                'staff_id' => $staff->id,
                'fiscal_year' => $request->fiscal_year[$key],
                'saman_name' => $request->saman_name[$key],
                'specification' => $request->specification[$key],
                'unit' => $request->unit[$key],
                'quantity' => $request->quantity[$key],
                'remarks' => $request->remarks[$key],
                'maag_no' => $latest_maag_no->maag_no,
                'kharid_type' => $request->radio
            ]);
        }
        $latest = array();
        foreach ($id as $key => $value) {
            $latest[$key] = StaffMaag::query()->where('id', $value->id)->with('saman')->first();
        }
        $request->session()->put('latest', $latest);

        Notification::create([
            'text' => $staff->nep_name . 'को नया माग फारम आवेदन भएकोछ',
            'is_read' => 0,
            'role_id' => config('pis_constant.ADMIN_ID'),
        ]);

        Notification::create([
            'text' => 'तपाइको आवेदन एडमिन ठाउमा छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $staff->id,
            'noti_type' => 'forms'
        ]);



        $staffMaag = StaffMaag::query()->where('staff_id', $staff->id)->get();
        $staffName = Staff::query()->where('user_id', auth()->user()->id)->first()->nep_name;
        $staffs = Staff::all();
        $fiscal_year = FiscalYear::query()->where('is_current', 1)->first();

        return redirect()->back()->with('msg', 'माग फारम आवेदन भएको छ');
        // return view(
        //     'pis.staff.forms.view_maag_form',
        //     [
        //         'latest' => $latest,
        //         'staff_name' => $staffName,
        //         'staffs' => $staffs,
        //         'fiscal_year' => $fiscal_year,
        //         'kharid_type' => $request->radio
        //     ]
        // );
    }

    public function maag_form_print(Request $request)
    {

        $request->validate([
            "fiscal_year" => 'required',
            "date" => 'required',
            "maag_date" => 'required',
            "prayojan" => 'required',
            "sifarish_garneko_name" => "required",
            "sifarish_date" => 'required',
            "kharid_type" => "required",
            "aadesh_date" => 'required',
            "maal_saman_bujeko" => 'required',
            "maal_saman_chadako" => 'required',
        ]);
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        $latest = $request->session()->get('latest');

        foreach ($latest as $key => $value) {
            $maag_no = $value->maag_no;
        }

        StaffMaagDetails::create([
            'print_date' => $request->date,
            'maag_date' => $request->maag_date,
            'prayojan' => $request->prayojan,
            'sifarish_garneko_name' => $request->sifarish_garneko_name,
            'sifarish_date' => $request->sifarish_date,
            'aadesh_date' => $request->aadesh_date,
            'maal_saman_bujeko_date' => $request->maal_saman_bujeko,
            'jinsi_khata_date' => $request->maal_saman_chadako,
            'maag_no' => $maag_no
        ]);

        $request->session()->forget('latest');
        return view(
            'pis.staff.forms.print_maag_form',
            [
                'fiscal_year' => $request->fiscal_year,
                'date' => $request->date,
                'maag_date' => $request->maag_date,
                'prayojan' => $request->prayojan,
                'sifarish_date' => $request->sifarish_date,
                'aadesh_date' => $request->aadesh_date,
                'maal_saman_bujeko' => $request->maal_saman_bujeko,
                'maal_saman_chadeko' => $request->maal_saman_chadeko,
                'staff' => $staff,
                'latest' => $latest,
                'sifarish_garneko_name' => $request->sifarish_garneko_name,
                'kharid_type' => $request->kharid_type,
            ]

        );
    }

    public function maag_form_list()
    {
        if (auth()->user()->hasRole('cao') == true || auth()->user()->hasRole('admin') == true) {
            $maag = StaffMaagno::with(['maags.maag_details', 'staffs'])->get();
        } else {
            $user = Staff::query()->where('user_id', auth()->user()->id)->first();
            if ($user != null) {
                $maag = StaffMaagno::with(['maags.maag_details', 'staffs'])->where('staff_id', $user->id)->get();
            } else {
                return redirect()->back()->with('msg', 'सुरुमा कर्मचारी विवरण भर्नुहोस्');
            }
        }
        $saman = SettingValues::query()->where('setting_id', 1)->get();


        return view(
            'pis.staff.forms.maag_form_list',
            [
                'maag' => $maag,
                'saman' => $saman
            ]
        );
    }

    public function view_maag_details(StaffMaagDetails $maag)
    {
        $maags = $maag->load('maag')->first();

        foreach ($maags->maag as $key => $value) {
            $fiscal_year = $value->fiscal_year;
            $kharid_type = $value->kharid_type;
            $staff = Staff::query()->where('id', $value->staff_id)->first();
        }


        return view(
            'pis.staff.forms.print_maag_form',
            [
                'fiscal_year' => $fiscal_year,
                'date' => $maag->print_date,
                'maag_date' => $maag->maag_date,
                'prayojan' => $maag->prayojan,
                'sifarish_date' => $maag->sifarish_date,
                'radio' => $kharid_type,
                'aadesh_date' => $maag->aadesh_date,
                'maal_saman_bujeko' => $maag->maal_saman_bujeko_date,
                'maal_saman_chadeko' => $maag->jinsi_khata_date,
                'staff' => $staff,
                'latest' => $maag->maag,
                'sifarish_garneko_name' => $maag->sifarish_garneko_name,
                'kharid_type' => $kharid_type,
            ]

        );
    }

    public function fill_maag_details(StaffMaagno $maag)
    {
        $latest = StaffMaag::query()->where('maag_no', $maag->maag_no)->with('saman')->get();
        foreach ($latest as $key => $value) {
            $kharid_type = $value->kharid_type;
        }
        $staffName = Staff::query()->where('user_id', auth()->user()->id)->first()->nep_name;
        $staffs = Staff::all();
        $fiscal_year = FiscalYear::query()->where('is_current', 1)->first();
        return view(
            'pis.staff.forms.view_maag_form',
            [
                'latest' => $latest,
                'staff_name' => $staffName,
                'staffs' => $staffs,
                'fiscal_year' => $fiscal_year,
                'kharid_type' => $kharid_type
            ]
        );
    }

    public function verify_maag_details(StaffMaagno $maag)
    {
        $staff_name = $maag->load('staffs')->staffs->nep_name;
        $maag->update([
            'is_verified' => config('pis_constant.APPROVE')
        ]);
        Notification::create([
            'text' => $staff_name . 'को नया माग फारम सिफारिस भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.CAO'),
        ]);

        return redirect()->back()->with('msg', 'स्वीकार गर्न सफल भयो');
    }

    public function decline_maag_details(StaffMaagno $maag)
    {
        $maag->update([
            'is_verified' => config('pis_constant.DECLINE')
        ]);
        return redirect()->back()->with('msg', 'अस्विकार गर्न सफल भयो');
    }

    public function approve_maag_details(StaffMaagno $maag)
    {
        $staff_name = $maag->load('staffs')->staffs->nep_name;
        $maag->update([
            'is_approved' => config('pis_constant.APPROVE')
        ]);
        Notification::create([
            'text' => 'तपाइको माग फारम स्वीकृत भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $maag->staff_id,
            'noti_type' => 'forms'
        ]);
        return redirect()->back()->with('msg', 'अनुमोदन गर्न सफल भयो');
    }

    public function disapprove_maag_details(StaffMaagno $maag)
    {
        $maag->update([
            'is_approved' => config('pis_constant.DECLINE')
        ]);
        Notification::create([
            'text' => 'तपाइको माग फारम अस्विकार भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $maag->staff_id,
            'noti_type' => 'forms'
        ]);
        return redirect()->back()->with('msg', 'अस्विकार गर्न सफल भयो');
    }

    public function edit_maag_form(StaffMaagno $maag)
    {
        $maag = $maag->load('maags');
        $fiscal_year = FiscalYear::query()->where('is_current', 1)->first();
        $user = auth()->user();
        $staff = Staff::query()->where('id', $maag->staff_id)->first();
        if ($staff != null) {
            if ($staff->is_approved == 0) {
                return redirect()->back()->with('msg', 'प्रमाणित हुन् वाकी');
            }
        } else {
            return redirect()->route('staff_form')->with('msg', ',कर्मचारी विवरण भर्नुहोस्');
        }
        $saman = $this->get_setting($this->setup_goods);

        return view(
            'pis.staff.forms.edit_maag_form',
            [
                'fiscal_year' => $fiscal_year,
                'staff' => $staff,
                'saman' => $saman,
                'maag' => $maag
            ]
        );
    }

    public function update_maag_form(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'fiscal_year.*' => 'required',
            'saman_name.*' => 'required',
            'specification.*' => 'required',
            'unit.*' => 'required',
            'quantity.*' => 'required',
            'remarks.*' => 'required'
        ]);

        $staff = Staff::query()->where('id', $request->staff_id)->first();
        $maag_no = StaffMaag::query()->where('maag_no', $request->maag_no)->get();

        foreach ($maag_no as $key => $value) {
            $value->delete();
        }
        foreach ($request->fiscal_year as $key => $value) {
            $id[$key] = StaffMaag::create([
                'staff_id' => $request->staff_id,
                'fiscal_year' => $request->fiscal_year[$key],
                'saman_name' => $request->saman_name[$key],
                'specification' => $request->specification[$key],
                'unit' => $request->unit[$key],
                'quantity' => $request->quantity[$key],
                'remarks' => $request->remarks[$key],
                'maag_no' => $request->maag_no,
                'kharid_type' => $request->radio
            ]);
        }

        $latest = array();
        foreach ($id as $key => $value) {
            $latest[$key] = StaffMaag::query()->where('id', $value->id)->with('saman')->first();
        }
        $request->session()->put('latest', $latest);

        Notification::create([
            'text' => $staff->nep_name . 'को नया माग फारम एडिट भएकोछ',
            'is_read' => 0,
            'role_id' => config('pis_constant.ADMIN_ID'),
        ]);

        Notification::create([
            'text' => 'तपाइको आवेदन एडिट भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $staff->id,
            'noti_type' => 'forms'
        ]);

        return redirect()->back()->with('msg', 'माग फारम आवेदन भएको छ');
    }

    public function marmat_aadesh_form()
    {
        $fiscal_year = FiscalYear::query()->where('is_current', 1)->first();
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();

        if ($staff != null) {
            if ($staff->is_approved == 0) {
                return redirect()->back()->with('msg', 'स्विक्र्त हुन् वाकी');
            }
        } else {
            return redirect()->route('staff_form')->with('msg', 'कर्मचारी विवरण भर्नुहोस्');
        }
        return view(
            'pis.staff.forms.marmat_aadesh_form',
            [
                'fiscal_year' => $fiscal_year,
                'staff' => $staff
            ]
        );
    }

    public function marmat_aadesh_form_submit(Request $request)
    {
        $approval = Staff::query()->where('user_id', auth()->user()->id)->first()->is_approved;
        if ($approval == 0) {
            return redirect()->back()->with('msg', 'स्वीकृत हुन् बाकी');
        }
        $request->validate([
            'saman_bibaran.*' => 'required',
            'saman_pahichan_no.*' => 'required',
            'anumati_mamrmat_lagat.*' => 'required',
            'reason.*' => 'required',
            'applicant_name.*' => 'required',
            'remarks.*' => 'required',
        ]);
        $marmat = StaffMarmatno::all();
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        if (count($marmat) > 0) {
            $marmat_no = StaffMarmatno::query()->latest()->first();
            $latest_marmat_no = StaffMarmatno::create([
                'marmat_form_no' => $marmat_no->marmat_form_no + 1,
                'staff_id' => $staff->id,
                'is_verified' => 0,
                'is_approved' => 0
            ]);
        } else {
            $latest_marmat_no =  StaffMarmatno::create([
                'marmat_form_no' => 1,
                'staff_id' => $staff->id,
                'is_verified' => 0,
                'is_approved' => 0
            ]);
        }
        foreach ($request->saman_bibaran as $key => $value) {
            $id[$key] =  StaffMarmat::create([
                'saman_bibaran' => $request->saman_bibaran[$key],
                'anumati_marmat_lagat' => $request->anumati_mamrmat_lagat[$key],
                'saman_pahichan_no' => $request->saman_pahichan_no[$key],
                'reason' => $request->reason[$key],
                'applicant_name' => $request->applicant_name[$key],
                'remarks' => $request->remarks[$key],
                'marmat_form_no' => $latest_marmat_no->marmat_form_no,
                'staff_id' => $staff->id
            ]);
        }

        Notification::create([
            'text' => $staff->nep_name . 'को नया मर्मत आदेस आवेदन भएकोछ',
            'is_read' => 0,
            'role_id' => config('pis_constant.ADMIN_ID'),
        ]);

        Notification::create([
            'text' => 'तपाइको आवेदन एडमिनको ठाउमा छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $staff->id,
            'noti_type' => 'forms'
        ]);
        $latest = array();
        foreach ($id as $key => $value) {
            $latest[$key] = StaffMarmat::query()->where('id', $value->id)->first();
        }

        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        $staffAddress = StaffAddress::query()->where('user_id', auth()->user()->id)->with('municipalities')->first();
        $staff_all = Staff::all();
        $staff_Services = StaffService::query()->where('user_id', auth()->user()->id)->first();
        $services = StaffService::all();

        // return view(
        //     'pis.staff.forms.view_marmat_aadesh_form',
        //     [
        //         'latest' => $latest,
        //         'staff' => $staff,
        //         'staff_address' => $staffAddress,
        //         'staff_all' => $staff_all,
        //         'staff_Services' => $staff_Services,
        //         'services' => $services
        //     ]
        // );


        return redirect()->back()->with('msg', 'Data submitted successfully');
    }

    public function print_marmat_form(Request $request)
    {
        $request->validate([
            'fiscal_year' => 'required',
            'date' => 'required',
            "date" => 'required',
            "staff_detail_date" => 'required',
            "sakha_pramukh_name" => 'required',
            "sakha_pramukh_position" => 'required',
            "sakha_pramukh_date" => 'required',
            "sakha_prawidhik_name" => 'required',
            "sakha_prawidhik_position" => 'required',
            "sakha_prawidhik_date" => 'required',
            "karylaya_pramukh_name" => 'required',
            "karylaya_pramukh_position" => 'required',
            "karylaya_pramukh_date" => 'required',
        ]);
        $latest = array();
        foreach ($request->latest as $key => $value) {
            $latest[$key] = StaffMarmat::query()->where('id', $value)->first();
        }

        foreach ($latest as $key => $value) {
            $marmat_form_no = $value->marmat_form_no;
        }

        $marmatstorekeeper = StaffMarmatStoreKeeper::query()->where('marmat_form_no', $marmat_form_no)->first();

        $staffs = Staff::all();
        $staffAddress = StaffAddress::query()->where('user_id', auth()->user()->id)->with('municipalities')->first();
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();

        StaffMarmatDetails::create([
            'date' => $request->date,
            "staff_detail_date" => $request->staff_detail_date,
            "sakha_pramukh_name" => $request->sakha_pramukh_name,
            "sakha_pramukh_position" => $request->sakha_pramukh_position,
            "sakha_pramukh_date" => $request->sakha_pramukh_date,
            "sakha_prawidhik_name" => $request->sakha_prawidhik_name,
            "sakha_prawidhik_position" => $request->sakha_prawidhik_position,
            "sakha_prawidhik_date" => $request->sakha_prawidhik_date,
            "karylaya_pramukh_name" => $request->karylaya_pramukh_name,
            "karylaya_pramukh_position" => $request->karylaya_pramukh_position,
            "karylaya_pramukh_date" => $request->karylaya_pramukh_date,
            'marmat_form_no' => $marmat_form_no
        ]);
        // Notification::create([
        //     'text' => 'नया मर्मत आदेस दर्ता भएकोछ',
        //     'is_read' => 0,
        //     'role_id' => config('pis_constant.ADMIN_ID'),
        // ]);
        return view(
            'pis.staff.forms.print_marmat_aadesh_form',
            [
                'staff' => $staff,
                'staff_address' => $staffAddress,
                'staffs' => $staffs,
                'latest' => $latest,
                'date' => $request->date,
                "staff_detail_date" => $request->staff_detail_date,
                "sakha_pramukh_name" => $request->sakha_pramukh_name,
                "sakha_pramukh_position" => $request->sakha_pramukh_position,
                "sakha_pramukh_date" => $request->sakha_pramukh_date,
                "sakha_prawidhik_name" => $request->sakha_prawidhik_name,
                "sakha_prawidhik_position" => $request->sakha_prawidhik_position,
                "sakha_prawidhik_date" => $request->sakha_prawidhik_date,
                "karylaya_pramukh_name" => $request->karylaya_pramukh_name,
                "karylaya_pramukh_position" => $request->karylaya_pramukh_position,
                "karylaya_pramukh_date" => $request->karylaya_pramukh_date,
            ]

        );
    }

    public function marmat_form_list()
    {
        if (auth()->user()->hasRole('cao') == true || auth()->user()->hasRole('admin') == true) {
            $marmat = StaffMarmatno::with(['marmats.marmatDetails', 'staffs', 'marmatStoreKeeper'])->get();
        } else {
            $staff_id = Staff::query()->where('user_id', auth()->user()->id)->first();
            if ($staff_id != null) {
                $marmat = StaffMarmatno::with('marmats.marmatDetails', 'staffs', 'marmatStoreKeeper')->where('staff_id', $staff_id->id)->get();
            } else {
                return redirect()->route('staff_form')->with('msg', 'सुरुमा कर्मचारी विवरण भर्नुहोस्');
            }
        }

        return view(
            'pis.staff.forms.marmat_form_list',
            [
                'marmat' => $marmat
            ]
        );
    }

    public function fill_marmat_details(StaffMarmatno $marmatno)
    {
        $marmatstorekeeper = StaffMarmatStoreKeeper::query()->where('marmat_form_no', $marmatno->marmat_form_no)->first();
        $latest = StaffMarmat::query()->where('marmat_form_no', $marmatno->marmat_form_no)->get();
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        $staffAddress = StaffAddress::query()->where('user_id', auth()->user()->id)->with('municipalities')->first();
        $staff_all = Staff::all();
        $staff_Services = StaffService::query()->where('user_id', auth()->user()->id)->first();
        $services = StaffService::all();
        $fiscal_year = getCurrentFiscalYear();
        return view(
            'pis.staff.forms.view_marmat_aadesh_form',
            [
                'latest' => $latest,
                'staff' => $staff,
                'staff_address' => $staffAddress,
                'staff_all' => $staff_all,
                'staff_Services' => $staff_Services,
                'services' => $services,
                'marmatstorekeeper' => $marmatstorekeeper,
                'fiscal_year' => $fiscal_year
            ]
        );
    }

    // public function submit_marmat_details(StaffMarmatno $marmatno)
    // {
    // }
    public function view_marmat_details(StaffMarmatDetails $marmat)
    {
        $marmat = $marmat->load('marmat');

        $latest = array();

        foreach ($marmat->marmat as $key => $value) {
            $latest[$key] = StaffMarmat::query()->where('id', $value->id)->first();
        }

        $staffs = Staff::all();
        $staffAddress = StaffAddress::query()->where('user_id', auth()->user()->id)->with('municipalities')->first();
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();

        return view(
            'pis.staff.forms.print_marmat_aadesh_form',
            [
                'staff' => $staff,
                'staff_address' => $staffAddress,
                'staffs' => $staffs,
                'latest' => $latest,
                'date' => $marmat->date,
                "staff_detail_date" => $marmat->staff_detail_date,
                "sakha_pramukh_name" => $marmat->sakha_pramukh_name,
                "sakha_pramukh_position" => $marmat->sakha_pramukh_position,
                "sakha_pramukh_date" => $marmat->sakha_pramukh_date,
                "sakha_prawidhik_name" => $marmat->sakha_prawidhik_name,
                "sakha_prawidhik_position" => $marmat->sakha_prawidhik_position,
                "sakha_prawidhik_date" => $marmat->sakha_prawidhik_date,
                "karylaya_pramukh_name" => $marmat->karylaya_pramukh_name,
                "karylaya_pramukh_position" => $marmat->karylaya_pramukh_position,
                "karylaya_pramukh_date" => $marmat->karylaya_pramukh_date,
            ]

        );
    }

    public function marmat_storekeeper_form(StaffMarmatno $marmatno)
    {
        $marmat = StaffMarmatno::query()->where('id', $marmatno->id)->first();
        return view('pis.staff.forms.marmat_storekeeper_form', [
            'marmat' => $marmat
        ]);
    }

    public function marmat_storekeeper_form_submit(Request $request)
    {
        StaffMarmatStoreKeeper::create([
            'sanket_no' => $request->sanket_no,
            'has_warranty' => $request->has_warranty,
            'before_marmat_times' => $request->before_marmat_times,
            'before_marmat_date' => $request->before_marmat_date,
            'before_marmat_price' => $request->before_marmat_price,
            'marmat_form_no' => $request->marmat_no
        ]);
        return redirect()->route('marmat-form-list');
    }

    public function edit_marmat_form(StaffMarmatno $marmatno)
    {
        $marmat = $marmatno->load('marmats');
        $fiscal_year = FiscalYear::query()->where('is_current', 1)->first();
        $staff = Staff::query()->where('id', $marmat->staff_id)->first();
        return view(
            'pis.staff.forms.edit_marmat_aadesh_form',
            [
                'fiscal_year' => $fiscal_year,
                'staff' => $staff,
                'marmat' => $marmat
            ]
        );
    }

    public function update_marmat_form(Request $request)
    {
        $request->validate([
            'saman_bibaran.*' => 'required',
            'saman_pahichan_no.*' => 'required',
            'anumati_mamrmat_lagat.*' => 'required',
            'reason.*' => 'required',
            'applicant_name.*' => 'required',
            'remarks.*' => 'required',
        ]);

        $marmat = StaffMarmatno::all();
        $staff = Staff::query()->where('id', $request->staff_id)->first();

        $previousMarmat = StaffMarmat::query()->where('marmat_form_no', $request->marmat_form_no)->get();

        foreach ($previousMarmat as $key => $value) {
            $value->delete();
        }

        foreach ($request->saman_bibaran as $key => $value) {
            $id[$key] =  StaffMarmat::create([
                'saman_bibaran' => $request->saman_bibaran[$key],
                'anumati_marmat_lagat' => $request->anumati_mamrmat_lagat[$key],
                'saman_pahichan_no' => $request->saman_pahichan_no[$key],
                'reason' => $request->reason[$key],
                'applicant_name' => $request->applicant_name[$key],
                'remarks' => $request->remarks[$key],
                'marmat_form_no' => $request->marmat_form_no,
                'staff_id' => $staff->id
            ]);
        }

        Notification::create([
            'text' => $staff->nep_name . 'को नया मर्मत आदेस एडिट भएकोछ',
            'is_read' => 0,
            'role_id' => config('pis_constant.ADMIN_ID'),
        ]);

        Notification::create([
            'text' => 'तपाइको मर्मत आवेदन एडिट भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $staff->id,
            'noti_type' => 'forms'
        ]);
        $latest = array();
        foreach ($id as $key => $value) {
            $latest[$key] = StaffMarmat::query()->where('id', $value->id)->first();
        }

        $staff = Staff::query()->where('id', $request->staff_id)->first();
        $staffAddress = StaffAddress::query()->where('user_id', auth()->user()->id)->with('municipalities')->first();
        $staff_all = Staff::all();
        $staff_Services = StaffService::query()->where('user_id', auth()->user()->id)->first();
        $services = StaffService::all();

        // return view(
        //     'pis.staff.forms.view_marmat_aadesh_form',
        //     [
        //         'latest' => $latest,
        //         'staff' => $staff,
        //         'staff_address' => $staffAddress,
        //         'staff_all' => $staff_all,
        //         'staff_Services' => $staff_Services,
        //         'services' => $services
        //     ]
        // );


        return redirect()->back()->with('msg', 'Data updated successfully');
    }

    public function verify_marmat_details(StaffMarmatno $marmat)
    {
        $staff = $marmat->load('staffs')->staffs;
        $marmat->update([
            'is_verified' => config('pis_constant.APPROVE')
        ]);
        Notification::create([
            'text' => $staff->nep_name . 'को नया मर्मत आदेस फारम सिफारिस भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.CAO'),
        ]);


        return redirect()->back()->with('msg', 'स्वीकार गर्न सफल भयो');
    }

    public function decline_marmat_details(StaffMarmatno $marmat)
    {

        // $marmat = $marmat->load('maag');
        // dd($marmat);
        $marmat->update([
            'is_verified' => config('pis_constant.DECLINE')
        ]);
        return redirect()->back()->with('msg', 'अस्विकार गर्न सफल भयो');
    }

    public function approve_marmat_details(StaffMarmatno $marmat)
    {
        $marmat->update([
            'is_approved' => config('pis_constant.APPROVE')
        ]);

        Notification::create([
            'text' => 'तपाइको मर्मत फारम स्वीकृत भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $marmat->staff_id,
            'noti_type' => 'forms'
        ]);
        return redirect()->back()->with('msg', 'अनुमोदन गर्न सफल भयो');
    }

    public function disapprove_marmat_details(StaffMarmatno $marmat)
    {
        $marmat->update([
            'is_approved' => config('pis_constant.DECLINE')
        ]);
        Notification::create([
            'text' => 'तपाइको मर्मत फारम अस्विकार भएको छ',
            'is_read' => 0,
            'role_id' => config('pis_constant.USER_ID'),
            'staff_id' => $marmat->staff_id,
            'noti_type' => 'forms'
        ]);
        return redirect()->back()->with('msg', 'अस्विकार गर्न सफल भयो');
    }

    public function bhraman_aadesh_form()
    {
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        $staffs = Staff::all();
        return view(
            'pis.staff.forms.bhraman_aadesh_form',
            [
                'staff' => $staff,
                'staffs' => $staffs
            ]
        );
    }

    public function bhraman_addesh_submit(Request $request)
    {
        $request->validate([
            'date' => 'required',
            's_no' => 'required',
            'staff' => 'required',
            'position' => 'required',
            'office' => 'required',
            'visit_place_name' => 'required',
            'visit_aim' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'visit_details' => 'required',
            'visit_expense' => 'required'
        ]);


        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        $visits = StaffVisitAadesh::all();

        if (count($visits) == 0) {

            $latest = StaffVisitAadesh::create([
                'date' => $request->date,
                's_no' => $request->s_no,
                'staff' => $request->staff,
                'position' => $request->position,
                'office' => $request->office,
                'visit_place_name' => $request->visit_place_name,
                'visit_aim' => $request->visit_aim,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'visit_details' => $request->visit_details,
                'visit_expense' => $request->visit_expense,
                'staff_id' => $staff->id,
                'aadesh_no' => 1
            ]);
        } else {
            $aadesh_no = StaffVisitAadesh::query()->latest()->first()->aadesh_no;


            $latest = StaffVisitAadesh::create([
                'date' => $request->date,
                's_no' => $request->s_no,
                'staff' => $request->staff,
                'position' => $request->position,
                'office' => $request->office,
                'visit_place_name' => $request->visit_place_name,
                'visit_aim' => $request->visit_aim,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'visit_details' => $request->visit_details,
                'visit_expense' => $request->visit_expense,
                'staff_id' => $staff->id,
                'aadesh_no' => $aadesh_no + 1
            ]);
        }


        foreach ($request->departure_place as $key => $value) {
            # code...
            $detail[$key]  = StaffVisitAadeshDetails::create([
                'departure_place' => $request->departure_place[$key],
                'departure_date' => $request->departure_date[$key],
                'destination_place' => $request->destination_place[$key],
                'destination_date' => $request->destination_date[$key],
                'visit_vehicle' => $request->visit_vehicle[$key],
                'aadesh_no' => $latest->aadesh_no,
                'destination_no' => $key + 1
            ]);
        }

        $latest = $latest->load('staffs');


        $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->from_date);
        $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->to_date);
        $variation_in_days = $to_date->diffInDays($from_date) + 1;


        return view('pis.staff.forms.print_bhraman_aadesh_form', [
            'latest' => $latest,
            'difference_in_days' => $variation_in_days,
            'detail' => $detail
        ]);

        return redirect()->back()->with('msg', 'Data inserted sucessfully');
    }

    public function bhraman_list()
    {
        $approval = Staff::query()->where('user_id', auth()->user()->id)->first();
        if ($approval != null) {
            if ($approval->is_approved == 0) {
                return redirect()->back()->with('msg', 'स्वीकृत हुन् बाकी');
            }
        } else {
            return redirect()->back()->with('msg', 'सुरुमा कर्मचारी विवरण भर्नुहोस्');
        }

        if (auth()->user()->hasRole('cao') == true || auth()->user()->hasRole('admin') == true) {
            $visit_aadesh = StaffVisitAadesh::query()->with('staffs')->orderBy('id', 'DESC')->get();
        } else {
            $staff_id = Staff::query()->where('user_id', auth()->user()->id)->first();

            if ($staff_id != null) {
                $visit_aadesh = StaffVisitAadesh::query()->with('staffs')
                    ->whereHas('staffs', function ($q) use ($staff_id) {
                        $q->where('staff_id', $staff_id->id);
                    })
                    ->orderBy('id', 'DESC')->get();
            }
        }

        return view('pis.staff.forms.bhraman_aadesh_list', [
            'visit_aadesh' => $visit_aadesh
        ]);
    }

    public function approve_bhraman(StaffVisitAadesh $visit)
    {
        // dd($visit);
        $visit->update([
            'is_approved' => 1
        ]);
        return redirect()->back()->with('msg', 'Approved sucessfully');
    }

    public function reject_bhraman(StaffVisitAadesh $visit)
    {
        $visit->update([
            'is_approved' => 2
        ]);
        return redirect()->back()->with('msg', 'Approved sucessfully');
    }

    public function bhraman_addesh_edit(StaffVisitAadesh $visit)
    {
        $visit = $visit->load('staffVisitAadeshDetail');
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        $staffs = Staff::all();
        return view('pis.staff.forms.edit_bhraman_aadesh_form', [
            'staff' => $staff,
            'staffs' => $staffs,
            'visit' => $visit
        ]);
    }

    public function bhraman_addesh_update(Request $request)
    {
        // dd($request->all());
        $visit = StaffVisitAadesh::query()->where('aadesh_no', $request->aadesh_no)->first();
        if ($visit->is_approved == 1) {
            return redirect()->back()->with('msg', 'Cannot update after approval');
        }
        $visits = StaffVisitAadesh::query()->where('aadesh_no', $request->aadesh_no)->with('staffVisitAadeshDetail')->first();
        if ($request->has('destination_no')) {
            # code...
            foreach ($request->destination_no as $key => $value) {
                if ($request->is_approved[$key] != 1) {
                    $visit_detail = StaffVisitAadeshDetails::query()->where('aadesh_no', $request->aadesh_no)->where('destination_no', $request->destination_no[$key])->first();
                    $visit_detail->update([
                        'departure_place' => $request->departure_place[$key],
                        'departure_date' => $request->departure_date[$key],
                        'destination_place' => $request->destination_place[$key],
                        'destination_date' => $request->destination_date[$key],
                        'visit_vehicle' => $request->visit_vehicle[$key],
                        'is_approved' => $request->is_approved[$key],
                    ]);
                }
            }
        }

        $Key = count($request->destination_no) - 1;

        $latest_destination_no = StaffVisitAadeshDetails::query()->where('aadesh_no', $request->aadesh_no)->latest('destination_no')->first()->destination_no;
        // dd($latest_destination_no);
        foreach ($request->departure_place as $key => $value) {
            if ($key > $Key) {
                // dd($key);
                StaffVisitAadeshDetails::create([
                    'departure_place' => $request->departure_place[$key],
                    'departure_date' => $request->departure_date[$key],
                    'destination_place' => $request->destination_place[$key],
                    'destination_date' => $request->destination_date[$Key],
                    'visit_vehicle' => $request->visit_vehicle[$key],
                    'destination_no' => $latest_destination_no + 1,
                    'aadesh_no' => $request->aadesh_no

                ]);
                $latest_destination_no++;
            }
        }



        return redirect()->back()->with('msg', 'form updated');
    }

    public function approve_destination(StaffVisitAadeshDetails $destination)
    {
        $destination->update([
            'is_approved' => 1
        ]);
        return redirect()->back()->with('msg', 'destination approved');
    }

    public function decline_destination(StaffVisitAadeshDetails $destination)
    {
        $destination->update([
            'is_approved' => 0
        ]);
        return redirect()->back()->with('msg', 'destination approval declined');
    }

    public function print_bhraman_kharcha(Request $request)
    {
        $data = $request->validate(
            [
                'visit_expense.*' => 'required',
                'bhatta_day.*' => 'required',
                'bhatta_rate.*' => 'required',
                'bhatta_total.*' => 'required',
                'futkar_detail.*' => 'required',
                'futkar_total.*' => 'required',
                'all_total.*' => 'required',
                'all_total.*' => 'required',
                'remarks.*' => 'required',
                'bhraman_total' => 'required',
                'bhatta_total_all' => 'required',
                'futkat_total_all' => 'required',
                'total_all_all' => 'required',
                'bhraman_peski' => 'required',
                'khud_bhuktani' => 'required',

            ]
        );
        $date = StaffVisitAadesh::query()->where('aadesh_no', $request->aadesh_no)->first()->date;
        $latest = array();
        foreach ($request->visit_expense as $key => $value) {
            $bill_details = StaffVisitAadeshDetails::query()->where('aadesh_no', $request->aadesh_no)->where('destination_no', $request->destination_no[$key])->first();
            // dd($bill_details);
            $latest[$key] = StaffVisitBill::create([
                "aadesh_no" => $request->aadesh_no,
                'destination_no' => $request->destination_no[$key],
                'prasthan_place' => $bill_details->departure_place,
                'prasthan_date' => $bill_details->departure_date,
                'pahuch_place' => $bill_details->destination_place,
                'pahuch_date' => $bill_details->destination_date,
                'visit_vehicle' => $bill_details->visit_vehicle,
                'visit_expense' => $request->visit_expense[$key],
                'bhatta_day' => $request->bhatta_day[$key],
                'bhatta_rate' => $request->bhatta_rate[$key],
                'bhatta_total' => $request->bhatta_total[$key],
                'futkar_detail' => $request->futkar_detail[$key],
                'futkar_total' => $request->futkar_total[$key],
                'remarks' => $request->remarks[$key],
                'bhraman_total' => $request->bhraman_total,
                'bhatta_total_all' => $request->bhatta_total_all,
                'futkat_total_all' => $request->futkat_total_all,
                'all_total' => $request->all_total[$key],
                'total_all_all' => $request->total_all_all,
                'jaach_date' => $request->jaach_date,
                'swikrit_date' => $request->swikrit_date,
                'bhraman_peski' => $request->bhraman_peski,
                'khud_bhuktani' => $request->khud_bhuktani,
                'swikrit_amount	' => $request->swikrit_amount,
                'karmachari_date' => $request->karmachari_date,
                'swikrit_amount' => $request->swikrit_amount,
            ]);
        }

        $staff_visit_aadesh = StaffVisitAadesh::query()->where('aadesh_no', $request->aadesh_no)->with('staffs')->first();
        $staff_service = StaffService::query()->where('user_id', $staff_visit_aadesh->staffs->user_id)->where('is_active', 1)->with('positions')->first();
        $staff_address = StaffAddress::query()->where('user_id', $staff_visit_aadesh->staffs->user_id)->with('municipalities')->first();
        // dd($staff_visit_aadesh);
        return view(
            'pis.staff.forms.print_bhraman_kharcha',
            [
                'latest' => $latest,
                'date' => $date,
                'staffVisitAadesh' => $staff_visit_aadesh,
                'staff_service' => $staff_service,
                'staff_address' => $staff_address
            ]
        );
    }



    public function bhraman_pratiwedan_form(StaffVisitAadesh $visit)
    {
        $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $visit->from_date);
        $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $visit->to_date);
        $variation_in_days = $to_date->diffInDays($visit->from_date) + 1;

        $staff_name = $visit->with('staffs')->first()->staffs->nep_name;

        $staff = Staff::all();
        return view(
            'pis.staff.forms.bhraman_pratiwedan_form',
            [
                'staffs' => $staff,
                'visit' => $visit,
                'difference_in_days' => $variation_in_days,
                'staff_name' => $staff_name
            ]
        );
    }

    public function bhraman_pratiwedan_form_submit(Request $request)
    {
        $request->validate([
            'aadesh_no' => 'required',
            "team_leader" => "required",
            "visit_duration" => "required",
            "visit_udasya" => "required",
            "mukhya_kaam" => "required",
            "sikai_upalabdi" => "required",
            "suggestion" => "required",
            "visit_paper_details" => "required"
        ]);

        $id = array();

        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();

        $id = StaffVisitPratiwedan::create([
            'aadesh_no' => $request->aadesh_no,
            'team_leader' => $request->team_leader,
            'visit_duration' => $request->visit_duration,
            'visit_udasya' => $request->visit_udasya,
            'mukhya_kaam' => $request->mukhya_kaam,
            'sikai_upalabdi' => $request->sikai_upalabdi,
            'suggestion' => $request->suggestion,
            'visit_paper_details' => $request->visit_paper_details,
            'staff_id' => $staff->id
        ]);


        $staffVisit = StaffVisitPratiwedan::query()->where('id', $id->id)->first();
        $staffName = Staff::query()->where('user_id', auth()->user()->id)->first();
        $staffService = StaffService::query()->where('user_id', auth()->user()->id)->with('positions')->first();
        $staff = Staff::query()->where('id', $request->team_leader)->first();

        return view(
            'pis.staff.forms.print_bhraman_pratiwedan_form',
            [
                'leader' => $request->team_leader,
                'latest_id' => $id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'visit_udasya' => $request->visit_udasya,
                'mukhya_kaam' => $request->mukhya_kaam,
                'sikai_upalabdi' => $request->sikai_upalabdi,
                'suggestion' => $request->suggestion,
                'visit_paper_details' => $request->visit_paper_details,
                'staff_name' => $staffName,
                'staffService' => $staffService,
                'staffVisit' => $staffVisit,
                'difference_in_days' => $request->visit_duration
            ]
        );
    }

    public function bhraman_pratiwedan_list()
    {
        $staffVisit = StaffVisit::with('staff')->get();

        $difference = array();

        foreach ($staffVisit as $key => $value) {
            $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->from_date);
            $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $value->to_date);
            $difference[$value->id] = $to_date->diffInDays($from_date) + 1;
        }

        return view(
            'pis.staff.forms.bhraman_pratiwedan_list',
            [
                'staffVisit' => $staffVisit,
                'difference' => $difference
            ]
        );
    }

    public function view_bhraman_details(StaffVisit $bhraman)
    {

        $staffVisit = StaffVisit::query()->where('id', $bhraman->id)->first();
        $staffName = Staff::query()->where('user_id', auth()->user()->id)->first();
        $staffService = StaffService::query()->where('user_id', auth()->user()->id)->with('positions')->first();
        $staff = Staff::query()->where('id', $bhraman->team_leader)->first();

        $from_date = \Carbon\Carbon::createFromFormat('Y-m-d', $bhraman->from_date);
        $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $bhraman->to_date);
        $variation_in_days = $to_date->diffInDays($from_date) + 1;


        return view(
            'pis.staff.forms.print_bhraman_pratiwedan_form',
            [
                'leader' => $staff,
                'latest_id' => $bhraman->id,
                'from_date' => $bhraman->from_date,
                'to_date' => $bhraman->to_date,
                'visit_udasya' => $bhraman->visit_udasya,
                'mukhya_kaam' => $bhraman->mukhya_kaam,
                'sikai_upalabdi' => $bhraman->sikai_upalabdi,
                'suggestion' => $bhraman->suggestion,
                'visit_paper_details' => $bhraman->visit_paper_details,
                'staff_name' => $staffName,
                'staffService' => $staffService,
                'staffVisit' => $staffVisit,
                'difference_in_days' => $variation_in_days
            ]
        );
    }



    public function bhraman_kharcha_form(StaffVisitAadesh $visit)
    {
        $visit->load('staffVisitAadeshDetail');
        $staff = Staff::query()->where('id', $visit->staff_id)->first()->user_id;
        $staffService = StaffService::query()->where('user_id', $staff)->where('is_active', 1)->with('positions', 'bhattas')->first();
        if ($staffService->bhattas == null) {
            return redirect()->back()->with('msg', 'भत्ता घोसणा भाको छैन');
        }

        $visit = $visit->load('staffVisitBill');
        $length = count($visit->staffVisitBill);
        if ($length != null) {
            $latest = array();
            $latest = $visit->staffVisitBill;
            $staff_visit_aadesh = StaffVisitAadesh::query()->where('aadesh_no', $visit->aadesh_no)->with('staffs')->first();
            $staff_service = StaffService::query()->where('user_id', $staff_visit_aadesh->staffs->user_id)->where('is_active', 1)->with('positions')->first();
            $staff_address = StaffAddress::query()->where('user_id', $staff_visit_aadesh->staffs->user_id)->with('municipalities')->first();
            $date = StaffVisitAadesh::query()->where('aadesh_no', $visit->aadesh_no)->first()->date;
            return view(
                'pis.staff.forms.print_bhraman_kharcha',
                [
                    'latest' => $latest,
                    'date' => $date,
                    'staffVisitAadesh' => $staff_visit_aadesh,
                    'staff_service' => $staff_service,
                    'staff_address' => $staff_address
                ]
            );
        }
        return view('pis.staff.forms.bhraman_kharcha_form', [
            'visit' => $visit,
            'staffService' => $staffService
        ]);
    }

    // public function bhraman_aadesh_no_search(Request $request)
    // {
    //     $visit = StaffVisitAadesh::query()->where('aadesh_no', $request->aadesh_no)->first();
    //     return view(
    //         'pis.staff.forms.bhraman_kharcha_form',
    //         [
    //             'visit' => $visit
    //         ]
    //     );
    // }

    public function bhraman_kharcha_form_submit(Request $request)
    {
        $id = array();
        foreach ($request->prasthan_place as $key => $value) {
            $latest[$key] = StaffVisitBill::create([
                'prasthan_place' => $request->prasthan_place[$key],
                'prasthan_date' => $request->prasthan_date[$key],
                'pahuch_place' => $request->pahuch_place[$key],
                'pahuch_date' => $request->pahuch_date[$key],
                'visit_vehicle' => $request->visit_vehicle[$key],
                'visit_expense' => $request->visit_expense[$key],
                'bhatta_day' => $request->bhatta_day[$key],
                'bhatta_rate' => $request->bhatta_rate[$key],
                'bhatta_total' => $request->bhatta_total[$key],
                'futkar_detail' => $request->futkar_detail[$key],
                'futkar_total' => $request->futkar_total[$key],
                'all_total' => $request->all_total[$key],
                'remarks' => $request->remarks[$key],
                'is_approved' => 1
            ]);
        }


        foreach ($latest as $key => $value) {
            $value->update([
                'bhraman_total' => $request->bhraman_total,
                'bhatta_total_all' => $request->bhatta_total_all,
                'futkat_total_all' => $request->futkat_total_all,
                'total_all_all' => $request->total_all_all,
                'bhraman_peski' => $request->bhraman_peski,
                'khud_bhuktani' => $request->khud_bhuktani,
                'aadesh_no' => $request->aadesh_no,
                'is_approved' => 1
            ]);
        }
    }



    public function pis_setting(Settings $setting)
    {
        $setting_value = SettingValues::query()->where('setting_id', $setting->id)->with(['staffs', 'leaves'])->get();
        if ($setting->slug == 'setup_previous_leaves') {
            $staff = Staff::all();
            $leaves = settingLeave::all();
            return view('pis.setting.setting_prev_leave', [
                'setting' => $setting,
                'setting_value' => $setting_value,
                'staff' => $staff,
                'leaves' => $leaves
            ]);
        }
        return view(
            'pis.setting.setting',
            [
                'setting' => $setting,
                'setting_value' => $setting_value
            ]
        );
    }

    public function pis_setting_add(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'is_kharcha' => 'required'
        ]);
        SettingValues::create([
            'name' => $request->name,
            'specification' => $request->specification,
            'setting_id' => $request->id,
            'unit' => $request->unit,
            'is_kharcha' => $request->is_kharcha

        ]);
        return redirect()->back()->with('msg', 'Setting added successfully');
    }

    public function pis_setting_update(Request $request)
    {
        $setting_value = SettingValues::query()->where('id', $request->value_id)->first();
        $setting_value->update([
            'name' => $request->name,
            'specification' => $request->specification,
            'setting_id' => $request->id,
            'unit' => $request->unit
        ]);
        return redirect()->back()->with('msg', 'Setting updated successfully');
    }

    public function setting_bhatta()
    {
        $setting_bhatta = SettingsBhatta::query()->with('positions')->get();
        $setup_positions = 'setup_positions';

        $positions = $this->get_shared_setting($setup_positions);
        return view('pis.staff.forms.setting_bhatta', [
            'setting_bhatta' => $setting_bhatta,
            'positions' => $positions
        ]);
    }

    public function add_setting_bhatta(Request $request)
    {
        $request->validate([
            'position' => 'required',
            'bhatta' => 'required'
        ]);
        SettingsBhatta::create([
            'position' => $request->position,
            'bhatta' => $request->bhatta
        ]);
        return redirect()->back()->with('msg', 'setting added successfully');
    }

    public function edit_bhatta_setting(Request $request)
    {
        $setting_bhatta = SettingsBhatta::query()->where('id', $request->bhatta_id)->first();
        $setting_bhatta->update([
            'bhatta' => $request->bhatta,
            'position' => $request->position
        ]);
        return redirect()->back()->with('msg', 'setting updated successfully');
    }

    public function all_notification()
    {
    }

    public function staffServices(Request $request)
    {
        // return response()->json($request->id, 200);
        $user_id = Staff::query()->where('id', $request->id)->first();
        $data = StaffService::query()->where('user_id', $user_id->user_id)
            ->where('is_active', 1)
            ->with('positions')->first();
        return response()->json($data, 200);
    }

    public function submit_saman_name(Request $request)
    {
        $data = SettingValues::create([
            'name' => $request->name,
            'is_kharcha' => $request->kharcha,
            'setting_id' => 1,
            'unit' => $request->unit,
            'specification' => $request->specification
        ]);
        if ($data != null) {
            return response()->json($data);
        }
    }

    public function get_saman_name()
    {
        $data = SettingValues::query()->where('setting_id', 1)->get();
        return response()->json($data);
    }

    public function get_saman_detail(Request $request)
    {
        $data = StaffMaagno::query()->where('id', $request->id)->with('maags')->first();
        if ($data != null) {
            return response()->json($data);
        }
    }
}
