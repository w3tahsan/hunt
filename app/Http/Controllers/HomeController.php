<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $sales = Order::where('created_at', '>', Carbon::now()->subDays(7))
            ->groupBy('created_at')
            ->selectRaw('sum(total) as sum, created_at')
            ->get();

        $sales_labels = '';
        $sales_data = '';
        foreach ($sales as $key => $order) {
            if (count($sales) - 1 != $key) {
                $sales_data .= $order->sum . ',';
                $sales_labels .= $order->created_at->format('M-d') . ',';
            } else {
                $sales_data .= $order->sum;
                $sales_labels .= $order-> created_at->format('M-d');
            }
        }
        $after_explode_sales_data = explode(',', $sales_data);
        $after_explode_sales_labels = explode(',', $sales_labels);


        $orders = Order::where('created_at', '>', Carbon::now()->subDays(7))
        ->groupBy('created_at')
        ->selectRaw('count(*) as total, created_at')
        ->get();

        $labels = '';
        $data = '';

        foreach($orders as $key=>$order){
            if(count($orders)-1 != $key){
                $data .= $order->total.',';
                $labels .= $order-> created_at->format('M-d') . ',';
            }else{
                $data .= $order->total;
                $labels .= $order-> created_at->format('M-d');
            }
        }

        $after_explode_data = explode(',', $data);
        $after_explode_labels = explode(',', $labels);

        return view('home', compact('after_explode_data', 'after_explode_labels', 'after_explode_sales_data', 'after_explode_sales_labels'));
    }

    function cat(){
        $categories = file_get_contents('https://api.venos.store/api/v1/categories');
        $categories = json_decode($categories)->data;
        return view('cat', [
            'categories'=> $categories
        ]);
    }
}
