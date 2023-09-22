<?php

use App\Http\Controllers\ExpiredController;
use App\Http\Controllers\LaporanPembelianPerPeriodeController;
use App\Http\Controllers\LaporanPembelianPerProdukController;
use App\Http\Controllers\LaporanPenjualanPenggunaanVoucherController;
use App\Http\Controllers\LaporanPenjualanPerProdukController;
use App\Http\Controllers\PengeluaranGudangController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockAdjustmentsController;
use App\Http\Controllers\TransfergudangController;
use App\Http\Controllers\VouchersController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\SystemUserGroupController;
use App\Http\Controllers\LaporanPenjualanPerPeriodeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//*SYSTEMUSER
Route::get('/system-user', [SystemUserController::class, 'index'])->name('system-user');
Route::get('/system-user/add', [SystemUserController::class, 'addSystemUser'])->name('add-system-user');
Route::post('/system-user/process-add-system-user', [SystemUserController::class, 'processAddSystemUser'])->name('process-add-system-user');
Route::get('/system-user/edit/{user_id}', [SystemUserController::class, 'editSystemUser'])->name('edit-system-user');
Route::post('/system-user/process-edit-system-user', [SystemUserController::class, 'processEditSystemUser'])->name('process-edit-system-user');
Route::get('/system-user/delete-system-user/{user_id}', [SystemUserController::class, 'deleteSystemUser'])->name('delete-system-user');
Route::get('/system-user/change-password/{user_id}  ', [SystemUserController::class, 'changePassword'])->name('change-password');
Route::post('/system-user/process-change-password', [SystemUserController::class, 'processChangePassword'])->name('process-change-password');
Route::get('/system-user/detail-seller/{user_id}', [SystemUserController::class, 'detailSystemUserSeller'])->name('detail-system-user-seller');
Route::get('/system-user/detail-buyer/{user_id}', [SystemUserController::class, 'detailSystemUserBuyer'])->name('detail-system-user-buyer');
Route::post('/system-user/filter', [SystemUserController::class, 'filter'])->name('filter-system-user');
Route::get('/system-user/blokir/{user_id}', [SystemUserController::class, 'blokirSystemUser'])->name('blokir-system-user');
Route::get('/system-user/unblokir/{user_id}', [SystemUserController::class, 'unblokirSystemUser'])->name('unblokir-system-user');


//*SYSTEMUSERGROUP
Route::get('/system-user-group', [SystemUserGroupController::class, 'index'])->name('system-user-group');
Route::get('/system-user-group/add', [SystemUserGroupController::class, 'addSystemUserGroup'])->name('add-system-user-group');
Route::post('/system-user-group/process-add-system-user-group', [SystemUserGroupController::class, 'processAddSystemUserGroup'])->name('process-add-system-user-group');
Route::get('/system-user-group/edit/{user_id}', [SystemUserGroupController::class, 'editSystemUserGroup'])->name('edit-system-user-group');
Route::post('/system-user-group/process-edit-system-user-group', [SystemUserGroupController::class, 'processEditSystemUserGroup'])->name('process-edit-system-user-group');
Route::get('/system-user-group/delete-system-user-group/{user_id}', [SystemUserGroupController::class, 'deleteSystemUserGroup'])->name('delete-system-user-group');

// <<<----- START COSTUMER ----->>> // 
Route::get('/customer', [CustomerController::class, 'index'])->name('Customer');
// Route::view('/customer','content/SystemCustomer/ListCustomer');
Route::view('/customer/tambah', 'content/SystemCustomer/TambahCustomer');
Route::get('/customer/tambah/process', [CustomerController::class, 'tambah']);
Route::get('/customer/detail/{customer_id}', [CustomerController::class, 'detail']);
Route::get('/customer/edit/{customer_id}', [CustomerController::class, 'edit']);
Route::get('/customer/edit/process/{customer_id}', [CustomerController::class, 'update']);
Route::get('/customer/hapus/{customer_id}', [CustomerController::class, 'delete']);
Route::get('/cetak-customer', [CustomerController::class, 'CetakCustomer']);
Route::get('/cetak-customer-excel', [CustomerController::class, 'CetakCustomerExcel']);
// <<<----- END COSTUMER ----->>>

