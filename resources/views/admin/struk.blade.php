<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk - Antrean {{ sprintf('%03d', $antrean->nomor_antrean) }}</title>
    <style>
        /* Pengaturan khusus untuk Printer Thermal 58mm */
        @page {
            margin: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            /* Font kasir */
            width: 58mm;
            /* Standar lebar kertas thermal */
            margin: 0 auto;
            padding: 10px;
            color: #000;
            background: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }

        .header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .header p {
            margin: 2px 0 0;
            font-size: 10px;
        }

        .content {
            text-align: center;
            margin-bottom: 10px;
        }

        .content p {
            margin: 0;
            font-size: 12px;
        }

        .nomor {
            font-size: 38px;
            font-weight: bold;
            margin: 5px 0;
            border: 1px solid #000;
            padding: 5px;
        }

        .poli {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .detail {
            font-size: 11px;
            text-align: left;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }

        .detail table {
            width: 100%;
        }

        .detail td {
            padding: 2px 0;
            vertical-align: top;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 10px;
        }

        /* Sembunyikan semua elemen browser saat di-print */
        @media print {
            body {
                width: 100%;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body onload="window.print(); window.onafterprint = function(){ window.close(); }">

    <div class="header">
        <h3>PUSKESMAS BALEENDAH</h3>
        <p>Jl. Raya Baleendah, Bandung</p>
    </div>

    <div class="content">
        <p>NOMOR ANTREAN</p>
        <div class="nomor">{{ sprintf('%03d', $antrean->nomor_antrean) }}</div>
        <div class="poli">{{ strtoupper($antrean->poli) }}</div>
    </div>

    <div class="detail">
        <table>
            <tr>
                <td width="35%">Nama</td>
                <td width="5%">:</td>
                <td>{{ $antrean->user->name }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $antrean->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>{{ $antrean->created_at->format('H:i') }} WIB</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Terima Kasih<br>Semoga Lekas Sembuh</p>
    </div>

</body>

</html>
