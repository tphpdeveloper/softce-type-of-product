<?php

namespace Softce\Type\Module;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Type extends Model
{
    use \Themsaid\Multilingual\Translatable;

    protected $fillable = ['name', 'icon', 'color'];
    public $translatable = ['name'];
    public $casts = [
        'name' => 'array'
    ];


    public function createButton(Collection $types, $product_id){
        $buttons = '';
        foreach($types as $type){
            $buttons .= view('typeofproducts::admin.button_group.button')
                ->with('type_id', $type->id)
                ->with('icon', $type->icon)
                ->with('color', $type->color)
                ->with('product_id', $product_id)
                ->render();
        }
        return $buttons;
    }
}
