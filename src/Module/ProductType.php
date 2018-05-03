<?php

namespace Softce\Type\Module;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_type';

    protected $fillable = ['type_id', 'product_id'];
}
