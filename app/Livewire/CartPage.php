<?php

namespace App\Livewire;

use App\Models\Provinve;
use Livewire\Component;

class CartPage extends Component
{
    public $selectedCity;
    public $shipping = 0;
    public $totalPrice = 0;
    public $totalWithShipping = 0;
    public $cart = [];
    public $cartCount = 0;

    public function mount()
    {
        // تحميل بيانات السلة من الجلسة (Session)
        $this->cart = session('cart', []);
        $this->cartCount = count($this->cart);

        // حساب السعر الإجمالي للمنتجات
        $this->calculateTotalPrice();
    }

    public function calculateTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->cart as $details) {
            $this->totalPrice += $details['Price'] * $details['quantity'];
        }
        $this->totalWithShipping = $this->totalPrice + $this->shipping;
    }

    public function updatedSelectedCity($cityId)
    {
        // تحديث سعر الشحن بناءً على المدينة المحددة
        $city = Provinve::find($cityId);
        if ($city) {
            $this->shipping = $city->Price;
        } else {
            $this->shipping = 0;
        }

        // حساب الإجمالي شامل الشحن
        $this->totalWithShipping = $this->totalPrice + $this->shipping;
    }

    public function removeFromCart($productId)
    {
        // حذف المنتج من السلة
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
            session(['cart' => $this->cart]);
            $this->cartCount = count($this->cart);
            $this->calculateTotalPrice();
        }
    }

    public function render()
    {
        $cities = Provinve::all(); // جلب جميع المدن من قاعدة البيانات
        return view('livewire.cart-page', [
            'cities' => $cities,
        ]);
    }
}
