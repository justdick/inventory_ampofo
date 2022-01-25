<?php

namespace App\Models;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand_name',
        'model_name',
        'wholesale_price',
        'min_price',
        'price_sold',
        'deleted_at'
    ];

    public function stock(){
        return $this->hasMany(Stock::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
