<?php

namespace App\Http\Controllers\Panel\Store;
use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\CategoryTableResource;
use App\Core\DynamicTableResources\DrugTableResource;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController implements ControllerContract
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $resource;


    public function __construct(CategoryTableResource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.store.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            Category::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La categoria se ha creado exitosamente!');
            return redirect()->route('categories.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'La categoria no se pudo crear!');
            return redirect()->route('categories.index');
        }
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('panel.store.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        DB::beginTransaction();
        try{
            $category->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La categoria se ha actualizado exitosamente!');
            return redirect()->route('categories.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'La categoria no se pudo actualizar!');
            return redirect()->route('categories.index');
        }
    }

}
