<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_img',
        'product_price',
        'category',
    ];
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
