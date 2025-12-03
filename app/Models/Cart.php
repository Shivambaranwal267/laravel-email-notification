<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id',
        'email',
        'sent_email'
    ];

    // A cart belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
