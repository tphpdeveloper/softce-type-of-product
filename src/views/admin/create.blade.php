@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    @include('mage2-ecommerce::admin.lang-triger.triger')
    <div class="row">
        <div class="col-md-6 col-sm-8">
             <div class="box box-info">
            <div class="box-header with-border">
                <h2>
                   Создать тип товара
                </h2>

            </div>
            <div class="box-body">
                 <form action="{{ route('admin.type.store') }}" method="post">
                    {{ csrf_field() }}

                    @include('typeofproduct::admin._fields')

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                        <a href="{{ route('admin.type.index') }}" class="btn btn-danger">Отмена</a>
                    </div>

                </form>
            </div>
        </div>
        </div>
    </div>
@endsection