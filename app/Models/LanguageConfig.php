<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageConfig extends Model
{
    protected $fillable = ['var','value','locale','language_id'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
