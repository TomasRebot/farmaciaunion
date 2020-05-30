<?php

namespace App\Http\Middleware;

use App\Entities\Form;
use App\Entities\Permission;
use App\Entities\RolePermissionsForms;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $intendedForm = Form::where('target', $request->path())->first();

        if( Auth::check() && $intendedForm && ! Auth::user()->can($intendedForm->key.'.view')){

            $request->session()->flash('flash_error', 'No tienes acceso a esta seccion, 
            si crees que es un error comunicate con 
            un administrador!');
            return redirect()->back();

        }


        if( ! Auth::check() || ! Auth::user()->hasAccessToPanel()){
            return redirect('/');
        }


        return $next($request);
    }
}
