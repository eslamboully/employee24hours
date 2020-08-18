<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title'];
    protected $fillable = ['company_id','parent_id'];

    public function parent()
    {
        return $this->belongsTo(JobType::class,'parent_id','id');
    }

    public function children()
    {
        return $this->hasMany(JobType::class,'parent_id','id');
    }
}
