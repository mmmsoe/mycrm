<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;

class CustomerApiController extends Controller
{
    public function index()
    {
        if($this->checkToken()) {
            return Customer::all();
        }

        return response(["error" => 'Unauthorize'], 401);
    }

    private function checkToken()
    {
        if(!request()->header('token')) {
            return false;
        }

        $token = request()->header('token');

        return User::where("token", $token)->count();
    }

    public function login() {
        if( auth()->attempt( request()->all() ) ) {
            $user = User::where("email", request()->email)->first();
            $user->token = str_random(32);
            $user->save();

            return $user;
        }

        return response(["error" => 'Invalide username or password'], 401);
    }

    public function view($id)
    {
        return Customer::find($id);
    }

    public function create()
    {
        if($this->checkToken()) {
            $customer = new Customer();
            $customer->name = request()->name;
            $customer->email = request()->email;
            $customer->phone = request()->phone;
            $customer->address = request()->address;
            $customer->save();

            return $customer;
        }

        return response(["error" => 'Unauthorize'], 401);
    }

    public function update($id)
    {
        $customer = Customer::find($id);
        $customer->name = request()->name;
        $customer->email = request()->email;
        $customer->phone = request()->phone;
        $customer->address = request()->address;
        $customer->save();

        return $customer;
    }

    public function delete($id)
    {
        if($this->checkToken()) {
            $customer = Customer::find($id);
            $customer->delete();

            return $customer;
        }

        return response(["error" => 'Unauthorize'], 401);
    }
}
