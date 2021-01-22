<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryImport;
use App\Http\Controllers\Controller;

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
        $today = Order::wheredate('created_at', Carbon::now())->count();
        $sevenDays = Order::where('created_at', Carbon::now()->subDays(7))->count();
        $yesterday = Order::where('created_at', Carbon::yesterday())->count();
        return view('backend.dashboard',
            [
                'today' => $today,
                'sevenDays' => $sevenDays,
                'yesterday' => $yesterday,

            ]
        );
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

    /**
     * Excel Download
     */
    function ExcelDownload(){
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    /**
     * Category Import Excel
     */
    public function CategoryImport(Request $request) 
    {
        Excel::import(new CategoryImport, $request->file('excel'));
        
        return redirect('/')->with('success', 'All good!');
    }

    /**
     * Selceted date
     */
    function SelectedDateExcelDownload(Request $request){
        $from = $request->start;
        $to = $request->end;

        return Excel::download(new OrderExport($from, $to), 'orders.xlsx');
    }

}
