<?php


namespace App\Core\Interfaces;


use Illuminate\Http\Request;

interface ResourceTableInterface
{
    public function sort($query, $request);
    public function filter($query,$request);
    public function getResource();
    public function handle(Request $request);
}
