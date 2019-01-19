<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['code','name','description','brand','price','category_id'];
    //function to create a relation with categories table
    public function categories(){
        return $this->belongsTo('App\Category');
    }
}
