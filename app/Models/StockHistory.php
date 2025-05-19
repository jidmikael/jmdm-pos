<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable = [
        'product_id', 'type', 'quantity', 'stock_after'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
