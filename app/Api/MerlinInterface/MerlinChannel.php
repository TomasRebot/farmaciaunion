<?php
namespace App\Api\MerlinInterface;

use Illuminate\Http\Request;

class MerlinChannel
{
    protected $strategy;

    protected $strategies = [
        'application/xml' => XmlProcessor::class,
        'application/csv' => CsvProcessor::class,
        'application/json' => JsonProcessor::class,
        'initial-load' => InitialLoadProcessor::class
    ];

    public function updateDB( String $type, Request $request )
    {

        try{
            $strategy = new $this->strategies[$type];
            $context = new MerlinContext($strategy);
            if( ! method_exists($context,'updateDB'))  throw new \Exception('Incorrect method', 500);
            return $context->updateDB($request);
        }catch (\Exception $e){
            return response()->json([
                'message'=> 'Wrong method requested',
                'aviable methods' => array_keys($this->strategies),
                'error' => true,
                'errors_message' => $e->getMessage()
            ]);
        }
    }

}
