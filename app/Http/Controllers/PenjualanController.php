<?php

namespace App\Http\Controllers;


use App\Models\Gudang;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\Customer;
use App\Models\SalesParent;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use PDF;

class PenjualanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $sales = Sales::get();
        return view('content/Penjualan/ListPenjualan', compact('sales'));
    }

    public function screenTambah()
    {
        $Customer = Customer::get();
        $Product = Product::get();
        $Warehouse = Gudang::get();
        $voucher = Vouchers::where('data_state', '=', 0)->get();
        $date = date("Y-m-d");
        $voucher = $voucher->where('end_date', '>=', $date);
        if (!Session::get('listSales')) {
            $list = [];
        } else {
            $list = Session::get('listSales');
        }

        if (Session::get('salesProductID')) {
            $product_id = Session::get('salesProductID');
            $productSelected = Product::where('data_state', 0)->where('product_id', $product_id)->first();
            $product_stock = $productSelected['product_stock'];
        } else {
            $product_stock = null;
            $product_id = null;
            $productSelected = null;
        }

        if (!Session::get('flash')) {
            $flash = null;
            $warehouse_id = null;
            $customer_id = null;
        } else {
            $flash = Session::get('flash');
            $warehouse_id = $flash['warehouse_id'];
            $customer_id = $flash['customer_id'];
        }
        return view('content/Penjualan/TambahPenjualan', compact('Customer', 'Product', 'list', 'Warehouse', 'product_id', 'productSelected', 'flash', 'warehouse_id', 'customer_id', 'product_stock','voucher'));

    }

    public function sessionList(Request $request)
    {
        if ($request->id == 0) {

            Session::put('salesProductID', $request->product_id);
            $flash = [
                'customer_id' => $request->customer_id,
                'warehouse_id' => $request->warehouse_id,
                'product_amount' => $request->product_amount,
                'sales_remark' => $request->sales_remark
            ];
            Session::put('flash', $flash);
            return redirect('/sales/tambah');
        } else {
            $customer = Customer::where('customer_id', $request->customer_id)->first();
            $gudang = Gudang::where('warehouse_id', $request->warehouse_id)->first();
            $product = Product::where('product_id', $request->product_id)->first();
            $request->validate([
                'customer_id' => 'required',
                'product_id' => 'required',
                'product_price' => 'required',
                'warehouse_id' => 'required',
                'product_amount' => 'required',
                'sales_remark' => 'required',
            ]);
            $discount = $request->sales_discount / 100;
            $data_penjualan = array(
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
                'product_price' => $product->product_price * $request->product_amount,
                'warehouse_id' => $request->warehouse_id,
                'product_amount' => $request->product_amount,
                'sales_remark' => $request->sales_remark,
                'customer_name' => $customer['customer_name'],
                'warehouse_name' => $gudang['warehouse_name'],
                'product_name' => $product['product_name'],
                'sales_discount' => $discount,
                'product_price_pure' => $product['product_price']
            );

            $lastdatapenjualan = Session::get('listSales');
            if ($lastdatapenjualan !== null) {
                array_push($lastdatapenjualan, $data_penjualan);
                Session::put('listSales', $lastdatapenjualan);
            } else {
                $lastdatapenjualan = [];
                array_push($lastdatapenjualan, $data_penjualan);
                Session::push('listSales', $data_penjualan);
            }
            Session::forget('flash');
            Session::forget('salesProductID');
            return redirect('/sales/tambah');
        }
    }

    public function deleteList($index)
    {
        $list = Session::get('listSales');
        unset($list[$index]);
        Session::put('listSales', $list);
        return redirect()->to('/sales/tambah');
    }


    public function tambah(Request $request)
    {
        if (!Session::get('listSales')) {
            $list = [];
        } else {
            $list = Session::get('listSales');
        }

        if (!count($list) == 0) {
            foreach ($list as $index => $value) {
                if (!is_null($value)) {
                    $count = $index + 1;
                }
            }

            if ($request->hiddenDiskonPersen != null && $request->hiddenPPNPersen != null) {
                $total = $request->hiddenTotal;
                $sales_parent = [
                    'subtotal_sales' => $request->subtotal,
                    'total_sales' => $request->hiddenTotal,
                    'sales_discount_persentage' => $request->hiddenDiskonPersen,
                    'sales_discount_value' => $request->hiddenDiskonValue,
                    'sales_ppn_percentage' => $request->hiddenPPNPersen,
                    'sales_ppn_value' => $request->hiddenPPNValue,
                ];
                
            } elseif ($request->hiddenDiskonPersen != null) {
                $total = $request->hiddenTotal;
                $sales_parent = [
                    'subtotal_sales' => $request->subtotal,
                    'total_sales' => $request->hiddenTotal,
                    'sales_discount_persentage' => $request->hiddenDiskonPersen,
                    'sales_discount_value' => $request->hiddenDiskonValue,
                ];
            } elseif ($request->hiddenPPNPersen != null) {
                $total = $request->hiddenTotal;
                $sales_parent = [
                    'subtotal_sales' => $request->subtotal,
                    'total_sales' => $request->hiddenTotal,
                    'sales_ppn_percentage' => $request->hiddenPPNPersen,
                    'sales_ppn_value' => $request->hiddenPPNValue,
                ];
            } else {
                $total = $request->subtotal;
                $sales_parent = [
                    'subtotal_sales' => $request->subtotal,
                    'total_sales' => $request->subtotal,
                ];
            }
            SalesParent::create($sales_parent);
            $getSalesParent = SalesParent::where('data_state', 0)->where('total_sales', $total)->orderBy('sales_parent_id', 'desc')->first();

            for ($i = 0; $i < $count; $i++) {
                if (isset($list[$i])) {
                    $totalStockWarehouse = ProductStock::where('data_state', 0)->where('warehouse_id', $list[$i]['warehouse_id'])->where('product_id', $list[$i]['product_id'])->sum('stock');
                    if ($list[$i]['product_amount'] <= $totalStockWarehouse) {
                        $date = date("Y-m-d");

                        $sales = [
                            'sales_parent_id' => $getSalesParent['sales_parent_id'],
                            'customer_id' => $list[$i]['customer_id'],
                            'sales_date' => $date,
                            'sales_remark' => $list[$i]['sales_remark'],
                            'vouchers_id' => $request->hiddenVoucherID,
                            'vouchers_nominal' => $request->hiddenVoucherNominal,
                            
                        ];
                        Sales::create($sales);

                        $getSales = Sales::where('data_state', 0)->where('sales_remark', $list[$i]['sales_remark'])->orderBy('sales_id', 'desc')->first();
                        $getProduct = Product::where('data_state', 0)->where('product_id', $list[$i]['product_id'])->first();
                        $getWarehouse = Gudang::where('data_state', 0)->where('warehouse_id', $list[$i]['warehouse_id'])->first();
                        $sales_id = $getSales->sales_id;
                        $warehouse_id = $getWarehouse->warehouse_id;
                        $product_price = $getProduct->product_price;
                        $sales_item_total_price = $product_price * $list[$i]['product_amount'];
                        

                        $sales_item = [
                            'sales_id' => $sales_id,
                            'product_id' => $list[$i]['product_id'],
                            'sales_item_price' => $product_price,
                            'warehouse_id' => $warehouse_id,
                            'sales_item_amount' => $list[$i]['product_amount'],
                            'sales_item_total_price' => $sales_item_total_price,
                            'sales_discount' => $list[$i]['sales_discount']
                        ];

                        $stock = $getProduct->product_stock - $list[$i]['product_amount'];
                        $product = [
                            'product_stock' => $stock
                        ];

                        Product::where('data_state', 0)->where('product_id', $list[$i]['product_id'])->update($product);
                        SalesItem::create($sales_item);

                        // PRODUCT STOCK
                        $sisa = $list[$i]['product_amount'];
                        while ($sisa > 0) {
                            $getProductStock = ProductStock::where('data_state', 0)
                                ->where('warehouse_id', $list[$i]['warehouse_id'])
                                ->where('product_id', $list[$i]['product_id'])
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

                    } else {
                        return redirect()->to('/sales/tambah')->with('error', 'STOCKNYA GA CUKUP MAS');
                    }
                }
            }
        } else {
            return redirect()->to('/sales/tambah');
        }

        Session::forget('listSales');
        Session::forget('flash');
        Session::forget('salesProductID');
        $message = 'Penjualan Berhasil di tambahkan';
        return redirect()->to('/sales')->with('message',$message);
    }

    public function detail($sales_id)
    {
        $sales = Sales::where('sales_id', $sales_id)->first();
        $sales_item = SalesItem::where('sales_id', $sales_id)->first();
        return view('content/Penjualan/DetailPenjualan', compact('sales', 'sales_item'));
    }

    public function invoice($sales_id)
    {
        $filename = 'Invoice-' . $sales_id . '.pdf';
        $sales = Sales::where('sales_id', $sales_id)->first();
        $sales_item = SalesItem::where('sales_id', $sales_id)->first();
        $html = view()->make('content/Penjualan/InvoicePenjualan', ['sales' => $sales, 'sales_item' => $sales_item])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Invoice-' . $sales_id);
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }
    public function getProductPrice(Request $request)
    {
        $product = Product::find($request->product_id);
        return response()->json($product->product_price);
    }
}