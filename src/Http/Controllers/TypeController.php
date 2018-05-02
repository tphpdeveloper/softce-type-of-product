<?php

namespace Softce\Type\Http\Controllers;

use Mage2\Ecommerce\Http\Controllers\Admin\AdminController;
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
        $this->path_slide = 'uploads/slider';
    }

    /**
     * Show list type of product
     */
    public function index()
    {


        return view('slider::admin-slide')
            ->with('slides', Type::all())
            ->with('path_slide', $this->path_slide);
    }

    /**
     * Create new type of product
     * @param TipeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TipeRequest $request)
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
     * @param TipeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TipeRequest $request, $id)
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