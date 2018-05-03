@push('scripts')
    <script>
        $('.js-add_to_type').click(function(e){
            e.preventDefault();
            e.stopPropagation();

            var elem = $(this),
                product_id = Number(elem.attr('data-product_id')),
                type_id = Number(elem.attr('data-type_id')),
                action = elem.attr('data-active').replace('^\s*', '').replace('\s*$'),
                overlay = $(elem.children()[0]);

            overlay.show();

            if(product_id > 0 && type_id > 0){
                $.ajax({
                    url : '{{ route('type.product') }}',
                    method : 'POST',
                    data : {
                        _token : '{{ csrf_token() }}',
                        product_id : product_id,
                        type_id : type_id,
                        action : action
                    },
                    success : function(data){
                        if(data === 'ok'){
                            if(action === 'disable'){
                                elem.removeClass('active');
                                elem.attr('data-active', 'enable');
                            }
                            else{
                                elem.addClass('active');
                                elem.attr('data-active', 'disable');
                            }
                        }
                        overlay.hide();
                    }
                });
            }
            else{
                alert('Недостаточно данных для добавления типа товара');
            }
        });
    </script>
@endpush