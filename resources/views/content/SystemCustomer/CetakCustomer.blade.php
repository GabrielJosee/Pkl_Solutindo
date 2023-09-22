<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Customer</title>
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Data Customer</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Pendaftaran</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>No Hp</th>
            </tr>
            @foreach ($customer as $ct)
                <tr align="center">
                    <td> {{ $ct->customer_id }}</td>
                    <td> {{ $ct->customer_name }}</td>
                    <td> {{ $ct->customer_address }}</td>
                    <td> {{ $ct->customer_register_date }}</td>
                    @if ($ct['customer_gender'] == 1)
                        <td>Laki - Laki</td>
                    @elseif ($ct['customer_gender'] == 2)
                        <td>Perempuan</td>
                    @endif
                    <td> {{ $ct->customer_age }}</td>
                    <td> {{ $ct->customer_phone }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
