<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use App\Models\Provinve;
use Illuminate\Support\Facades\Auth;

class Counter extends Component
{
    public $selectedCity;
    public $shipping = 0;
    public $totalPrice = 7200; // سعر المنتج (يمكن تغييره حسب منطق التطبيق)
    public $totalWithShipping = 7200; // الإجمالي الافتراضي

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

    public function render()
    {
        $cities = Provinve::all(); // جلب جميع المدن من قاعدة البيانات
        return view('livewire.counter', [
            'cities' => $cities,
        ]);
    }
}
