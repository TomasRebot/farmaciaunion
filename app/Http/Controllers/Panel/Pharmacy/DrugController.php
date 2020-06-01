<?php

namespace App\Http\Controllers\Panel\Pharmacy;

use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\DrugTableResource;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Drug;
use App\Entities\TherapeuticAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DrugController extends BaseController implements ControllerContract
{
    protected $resource;

    public function __construct(DrugTableResource $resource)
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
        $therapeutic_actions = TherapeuticAction::actives()->get();

        return view('panel.pharmacy.drugs.create', compact('therapeutic_actions'));
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
            $drug = Drug::create($request->all());
            $drug->therpaeuticActions()->sync($request->primary_therapeutic_action_id);
            $drug->save();

            DB::commit();
            $request->session()->flash('flash_message', 'La droga se ha creado exitosamente!');
            return redirect()->route('drugs.index');
        }catch (\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            $request->session()->flash('flash_error', 'La droga no se pudo crear!');
            return redirect()->route('drugs.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TherapeuticAction $drug
     * @return \Illuminate\Http\Response
     */
    public function edit(Drug $drug)
    {
        return view('panel.pharmacy.drugs.edit', compact('drug'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Drug $drug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {
        DB::beginTransaction();
        try{
            $drug->therpaeuticActions()->sync($request->primary_therapeutic_action_id);
            $drug->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La droga se ha actualizado exitosamente!');
            return redirect()->route('drugs.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'La droga no se pudo actualizar!');
            return redirect()->route('drugs.index');
        }
    }
}
