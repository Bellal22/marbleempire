<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductA extends Model
{
    protected $table='product_a';
    protected $primaryKey ='id';
    
    protected $fillable = [
        'product_name',
        // 'product_no',
        'describtion',
        'details',
        'photo',
        'type',
        'class'
    ];
}
