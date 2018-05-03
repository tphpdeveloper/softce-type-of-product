<?php
/**
 * Created by PhpStorm.
 * User: UserCE
 * Date: 03.05.2018
 * Time: 9:51
 */

namespace Softce\Type\TypeButton\Contracts;


interface TypeButton
{

    /**
     * Returned list button type of product
     * @param $product_id
     * @return string
     */
    public function getButton($product_id);
}