// <<<----- START PRODUCT ----->>> 
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/tambah',[ProductController::class, 'screenTambah']);
Route::get('/product/tambah/process',[ProductController::class,'tambah']);
Route::get('/product/detail/{product_id}', [ProductController::class, 'detail']);
Route::get('/product/edit/{product_id}', [ProductController::class, 'edit']);
Route::get('/product/edit/process/{product_id}', [ProductController::class, 'update']);
Route::get('/product/hapus/{product_id}', [ProductController::class, 'delete']);
Route::get('/cetak-product', [ProductController::class, 'CetakProduct']);
Route::get('/cetak-product-excel', [ProductController::class, 'CetakProductExcel']);


// <<<----- START PRODUCT CATEGORY ----->>>
Route::get('/productcategory', [ProductCategoryController::class, 'index'])->name('product-category');
Route::view('/productcategory/tambah', 'content/ProductCategory/TambahProductCategory');
Route::get('/productcategory/tambah/process', [ProductCategoryController::class, 'tambah'])->name('add-ProductCategory');
Route::get('/productcategory/edit/{product_category_id}', [ProductCategoryController::class, 'edit']);
Route::get('/productcategory/edit/process/{product_category_id}', [ProductCategoryController::class, 'update']);
Route::get('/productcategory/detail/{product_category_id}', [ProductCategoryController::class, 'detail']);
Route::get('/productcategory/hapus/{product_category_id}', [ProductCategoryController::class, 'delete']);
// <<<----- END PRODUCT CATEGORY ----->>>

// START PENJUALAN
Route::get('/sales', [PenjualanController::class, 'index'])->name('sales');
Route::get('/sales/tambah',[PenjualanController::class,'screenTambah']);
Route::get('/sales/tambah/session',[PenjualanController::class, 'session']);
Route::get('/sales/tambah/list',[PenjualanController::class, 'sessionList'])->name('sessionListSales');
Route::get('/sales/tambah/hapus/{index}',[PenjualanController::class, 'deleteList']);
Route::get('/sales/tambah/process',[PenjualanController::class,'tambah']);
Route::get('/sales/detail/{sales_id}',[PenjualanController::class,'detail']);   
Route::get('/sales/invoice/{sales_id}',[PenjualanController::class,'invoice']);

// END PENJUALAN


// START LAPORAN PENJUALAN
Route::get('/laporan-penjualan-per-periode', [LaporanPenjualanPerPeriodeController::class, 'index'])->name('laporan-penjualan-per-periode');;
Route::post('/laporan-penjualan-per-periode/filter', [LaporanPenjualanPerPeriodeController::class, 'filter'])->name('filter-laporan-penjualan-per-periode');
Route::get('/laporan-penjualan-per-periode/cetak-pdf', [LaporanPenjualanPerPeriodeController::class, 'CetakPDF']);
Route::get('/laporan-penjualan-per-periode/cetak-excel', [LaporanPenjualanPerPeriodeController::class, 'CetakExcel']);

Route::get('/laporan-penjualan-penggunaan-voucher', [LaporanPenjualanPenggunaanVoucherController::class, 'index'])->name('laporan-penjualan-penggunaan-voucher');
Route::post('/laporan-penjualan-penggunaan-voucher/filter', [LaporanPenjualanPenggunaanVoucherController::class, 'filter'])->name('filter-laporan-penjualan-penggunaan-voucher');

Route::get('/laporan-penjualan-per-produk', [LaporanPenjualanPerProdukController::class, 'index'])->name('laporan-penjualan-per-produk');;
Route::post('/laporan-penjualan-per-produk/filter', [LaporanPenjualanPerProdukController::class, 'filter'])->name('filter-laporan-penjualan-per-produk');
Route::get('/laporan-penjualan-per-produk/cetak-pdf', [LaporanPenjualanPerProdukController::class, 'CetakPDF']);
Route::get('/laporan-penjualan-per-produk/cetak-excel', [LaporanPenjualanPerProdukController::class, 'CetakExcel']);
// END LAPORAN PENJUALAN

// START LAPORAN PEMBELIAN
Route::get('/laporan-pembelian-per-periode', [LaporanPembelianPerPeriodeController::class, 'index'])->name('laporan-pembelian-per-periode');;
Route::post('/laporan-pembelian-per-periode/filter', [LaporanPembelianPerPeriodeController::class, 'filter'])->name('filter-laporan-pembelian-per-periode');
Route::get('/laporan-pembelian-per-periode/cetak-pdf', [LaporanPembelianPerPeriodeController::class, 'CetakPDF']);
Route::get('/laporan-pembelian-per-periode/cetak-excel', [LaporanPembelianPerPeriodeController::class, 'CetakExcel']);

