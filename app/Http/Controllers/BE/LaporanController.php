<?php

namespace App\Http\Controllers\BE;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $start = Carbon::now()->startOfMonth()->format('m/d/Y');
        $end = Carbon::now()->endOfMonth()->format('m/d/Y');


        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('m/d/Y');
            $end = Carbon::parse($date[1])->format('m/d/Y');
        }

        $dateStart = date('Y-m-d', strtotime($start));
        $dateEnd = date('Y-m-d', strtotime($end));
        $penjualan = Penjualan::whereBetween('tanggal', [$dateStart,$dateEnd])->get();
        $pembelian = Pembelian::whereBetween('tanggal', [$dateStart,$dateEnd])->get();
        $pengeluaran = $pembelian->sum('total');
        $pemasukan = $penjualan->sum('total');
        $totalKg = Penjualan::whereBetween('tanggal', [$dateStart,$dateEnd])->where('kategori_id','!=', 6)->sum('qty');
        $total = $pemasukan - $pengeluaran;

        return view('be.laporan.index', compact('dateStart', 'dateEnd','start','end','pembelian','penjualan','pemasukan','pengeluaran', 'total', 'totalKg'));
    }

    public function export($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('m/d/Y');
        $end = Carbon::parse($date[1])->format('m/d/Y');
        $dateStart = date('Y-m-d', strtotime($start));
        $dateEnd = date('Y-m-d', strtotime($end));
        $penjualan = Penjualan::whereBetween('tanggal', [$dateStart,$dateEnd])->get();
        $pembelian = Pembelian::whereBetween('tanggal', [$dateStart,$dateEnd])->get();
        $pengeluaran = $pembelian->sum('total');
        $pemasukan = $penjualan->sum('total');
        $totalKg = Penjualan::whereBetween('tanggal', [$dateStart,$dateEnd])->where('kategori_id','!=', 6)->sum('qty');
        $total = $pemasukan - $pengeluaran;

        $timestamp = now()->format('Y-m-d_H-i-s'); // Menggunakan timestamp saat ini
        $filename = 'report_' . $timestamp . '.xlsx';

        return Excel::download(new ReportExport($dateStart, $dateEnd), $filename);
    }
}
