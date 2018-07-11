<a href="#"
   data-product_id="{{ $product_id }}"
   data-type_id="{{ $type->id }}"
   class="js-add_to_type btn bg-{{ $type->color or 'grey' }}@if(isset($enable) && $enable) active btn-primary @endif"
   title="{{ $type->name }}"
   data-active="@if(isset($enable) && $enable) disable @else enable @endif"
   style="position: relative;"
        >

    {{ $type->icon }}
    <div class="overlay" style="display: none;">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</a>
