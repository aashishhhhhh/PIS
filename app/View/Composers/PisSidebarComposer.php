<?php

namespace App\View\Composers;

use App\Models\PisModel\Settings;
use App\Models\PisModel\Staff;
use App\Models\SharedModel\Setting;
use Illuminate\View\View;

class PisSidebarComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = Setting::query()->UpdatedIn(config('constant.app_name_pis'))->get();
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        $pis_settings = Settings::query()->get();
        $view->with(
            [
                'data' => $data,
                'pis_settings' => $pis_settings,
                'staff' => $staff
            ]
        );
    }
}
