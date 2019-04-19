<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductB extends Model
{
    protected $table='product_b';
    protected $primaryKey ='id';
    protected $fillable = [
        'product_name',
        'describtion',
        'details',
        'photo',
        'type'
    ];
}
