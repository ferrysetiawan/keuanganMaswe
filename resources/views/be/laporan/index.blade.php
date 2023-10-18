@extends('layouts.BE.template.template')

@section('title')
    Laporan
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Tanggal {{ $start .' - '. $end }}</h1>
                <span class="ml-auto">
                    <form autocomplete="off" action="{{ route('laporan') }}" method="GET" class="form-inline" id="date-range-form">
                        @can('laporan_create')
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" id="start" value="{{ $start }}">
                                <input type="hidden" id="end" value="{{ $end }}">
                                <input value="{{ $start .'-'. $end }}" id="tanggal" type="text" name="date" class="form-control" placeholder="" aria-label="">
                            <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                            </div>
                        </div>
                        @endcan
                        @can('laporan_download')
                        <a href="{{ url('/dashboard/laporan/export/'. $dateStart . '+' . $dateEnd) }}" class="btn btn-success ml-2 py-2">Export</a>
                        @endcan

                    </form>

                </span>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Uang Masuk</h4>
                            </div>
                            <div class="card-body">
                                {{ moneyFormat($pemasukan) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Uang Keluar</h4>
                            </div>
                            <div class="card-body">
                                {{ moneyFormat($pengeluaran) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total</h4>
                            </div>
                            <div class="card-body">
                                {{ moneyFormat($total) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-balance-scale-right"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Kg</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalKg }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Penjualan</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-md" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Pembeli</th>
                                            <th>Kolam</th>
                                            <th>Kelas</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Total</th>
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
                                                        <span class="badge badge-info mr-2">{{ $i->nama_kolam }}</span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $item->kategori->nama_kategori }}</td>
                                                <td>{{ moneyFormat($item->harga) }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ moneyFormat($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Pembelian</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-md" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Uraian</th>
                                            <th>Kategori</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembelian as $no=>$item)
                                            <tr>
                                                <td>{{ $no + 1 }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->kategori->nama_kategori }}</td>
                                                <td>{{ moneyFormat($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
        $(document).ready(function() {
            $("table").DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                destroy: true,
                responsive: true
            });

           var start = $("#start").val();
           var end = $("#end").val();

           $("#tanggal").daterangepicker({
                startDate: start,
                endDate: end
            })

        });

    </script>
@endsection
