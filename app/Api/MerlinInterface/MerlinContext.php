<?php

namespace App\Api\MerlinInterface;
use Illuminate\Http\Request;
class MerlinContext
{

    public function __construct(MerlinContract $strategy)
    {
        $this->strategy = $strategy;
    }

    public function updateDB(Request $request){
        return $this->strategy->updateDB($request);
    }

    public function inform($data){
        return $this->strategy->inform($data);
    }
}
