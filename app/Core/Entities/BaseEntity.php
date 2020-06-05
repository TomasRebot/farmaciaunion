<?php


namespace App\Core\Entities;


use App\Core\Traits\UserExtensions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEntity extends Model
{
    use UserExtensions;

    public $onSoftDelete = 'toggleState';

    public function scopeActives($query)
    {
        return $query->where('state', '1');
    }

    public function scopeUnactives($query)
    {
        return $query->where('state', '0');
    }


    public function getCreatedParsedAttribute(){
        return Carbon::parse($this->created_at)->format('d/m/y');
    }













}
