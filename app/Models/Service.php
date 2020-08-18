<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title','description'];
    protected $fillable = ['company_id','service_category_id','price','file','time'];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class,'service_category_id','id');
    }
}
