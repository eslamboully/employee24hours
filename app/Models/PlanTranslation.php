<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    protected $fillable = ['title','description','salary_type'];
    public $timestamps = false;
}
