@extends('layouts.BE.template.template')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
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
        </section>
    </div>
@endsection
