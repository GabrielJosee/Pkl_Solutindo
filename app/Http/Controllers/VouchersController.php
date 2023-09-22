<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vouchers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class VouchersController extends Controller
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
        $voucher = Vouchers::where('data_state', '=', 0)->get();
        return view('content/Voucher/ListVoucher', ['voucher' => $voucher]);
    }
    public function screenTambah()
    {
        return view('content/Voucher/TambahVoucher');
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'vouchers_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'nominal' => 'required'
        ]);

        $voucher = [
            'vouchers_name' => $request->vouchers_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'nominal' => $request->nominal,
        ];
        Vouchers::create($voucher);
        $message = 'Voucher Berhasil di tambahkan';
        return redirect()->to('/vouchers')->with('message',$message);
    }

    public function edit($vouchers_id)
    {
        $voucher = Vouchers::where('vouchers_id', $vouchers_id)->first();
        return view('content/Voucher/EditVoucher', ['voucher' => $voucher]);
    }

    public function update(Request $request, $vouchers_id)
    {
        $request->validate([
            'vouchers_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'nominal' => 'required'
        ]);

        $voucher = [
            'vouchers_name' => $request->vouchers_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'nominal' => $request->nominal,
        ];
        Vouchers::where('vouchers_id', $vouchers_id)->update($voucher);
        return redirect()->to('/vouchers');
    }
    
    public function delete($vouchers_id)
    {
        $voucher = ['data_state' => 1];
        Vouchers::where('vouchers_id', $vouchers_id)->update($voucher);
        return redirect()->to('/vouchers');
    }

}
