<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers=User::all();
       return view('Admin.Customer.Customer',
        compact('customers'));
    }

    public function  show($UserID)
    {
        $user_data=User::with('order')->findOrFail($UserID);

        return view('admin.Customer.show_customer' ,
         compact('user_data') );
    }


    public function manage_customer_process(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'mobile'=>'required',
            'password'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'pincode'=>'required',
            'status'=>'required',
        ]);
    }


    public function delete(Request $request,$id)
    {
        $data=Size::find($id);
        $data->delete();
        $request->session()->flash('message','Size is successfully deleted');
        return redirect('admin/size');
    }

    public function status(Request $request,$status,$id)
    {
        $data=Customer::find($id);
        $data->status=$status;
        $data->save();
        $request->session()->flash('message','Customer Status is successfully Updated');
        return redirect('admin/customer');


    }
}
