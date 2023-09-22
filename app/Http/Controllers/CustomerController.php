<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CustomerController extends Controller
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
        $customer = Customer::where('data_state', '=', 0)->get();
        return view('content/SystemCustomer/ListCustomer', ['customer' => $customer]);
    }
    public function CetakCustomer()
    {
        $filename = 'Customer.pdf';
        $customer = Customer::where('data_state', '=', 0)->get();
        $html = view()->make('content/SystemCustomer/CetakCustomer', ['customer' => $customer])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Customer');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakCustomerExcel()
    {
        $customer = Customer::where('data_state', '=', 0)->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Alamat')
            ->setCellValue('D1', 'Tanggal Pendaftaran')
            ->setCellValue('E1', 'Jenis Kelamin')
            ->setCellValue('F1', 'Umur')
            ->setCellValue('G1', 'No Hp');
        $cell = 2;
        foreach ($customer as $cust) {
            $activeWorksheet
                ->setCellValue('A' . $cell, $cust['customer_id'])
                ->setCellValue('B' . $cell, $cust['customer_name'])
                ->setCellValue('C' . $cell, $cust['customer_address'])
                ->setCellValue('D' . $cell, $cust['customer_register_date']);

            if ($cust['customer_gender'] == 1) {
                $activeWorksheet->setCellValue('E' . $cell, 'Laki - Laki');
            } else if ($cust['customer_gender'] == 2) {
                $activeWorksheet->setCellValue('E' . $cell, 'Perempuan');
            };

            $activeWorksheet
                ->setCellValue('F' . $cell, $cust['customer_age'])
                ->setCellValue('G' . $cell, $cust['customer_phone']);

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

    public function edit($customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->first();
        return view('content/SystemCustomer/EditCustomer', ['customer' => $customer]);
    }

    public function update(Request $request, $customer_id)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_gender' => 'required',
            'customer_age' => 'required',
            'customer_phone' => 'required'
        ]);

        $customer = [
            'customer_name' => $request->customer_name,
            'customer_address' => $request->customer_address,
            'customer_gender' => $request->customer_gender,
            'customer_age' => $request->customer_age,
            'customer_phone' => $request->customer_phone,
        ];
        Customer::where('customer_id', $customer_id)->update($customer);
        return redirect()->to('/customer');
    }

    public function detail($customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->first();
        return view('content/SystemCustomer/DetailCustomer', ['customer' => $customer]);
    }

    public function delete($customer_id)
    {
        $customer = ['data_state' => 1];
        Customer::where('customer_id', $customer_id)->update($customer);
        return redirect()->to('/customer');
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_gender' => 'required',
            'customer_age' => 'required',
            'customer_phone' => 'required'
        ]);

        $date = date("Y-m-d");

        $customer = [
            'customer_name' => $request->customer_name,
            'customer_address' => $request->customer_address,
            'customer_register_date' => $date,
            'customer_gender' => $request->customer_gender,
            'customer_age' => $request->customer_age,
            'customer_phone' => $request->customer_phone,
        ];
        Customer::create($customer);
        $message = 'System Customer Berhasil di tambahkan';
        return redirect()->to('/customer')->with('message',$message);
    }

}