<?php

namespace Src\Produits\Infrastructure\Models;

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
        'stock'
    ];
}
