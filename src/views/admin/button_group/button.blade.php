<a href="#"
   data-product_id="{{ $product_id }}"
   data-type_id="{{ $type->id }}"
   class="js-add_to_type btn bg-{{ $type->color or 'grey' }}@if($product_id % 2 == 0)-active @endif"
   title="{{ $type->name }}"
    >{{ $type->icon }}</a>
