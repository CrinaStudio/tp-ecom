<?php

namespace Src\Products\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'price',
        'stockQuantity',
        'description',
        'salePrice',
        'costPrice',
        'status',
        'shippingClass'

    ];
}
