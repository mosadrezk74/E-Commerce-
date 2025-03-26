<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Models\Order;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Models\Admin\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('ADMIN_LOGIN')) {
            return redirect('admin/dashboard');
        } else {
            return view('admin.login');
        }
    }

    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');

        $admin = Admin::where('email', $email)->first();

        if ($admin && Hash::check($password, $admin->password)) {
            $request->session()->put('ADMIN_LOGIN', true);
            $request->session()->put('ADMIN_ID', $admin->id);
            return redirect('admin.dashboard');
        } else {
            $request->session()->flash('error', 'Please enter valid login details');
            return redirect('admin');
        }
    }

    public function dashboard()
    {
        $customers = User::count();
        $activeCustomers = User::where('IsActive', 1)->count();
        $inactiveCustomers = User::where('IsActive', 0)->count();
        $totalAmount = Order::sum('TotalAmount');

        $placedOrders = Order::where('status', 1)->count();
        $onTheWayOrders = Order::where('status', 2)->count();
        $deliveredOrders = Order::where('status', 3)->count();
        $successfulPayments = Order::where('pay_status', 1)->count();

        $data = compact('customers', 'activeCustomers', 'inactiveCustomers', 'totalAmount', 'placedOrders', 'onTheWayOrders', 'deliveredOrders', 'successfulPayments');

        return view('admin.dashboard', $data);
    }

    public function updatePassword()
    {
        $admin = Admin::find(1);
        $admin->password = Hash::make('12345678');
        $admin->save();
    }
}
