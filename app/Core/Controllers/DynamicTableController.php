<?php

namespace App\Core\Controllers;
use App\Core\DynamicTableResources\ActiveClientTableResource;
use App\Core\DynamicTableResources\BrandTableResource;
use App\Core\DynamicTableResources\CategoryTableResource;
use App\Core\DynamicTableResources\DrugTableResource;
use App\Core\DynamicTableResources\FormsTableResource;
use App\Core\DynamicTableResources\LaboratoryTableResource;
use App\Core\DynamicTableResources\ModuleTableResource;
use App\Core\DynamicTableResources\PermissionTableResource;
use App\Core\DynamicTableResources\ProductTableResource;
use App\Core\DynamicTableResources\ProviderTableResource;
use App\Core\DynamicTableResources\RoleTableResource;
use App\Core\DynamicTableResources\TherapeuticActionTableResource;
use App\Core\DynamicTableResources\UnactiveClientTableResource;
use App\Core\DynamicTableResources\UserTableResource;
use Illuminate\Http\Request;

class DynamicTableController extends BaseController
{
    protected $resolvers = [
        'ActiveClients' => ActiveClientTableResource::class,
        'UnactiveClients' => UnactiveClientTableResource::class,
        'UserResolver' => UserTableResource::class,
        'RoleResolver' => RoleTableResource::class,
        'PermissionResolver' => PermissionTableResource::class,
        'ModuleResolver' => ModuleTableResource::class,
        'FormResolver' => FormsTableResource::class,
        'DrugResolver' => DrugTableResource::class,
        'LaboratoryResolver' => LaboratoryTableResource::class,
        'TherapeuticActionResolver' => TherapeuticActionTableResource::class,
        'BrandResolver' => BrandTableResource::class,
        'CategoryResolver' => CategoryTableResource::class,
        'ProductResolver' => ProductTableResource::class,
        'ProviderResolver' => ProviderTableResource::class

    ];

    public function resolve(Request $request){

        return (new $this->resolvers[$request->resolver])->handle($request);
    }

}
