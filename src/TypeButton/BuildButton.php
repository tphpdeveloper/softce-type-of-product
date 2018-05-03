<?php
/**
 * Created by PhpStorm.
 * User: UserCE
 * Date: 03.05.2018
 * Time: 10:20
 */

namespace Softce\Type\TypeButton;


use Illuminate\Support\Collection;
use Softce\Type\TypeButton\Contracts\TypeButton;

class BuildButton implements TypeButton
{
    private $types = null;

    /**
     * BuildButton constructor. Get eloquent collection from types table
     * @param Collection $types
     */
    public function __construct(Collection $types)
    {
        $this->types = $types;
    }

    /**
     * @param $product_id
     * @return string
     */
    public function getButton($product_id)
    {
        $buttons = '';
        if(count($this->types)) {
            foreach($this->types as $type){
                $view = view('typeofproduct::admin.button_group.button')
                    ->with('type', $type)
                    ->with('product_id', $product_id);
                if($type->product_type){
                    $data = $type->product_type->pluck('type_id', 'product_id')->toArray();
                    if(count($data)){
                        $view->with( 'enable', (isset($data[$product_id]) ? true : false ) );
                    }
                }
                $buttons .= $view;
            }
        }
        return $buttons;
    }

    /**
     * Returns a view with a script for working with product type keys
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getScript(){
        return view('typeofproduct::admin.button_group.script');
    }
}