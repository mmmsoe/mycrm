<?php

namespace App\Http\Controllers;

use App\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $customers = Customer::all();

        return view('customer/index', [
            'customers' => $customers
        ]);
    }

    public function view($id)
    {
        $customer = Customer::find($id);

        return view('customer/view', [
            'customer' => $customer
        ]);
    }

    public function add()
    {
        return view('customer/add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            "name" => "required|min:3",
            "email" => "required|email",
            "phone" => "required",
            "address" => "required"
        ]);

        if( $validator->fails() ) {
            return redirect('customers/add')->withErrors( $validator );
        }

        $customer = new Customer();
        $customer->name = request()->name;
        $customer->email = request()->email;
        $customer->phone = request()->name;
        $customer->address = request()->address;
        $customer->save();

        return redirect('customers');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer/edit', [
            'customer' => $customer
        ]);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            "name" => "required|min:3",
            "email" => "required|email",
            "phone" => "required",
            "address" => "required"
        ]);

        if( $validator->fails() ) {
            return back()->withErrors( $validator );
        }

        $customer = Customer::find($id);
        $customer->name = request()->name;
        $customer->email = request()->email;
        $customer->phone = request()->name;
        $customer->address = request()->address;
        $customer->save();

        return redirect('customers')->with('info', $customer->name . ' updated.');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect('customers')->with('info', 'A customer deleted.');
    }
}
