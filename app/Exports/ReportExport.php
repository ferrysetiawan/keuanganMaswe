<?php

namespace App\Exports;

use App\Models\Pembelian;
use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromView
{
    use Exportable;

    public function __construct($dateStart, $dateEnd)
    {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    public function view(): View
    {
        $penjualan = Penjualan::whereBetween('tanggal', [$this->dateStart,$this->dateEnd])->get();
        $pembelian = Pembelian::whereBetween('tanggal', [$this->dateStart,$this->dateEnd])->get();
        $pengeluaran = $pembelian->sum('total');
        $pemasukan = $penjualan->sum('total');
        $totalKg = Penjualan::whereBetween('tanggal', [$this->dateStart,$this->dateEnd])->where('kategori_id','!=', 3)->sum('qty');
        $total = $pemasukan - $pengeluaran;
        return view('be.laporan.cetak',[
            'penjualan' => $penjualan,
            'pembelian' => $pembelian,
            'pengeluaran' => $pengeluaran,
            'pemasukan' => $pemasukan,
            'totalKg' => $totalKg,
            'total' => $total
        ]);}
}
