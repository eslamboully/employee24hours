<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportSystemTranslation extends Model
{
    protected $fillable = ['title','description'];
    public $timestamps = false;
}
