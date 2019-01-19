<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['id','code','name','description','active'];

    public function products(){
        return $this->hasMany('App\Product');
    }
}
