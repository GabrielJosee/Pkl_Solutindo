<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $ProductCategory = ProductCategory::where('data_state','=',0)->get();
        return view('content/ProductCategory/ListProductCategory', compact('ProductCategory'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'product_category_code' => 'required',
            'product_category_name' => 'required'
        ]);
    
        $ProductCategory = [
            'product_category_code' => $request->product_category_code,
            'product_category_name' => $request->product_category_name,
        ];
        ProductCategory::create($ProductCategory);
        $message = 'Product Category Berhasil di tambahkan';
        return redirect()->to('/productcategory')->with('message',$message);
    }
    
    public function edit($product_category_id)
    {
        $ProductCategory = ProductCategory::where('product_category_id', $product_category_id)->first();
        return view('content/ProductCategory/EditProductCategory', ['ProductCategory' => $ProductCategory]);
    }
    
    public function update(Request $request, $product_category_id)
    {
        $request->validate([
            'product_category_code' => 'required',
            'product_category_name' => 'required'
        ]);
        
        $ProductCategory = [
            'product_category_code' => $request->product_category_code,
            'product_category_name' => $request->product_category_name
        ];
        ProductCategory::where('product_category_id', $product_category_id)->update($ProductCategory);
        return redirect()->to('/productcategory');
    }
        
    public function detail($product_category_id)
    {
        $ProductCategory = ProductCategory::where('product_category_id',$product_category_id)->first();
        return view('content/ProductCategory/DetailProductCategory', compact('ProductCategory'));
    }

    public function delete($product_category_id)
    {
        $ProductCategory = ['data_state' => 1];
        ProductCategory::where('product_category_id', $product_category_id)->update($ProductCategory);
        return redirect()->to('/productcategory');
    }

}
