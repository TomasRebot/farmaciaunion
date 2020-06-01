<?php

namespace App\Http\Controllers\Panel\Pharmacy;


use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\LaboratoryTableResource;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaboratoryController extends BaseController implements ControllerContract
{
    protected $resource;

    public function __construct(LaboratoryTableResource $resource)
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
        return view('panel.pharmacy.laboratories.create');
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
            Laboratory::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El laboratorio se ha creado exitosamente!');
            return redirect()->route('laboratories.index');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            $request->session()->flash('flash_error', 'El laboratorio no se pudo crear!');
            return redirect()->route('laboratories.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Laboratory $laboratory
     * @return \Illuminate\Http\Response
     */
    public function edit(Laboratory $laboratory)
    {
        return view('panel.pharmacy.laboratories.edit', compact('laboratory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Laboratory $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laboratory $laboratory)
    {
        DB::beginTransaction();
        try{
            $laboratory->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El laboratorio se ha actualizado exitosamente!');
            return redirect()->route('laboratories.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El laboratorio no se pudo actualizar!');
            return redirect()->route('laboratories.index');
        }
    }
}
