<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Product;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
Use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DB;
use Symfony\Component\Routing\Route;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\Support\Renderable
     * 
     */

     public function __construct()
     {
         $this->middleware('auth');
     }
 

    public function index()
    {
        
        $product = Product::where('data_state','=',0)->get();
        return view('content/Product/ListProduct', compact('product'));
    }

    public function CetakProduct()
    {
        $filename = 'Product.pdf';
        $product = Product::where('data_state','=',0)->get();
        $html = view()->make('content/Product/CetakProduct', ['product' => $product])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Product');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakProductExcel() 
    {
        $Product = Product::where('data_state', '=', 0)->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Kategori Produk')
            ->setCellValue('C1', 'Nama Produk')
            ->setCellValue('D1', 'Harga Produk')
            ->setCellValue('E1', 'Deskripsi Produk');
        $cell = 2;
        foreach ($Product as $prod) {
            $activeWorksheet
                ->setCellValue('A' . $cell, $prod['product_id'])
                ->setCellValue('B' . $cell, $prod->productCategory['product_category_name'])
                ->setCellValue('C' . $cell, $prod['product_name'])
                ->setCellValue('D' . $cell, $prod['product_price'])
                ->setCellValue('E' . $cell, $prod['product_description']);
            $cell++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Customer.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();
        $ProductCategory = ProductCategory::get();
        return view('content/Product/EditProduct', ['product' => $product, 'ProductCategory' => $ProductCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        $request->validate([
            'product_category_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'expired_time' => 'required',
        ]);
        $product = [
            'product_category_id' => $request->product_category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'expired_time' => $request->expired_time,
        ];
        Product::where('product_id', $product_id)->update($product);
        return redirect()->to('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($product_id)
    {
        $product = ['data_state' => 1];
        Product::where('product_id', $product_id)->update($product);
        return redirect()->to('/product');
    }

    public function detail($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();
        return view('content/Product/Detailproduct', ['product' => $product]);
    }


    public function screenTambah()
    {
        $ProductCategory = ProductCategory::get();
        return view('content/Product/TambahProduct', ['ProductCategory' => $ProductCategory]);
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'product_category_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'expired_time' => 'required',
            'product_description' => 'required',
        ]);

        $product = [
            'product_category_id' => $request->product_category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'expired_time' => $request->expired_time,
            'product_description' => $request->product_description, 
        ];
        Product::create($product);
        $message = 'Produk Berhasil di tambahkan';
        return redirect()->to('/product')->with('message',$message);
    }

    public function pieGrafik()
    {
       $product = Product::select('product_name',\DB::raw("COUNT(product_id) as count"))
       ->GroupBy('product_name')
       ->get();

    //    dd($product);
       return view('content/Product/GrafikProduct',compact('product')); 
    }
}