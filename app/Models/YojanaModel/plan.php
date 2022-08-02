<?php

namespace App\Models\YojanaModel;

use App\Models\SharedModel\SettingValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'reg_no',
        'name',
        'fiscal_year_id',
        'expense_type_id',
        'type_id',
        'topic_area_type_id',
        'topic_id',
        'type_of_allocation_id',
        'grant_amount',
        'first_installment',
        'second_installment',
        'third_installment',
        'fourth_installment',
        'detail',
        'is_cancel',
        'added_by',
        'plan_id'
    ];

    public function wardDetail(): HasMany
    {
        return $this->hasMany(plan_ward_detail::class);
    }

    public function budgetSourcePlanDetails(): HasMany
    {
        return $this->hasMany(budget_source_plan::class);
    }
    public function scopeCurrentFiscalYear($query)
    {
        return $query->where('fiscal_year_id', getCurrentFiscalYear(TRUE)->id);
    }

    public function planAllocation(): HasMany
    {
        return $this->hasMany(SettingValue::class, 'type_of_allocation_id');
    }

    public function setGrantAmountAttribute($value)
    {
        $this->attributes['grant_amount'] = English($value);
    }

    public function kulLagat(): HasOne
    {
        return $this->hasOne(kul_lagat::class);
    }

    public function planOperate(): HasOne
    {
        return $this->hasOne(plan_operate::class);
    }

    // Referencing own class for yojana break down
    public function Parents(): HasMany
    {
        return $this->hasMany(plan::class);
    }

}
