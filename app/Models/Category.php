<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Praktikum 6
    protected $fillable = ['name', 'description'];
 
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
