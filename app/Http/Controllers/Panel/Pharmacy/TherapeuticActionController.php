<?php

namespace App\Http\Controllers\Panel\Pharmacy;


use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\TherapeuticActionTableResource;
use App\Core\Interfaces\ControllerContract;
use App\Entities\TherapeuticAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TherapeuticActionController extends BaseController implements ControllerContract
{
    protected $resource;

    public function __construct(TherapeuticActionTableResource $resource)
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

        return view('panel.pharmacy.therapeutic_actions.create');
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
            TherapeuticAction::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La accion terapeutica se ha creado exitosamente!');
            return redirect()->route('therapeutic-actions.index');


        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'La accion terapeutica no se pudo crear!');
            return redirect()->route('therapeutic-actions.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TherapeuticAction $therapeuticAction
     * @return \Illuminate\Http\Response
     */
    public function edit(TherapeuticAction $therapeuticAction)
    {
        return view('panel.pharmacy.therapeutic_actions.edit', compact('therapeuticAction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param TherapeuticAction $therapeuticAction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TherapeuticAction $therapeuticAction)
    {
        DB::beginTransaction();
        try{
            $therapeuticAction->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La accion terapeutica se ha actualizado exitosamente!');
            return redirect()->route('therapeutic-actions.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'La accion terapeutica no se pudo actualizar!');
            return redirect()->route('therapeutic-actions.index');
        }
    }
}
