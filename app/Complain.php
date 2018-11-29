<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function logs()
    {
        return $this->hasMany('App\Log');
    }
}
