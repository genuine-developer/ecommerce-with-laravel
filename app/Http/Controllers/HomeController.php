<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    /**
     * Show All Users dashboard
     */
    function Users()
    {
        $users = User::orderBy('name', 'asc')->paginate(5);
        $total_user = User::count();
        return view('backend.users.users',
            [
                'users' => $users,
                'total_user' => $total_user
            ]);
    }

    /**
     * Order Function
     */
    function Orders(){
        $orders = Order::latest()->paginate();
        return view('backend.orders.order',
            [
                'orders' => $orders
            ]
        );
    }


}
