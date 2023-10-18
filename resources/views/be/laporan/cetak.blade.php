<table>
    <thead>
        <tr>
            <th colspan="4" style="font-size: 16px;font-weight: bold">Laporan Keuangan</th>
        </tr>
        <tr>
            <th width="200%" style="font-size: 12px;font-weight: bold">Uang Masuk</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Uang Keluar</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Total</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Total Kg</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ moneyFormat($pemasukan) }}</td>
            <td>{{ moneyFormat($pengeluaran) }}</td>
            <td>{{ moneyFormat($total) }}</td>
            <td>{{ $totalKg }}</td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th colspan="7" width="200%" style="font-size: 16px;font-weight: bold">Rincian Penjualan</th>
        </tr>
        <tr>
            <th width="200%" style="font-size: 12px;font-weight: bold">No</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Tanggal</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Pembeli</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Kolam</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Kelas</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Harga</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Qty</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penjualan as $no=>$item)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->pembeli }}</td>
                <td>
                    @foreach ($item->kolam as $i)
                    <span>{{ $i->nama_kolam }}, </span>
                    @endforeach
                </td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td>{{ moneyFormat($item->harga) }}</td>
                <td>{{ $item->qty }}</td>
                <td style="text-align: right">{{ moneyFormat($item->total) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="text-align: center; font-weight: bold">Total</td>
            <td style="text-align: right; font-weight: bold">{{ moneyFormat($pemasukan) }}</td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th colspan="3" width="200%" style="font-size: 16px;font-weight: bold">Rincian Pembelian</th>
        </tr>
        <tr>
            <th width="200%" style="font-size: 12px;font-weight: bold">No</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Tanggal</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Uraian</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Kategori</th>
            <th width="200%" style="font-size: 12px;font-weight: bold">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembelian as $no=>$item)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td style="text-align: right">{{ moneyFormat($item->total) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: center; font-weight: bold">Total</td>
            <td style="text-align: right; font-weight: bold">{{ moneyFormat($pengeluaran) }}</td>
        </tr>
    </tbody>
</table>



