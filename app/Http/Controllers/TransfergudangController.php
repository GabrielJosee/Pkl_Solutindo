<?php

namespace App\Http\Controllers;

use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Models\TransferGudang;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class TransfergudangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tgudang = TransferGudang::where('data_state', '=', 0)->get();
        return view('content/PemindahanGudang/ListPemindahanGudang', ['tgudang' => $tgudang]);
    }

    public function screenTambah()
    {
        if (!Session::get('filter_warehouse_id')) {
            $product_stock = ProductStock::where('data_state', 0)->get();
        } else {
            $warehouse_id = Session::get('filter_warehouse_id');
            $product_id = Session::get('filter_product_id');
            $product_stock = ProductStock::where('data_state', 0)->where('warehouse_id', $warehouse_id)->where('product_id', $product_id)->get();
        }

        if (!Session::get('product_stock_id')) {
            $productStockSelect = [];
        } else {
            $productStockSelect = ProductStock::where('product_stock_id', Session::get('product_stock_id'))->first();
        }

        $product = Product::select('product_name', 'product_id')
            ->where('data_state', 0)
            ->get()
            ->pluck('product_name', 'product_id');
        $gudang = Gudang::select('warehouse_name', 'warehouse_id')
            ->where('data_state', 0)
            ->get()
            ->pluck('warehouse_name', 'warehouse_id');
        return view('content/PemindahanGudang/TambahPemindahanGudang', compact('gudang', 'product', 'product_stock', 'productStockSelect'));
    }

    public function filter(Request $request)
    {
        $warehouse_id = $request->warehouse_id;
        $product_id = $request->product_id;

        Session::put('filter_warehouse_id', $warehouse_id);
        Session::put('filter_product_id', $product_id);

        return redirect('/pemindahan-gudang/tambah');
    }

    public function pindah($product_stock_id)
    {
        Session::forget('filter_warehouse_id');
        Session::forget('filter_product_id');
        Session::put('product_stock_id', $product_stock_id);
        return redirect('/pemindahan-gudang/tambah');
    }
    public function kembali_pg()
    {
        Session::forget('filter_warehouse_id');
        Session::forget('filter_product_id');
        return redirect('/pemindahan-gudang');
    }

    public function kembali_pgtambah()
    {
        Session::forget('product_stock_id');
        return redirect('/pemindahan-gudang/tambah');
    }

    public function tambah(Request $request)
    {
        
        $request->validate([
            'warehouse_id' => 'required',
            'product_id' => 'required',
            'required_amount' => 'required',
            'destination_warehouse' => 'required'
        ]);
        
        $product_stock_id = Session::get('product_stock_id');
        $getProductStock = ProductStock::where('product_stock_id', $product_stock_id)->first();
        $oldProductStock = ProductStock::where('warehouse_id', $request->destination_warehouse)->where('product_id', $getProductStock->product_id)->where('purchase_no', $getProductStock->purchase_no)->first();
        if($getProductStock->stock >= $request->required_amount){


        if ($oldProductStock == null) {
            // membuat product stock baru
            $productStock = [
                'product_id' =>$getProductStock->product_id,
                'warehouse_id' => $request->destination_warehouse,
                'purchase_no' => $getProductStock->purchase_no,
                'stock' => $request->required_amount,
                'expired_time' => $getProductStock->expired_time,
                'expired_date' => $getProductStock->expired_date
            ];
            ProductStock::create($productStock);
            // membuat product stock baru
            
            // mengupdate product stock lama
            $stockProductStock = $getProductStock->stock - $request->required_amount;
            $PS = [
                'stock' => $stockProductStock,
            ];
            ProductStock::where('product_stock_id', $product_stock_id)->update($PS);
            // mengupdate product stock lama
            
            //membuat warehouse transfer
            $warehouse_transfer = [
                'warehouse_id' => $getProductStock->warehouse_id,
                'product_id' => $getProductStock->product_id,
                'required_amount' => $request->required_amount,
                'destination_warehouse' => $request->destination_warehouse
            ];
            TransferGudang::create($warehouse_transfer);
            //membuat warehouse transfer
            
        } else {
            // mengupdate product stock lama
            $stockProductStock = $getProductStock->stock - $request->required_amount;
            $PS = [
                'stock' => $stockProductStock,
            ];
            ProductStock::where('product_stock_id', $product_stock_id)->update($PS);
            // mengupdate product stock lama
            
            // mengupdate product stock baru
            $product_stock_baru = [
                'stock' => $oldProductStock->stock + $request->required_amount
            ];
            ProductStock::where('warehouse_id', $request->destination_warehouse)->where('product_id', $getProductStock->product_id)->where('purchase_no', $getProductStock->purchase_no)->update($product_stock_baru);
            // mengupdate product stock baru
            
            //membuat warehouse transfer
            $warehouse_transfer = [
                'warehouse_id' => $getProductStock->warehouse_id,
                'product_id' => $getProductStock->product_id,
                'required_amount' => $request->required_amount,
                'destination_warehouse' => $request->destination_warehouse
            ];
            TransferGudang::create($warehouse_transfer);
            //membuat warehouse transfer
            
        }
        Session::forget('product_stock_id');
        $message = 'Transfer Gudang Berhasil di tambahkan';
        return redirect()->to('/pemindahan-gudang')->with('message',$message);        
    }
    else{
        return redirect()->to('/pemindahan-gudang/tambah')->with('error','STOCKNYA GA CUKUP MAS');
    }
    }

    public function detail($warehouse_transfer_id)
    {
        $pemindahan_gudang = TransferGudang::where('warehouse_transfer_id', $warehouse_transfer_id)->first();
        return view('content/PemindahanGudang/DetailPemindahanGudang', compact('pemindahan_gudang'));
    }
}