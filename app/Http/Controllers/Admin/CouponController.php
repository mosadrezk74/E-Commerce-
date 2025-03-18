<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('Admin.Coupon.coupon', compact('coupons'));
    }

    public function create()
    {
        return view('Admin.Coupon.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'Code' => 'required|string|max:255|unique:coupons,Code',
            'DiscountValue' => 'required|numeric|min:0',
            'ValidFrom' => 'required|date',
            'ValidTo' => 'required|date|after:ValidFrom',
            'MaxUsage' => 'nullable|integer|min:1',
            'UsedCount' => 'nullable|integer|min:0',
            'IsActive' => 'nullable|boolean',
        ]);

        $coupon = new Coupon();
        $coupon->Code = $request->Code;
        $coupon->DiscountValue = $request->DiscountValue;
        $coupon->ValidFrom = $request->ValidFrom;
        $coupon->ValidTo = $request->ValidTo;
        $coupon->MaxUsage = $request->MaxUsage ?? null;
        $coupon->UsedCount = 0;
        $coupon->IsActive = $request->IsActive ?? 0;
        $coupon->save();

        return redirect()->route('admin.coupon.index')->with('message', 'Coupon is successfully created');
    }


    public function delete(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        $request->session()->flash('message', 'Coupon is successfully deleted');
        return redirect()->route('admin.coupon.index');
    }

    public function status(Request $request, $status, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->is_active = $status;
        $coupon->save();

        $request->session()->flash('message', 'Coupon status is successfully updated');
        return redirect()->route('admin.coupon.index');
    }
}
