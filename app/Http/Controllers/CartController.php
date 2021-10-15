<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index')->with([
            "items" => \Cart::getContent()
        ]);
    }


    //add item to cart
    public function addProductToCart(Request $request, Product $product)
    {
        \Log::info('This is some useful information.',$request->all());
        \Cart::add(array(
            "id" => $product->id,
            "name" => $product->title,
            "price" => $product->price,
            "quantity" => $request->qty,
            'attributes' => array(),
            'associatedModel' => $product,
        ));
        return redirect()->route("cart.index");
    }


    //update item on cart
    public function updateProductOnCart(Request $request, Product $product)
    {
        \Log::info('This is some useful information.',$request->all());
        \Cart::update($product->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty,
            )
        ));
        return redirect()->route("cart.index");
    }



    //remove item from cart
    public function removeProductFromCart(Product $product)
    {

        \Cart::remove($product->id);
        return redirect()->route("cart.index");
    }
}
