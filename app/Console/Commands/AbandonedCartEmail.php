<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class AbandonedCartEmail extends Command
{
    protected $signature = 'cart:send-email';
    protected $description = 'Send abandoned cart emails every 5 minutes';

    public function handle()
    {
        $carts = Cart::where('sent_email', 0)->get();

        foreach ($carts as $cart) {
            $product = $cart->product;

            $data = [
                'product_name' => $product->product_name,
                'price' => $product->price,
                'product_image' => $product->product_image
            ];

            Mail::to($cart->email)->send(new OrderMail($data));

            // prevent duplicates
            $cart->update(['sent_email' => 1]);
        }

        return Command::SUCCESS;
    }
}
