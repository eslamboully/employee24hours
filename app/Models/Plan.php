<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Plan extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title', 'description','salary_type'];
    protected $fillable = ['price','number_of_jobs'];
}
