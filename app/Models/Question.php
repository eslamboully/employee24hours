<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['question','answer'];
    protected $fillable = ['company_id'];

}
