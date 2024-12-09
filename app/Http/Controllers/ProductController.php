<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function views()
    {
        $products = Product::all();
        return view('products', compact('products')); // Points to resources/views/products.blade.php
    }

    /**
     * Show form to create a new product.
     */
    public function create()
    {
        return view('products.create'); // Points to resources/views/products/create.blade.php
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;

    // Save image to public/upload/product_images
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('upload/product_images'), $imageName);
        $product->image = $imageName;
    }

    $product->save();

    return redirect()->route('products.create')->with('success', 'Product created successfully!');
}


    /**
     * Add a product to the cart.
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Show the shopping cart.
     */
    public function cart()
    {
        return view('cart'); // Points to resources/views/cart.blade.php
    }

    /**
     * Checkout and clear the cart.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => "Checkout successful.",
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Update product quantity in the cart.
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Remove product from the cart.
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
