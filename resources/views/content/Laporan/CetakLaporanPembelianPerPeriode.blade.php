<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Laporan Pembelian per Produk</title>
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Pembelian per Periode</h1>
        <h4 align="center">Periode {{$start_date}} s/d {{$end_date}}</h4>
        <table class="static" rules="all" border="1px" style="width: 95%; ">
            <tr align="center">
                <th width="5%"><b>No</b></th>
                <th width="20%"><b>Pemasok</b></th>
                <th width="25%"><b>Produk</b></th>
                <th width="15%"><b>Jumlah Beli</b></th>
                <th width="10%"><b>Diskon</b></th>
                <th width="25%"><b>Harga</b></th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($purchase as $purchases)
                <tr>
                    <td width="5%" align="center">{{ $no }}</td>
                    <td width="20%" align="left">{{ $purchases['supplier_name'] }}</td>
                    <td width="25%" align="left">{{ $purchases->callProduct['product_name'] }}</td>
                    <td width="15%" align="center">{{ $purchases['purchase_amount'] }}</td>
                    <td width="10%" align="center">
                        @if ($purchases['purchase_discount'] == 0.0)
                            -
                        @else
                            {{ $purchases['purchase_discount'] * 100 }}%
                        @endif
                    </td>
                    <td width="25%" align="right">Rp{{str_replace(',', '.', (number_format($purchases['purchase_price'])))}},00</td>
                </tr>
                <?php $no++; ?>
            @endforeach
            <tr>
                <td colspan="5" align="center"><b>Total</b></td>
                <td align="right"><b>Rp.{{ number_format($total_price) }},00</b></td>
            </tr>
        </table>
    </div>
</body>

</html>
