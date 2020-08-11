<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConventionTranslation extends Model
{
    protected $fillable = ['main_items','sub_items'];
    public $timestamps = false;
}
