<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class AbandonedCartEmail extends Command
{
    // Command signature
    protected $signature = 'cart:send-email';
    protected $description = 'Send abandoned cart emails every 5 minutes';

    public function handle()
    {
        \Log::info("Running abandoned cart command..."); // Logging for debug

        // Get carts that haven't received email yet and older than 10 minutes
        $carts = Cart::where('sent_email', 0)
                     ->where('created_at', '<=', now()->subMinutes(10))
                     ->get();

        foreach ($carts as $cart) {
            $product = $cart->product;

            if (!$product) {
                \Log::warning("Cart ID {$cart->id} has no product associated.");
                continue; // Skip if product deleted
            }

            $data = [
                'product_name' => $product->product_name,
                'price' => $product->price,
                'product_image' => $product->product_image
            ];

            // Send email (queued)
            Mail::to($cart->email)->queue(new OrderMail($data));

            // Mark as email sent
            $cart->update(['sent_email' => 1]);

            \Log::info("Abandoned cart email sent to {$cart->email}");
        }

        return Command::SUCCESS;
    }
}
