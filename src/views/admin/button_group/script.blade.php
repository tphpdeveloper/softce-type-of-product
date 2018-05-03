@push('scripts')
    <script>
        $('.js-add_to_type').click(function(e){
            e.preventDefault();
            e.stopPropagation();

            var elem = $(this),
                product_id = elem.data('product_id'),
                type_id = elem.data('type_id');

            console.log(product_id + ' - ' + type_id);
        });
    </script>
@endpush