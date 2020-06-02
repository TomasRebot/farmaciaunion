<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class NonModelForSoftDeleteException extends Exception
{

    public function render()
    {
        return response()->json([
            'error' => true,
            'message' => $this->getMessage()
        ]);
    }

}
