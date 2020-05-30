<?php

namespace App\Entities;

class Client extends User
{

    protected $table = 'users';

//    public function salesOrders(){
//        return $this->hasMany(SaleOrder::class, 'client_id', 'id');
//    }


}
