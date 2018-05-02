<?php

namespace Softce\Type\Module;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use \Themsaid\Multilingual\Translatable;

    protected $fillable = ['name', 'icon', 'color'];
    public $translatable = ['name'];
    public $casts = [
        'name' => 'array'
    ];
}
