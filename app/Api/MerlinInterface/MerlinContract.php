<?php
namespace App\Api\MerlinInterface;

use Illuminate\Http\Request;

interface MerlinContract
{
    public function inform($data);
    public function updateDB(Request $request);

}
