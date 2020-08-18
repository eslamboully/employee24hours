<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title'];
    protected $fillable = ['company_id'];
}
