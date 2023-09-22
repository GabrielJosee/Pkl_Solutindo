<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\PengeluaranGudang;
use App\Http\Controllers\Controller;


class PengeluaranGudangController extends Controller
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
        $pengeluaran_gudang = PengeluaranGudang::where('data_state', '=', 0)->get();
        return view('content/PengeluaranGudang/ListPengeluaranGudang', compact('pengeluaran_gudang'));
    }

    public function screenTambah()
    {
        $product = Product::select('product_name', 'product_id')
            ->where('data_state', 0)
            ->get()
            ->pluck('product_name', 'product_id');
        $gudang = Gudang::select('warehouse_name', 'warehouse_id')
            ->where('data_state', 0)
            ->get()
            ->pluck('warehouse_name', 'warehouse_id');
        return view('content/PengeluaranGudang/TambahPengeluaranGudang', compact('gudang', 'product'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'warehouse_id' => 'required',
            'product_id' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required'
        ]);
        $totalStockWarehouse = ProductStock::where('data_state', 0)->where('warehouse_id', $request->warehouse_id)->where('product_id', $request->product_id)->sum('stock');
        if ($request->jumlah <= $totalStockWarehouse) {

            // CORE PRODUCT
            $product = Product::where('data_state', 0)->where('product_id', $request->product_id)->first();
            $stock = $product->product_stock - $request->jumlah;
            $product = [
                'product_stock' => $stock
            ];
            Product::where('data_state', 0)->where('product_id', $request->product_id)->update($product);
            // CORE PRODUCT

            // PRODUCT STOCK
            $sisa = $request->jumlah;
            while ($sisa > 0) {
                $getProductStock = ProductStock::where('data_state', 0)
                    ->where('warehouse_id', $request->warehouse_id)
                    ->where('product_id', $request->product_id)
                    ->where('stock', '<>', 0)
                    ->orderBy('expired_date', 'asc')
                    ->orderBy('product_stock_id', 'asc')
                    ->first();
                $stockProductStock = $getProductStock->stock - $sisa;
                if ($stockProductStock < 0) {
                    $sisa = abs($stockProductStock);
                    $stockProductStock = 0;
                } else {
                    $sisa = 0;
                }
                $PS = [
                    'stock' => $stockProductStock,
                ];
                ProductStock::where('product_stock_id', $getProductStock->product_stock_id)->update($PS);
            }
            // PRODUCT STOCK

            // PENGELUARAN GUDANG
            $pengeluaran_gudang = [
                'warehouse_id' => $request->warehouse_id,
                'product_id' => $request->product_id,
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
            ];
            PengeluaranGudang::create($pengeluaran_gudang);
            // PENGELUARAN GUDANG
            $message = 'List Pengeluaran Gudang Berhasil di tambahkan';
            return redirect()->to('/pengeluaran-gudang')->with('message',$message);
            
        } else {
            // msg

            // msg
            return redirect()->to('/pengeluaran-gudang/tambah');
        }

    }

    public function detail($pengeluaran_gudang_id)
    {
        $pengeluaran_gudang = PengeluaranGudang::where('pengeluaran_gudang_id', $pengeluaran_gudang_id)->first();
        return view('content/PengeluaranGudang/DetailPengeluaranGudang', compact('pengeluaran_gudang'));
    }

}