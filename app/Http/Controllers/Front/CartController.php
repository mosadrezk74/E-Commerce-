<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CartService;

class CartController extends Controller
{
    public function cart()
    {

        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        $cartTotal = array_sum(array_map(fn($item) => ($item['Price'] ?? 0) * ($item['quantity'] ?? 1), $cart));
        $user = User::with('Ship')->find(auth()->id());

        if ($user && $user->Ship->isNotEmpty()) {
            $shipping = $user->Ship->first()->ShippingCost;
        } else {
            $shipping = 0;
        }


        return view('Website.cart', compact('cart','cartCount','cartTotal'
    ,'shipping'
    ));
    }

    public function addToCart($ProductID)
    {
        $product = Product::findOrFail($ProductID);
        $cart = session()->get('cart', []);

        if (isset($cart[$ProductID])) {
            $cart[$ProductID]['quantity']++;
        } else {
            $cart[$ProductID] = [
                "ProductName"  => $product->ProductName,
                "ImageURL"     => $product->ImageURL ?? asset('images/default-image.jpg'),
                "Price"        => $product->Price,
                "quantity"     => request('quantity', 1),
                "Description"  => $product->Description
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة بنجاح!');
    }

    public function removeFromCart($ProductID)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$ProductID])) {
            unset($cart[$ProductID]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'تمت إزالة المنتج من السلة!');
    }

    public function clearCart()
    {
        session()->forget('cart');

        return redirect()->back()->with('success', 'تم إفراغ السلة بالكامل!');
    }

    public function wishlist()
    {
        $wishlist = session()->get('wishlist', []);
        return view('Website.wishlist', compact('wishlist'));
    }
    public function addToWishlist($ProductID)
    {
        $product = Product::findOrFail($ProductID);
        $wishlist = session()->get('wishlist', []);


            $wishlist[$ProductID] = [
                "ProductName"  => $product->ProductName,
                "ImageURL"     => $product->ImageURL ?? asset('images/default-image.jpg'),
                "Price"        => $product->Price,
                "Description"  => $product->Description
            ];


        session()->put('wishlist', $wishlist);

        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى قائمة الرغبات بنجاح!');
    }

}
