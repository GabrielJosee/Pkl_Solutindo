<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\SalesItem;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Helper\Table;

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
        // START msgExpired
        $date = date("Y-m-d");
        $expired = ProductStock::where('data_state', 0)
            ->where('expired_date', '<=', $date)
            ->where('stock', '>', 0) // Tambahkan kondisi ini untuk menghindari produk dengan stock 0
            ->get();
        // END msgExpired

        //START USER 
        $menus = User::select('system_menu_mapping.*', 'system_menu.*')
            ->join('system_user_group', 'system_user_group.user_group_id', '=', 'system_user.user_group_id')
            ->join('system_menu_mapping', 'system_menu_mapping.user_group_level', '=', 'system_user_group.user_group_level')
            ->join('system_menu', 'system_menu.id_menu', '=', 'system_menu_mapping.id_menu')
            ->where('system_user.user_id', '=', Auth::id())
            ->orderBy('system_menu_mapping.id_menu', 'ASC')
            ->get();
        //END USER 



        //---START PENJUALAN GRAFIK PRODUCT--- 


        $product = SalesItem::select('product_name', \DB::raw("COUNT(sales_item_amount) as count"), \DB::raw('DATE_FORMAT(sales_item.created_at, "%Y-%m") as month'))
            ->join('core_product', 'core_product.product_id', '=', 'sales_item.product_id')
            ->whereRaw('DATE_FORMAT(sales_item.created_at, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m")')
            ->groupBy('product_name', \DB::raw('DATE_FORMAT(sales_item.created_at, "%Y-%m")'))
            ->get();

        // ---END GRAFIK PENJUALAN PRODUCT ---


        //---START GRAFIK PRODUCT TIDAK TERJUAL SEBULAN --- 


        $not_sell = Product::select('core_product.product_id', 'core_product.product_name', \DB::raw('MAX(product_stock) as sum'), \DB::raw('DATE_FORMAT(core_product.created_at, "%Y-%m") as month'))
            ->leftJoin('sales_item', 'core_product.product_id', '=', 'sales_item.product_id')
            ->whereRaw('DATE_FORMAT(core_product.created_at, "%Y-%m") <= DATE_FORMAT(CURDATE(), "%Y-%m")')
            ->whereRaw('(DATE_FORMAT(sales_item.created_at, "%Y-%m") != DATE_FORMAT(CURDATE(), "%Y-%m") OR sales_item.sales_item_id IS NULL)')
            ->where('product_stock', '>', 0)
            ->groupBy('core_product.product_id', 'core_product.product_name', 'month')
            ->get();
        // dd($not_sell);




        //---END GRAFIK PRODUCT TIDAK TERJUAL SEBULAN --- 


        //---START GRAFIK TOTAL PRICE--- 
        $sales_item_total_price = SalesItem::select(
            DB::raw('CAST(sum(sales_item_total_price)as int) as sales_item_total_price'),
            DB::raw("DATE_FORMAT(created_at,'%Y-%M')as tanggal")
        )
            ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
            ->groupBy(DB::raw("tanggal"))
            ->orderBy('created_at', 'ASC')
            ->pluck('sales_item_total_price');

        $tahun = SalesItem::select(
            DB::raw("DATE_FORMAT(created_at,'%M')as tanggal")
        )
            ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
            ->groupBy('tanggal')
            ->orderBy('created_at', 'ASC')
            ->pluck('tanggal');

        return view('home', compact('menus', 'product', 'sales_item_total_price', 'tahun', 'not_sell', 'expired'));
        //---END GRAFIK TOTAL PRICE---  
    }
}