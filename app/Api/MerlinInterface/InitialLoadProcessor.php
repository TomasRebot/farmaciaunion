<?php


namespace App\Api\MerlinInterface;

use App\Jobs\FireInitialLoadJob;
use Illuminate\Http\Request;


class InitialLoadProcessor implements MerlinContract
{


    public function inform($data)
    {
        // TODO: Implement inform() method.
    }

    public function updateDB(Request $request)
    {

        FireInitialLoadJob::dispatch();
        return response()->json(['status' => 200,'message' => 'queue running on secondary thread']);

    }

}
