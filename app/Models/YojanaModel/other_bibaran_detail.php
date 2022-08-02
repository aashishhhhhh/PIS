<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class other_bibaran_detail extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = ['date', 'date_eng', 'staff_id', 'post_id','other_bibaran_id'];
    
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value;
        $this->attributes['date_eng'] = convertBsToAd($value);
    }
    
    public function otherBibaran(): BelongsTo
    {
        return $this->belongsTo(other_bibaran::class);
    }
}
