<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    //Praktikum 6
    protected $fillable = ['category_id', 'code', 'name', 'unit', 'price', 'stock'];
 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
 
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    //Tugas Praktikum 6
    protected function priceRupiah(): Attribute
    {
        return Attribute::get(
            fn () => 'Rp ' . number_format($this->price, 0, ',', '.')
        );
    }

}
