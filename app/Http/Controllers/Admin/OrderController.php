<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();

        return view('Admin.Order.order', compact('orders'));
    }



    public function update_payemnt_status(Request $request, $status, $id)
    {
        DB::table('orders')
            ->where(['id' => $id])
            ->update(['payment_status' => $status]);
        return redirect('/admin/order_detail/' . $id);
    }

    public function update_order_status(Request $request, $status, $id)
    {
        DB::table('orders')
            ->where(['id' => $id])
            ->update(['order_status' => $status]);
        return redirect('/admin/order_detail/' . $id);
    }

    public function update_track_detail(Request $request, $id)
    {
        $track_details = $request->post('track_details');
        DB::table('orders')
            ->where(['id' => $id])
            ->update(['track_details' => $track_details]);
        return redirect('/admin/order_detail/' . $id);
    }

}
