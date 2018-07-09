<?php

namespace Softce\Type\Http\Controllers;

use Illuminate\Http\Request;
use Mage2\Ecommerce\Http\Controllers\Admin\AdminController;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;

use Mage2\Ecommerce\Models\Database\Product;
use Softce\Type\Http\Requests\TypeRequest;
use Softce\Type\Module\Type;
use File;
use DB;

class TypeController extends AdminController
{

    public function __construct()
    {
        $this->middleware(['admin.auth']);
    }

    /**
     * Show list type of product
     */
    public function index()
    {
        $dataGrid = DataGrid::model(Type::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name', ['label' => 'Название'])
            ->column('icon', ['label' => 'Знак клавиши'])
            ->linkColumn('', [], function ($model) {
                return "
                
                <a href='" . route('admin.type.edit', $model->id) . "'  class='btn bg-purple'><i class ='fa fa-edit'></i></a>
                <form id='admin-type-destroy-" . $model->id . "' class='inline-form'
                method='POST'
                action='" . route('admin.type.destroy', $model->id) . "'>
                    <input name='_method' type='hidden' value='DELETE' />
                    " . csrf_field() . "
                    <a href='#' data-destroy=\"jQuery('#admin-type-destroy-$model->id').submit()\"  class='btn btn-danger js-delete' >
                        <i class ='fa fa-trash'></i>
                    </a>
                </form>
            ";
            });

        return view('typeofproduct::admin.index')
            ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new type of product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('typeofproduct::admin.create');
    }

    /**
     * Create new type of product
     * @param TypeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TypeRequest $request)
    {
        $data = $request->except('_token');
        $data['icon'] = mb_substr(mb_strtoupper($data['name'][app()->getLocale()]), 0, 1);
        $page = Type::create($data);
        if($page) {
            return redirect()->route('admin.type.index')->with('notificationText', 'Тип товаров успешно создан');
        }
        return redirect()->route('admin.type.index')->with('errorText', 'Ошибка создания типа товаров. Пвторите попытку позже.');

    }

    /**
     * Show the form for editing the specified type of products.
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $model = Type::find($id);
        return view('typeofproduct::admin.edit')
            ->with('model', $model)
            ;
    }

    /**
     * Update type of product
     * @param TypeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TypeRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['icon'] = mb_substr(mb_strtoupper($data['name'][app()->getLocale()]), 0, 1);

        $model = Type::find($id);
        $model->update($data);
        if($model) {
            return redirect()->route('admin.type.index')->with('notificationText', 'Тип товаров успешно обновлен');
        }
        return redirect()->route('admin.type.index')->with('errorText', 'Ошибка обновления типа товаров. Пвторите попытку позже.');

    }

    /**
     * Delete type of product
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $model = Type::find($id);
        if($model){
            $model->delete();
            return redirect()->route('admin.type.index')->with('notificationText', 'Тип товаров успешно удален');
        }
        return redirect()->route('admin.type.index')->with('errorText', 'Ошибка удаления типа товаров. Повторите попытку позже.');
    }

    public function setToProduct(Request $request){
        //$product = Product::find($request->product_id);
        $type = Type::find($request->type_id);

        if($request->action == 'disable'){
            $type->product()->detach($request->product_id);
        }
        else {
            $type->product()->attach($request->product_id);
        }
        return 'ok';
    }

}