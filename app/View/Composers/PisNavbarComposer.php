<?php

namespace App\View\Composers;

use App\Models\SharedModel\MainAppSetting;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PisNavbarComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $data = MainAppSetting::first();
        if (Auth::user()->hasRole('admin')) {
            $role = 9;
        } elseif (Auth::user()->hasRole('cao')) {
            $role = 4;
        } elseif (Auth::user()->hasRole('user')) {
            $role = 10;
        } else {
            $role = null;
        }
        $view->with([
            'data' => $data,
            'role' => $role
        ]);
    }
}
