<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\NewPlanFormRequest;
use App\Models\YojanaModel\budget_source_plan;
use App\Models\YojanaModel\BudgetSource;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\plan_ward_detail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PlanController extends Controller
{
    public function index(): View
    {
        return view('yojana.plan.plan', [
            'plans' => plan::query()
                ->with('wardDetail', 'budgetSourcePlanDetails.budgetSources', 'Parents.budgetSourcePlanDetails.budgetSources')
                ->whereNull('plan_id')
                ->get()
        ]);
    }

    public function create(): View
    {
        $data = getSettingByKey([
            config('SLUG.expense_type'),
            config('SLUG.topic'),
            config('SLUG.sub_topic'),
            config('SLUG.type_of_allocation')
        ]);

        return view('yojana.plan.new_plan', [
            'expense_types' => $data['expense_types'],
            'topics' => $data['topics'],
            'type_of_allocations' => $data['type_of_plan_allocations'],
            'budget_sources' => BudgetSource::query()
                ->get()
        ]);
    }


    public function store(NewPlanFormRequest $request): RedirectResponse
    {
        if ($request->grant_amount == 0) {
            Alert::error('कृपया रकम चेक गर्नुहोस्');
            return redirect()->back();
        }
        $regNo = plan::query()->latest()->first();

        DB::transaction(function () use ($request, $regNo) {
            $plan = plan::create($request->except('ward_no', 'rakam', 'budget_source_id', 'budget_source_name') + [
                'reg_no' => $regNo == null ? 1 : $regNo->reg_no + 1,
                'entered_by' => auth()->user()->id
            ]);

            foreach ($request->budget_source_id as $key => $budget_source_id) {
                budget_source_plan::create([
                    'plan_id' => $plan->id,
                    'budget_source_id' => $budget_source_id,
                    'amount' => $request->rakam[$budget_source_id]
                ]);
            }

            if ($request->has('is_main')) {
                plan_ward_detail::create(['plan_id' => $plan->id, 'ward_no' => $request->is_main, 'is_main' => true]);
            }

            foreach ($request->ward_no as $key => $ward_no) {
                plan_ward_detail::create([
                    'plan_id' => $plan->id,
                    'ward_no' => $ward_no
                ]);
            }
        });

        toast("योजना दर्ता हुन सफल भयो", 'success');
        return redirect()->back();
    }

    public function breakDown(plan $plan): View
    {
        abort_if($plan->plan_id != null, 403);
        $data = getSettingByKey([
            config('SLUG.expense_type'),
            config('SLUG.topic'),
            config('SLUG.sub_topic'),
            config('SLUG.type_of_allocation')
        ]);
        return view('yojana.plan.break_down', [
            'expense_types' => $data['expense_types'],
            'topics' => $data['topics'],
            'type_of_allocations' => $data['type_of_plan_allocations'],
            'plan' => $plan->load('budgetSourcePlanDetails.budgetSources', 'Parents')
        ]);
    }

    public function storeBreakYojana(Request $request, plan $plan): RedirectResponse
    {
        if ($request->grant_amount == 0) {
            Alert::error('कृपया रकम चेक गर्नुहोस्');
            return redirect()->back();
        }
        $regNo = plan::query()->latest()->first();

        $id =  DB::transaction(function () use ($request, $regNo, $plan) {
            $plan_id = plan::create($request->except('ward_no', 'rakam', 'budget_source_id', 'budget_source_name') + [
                'reg_no' => $regNo == null ? 1 : $regNo->reg_no + 1,
                'entered_by' => auth()->user()->id,
                'plan_id' => $plan->id
            ]);

            foreach ($request->budget_source_id as $key => $budget_source_id) {
                budget_source_plan::create([
                    'plan_id' => $plan_id->id,
                    'budget_source_id' => $budget_source_id,
                    'amount' => $request->rakam[$budget_source_id],
                    'is_split' => true
                ]);
            }

            if ($request->has('is_main')) {
                plan_ward_detail::create(['plan_id' => $plan_id->id, 'ward_no' => $request->is_main, 'is_main' => true]);
            }

            foreach ($request->ward_no as $key => $ward_no) {
                plan_ward_detail::create([
                    'plan_id' => $plan_id->id,
                    'ward_no' => $ward_no
                ]);
            }

            return $plan_id->id;
        });

        toast("योजना टुक्राउन सफल दर्ता नं " . Nepali($id), 'success');
        return redirect()->route('plan.index');
    }
}
