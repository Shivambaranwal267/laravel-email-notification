<?php

namespace App\Console\Commands;

use App\Mail\OrderMail;
use App\Models\Cart;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AbandonedCartEmail extends Command
{
    protected $signature = 'cart:send-email';

    protected $description = 'Send abandoned cart emails every 5 minutes';

    public function handle()
    {
        \Log::info('Running abandoned cart command...');
        $carts = Cart::where('sent_email', 0)->get();

        foreach ($carts as $cart) {
            \Log::info('Sending email to: '.$cart->email);
            $product = $cart->product;
            \Log::info('Abandoned cart email command running');

            $data = [
                'product_name' => $product->product_name,
                'price' => $product->price,
                'product_image' => $product->product_image,
            ];

            Mail::to($cart->email)->send(new OrderMail($data));

            // prevent duplicates
            $cart->update(['sent_email' => 1]);

            \Log::info('Email sent and marked as sent for: '.$cart->email);
        }

        return Command::SUCCESS;
    }
}
