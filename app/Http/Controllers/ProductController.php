<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('welcome', compact('products'));
    }

    public function StoreProduct(Request $request)
    {
        $image = $request->file('product_image');

        $fileName = time().'.'.$image->getClientOriginalName();
        $image->move(public_path('upload/product/'), $fileName);
        $save_url = 'upload/product/'.$fileName;

        Product::insert([
            'product_name' => $request->product_name,
            'category' => $request->category,
            'price' => $request->price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        // / Send Mail Notifications
        $data = [
            'email' => $request->email,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'product_image' => $save_url,
        ];

        // Use $request->email instead of $cart->email
        Mail::to($request->email)->send(new OrderMail($data));

        return redirect()->back()->with('success', 'Product Added Successfully');
    }
}
