<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Job extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title','description'];
    protected $fillable = [
        'company_id','job_type_id', 'convention_id','work_from',
        'work_to','work_days_in_week','salary','helper_type','status'
    ];
}