Route::get('/laporan-pembelian-per-produk', [LaporanPembelianPerProdukController::class, 'index'])->name('laporan-pembelian-per-produk');;
Route::post('/laporan-pembelian-per-produk/filter', [LaporanPembelianPerProdukController::class, 'filter'])->name('filter-laporan-pembelian-per-produk');
Route::get('/laporan-pembelian-per-produk/cetak-pdf', [LaporanPembelianPerProdukController::class, 'CetakPDF']);
Route::get('/laporan-pembelian-per-produk/cetak-excel', [LaporanPembelianPerProdukController::class, 'CetakExcel']);
// END LAPORAN PEMBELIAN


// START PEMBELIAN
Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');
Route::get('/purchase/tambah',[PurchaseController::class, 'screenTambah']);
Route::get('/purchase/tambah/list',[PurchaseController::class, 'sessionList'])->name('sessionListPurchase');
Route::get('/purchase/tambah/hapus/{index}',[PurchaseController::class, 'deleteList']);
Route::get('/purchase/tambah/process',[PurchaseController::class, 'tambah']);
Route::get('/purchase/cetak-pdf', [PurchaseController::class, 'CetakPDF']);
// END PEMBELIAN


// START PENYESUAIAN STOCK 
Route::get('/stock-adjustments', [StockAdjustmentsController::class, 'index'])->name('stock-adjustments');
Route::get('/stock-adjustments/tambah',[StockAdjustmentsController::class, 'screenTambah']);
Route::get('/stock-adjustments/tambah/process',[StockAdjustmentsController::class, 'tambah']);
// END PENYESUAIAN STOCK

Route::get('/get-product-price', 'SalesController@getProductPrice')->name('getProductPrice');


// START GUDANG
Route::get('/warehouse', [WarehouseController::class, 'index'])->name('warehouse');
Route::get('/warehouse/tambah',[WarehouseController::class, 'screenTambah']);
Route::get('/warehouse/tambah/process',[WarehouseController::class, 'tambah']);
Route::get('/warehouse/edit/{warehouse_id}',[WarehouseController::class, 'edit']);
Route::get('/warehouse/edit/process/{warehouse_id}',[WarehouseController::class, 'update']);
Route::get('/warehouse/hapus/{warehouse_id}', [WarehouseController::class, 'delete']);
Route::get('/warehouse/detail/{warehouse_id}', [WarehouseController::class, 'detail']);
// END GUDANG


// START PENGELUARAN GUDANG
Route::get('/pengeluaran-gudang', [PengeluaranGudangController::class, 'index'])->name('pengeluaran-gudang');
Route::get('/pengeluaran-gudang/tambah',[PengeluaranGudangController::class, 'screenTambah']);
Route::get('/pengeluaran-gudang/tambah/process',[PengeluaranGudangController::class, 'tambah']);
Route::get('/pengeluaran-gudang/detail/{pengeluaran_gudang_id}', [PengeluaranGudangController::class, 'detail']);
// END PENGELUARAN GUDANG


// START PEMINDAHAN BARANG GUDANG
Route::get('/pemindahan-gudang', [TransfergudangController::class, 'index'])->name('warehouse-transfer');
Route::get('/pemindahan-gudang/tambah',[TransfergudangController::class, 'screenTambah']);
Route::get('/pemindahan-gudang/kembali_pg',[TransfergudangController::class, 'kembali_pg']);
Route::get('/pemindahan-gudang/tambah/kembali_pgtambah',[TransfergudangController::class, 'kembali_pgtambah']);
Route::get('/pemindahan-gudang/tambah/search',[TransfergudangController::class, 'filter']);
Route::get('/pemindahan-gudang/tambah/pindah/{product_stock_id}',[TransfergudangController::class, 'pindah']);
Route::get('/pemindahan-gudang/tambah/process',[TransfergudangController::class, 'tambah']); 
Route::get('/pemindahan-gudang/detail/{warehouse_transfer_id}', [TransfergudangController::class, 'detail']);
// END PEMINDAHAN BARANG GUDANG


//START VOUCHER
Route::get('/vouchers', [VouchersController::class, 'index'])->name('vouchers');
Route::get('/vouchers/tambah',[VouchersController::class, 'screenTambah']);
Route::get('/vouchers/tambah/process',[VouchersController::class, 'tambah']);
Route::get('/vouchers/edit/{vouchers_id}',[VouchersController::class, 'edit']);
Route::get('/vouchers/edit/process/{vouchers_id}',[VouchersController::class, 'update']);
Route::get('/vouchers/hapus/{vouchers_id}', [VouchersController::class, 'delete']);
//END VOUCHER