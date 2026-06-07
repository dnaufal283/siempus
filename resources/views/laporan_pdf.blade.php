<style>
    body {
        font-family: sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .header {
        text-align: center;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
    }
</style>

<div class="header">
    <h2>LAPORAN HARIAN SIEMPUS</h2>
    <p>Tanggal: {{ $date }}</p>
</div>

<p>Ringkasan Kinerja: <strong>{{ $selesai }} dari {{ $total }} Pasien Terlayani</strong></p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Jam Update</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($antrean as $key => $a)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $a->user->name }}</td>
                <td>{{ $a->updated_at->format('H:i') }}</td>
                <td>{{ strtoupper($a->status) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
