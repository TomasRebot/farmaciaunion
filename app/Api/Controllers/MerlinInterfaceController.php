<?php

namespace App\Api\Controllers;
use App\Api\MerlinInterface\MerlinChannel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class MerlinInterfaceController extends BaseController
{

    protected $merlinChannel;

    public function __construct(MerlinChannel $merlinChannel)
    {
        $this->merlinChannel = $merlinChannel;
    }

    public function updateProduct(Request $request)
    {
        $header = $request->header()['token'][0];

        if(!$header || $header === '' )  {
            return response()->json(['status' => 500, 'message' => 'invalid token']);
        }else{

            $type = $request->header()['content-type'][0];
            return $this->merlinChannel->updateDB($type,$request);
        }
    }
    public function fireInitialLoad(Request $request)
    {
        return $this->merlinChannel->updateDB('initial-load',$request);
    }

}
