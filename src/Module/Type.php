<?php

namespace Softce\Type\Module;

use Illuminate\Database\Eloquent\Model;
use Mage2\Ecommerce\Models\Database\Product;

class Type extends Model
{
    use \Themsaid\Multilingual\Translatable;

    protected $fillable = ['name', 'icon', 'color'];
    public $translatable = ['name'];
    public $casts = [
        'name' => 'array'
    ];

    public function product(){
        return $this->belongsToMany(Product::class)->withPivot(['product_id', 'type_id']);
    }

    public function product_type(){
        return $this->hasMany(ProductType::class);
    }

}
