<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\StockAdjustments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockAdjustmentsController extends Controller
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
        $stock_adjustments = StockAdjustments::where('data_state', '=', 0)->get();
        return view('content/StockAdjustments/ListStockAdjustments', ['stock_adjustments' => $stock_adjustments]);
    }

    public function screenTambah()
    {
        $product = Product::where('data_state', 0)->get();
        if (!Session::get('product_id')) {
            $product_id = null;
            return view('content/StockAdjustments/TambahStockAdjustments', ['product' => $product, 'product_id' => $product_id]);
        } else {
            $product_id = Session::get('product_id');
            $product_selected = Product::where('data_state', 0)->where('product_id', $product_id)->first();
            return view('content/StockAdjustments/TambahStockAdjustments', ['product' => $product, 'product_selected' => $product_selected, 'product_id' => $product_id]);
        }

    }

    public function tambah(Request $request)
    {
        if (!$request->product_id == null && !$request->initial_amount == null && !$request->adjustment_amount == null) {
            $product = Product::where('product_id', $request->product_id)->where('data_state', 0)->first();
            if ($request->initial_amount > $request->adjustment_amount) {
                $selisih = $request->initial_amount - $request->adjustment_amount;
            } elseif ($request->initial_amount < $request->adjustment_amount) {
                $selisih = $request->adjustment_amount - $request->initial_amount;
            }

            $stockProduct = [
                'product_stock' => $request->adjustment_amount
            ];
            $stock_adjustments = [
                'product_id' => $request->product_id,
                'initial_amount' => $product->product_stock,
                'adjustment_amount' => $request->adjustment_amount,
                'difference' => $selisih,
            ];
    
            Product::where('product_id', $request->product_id)->update($stockProduct);
            StockAdjustments::create($stock_adjustments);
            Session::forget('product_id');
            $message = 'Stock Adjustment Berhasil di tambahkan';
            return redirect()->to('/stock-adjustments')->with('message',$message);
        } else {
            Session::put('product_id', $request->product_id);
            return redirect('/stock-adjustments/tambah');
        }
    }
}