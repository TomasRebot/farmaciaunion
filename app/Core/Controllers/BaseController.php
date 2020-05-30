<?php
namespace App\Core\Controllers;
use App\Core\Traits\deleteHandlerTrait;
use App\Exceptions\NonModelForSoftDeleteException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    use DeleteHandlerTrait;

}
