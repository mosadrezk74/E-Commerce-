<?php

namespace App\Http\Controllers\front;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon || !$coupon->isValid()) {
            return response()->json(['message' => 'Invalid or expired coupon'], 400);
        }

        $discount = $coupon->type === 'percentage'
            ? ($request->total * $coupon->discount / 100)
            : $coupon->discount;

        return view('Website.checkout', compact('discount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'discount' => 'required|numeric',
            'type' => 'required|in:fixed,percentage',
            'expires_at' => 'nullable|date',
            'usage_limit' => 'nullable|integer'
        ]);

        Coupon::create($request->all());

        return response()->json(['message' => 'Coupon created successfully']);
    }
}
