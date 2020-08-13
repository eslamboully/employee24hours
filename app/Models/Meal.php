<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title','description'];
    protected $fillable = ['department_id','price','offer_price','offer_start_at','offer_end_at','block','offer_type'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, 'meal_product', 'meal_id', 'product_id');
    }

    public function related_array()
    {
        $ids = [];
        foreach ($this->related()->get() as $product) {
            array_push($ids,$product->id);
        }

        return $ids;
    }
}
