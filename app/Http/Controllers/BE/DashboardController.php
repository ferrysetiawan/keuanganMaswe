<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $start = Carbon::now()->startOfMonth()->format('m/d/Y');
        $end = Carbon::now()->endOfMonth()->format('m/d/Y');

        $dateStart = date('Y-m-d', strtotime($start));
        $dateEnd = date('Y-m-d', strtotime($end));
        $penjualan = Penjualan::whereBetween('tanggal', [$dateStart,$dateEnd])->get();
        $pembelian = Pembelian::whereBetween('tanggal', [$dateStart,$dateEnd])->get();
        $pengeluaran = $pembelian->sum('total');
        $pemasukan = $penjualan->sum('total');
        $totalKg = Penjualan::whereBetween('tanggal', [$dateStart,$dateEnd])->where('kategori_id','!=', 3)->sum('qty');
        $total = $pemasukan - $pengeluaran;

        return view('dashboard', compact('dateStart', 'dateEnd','start','end','pembelian','penjualan','pemasukan','pengeluaran', 'total', 'totalKg'));
    }
}
