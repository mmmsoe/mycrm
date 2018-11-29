<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function complains()
    {
        return $this->hasMany('App\Complain');
    }
}
