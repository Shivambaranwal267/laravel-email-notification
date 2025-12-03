<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        // prevent duplicates
        $exists = Cart::where('product_id', $product->id)
                      ->where('email', 'shivambaranwal367@gmail.com')
                      ->first();

        if ($exists) {
            return back()->with('error', 'Product already in cart. Email not sent twice.');
        }

        Cart::create([
            'product_id' => $product->id,
            'email' => 'shivambaranwal367@gmail.com',
            'sent_email' => 0
        ]);

        return back()->with('success', 'Product added to cart!');
    }
}
