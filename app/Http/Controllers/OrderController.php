<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{

    public function create($id)
    {
        $product = Product::findOrFail($id);
        $thumbs = is_array($product->thumbnails) ? $product->thumbnails : json_decode($product->thumbnails, true);
        $img = $thumbs[0] ?? null;
        return view('order', compact('product', 'img'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id'      => 'required|exists:products,id',
            'email'           => 'required|email',
            'nama_pemesan'  => 'required|string|max:255',
            'no_hp'           => 'required|string|max:20',
            'day_start'       => 'required|date',
            'day_end'         => 'required|date|after_or_equal:day_start',
            'proof'           => 'accepted',
        ]);

         $validated['proof'] = 'accepted';

    Order::create($validated);

    return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
    }
}
