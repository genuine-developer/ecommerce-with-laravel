<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Order;
use App\User;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.users.users',
            [
                'users' => $users,
                'total_user' => $total_user,
                'roles' => $roles,
                'permissions' => $permissions
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

    /**
     * PDF Download
     */
    function PDFDownload(){
        $orders = Order::all();
        $pdf = PDF::loadView('backend.exports.pdf', [
            'orders'=> $orders
        ]);
        return $pdf->download('invoice.pdf');

    }


    /**
     * Comments
     */
    function Comments(Request $request){
        
        $comments = new Comment;
        $comments->blog_id = $request->blog_id;
        $comments->user_id = Auth::id();
        $comments->name = $request->name;
        $comments->status = 2;
        $comments->email = $request->email;
        $comments->comment = $request->comment;
        $comments->save();
        
        return back();
    }
}
