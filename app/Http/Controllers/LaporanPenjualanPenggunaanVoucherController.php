<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\SalesItem;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanPenjualanPenggunaanVoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sales = Sales::where('data_state', 0)->where('vouchers_id', '!=', null)->get();

        if (!Session::get('start_date')) {
            $start_date = date('Y-m-d');
        } else {
            $start_date = Session::get('start_date');
        }

        if (!Session::get('end_date')) {
            $end_date = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        } else {
            $end_date = Session::get('end_date');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }

        $sales = $sales->where('sales_date', '>=', $start_date)->where('sales_date', '<=', $stop_date);

        return view('content/Laporan/LaporanPenjualanPenggunaanVoucher', compact('sales', 'start_date', 'end_date'));
    }

    public function filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);

        return redirect('/laporan-penjualan-penggunaan-voucher');
    }
}