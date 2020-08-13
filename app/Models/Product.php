<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title','description'];
    protected $fillable = ['photo','department_id','quantity','status','loyalty_points','recommended','block','price'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_id');
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
