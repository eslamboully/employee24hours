<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['name','code','locale','direction'];

    public function language_configs()
    {
        return $this->hasMany(LanguageConfig::class);
    }
}
