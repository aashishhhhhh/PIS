<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\PisModel\StaffService;
use App\Models\SharedModel\bank;
use App\Models\SharedModel\SettingValue;
use App\Models\YojanaModel\BudgetSource;
use App\Models\YojanaModel\setting\anugaman_samiti;
use App\Models\YojanaModel\setting\anugaman_samiti_detail;
use App\Models\YojanaModel\setting\tole_bikas_samiti;
use App\Models\YojanaModel\setting\tole_bikas_samiti_detail;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ApiHelperController extends Controller
{
    public function getBudgetSourceAmount()
    {
        $data['budget_source_amount'] = $budget_source_amount = BudgetSource::query()
            ->withSum(['budget_source_deposit as amount' => function ($query) {
                $query->where('fiscal_year_id', getCurrentFiscalYear(TRUE)->id);
            }], 'amount')
            ->where('id', request('budget_source_id'))
            ->withSum(['budget_source_plan as amountToBeSubtracted' => function ($query) {
                $query->where('is_split', 0);
            }], 'amount')
            ->first();
        $actual_amount = $budget_source_amount->amount - ($budget_source_amount->amountToBeSubtracted ?? 0);

        $html = '<tr id="tr_' . $budget_source_amount->id . '"><td class="text-center"><input type="text" class="form-control form-control-sm" name="budget_source_name[]" value="' . $budget_source_amount->name . '" readonly></td>';
        $html .= '<td class="text-center"><input type="number" id="amount_' . $budget_source_amount->id . '" onkeyup="calculateBakiAmount(' . $budget_source_amount->id . ')" step="0.1" class="form-control form-control-sm amount" name="rakam[' . $budget_source_amount->id . ']"></td>';
        $html .= '<td class="text-center"><input class="form-control form-control-sm" id="jamma_' . $budget_source_amount->id . '" value="' . $actual_amount . '" disabled></td>';
        $html .= '<td class="text-center"><input class="form-control form-control-sm" id="baki_' . $budget_source_amount->id . '" readonly></td><input type="hidden" class="budget_source_id" name="budget_source_id[]" value="' . $budget_source_amount->id . '">';
        $html .= '<td class="text-center"><span class="btn btn-danger btn-sm" onclick="removeTR(' . $budget_source_amount->id . ')"><i class="fa-solid fa-circle-xmark"></i></span></td>';
        $data['html'] = $html;
        return response()->json($data, 200);
    }

    public function getTopicAreaType()
    {
        $data['topic_area_types'] = $topic_area_types = SettingValue::query()
            ->where('cascading_parent_id', request('setting_id'))
            ->whereNotNull('cascading_parent_id')
            ->get();
        $html = '<option value="">--छान्नुहोस्--</option>';
        foreach ($topic_area_types as $topic_area_type) {
            $html .= '<option value="' . $topic_area_type->id . '">' . $topic_area_type->name . '</option>';
        }

        $data['html'] = $html;
        return response()->json($data);
    }

    public function getBankName()
    {
        return response()->json(bank::query()->where('id', request('bankId'))->first());
    }

    public function getToleBikasSamitiDetail()
    {
        $html = '';
        $tole_bikas_samiti_details = tole_bikas_samiti_detail::query()
            ->where('tole_bikas_samiti_id', request('tole_bikas_samiti_id'))
            ->get();
        foreach ($tole_bikas_samiti_details as $tole_bikas_samiti_detail) {
            $html .= '<tr><td class="text-center"><input class="form-control form-control-sm" disabled required value="' . getSettingValueById($tole_bikas_samiti_detail->position)->name . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->name . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->ward_no . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->gender . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->cit_no . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->issue_district . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->contact_no . '"></td></tr>';
        }
        return response()->json($html);
    }


    public function getAnugmanSamiti()
    {
        $html = '';
        $anugaman_samiti = anugaman_samiti::query()
            ->where('anugaman_samiti_type_id', request('anugaman_samiti_type_id'))
            ->when(request('ward_no') && request('anugaman_samiti_type_id') != 1, function ($q) {
                $q->where('ward_no', request('ward_no'));
            })
            ->with('anugamanSamitiDetails', function ($q) {
                $q->where('status', 1);
            })
            ->first();

        if ($anugaman_samiti != null) {
            foreach ($anugaman_samiti->anugamanSamitiDetails as $key => $anugaman_samiti_detail) {
                $html .= '<tr class="dummy"><td class="text-center"><input type="text" class="form-control form-control-sm" value="' . getSettingValueById($anugaman_samiti_detail->post_id)->name . '" disabled></td>';
                $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->name . '" disabled></td>';
                $html .= '<td class="text-center" style="width:10%;"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->ward_no . '" disabled></td>';
                $html .= '<td class="text-center" style="width:10%;"><input type="text" class="form-control form-control-sm" value="' . returnGender($anugaman_samiti_detail->gender) . '" disabled></td>';
                $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->mobile_no . '" disabled></td>';
                $html .= '<td class="text-center"><a href="' . route("anugaman.setStatus", $anugaman_samiti_detail) . '" class="btn btn-sm btn-primary">निष्क्रिय गर्नुहोस्</a></td></tr>';
            }
        }
        return response()->json($html);
    }

    public function getAnugmanSamitiById()
    {
        $html = '';
        $anugaman_samiti_detail = anugaman_samiti_detail::query()
            ->where('anugaman_samiti_id', request('anugaman_samiti_id'))
            ->get();

        if ($anugaman_samiti_detail->count()) {
            foreach ($anugaman_samiti_detail as $anugaman_samiti_detail) {
                $html .= '<tr class="dummy"><td class="text-center"><input type="text" class="form-control form-control-sm" value="' . getSettingValueById($anugaman_samiti_detail->post_id)->name . '" disabled></td>';
                $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->name . '" disabled></td>';
                $html .= '<td class="text-center" style="width:10%;"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->ward_no . '" disabled></td>';
                $html .= '<td class="text-center" style="width:10%;"><input type="text" class="form-control form-control-sm" value="' . returnGender($anugaman_samiti_detail->gender) . '" disabled></td>';
                $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->mobile_no . '" disabled></td></tr>';
            }
        }
        return response()->json($html);
    }

    public function getPostByStaffId()
    {
        $staffService = StaffService::query()->where('user_id', request('staff_id'))->first();
        if ($staffService != NULL) {
            return response()->json(
                [
                    'post' => getSettingValueById($staffService->position)->name,
                    'post_id' => $staffService->position
                ]
            );
        }
    }

    public function getChildRole()
    {
        $html = '';
        $roles = Role::query()
            ->where('role_id', request('role_id'))
            ->get();
        $html .=  '<div class="input-group input-group-sm mb-3">';
        $html .= '<div class="input-group-prepend">';
        $html .= '<span class="input-group-text">भूमिका<span class="text-dnager px-1 font-weight-bold text-danger">*</span></span></div>';
        $html .= '<select name="role_id[]" class="form-control" id="child_role">';
        $html .= '<option value="">--छान्नुहोस्--</option>';
        foreach ($roles as $key => $role) {
            $html .= '<option value="' . $role->id . '">' . $role->name . '</option>';
        }
        $html .= '</select></div>';

        return response()->json($html);
    }
}
