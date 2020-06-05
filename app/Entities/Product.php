<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Carbon\Carbon;


class Product extends BaseEntity
{


    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'description',
        'bar_code',
        'provider_id',
        'merlin_id',
        'die_number',
        'presentation',
        'fragment_unit',
        'laboratory_id',
        'state',
        'stock',
        'brand_id',
        'category_id',
        'primary_therapeutic_action_id',
        'drug_id',
        'price'
    ];

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }


    public function laboratory()
    {
        return $this->hasOne(Laboratory::class, 'id', 'laboratory_id');
    }

    public function provider()
    {
        return $this->hasOne(Provider::class, 'id', 'provider_id');
    }


    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drug_id');
    }
    public function primaryTherapeuticAction()
    {
        return $this->belongsTo(TherapeuticAction::class, 'primary_therapeutic_action_id','id');
    }




}
