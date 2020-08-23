<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model implements TranslatableContract
{
    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['title','description'];
    protected $fillable = [
        'company_id','job_type_id', 'convention_id','work_from',
        'work_to','work_days_in_week','salary','helper_type','status',
        'refusal_details'
    ];

    public function type()
    {
        return $this->belongsTo(JobType::class,'job_type_id','id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class,'job_id','id');
    }

    public function convention()
    {
        return $this->belongsTo(Convention::class,'convention_id','id');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class,'job_id','id');
    }
}
