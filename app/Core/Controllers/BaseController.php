<?php
namespace App\Core\Controllers;
use App\Core\Traits\DeleteHandlerTrait;
use App\Http\Controllers\Controller;


abstract class BaseController extends Controller
{
    use DeleteHandlerTrait;

    public function index()
    {
        $apiResource = $this->resource->getResource();
        return view('panel.partials.dynamictable', compact('apiResource'));
    }
}
