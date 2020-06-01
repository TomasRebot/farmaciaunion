<?php


namespace App\Core\Entities;


use App\Core\Traits\UserExtensions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEntity extends Model
{
    use UserExtensions;

    protected $onSoftDelete = 'toggleState';

    public function scopeActives()
    {
        return self::where('state', '1');
    }


    public function getCreatedParsedAttribute(){
        return Carbon::parse($this->created_at)->format('d/m/y');
    }

    public function hasSpecialty($specialty_id)
    {
        return $this->specialties->pluck('id')->contains($specialty_id);
    }











}
