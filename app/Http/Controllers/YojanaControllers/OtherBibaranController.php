<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\OtherBibaranRequest;
use App\Models\PisModel\Staff;
use App\Models\YojanaModel\anugaman_plan;
use App\Models\YojanaModel\kul_lagat;
use App\Models\YojanaModel\other_bibaran;
use App\Models\YojanaModel\other_bibaran_detail;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OtherBibaranController extends Controller
{
    public function index($regNo, YojanaHelper $helper)
    {
        $kul_lagat = kul_lagat::query()->where('plan_id', $regNo)->first();
        $type = type::query()->where('plan_id', $regNo)->first();
        $anugaman_plan = anugaman_plan::query()
            ->where('plan_id', $regNo)
            ->where('type_id', session('type_id'))
            ->with('anugamanSamiti.anugamanSamitiDetails')
            ->first();
        
        if ($kul_lagat == null || $type == null || (session('type_id') == config('TYPE.AMANAT_MARFAT') ? FALSE : ( $anugaman_plan == null ? TRUE : FALSE))) {
            Alert::error("सम्पूर्ण फारम भरेर मात्र अगाडी बढ्नुहोला");
            return redirect()->back();
        } else {
            $other_bibaran = other_bibaran::query()
                ->where('plan_id', $regNo)
                ->where('type_id', session('type_id'))
                ->with('otherBibaranDetail', function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $view = $other_bibaran == null ? 'other_bibaran' : 'edit_other_bibaran';
            $relationName = $helper->getRelationNameViaSession(session('type_id'));

            return view('yojana.other-bibaran.' . $view, [
                'plan' => plan::query()->where('reg_no', $regNo)->first(),
                'kul_lagat' => $kul_lagat,
                'type' => $relationName == '' ? $type->typeable : $type->typeable->load($relationName),
                'relationName' => $relationName,
                'regNo' => $regNo,
                'anugaman_plan' => $anugaman_plan,
                'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
                'other_bibaran' => $other_bibaran
            ]);
        }
    }

    public function store(OtherBibaranRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $other_bibaran = other_bibaran::create($request->validated() + ['type_id' => session('type_id')]);

            foreach ($request->post as $key => $post_id) {
                other_bibaran_detail::create([
                    'other_bibaran_id' => $other_bibaran->id,
                    'post_id' => $post_id,
                    'staff_id' => $request->staff_id[$key],
                    'date' => $request->date[$key]
                ]);
            }
        });
        toast('योजनाको अन्य विवरण हाल्न सफल भयो', 'success');
        return redirect()->back();
    }

    public function update(OtherBibaranRequest $request, other_bibaran $other_bibaran): RedirectResponse
    {
        DB::transaction(function () use ($request, $other_bibaran) {
            $other_bibaran->update($request->validated());

            other_bibaran_detail::query()
                ->where('other_bibaran_id', $other_bibaran->id)
                ->delete();

            foreach ($request->post as $key => $post_id) {
                other_bibaran_detail::create([
                    'other_bibaran_id' => $other_bibaran->id,
                    'post_id' => $post_id,
                    'staff_id' => $request->staff_id[$key],
                    'date' => $request->date[$key]
                ]);
            }
        });
        toast('योजनाको अन्य विवरण सच्याउन सफल भयो', 'success');
        return redirect()->back();
    }
}
