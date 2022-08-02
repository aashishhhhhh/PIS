<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\anugaman_samiti;
use App\Models\YojanaModel\setting\tole_bikas_samiti;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SamitiGathanController extends Controller
{
    const SLUG_ARRAY = ['tole-bikas-samiti', 'anugaman-samiti'];

    public function index(): View
    {
        return view('yojana.samiti_gathan', [
            'tole_bikas_count' => tole_bikas_samiti::query()->count(),
            'anugaman_samiti_count' => anugaman_samiti::query()->where('is_useable', 1)->count()
        ]);
    }

    public function planOperateDashboard(): View
    {
        return view('yojana.plan_operate');
    }

    public function searchPlan($slug): View
    {
        abort_if(!in_array($slug, config('TYPE.SLUG')), 404);
        return view('yojana.search_plan.search_plan', [
            'slug' => $slug,
            'type_id' => config('TYPE.' . $slug)
        ]);
    }

    public function searchPlanByRegno(Request $request)
    {
        if ($request->reg_no == '') {
            Alert::error("योजनाको दर्ता नं अनिवार्य छ");
        } else {
            $plan = plan::query()
                ->where('reg_no', English($request->reg_no))
                ->with('Parents', 'planOperate')
                ->first();
            if ($plan == null) {
                Alert::error("योजनाको दर्ता नं भेटिएन");
            } else {
                if ($plan->Parents->count() > 0) {
                    Alert::error("यो योजनाको टुक्रीसकेको छ");
                } else {
                    abort_if(!in_array($request->type_id, config('TYPE.TYPE_ARRAY')), 404);
                    if ($plan->planOperate != null) {
                        if ($plan->planOperate->type_id == $request->type_id) {
                            session(['type_id' => $request->type_id]);
                        } else {
                            Alert::error($plan->name . ' योजना ' . config('TYPE.' . $plan->planOperate->type_id) . 'बाट संचालन भैसकेको छ');
                            return redirect()->back();
                        }
                    }
                    session(['type_id' => $request->type_id]);
                    return view('yojana.search_plan.dashboard', [
                        'reg_no' => English($request->reg_no),
                        'plan' => $plan
                    ]);
                }
            }
        }
        return redirect()->back();
    }
}
