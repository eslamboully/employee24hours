<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTranslation extends Model
{
    protected $fillable = ['title','description'];
    public $timestamps = false;
}
