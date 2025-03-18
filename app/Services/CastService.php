<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getCart()
    {
        return Session::get('cart', []);
    }

    public function addToCart($productId, $quantity = 1)
    {
        $product = Product::findOrFail($productId);
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'ProductName'  => $product->ProductName,
                'ImageURL'     => $product->ImageURL,
                'Price'        => $product->Price,
                'quantity'     => $quantity,
                'Description'  => $product->Description
            ];
        }

        Session::put('cart', $cart);
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        $cart = $this->getCart();
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(1, $quantity); // الحد الأدنى 1
            Session::put('cart', $cart);
        }
    }

    public function clearCart()
    {
        Session::forget('cart');
    }

    public function getTotalPrice()
    {
        return array_sum(array_map(fn($item) => $item['Price'] * $item['quantity'], $this->getCart()));
    }

    public function getCartCount()
    {
        return array_sum(array_column($this->getCart(), 'quantity'));
    }
}
