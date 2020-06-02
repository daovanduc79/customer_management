<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;

class City extends Model
{
    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
