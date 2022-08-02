<?php

namespace App\Http\Controllers\SharedControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SharedRequest\UserRequest;
use App\Models\PisModel\Notification;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        return view('shared.user.user-list', [
            'users' => User::query()
                ->where('id', '!=', config('constant.SUPERADMIN_ID'))
                ->get(),
            'roles' => Role::query()
                ->where('id', '!=', config('constant.SUPERADMIN_ROLE_ID'))
                ->whereNull('role_id')
                ->get()
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        foreach ($request->role_id as $key => $value) {
            if ($key == 1) {
                if ($value == 10) {
                    DB::transaction(function () use ($request) {
                        $user = User::create($request->validated() + ['is_verified' => 1]);
                        $user->assignRole($request->role_id);
                        Notification::create([
                            'event_id' => $user->id,
                            'text' => $user->name . 'लाइ कर्मचारी दर्ता गराऊन सफल भयो',
                            'is_read' => 0,
                            'role_id' => config('pis_constant.CAO')
                        ]);
                    });
                    toast('प्रयोगकर्ता थप्न सफल भयो', 'success');
                    return redirect()->back();
                }
            }
        }
        DB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            $user->assignRole($request->role_id);
        });
        toast('प्रयोगकर्ता थप्न सफल भयो ', 'success');
        return redirect()->back();
    }
}
