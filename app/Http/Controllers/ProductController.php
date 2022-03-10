<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Provide listing of all available products
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(20)->toArray();
        return array_reverse($products);      
    }

    /**
     * Method to store product in database
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = new Product([
            'name' => $validated['name'],
            'detail' => $validated['detail'],
            'price' => $validated['price']
        ]);
        $product->save();
        return response()->json('Product created!');
    }

    /**
     * Method to show product detail
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Method to update product in database
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return Illuminate\Http\Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json('Product updated!');
    }

    /**
     * Method to delete product from database
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('Product deleted!');
    }
}
