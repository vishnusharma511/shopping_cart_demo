<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public $fillable = [
        'name',
        'description',
        'imageSrc',
        'price'
    ];

    public function prodCard(){
        return $this->hasOne(Cart::class,'product_id','id');
    }
}
