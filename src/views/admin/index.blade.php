@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="box">
        <div class="box-header">
                <h2 class="box-header__wrapper">
                    <div class="box-header__item">
                        <i class="fa fa-list-ul"></i>
                        <span class="main-title-wrap">Список типов товаров</span>
                    </div>
                    <a style="" href="{{ route('admin.type.create') }}" class="btn btn-info float-right">
                        <i class="fa fa-plus"></i>
                        Создать тип
                    </a>
                </h2>

        </div>
        <div class="box-body">
            {!! $dataGrid->render() !!}
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $('.js-add_to_type').click(function(e){
            e.preventDefault();
            e.stopPropagation();


        });
    </script>
@endpush