<?php

namespace App\Http\Controllers\Panel\Client;

use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\ActiveClientTableResource;
use App\Core\DynamicTableResources\UnactiveClientTableResource;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Client;
use App\Entities\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends  BaseController implements ControllerContract
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $activeClientResource;
    protected $unactiveClientResource;


    public function __construct(ActiveClientTableResource $activeClientResource, UnactiveClientTableResource $unactiveClientResource)
    {
        $this->activeClientResource = $activeClientResource;
        $this->unactiveClientResource = $unactiveClientResource;
    }
    public function index()
    {
        $apiResource = $this->activeClientResource->getResource();

        return view('panel.client.active-index', compact('apiResource'));
    }
    public function unactives()
    {
        $apiResource = $this->unactiveClientResource->getResource();
        return view('panel.client.unactive-index',compact('apiResource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.client.create');
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

            $client = Client::create($request->all());
            $client->roles()->sync(Role::where('name', 'Cliente')->first()->id);
            $client->save();
            DB::commit();
            $request->session()->flash('flash_message', 'El cliente se ha creado exitosamente!');
            return redirect()->route('client.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El cliente no se pudo crear!');
            return redirect()->route('clients.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('panel.client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {

        DB::beginTransaction();
        try{
            $stmt = $request->password == '' ? $request->except('password') : $request->all();
            $client->update($stmt);
            $client->save();
            DB::commit();
            $request->session()->flash('flash_message', 'El usuario se ha actualizado exitosamente!');
            return redirect()->route('client.index');

        }catch (\Exception $e){
            DB::rollBack();

            $request->session()->flash('flash_error', $e->getMessage());
            return redirect()->route('clients.index');
        }

    }
}
