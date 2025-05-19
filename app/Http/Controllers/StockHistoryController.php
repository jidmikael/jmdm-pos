<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockHistory;
use App\Models\Product;

class StockHistoryController extends Controller
{
    public function index(Request $request)
    {
        $row = $request->input('row', 10);
        $search = $request->input('search');

        $query = StockHistory::with('product.category', 'product.supplier')->latest();

        if ($search) {
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%');
            });
        }

        $stockHistories = $query->paginate($row);

        return view('stock.history.index', compact('stockHistories'));
    }
    public function create()
    {
        $products = Product::all();
        return view('stock.history.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        // Step 1: Get the product
        $product = Product::findOrFail($request->product_id);

        // Step 2: Update the stock depending on type
        if ($request->type === 'in') {
            $product->product_store += $request->quantity;
        } elseif ($request->type === 'out') {
            if ($product->product_store < $request->quantity) {
                return back()->with('error', 'Not enough stock to subtract.');
            }
            $product->product_store -= $request->quantity;
        }

        // Step 3: Save the updated stock to the product
        $product->save();

        // Step 4: Create stock history and include the current stock AFTER update
        StockHistory::create([
            'product_id'   => $product->id,
            'type'         => $request->type,
            'quantity'     => $request->quantity,
            'stock_after'  => $product->product_store, // ✅ This now has the updated stock
        ]);

        return redirect()->route('stock.history')->with('success', 'Stock updated successfully.');
    }


}
