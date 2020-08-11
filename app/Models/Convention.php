<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Convention extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['main_items','sub_items'];
    protected $fillable = ['agreement_id'];

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }
}
