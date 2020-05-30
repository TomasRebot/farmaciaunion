<?php

namespace App\Http\Controllers\Panel\Admin;
use App\Core\Controllers\BaseController;
use App\Core\interfaces\ControllerContract;

use App\GlobalConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalConfigController extends BaseController implements ControllerContract
{

    public function index()
    {
        $globalConfig = GlobalConfig::first();
        return view('panel.admin.globals.index', compact('globalConfig'));
    }


    public function create()
    {
        return view('panel.admin.globals.create', compact('roles'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $globalConfig = GlobalConfig::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La configuracion se ha creado exitosamente!');
            return redirect()->route('globals.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'La configuracion no se pudo crear!');
            return redirect()->route('global-config.index')->withErrors();
        }

    }
    public function update(Request $request, GlobalConfig $globalConfig)
    {
        DB::beginTransaction();
        try{
            $globalConfig->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La configuracion se ha actualizado exitosamente!');
            return redirect()->route('global-config.index');

        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', $e->getMessage());
            return redirect()->route('global-config.index');
        }

    }


}
