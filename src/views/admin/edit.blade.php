@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    @include('mage2-ecommerce::admin.lang-triger.triger')
<div class="box box-info">
    <div class="box-header">
        <h2>
           <i class="fa fa-pencil"></i> Редактировать тип товаров
        </h2>

    </div>
    <div class="box-body">
         <form action="{{ route('admin.type.update', $model->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">

            @include('typeofproduct::admin._fields')

            <div class="form-group">
                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>Сохранить</button>
                <a href="{{ route('admin.type.index') }}" class="btn btn-danger"><i class="fa fa-close"></i> Отмена</a>
            </div>

        </form>
    </div>
</div>
@endsection