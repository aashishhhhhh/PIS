<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\KulLagatRequestSubmit;
use App\Models\YojanaModel\kul_lagat;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\plan_operate;
use App\Models\YojanaModel\setting\contingency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KulLagatController extends Controller
{
    public function index($reg_no, Request $request)
    {
        $contingency = contingency::query()
            ->where('fiscal_year_id', getCurrentFiscalYear(true)->id)
            ->latest()
            ->first();

        if ($contingency == null) {
            Alert::error("कन्टेन्जेन्सी कट्टी हालेको छैन");
            return redirect()->back();
        }
        $planOperate = plan_operate::query()->where('plan_id', $reg_no)->first();
        return view($planOperate == null ? 'yojana.kul_lagat.create_kul_lagat' : 'yojana.kul_lagat.edit_kul_lagat', [
            'regNo' => $reg_no,
            'kul_lagat' => kul_lagat::query()->where('plan_id', $reg_no)->first(),
            'plan' => plan::query()
                ->where('reg_no', $reg_no)
                ->with('budgetSourcePlanDetails.budgetSources')
                ->first(),
            'contingency' => $contingency,
            'amount' => getAmountIncContingency($reg_no)
        ]);
    }

    public function store(KulLagatRequestSubmit $request): RedirectResponse
    {
        if (!session()->has('type_id')) {
            Alert::error('Session expired. Please enter the plan number');
        } else {
            DB::transaction(function () use ($request) {
                kul_lagat::create(
                    [
                        'plan_id' => $request->plan_id,
                        'napa_amount' => $request->napa_amount,
                        'napa_contingency' => $request->has('napa_contingency_check') ? $request->napa_contingency : null,
                        'other_office_con' => $request->other_office_con,
                        'other_office_con_contingency' => $request->has('other_agreement_contingency_check') ? $request->other_office_con_contingency : null,
                        'other_office_con_name' => $request->other_office_con_name,
                        'other_office_agreement' => $request->other_office_agreement,
                        'other_agreement_contingency' => $request->has('other_agreement_contingency_check') ? $request->other_agreement_contingency : null,
                        'other_contingency_con_name' => $request->other_contingency_con_name,
                        'customer_agreement' => $request->customer_agreement,
                        'customer_agreement_contingency' => $request->has('customer_agreement_check') ? $request->customer_agreement_contingency : null,
                        'work_order_budget' => $request->work_order_budget,
                        'consumer_budget' => $request->consumer_budget,
                        'total_investment' => $request->total_investment,
                        'type_id' => session('type_id')
                    ]
                );

                plan_operate::create([
                    'plan_id' => $request->plan_id,
                    'type_id' => session('type_id'),
                    'entered_by' => auth()->user()->id
                ]);
            });

            toast("कुल लागत हाल्न सफल भयो ", "success");
        }
        return redirect()->back();
    }

    public function update(KulLagatRequestSubmit $request, kul_lagat $kul_lagat): RedirectResponse
    {
        $kul_lagat->update(
            [
                'napa_amount' => $request->napa_amount,
                'napa_contingency' => $request->has('napa_contingency_check') ? $request->napa_contingency : null,
                'other_office_con' => $request->other_office_con,
                'other_office_con_contingency' => $request->has('other_agreement_contingency_check') ? $request->other_office_con_contingency : null,
                'other_office_con_name' => $request->other_office_con_name,
                'other_office_agreement' => $request->other_office_agreement,
                'other_agreement_contingency' => $request->has('other_agreement_contingency_check') ? $request->other_agreement_contingency : null,
                'other_contingency_con_name' => $request->other_contingency_con_name,
                'customer_agreement' => $request->customer_agreement,
                'customer_agreement_contingency' => $request->has('customer_agreement_check') ? $request->customer_agreement_contingency : null,
                'work_order_budget' => $request->work_order_budget,
                'consumer_budget' => $request->consumer_budget,
                'total_investment' => $request->total_investment,
            ]
        );

        toast("कुल लागत सच्याउन सफल भयो ", "success");
        return redirect()->back();
    }
}
