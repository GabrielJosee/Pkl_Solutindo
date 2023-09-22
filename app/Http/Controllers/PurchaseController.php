<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Purchase;
use App\Models\PurchaseParent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use PDF;

class PurchaseController extends Controller
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
        $purchase = Purchase::where('data_state', '=', 0)->get();
        return view('content/Purchase/ListPurchase', ['purchase' => $purchase]);
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
        if (!Session::get('listPurchase')) {
            $list = [];
        } else {
            $list = Session::get('listPurchase');
        }
        return view('content/Purchase/TambahPurchase', compact('product', 'list', 'gudang'));
    }

    public function sessionList(Request $request)
    {

        $request->validate([
            'supplier_name' => 'required',
            'warehouse_id' => 'required',
            'product_id' => 'required',
            'purchase_amount' => 'required',
            'purchase_price' => 'required',
        ]);

        $gudang = Gudang::where('warehouse_id', $request->warehouse_id)->first();
        $product = Product::where('product_id', $request->product_id)->first();
        $discount = $request->purchase_discount / 100;
        $purchase = array(
            'supplier_name' => $request->supplier_name,
            'warehouse_id' => $request->warehouse_id,
            'product_id' => $request->product_id,
            'purchase_amount' => $request->purchase_amount,
            'purchase_price' => $request->purchase_price,
            'purchase_discount' => $discount,
            'warehouse_name' => $gudang['warehouse_name'],
            'product_name' => $product['product_name'],
        );

        $lastdataPurchase = Session::get('listPurchase');
        if ($lastdataPurchase !== null) {
            array_push($lastdataPurchase, $purchase);
            Session::put('listPurchase', $lastdataPurchase);
        } else {
            $lastdataPurchase = [];
            array_push($lastdataPurchase, $purchase);
            Session::push('listPurchase', $purchase);
        }

        return redirect('/purchase/tambah');
    }

    public function deleteList($index)
    {
        $list = Session::get('listPurchase');
        unset($list[$index]);
        Session::put('listPurchase', $list);
        return redirect()->to('/purchase/tambah');
    }

    public function tambah(Request $request)
    {
        if (!Session::get('listPurchase')) {
            $list = [];
        } else {
            $list = Session::get('listPurchase');
        }

        if (!count($list) == 0) {
            foreach ($list as $index => $value) {
                if (!is_null($value)) {
                    $count = $index + 1;
                }
            }

            if ($request->hiddenDiskonPersen != null && $request->hiddenPPNPersen != null) {
                $purchase_parent = [
                    'subtotal_purchase' => $request->subtotal,
                    'total_purchase' => $request->hiddenTotal,
                    'purchase_discount_persentage' => $request->hiddenDiskonPersen,
                    'purchase_discount_value' => $request->hiddenDiskonValue,
                    'purchase_ppn_percentage' => $request->hiddenPPNPersen,
                    'purchase_ppn_value' => $request->hiddenPPNValue,
                ];

            } elseif ($request->hiddenDiskonPersen != null) {
                $purchase_parent = [
                    'subtotal_purchase' => $request->subtotal,
                    'total_purchase' => $request->hiddenTotal,
                    'purchase_discount_persentage' => $request->hiddenDiskonPersen,
                    'purchase_discount_value' => $request->hiddenDiskonValue,
                ];
            } elseif ($request->hiddenPPNPersen != null) {
                $purchase_parent = [
                    'subtotal_purchase' => $request->subtotal,
                    'total_purchase' => $request->hiddenTotal,
                    'purchase_ppn_percentage' => $request->hiddenPPNPersen,
                    'purchase_ppn_value' => $request->hiddenPPNValue,
                ];
            } else {
                $purchase_parent = [
                    'subtotal_purchase' => $request->subtotal,
                    'total_purchase' => $request->hiddenTotal,
                ];
            }
            PurchaseParent::create($purchase_parent);
            $getPurchaseParent = PurchaseParent::where('data_state', 0)->where('total_purchase', $request->hiddenTotal)->orderBy('purchase_parent_id', 'desc')->first();
            
            for ($i = 0; $i < $count; $i++) {
                if (isset($list[$i])) {
                    $purchase = [
                        'purchase_parent_id' => $getPurchaseParent['purchase_parent_id'],
                        'supplier_name' => $list[$i]['supplier_name'],
                        'product_id' => $list[$i]['product_id'],
                        'purchase_amount' => $list[$i]['purchase_amount'],
                        'purchase_price' => $list[$i]['purchase_price'],
                        'purchase_discount' => $list[$i]['purchase_discount'],
                    ];
                    Purchase::create($purchase);

                    $expired_date = Carbon::now();
                    $getProduct = Product::where('product_id', $list[$i]['product_id'])->first();
                    $expired_date->addDays($getProduct->expired_time);
                    $getPurchase = Purchase::where('data_state', 0)->where('supplier_name', $list[$i]['supplier_name'])->orderBy('purchase_id', 'desc')->first();
                    $purchase_no = $getPurchase->purchase_no;

                    $productStock = [
                        'product_id' => $list[$i]['product_id'],
                        'warehouse_id' => $list[$i]['warehouse_id'],
                        'purchase_no' => $purchase_no,
                        'stock' => $list[$i]['purchase_amount'],
                        'expired_time' => $getProduct->expired_time,
                        'expired_date' => $expired_date
                    ];
                    ProductStock::create($productStock);

                    $getProductStock = ProductStock::where('data_state', 0)->where('product_id', $list[$i]['product_id'])->get();
                    $tambahStock = [
                        'product_stock' => $getProductStock->sum('stock')
                    ];
                    Product::where('product_id', $list[$i]['product_id'])->update($tambahStock);

                }
            }

        } else {
            return redirect()->to('/purchase/tambah');
        }

        Session::forget('listPurchase');
        $message = 'Pembelian Berhasil di tambahkan';
        return redirect()->to('/purchase')->with('message',$message);
    }

    public function CetakPDF()
    {
        $filename = 'Pembelian.pdf';
        $purchase = Purchase::where('data_state', '=', 0)->get();
        $html = view()->make('content/Purchase/CetakPurchase', ['purchase' => $purchase])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Pembelian');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }
}