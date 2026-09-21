<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //Praktikum 6
    protected $fillable = ['invoice_number', 'user_id', 'total', 'pay', 'change'];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }


}
