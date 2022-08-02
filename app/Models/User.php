<?php

namespace App\Models;

use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffAddress;
use App\Models\PisModel\StaffProfile;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $connection = 'mysql_shared';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function staffs(): HasMany
    {
        return $this->hasMany(Staff::class, 'user_id', 'id');
    }

    public function staffsAddress(): HasOne
    {
        return $this->hasOne(StaffAddress::class, 'user_id');
    }

    public function staffsProfile(): HasMany
    {
        return $this->hasMany(StaffProfile::class, 'user_id', 'id');
    }

    public function languages()
    {
        return $this->belongsTo(SettingValue::class, 'language', 'id');
    }

    public function services()
    {
        return $this->belongsTo(SettingValue::class, 'service', 'id');
    }

    public function officeGroups()
    {
        return $this->belongsTo(SettingValue::class, 'office_group', 'id');
    }

    public function levels()
    {
        return $this->belongsTo(SettingValue::class, 'level', 'id');
    }

    public function positions()
    {
        return $this->belongsTo(SettingValue::class, 'position', 'id');
    }

    public function officeSubGroups()
    {
        return $this->belongsTo(SettingValue::class, 'office_subgroup', 'id');
    }

    public function qualifications()
    {
        return $this->belongsTo(SettingValue::class, 'qualification', 'id');
    }

    public function subjects()
    {
        return $this->belongsTo(SettingValue::class, 'subject', 'id');
    }

    public function years()
    {
        return $this->belongsTo(SettingValue::class, 'year', 'id');
    }

    public function institutes()
    {
        return $this->belongsTo(SettingValue::class, 'institute', 'id');
    }

    public function punishments()
    {
        return $this->belongsTo(SettingValue::class, 'punishment', 'id');
    }
}
