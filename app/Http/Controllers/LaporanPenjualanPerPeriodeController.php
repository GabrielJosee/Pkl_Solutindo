<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\SalesItem;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanPenjualanPerPeriodeController extends Controller
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
        $sales_item = SalesItem::where('data_state', 0)->get();

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

        $sales_item = $sales_item->where('created_at', '>=', $start_date)->where('created_at', '<=', $stop_date);

        return view('content/Laporan/LaporanPenjualanPerPeriode', compact('sales_item', 'start_date', 'end_date'));
    }

    public function filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);

        return redirect('/laporan-penjualan-per-periode');
    }

    public function CetakPDF()
    {
        $filename = 'Laporan Penjualan per Periode.pdf';

        $sales_item = SalesItem::where('data_state', 0)->get();
        $total_price = SalesItem::where('data_state', 0)->sum('sales_item_total_price');

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
        $sales_item = $sales_item->where('created_at', '>=', $start_date)->where('created_at', '<=', $stop_date);
        $total_price = SalesItem::where('data_state', 0)->where('created_at', '>=', $start_date)->where('created_at', '<=', $stop_date)->sum('sales_item_total_price');
        $html = view()->make('content/Laporan/CetakLaporanPenjualanPerPeriode', ['sales_item' => $sales_item, 'start_date' => $start_date, 'end_date' => $end_date, 'total_price' => $total_price])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Laporan Penjualan per Periode');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakExcel()
    {
        $sales_item = SalesItem::where('data_state', 0)->get();
        
        
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
        $sales_item = $sales_item->where('created_at', '>=', $start_date)->where('created_at', '<=', $stop_date);
        $total_price = SalesItem::where('data_state', 0)->where('created_at', '>=', $start_date)->where('created_at', '<=', $stop_date)->sum('sales_item_total_price');
        
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        
        $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize('12');
        $activeWorksheet->getColumnDimension('A')->setWidth(5);
        $activeWorksheet->getColumnDimension('B')->setWidth(20);
        $activeWorksheet->getColumnDimension('C')->setWidth(20);
        $activeWorksheet->getColumnDimension('D')->setWidth(20);

        $activeWorksheet->setCellValue('A1', 'Laporan Penjualan Per Periode');
        $activeWorksheet->getStyle('A1')->getFont()->setSize('16')->setBold(true);
        $activeWorksheet->mergeCells('A1:D1');

        $activeWorksheet->setCellValue('A2', 'Periode ' . $start_date . ' s/d ' . $end_date);
        $activeWorksheet->getStyle('A2')->getFont()->setSize('12');
        $activeWorksheet->mergeCells('A2:D2');
        $activeWorksheet->getStyle('A1:A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $activeWorksheet
            ->setCellValue('A3', 'No')
            ->setCellValue('B3', 'Nama Produk')
            ->setCellValue('C3', 'Jumlah Produk')
            ->setCellValue('D3', 'Nominal');
        $activeWorksheet->getStyle('A3:D3')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A3:D3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $cell = 4;
        $no = 1;
        foreach ($sales_item as $si) {
            $activeWorksheet->getStyle('A' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $activeWorksheet->getStyle('C' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('D' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $activeWorksheet
                ->setCellValue('A' . $cell, $no)
                ->setCellValue('B' . $cell, $si->callProduct['product_name'])
                ->setCellValue('C' . $cell, $si['sales_item_amount'])
                ->setCellValue('D' . $cell, 'Rp' . number_format($si['sales_item_total_price']) . ',00');
            $no++;
            $cell++;
        }
        $activeWorksheet->getStyle('A3:D' . $cell)->applyFromArray($styleArray);
        $activeWorksheet->mergeCells('A' . $cell . ':C' . $cell);
        $activeWorksheet->getStyle('A' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $activeWorksheet->getStyle('D' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $activeWorksheet->getStyle('A' . $cell . ':D' . $cell)->getFont()->setBold(true);
        $activeWorksheet
            ->setCellValue('A' . $cell, 'Total')
            ->setCellValue('D' . $cell, 'Rp' . number_format($total_price) . ',00');
        $writer = new Xlsx($spreadsheet);
        $writer->save('Laporan Penjualan per Periode.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Penjualan per Periode.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }


}