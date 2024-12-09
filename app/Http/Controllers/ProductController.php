<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{





    
    /**
     * Display a listing of products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products')); // Points to resources/views/products/index.blade.php
    }

    /**
     * Show form to create a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('products.create'); // Points to resources/views/products/create.blade.php
    }

    /**
     * Store a newly created product in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath; // Save image path
        }

        $product->save();

        return redirect()->route('products.create')->with('success', 'Product created successfully!');
    }

    /**
     * Show the shopping cart.
     *
     * @return \Illuminate\View\View
     */
    public function cart()
    {
        return view('cart'); // Points to resources/views/cart/index.blade.php
    }

    /**
     * Add product to cart.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
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
     * Update product quantity in the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
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
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function remove(Request $request)
{
    if ($request->id) {
        $cart = session()->get('cart');

          if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);

            return response()->json(['success' => 'Product removed successfully']);
        }
    }

    return response()->json(['error' => 'Invalid product ID'], 400);
}  


} 
