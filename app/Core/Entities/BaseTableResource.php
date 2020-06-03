<?php


namespace App\Core\Entities;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseTableResource
{

    protected $request;

    protected $current_form;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->current_form = DB::table('forms')->where('target', $this->request->path())->pluck('key')->first();
    }


    public function filter($query,$request)
    {
        if(isset($request->columnFilters) && count($request->columnFilters)){
            foreach($request->columnFilters as $key =>  $filter){
                $query = $query->orWhere($filter, 'LIKE', '%'.$request->search_query.'%');
            }
        }
        return $query;
    }

    public function sort($query, $request)
    {
        $sort = $request->sort;
        $field = ($sort['field'] != '') ? $sort['field'] : null;
        $type = ($sort['type'] != '') ? $sort['type'] : null;
        if(isset($sort['type']) && isset($sort['field']) && !is_null($field) && !is_null($type))
        {
          $query = $query->orderBy($field, $type);
        }
        return $query;
    }

}
