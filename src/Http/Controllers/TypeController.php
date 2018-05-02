<?php

namespace Softce\Type\Http\Controllers;

use Mage2\Ecommerce\Http\Controllers\Admin\AdminController;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;

use Softce\Type\Http\Requests\TypeRequest;
use Softce\Type\Module\Type;
use File;
use DB;

class TypeController extends AdminController
{

    private $path_slide = '';

    public function __construct()
    {
        $this->middleware(['admin.auth', 'main_lang']);
    }

    /**
     * Show list type of product
     */
    public function index()
    {
        $dataGrid = DataGrid::model(Type::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name', ['label' => 'Название'])
            ->linkColumn('', [], function ($model) {
                return "
                
                <a href='" . route('admin.typeofproduct.edit', $model->id) . "'  class='btn bg-purple'><i class ='fa fa-edit'></i></a>
                <form id='admin-typeofproduct-destroy-" . $model->id . "' class='inline-form'
                method='POST'
                action='" . route('admin.typeofproduct.destroy', $model->id) . "'>
                    <input name='_method' type='hidden' value='DELETE' />
                    " . csrf_field() . "
                    <a href='#' data-destroy=\"jQuery('#admin-typeofproduct-destroy-$model->id').submit()\"  class='btn btn-danger js-delete' >
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
        $new_slide = $request->file('new_slide');

        if($new_slide) {
            foreach($new_slide as $slide) {
                $name_file = $slide->getClientOriginalName();
                $slide->move(public_path($this->path_slide), $name_file);
                Type::create([
                    'path' => $name_file
                ]);
            }

            return redirect()->route('admin.slider.index')->with('notificationText', 'Слайд(и) успешно добавлен(и)');
        }

        return redirect()->route('admin.slider.index')->with('errorText', 'Для создания слайд(а/ов) нужно изображение');
    }

    /**
     * Update type of product
     * @param TypeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TypeRequest $request, $id)
    {
        $slide = Type::find($id);
        if($slide){
            $new_slide = $request->file('slide');
            $slide->text = $request->text;

            if($new_slide){
                File::delete(public_path($this->path_slide.'/'.$slide->path));

                $name_file = $new_slide->getClientOriginalName();
                $new_slide->move(public_path($this->path_slide), $name_file);
                $slide->path = $name_file;
            }
            $slide->save();

            return redirect()->route('admin.slider.index')->with('notificationText', 'Слайд успешно обновлен');
        }
        return redirect()->route('admin.slider.index')->with('errorText', 'Ошибка обновления слайда. Повторите запрос позже!!!');
    }

    /**
     * Delete type of product
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $slide = Type::find($id);
        if($slide){
            File::delete(public_path($this->path_slide.'/'.$slide->path));
            $slide->delete();
            return redirect()->route('admin.slider.index')->with('notificationText', 'Слайд успешно удален');
        }
        return redirect()->route('admin.slider.index')->with('errorText', 'Ошибка удаления слайда. Повторите запрос позже!!!');
    }

}