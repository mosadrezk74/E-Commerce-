<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Provinve;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Events\PurchaseCompleted;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function shop()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();
        return view('Website.shop', compact('products', 'categories'));
    }

    public function index()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::where('status', 1)->get();
        $latest_products = Product::with('category')->latest()->limit(9)->get();
        $t_products=Product::where('CategoryID', 5)->get();
        return view('Website.index', compact('products', 'categories', 'latest_products',
        't_products'));
    }

    public function show_product($ProductID)
    {
        $product = Product::with('category')->findOrFail($ProductID);
        $products=Product::all();
        $categories = Category::all();
        return view('Website.detail', compact('product',
        'products',
        'categories'));
    }

    public function category_product($CategoryID)
    {
        $products = Product::where('CategoryID', $CategoryID)->paginate(10);
        $categories = Category::all();
        return view('Website.category', compact('products', 'categories'));
    }

    public function about()
    {
        return view('Website.about-us');
    }

    public function contact()
    {
        return view('Website.contact-us');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        $cartTotal = array_sum(array_map(fn($item) => ($item['Price'] ?? 0) * ($item['quantity'] ?? 1), $cart));
        $user = User::with('Ship','city')->find(auth()->id());
        $cities = Provinve::all();


        $shipping=Auth::user()->city->Price;

        return view('Website.checkout' , compact(
            'cart','cartCount',
            'cartTotal','shipping' ,'cities'));
    }

    public function HandleCheckout(Order $order)
    {
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        $cartTotal = array_sum(array_map(fn($item) => ($item['Price'] ?? 0) * ($item['quantity'] ?? 1), $cart));
        $user = User::with('Ship')->find(auth()->id());


        $orders=Order::create([
            'UserID'=>auth()->user()->UserID,
            'OrderDate'=>now(),
            'TotalAmount'=>$cartTotal,
            'Status'=>0,
            'PaymentMethod'=>0,
            'Pay_Status'=>0,
        ]);
        event(new PurchaseCompleted($order));

        return redirect()->back()->with('success', 'Order has been placed successfully');

     }

     public function edit_profile()
     {
        $cities = Provinve::all();
         $user = User::with('Ship','city')->find(auth()->id());
         return view('Website.profile', compact('user','cities'));
     }

        public function update_profile(Request $request)
        {
            $user = User::FindOrFail(auth()->id());
            $user->FirstName = $request->FirstName;
            $user->LastName = $request->LastName;
            $user->Email = $request->Email;
            $user->PhoneNumber = $request->PhoneNumber;
            $user->City  = $request->City;
            $user->Address = $request->Address;
            $user->save();
            return redirect()->back()->with('success', 'Profile has been updated successfully');

        }


        public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|exists:coupons,Code'
        ]);

        $coupon = Coupon::where('Code', $request->coupon_code)->first();

        if (!$coupon || !$coupon->isValid()) {
            return response()->json(['status' => 'error', 'message' => 'Invalid or expired coupon.']);
        }


        $cartTotal = session()->get('cart_total', 0);

        $discount = min($cartTotal, $coupon->DiscountValue);
        session()->put('discount', $discount);
        session()->put('coupon_code', $coupon->Code);

        $coupon->increment('UsedCount');

        return response()->json([
            'status' => 'success',
            'message' => 'Coupon applied successfully!',
            'new_total' => number_format($cartTotal - $discount, 2),
            'discount' => number_format($discount, 2),
        ]);
    }


}
