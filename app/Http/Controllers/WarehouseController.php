<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use Carbon\Carbon;
use App\Http\Controllers\Controller;


class WarehouseController extends Controller
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
        $gudang = Gudang::where('data_state', '=', 0)->get();
        return view('content/Gudang/ListGudang', ['gudang' => $gudang]);
    }

    public function screenTambah()
    {
        return view('content/Gudang/TambahGudang');
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required',
            'address' => 'required',
            'warehouse_responsible_name' => 'required',
            'number_phone' => 'required'
        ]);

        $gudang = [
            'warehouse_name' => $request->warehouse_name,
            'address' => $request->address,
            'warehouse_responsible_name' => $request->warehouse_responsible_name,
            'number_phone' => $request->number_phone,
        ];
        Gudang::create($gudang);
        $message = 'Gudang Berhasil di tambahkan';
        return redirect()->to('/warehouse')->with('message',$message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($warehouse_id)
    {
        $gudang = Gudang::where('warehouse_id', $warehouse_id)->first();
        return view('content/Gudang/EditGudang', ['gudang' => $gudang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $warehouse_id)
    {
        $request->validate([
            'warehouse_name' => 'required',
            'address' => 'required',
            'warehouse_responsible_name' => 'required',
            'number_phone' => 'required'
        ]);

        $gudang = [
            'warehouse_name' => $request->warehouse_name,
            'address' => $request->address,
            'warehouse_responsible_name' => $request->warehouse_responsible_name,
            'number_phone' => $request->number_phone,
        ];
        Gudang::where('warehouse_id', $warehouse_id)->update($gudang);
        return redirect()->to('/warehouse');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($warehouse_id)
    {
        $gudang = ['data_state' => 1];
        Gudang::where('warehouse_id', $warehouse_id)->update($gudang);
        return redirect()->to('/warehouse');
    }

    public function detail($warehouse_id)
    {
        $gudang = Gudang::where('warehouse_id', $warehouse_id)->first();
        return view('content/Gudang/DetailGudang', ['gudang' => $gudang]);
    }

}
