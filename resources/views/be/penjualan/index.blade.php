@extends('layouts.BE.template.template')

@section('title')
    Penjualan
@endsection
@section('content')
    <div class="main-content">
        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="my-2">
                                <label for="tanggal">Tanggal</label>
                                <input required id="tanggal" type="date" name="tanggal" class="form-control" placeholder="dd/mm/yy">
                            </div>

                            <div class="my-2">
                                <label for="pembeli">Nama Pembeli</label>
                                <input required id="pembeli" type="text" name="pembeli" class="form-control" placeholder="Masukan Nama">
                            </div>

                            <div class="my-2">
                                <label for="name">Kelas</label>
                                <select class="form-control" name="kategori_id" id="kategoriIn">
                                    <option value="">Pilih Kelas</option>
                                </select>
                            </div>

                            <div class="my-2">
                                <label>Kolam</label>
                                <select required id="selectKolam" name="kolam_id[]" class="form-control select2" multiple="" style="width: 100%">
                                    <option value="">Pilih Kolam</option>
                                </select>
                            </div>

                            <div class="my-2">
                                <label for="unit">Unit</label>
                                <input required id="unit" type="text" name="unit" class="form-control" placeholder="Masukan Unit">
                            </div>

                            <div class="my-2">
                                <label for="qty">Qty</label>
                                <input required type="number" id="qty" name="qty" class="form-control"
                                    placeholder="Masukan Quantity">
                            </div>

                            <div class="my-2">
                                <label for="harga">Harga</label>
                                <input required type="number" id="harga" name="harga" class="form-control"
                                    placeholder="Masukan Harga">
                            </div>

                            <div class="my-2">
                                <label for="total">Total</label>
                                <input type="number" id="total" name="total" class="form-control"
                                    placeholder="Total">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                            <button type="submit" id="add_TU_btn" class="btn btn-primary">
                                <div id="textSimpan">Simpan</div>
                                <div id="loadingButton" style="display: none;">
                                    <?xml version="1.0" encoding="utf-8"?>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        style="margin: auto; background: none; display: block; shape-rendering: auto;"
                                        width="30px" height="30px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                        <circle cx="50" cy="50" fill="none" stroke="#ffffff"
                                            stroke-width="10" r="35"
                                            stroke-dasharray="164.93361431346415 56.97787143782138">
                                            <animateTransform attributeName="transform" type="rotate"
                                                repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50"
                                                keyTimes="0;1"></animateTransform>
                                        </circle>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editTUModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    </div>
                    <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">

                            <div class="my-2">
                                <label for="tanggal">Tanggal</label>
                                <input required id="tanggalan" type="date" name="tanggal" class="form-control" placeholder="dd/mm/yy">
                            </div>

                            <div class="my-2">
                                <label for="pembeli">Nama Pembeli</label>
                                <input required id="pembelian" type="text" name="pembeli" class="form-control" placeholder="Masukan Nama">
                            </div>

                            <div class="my-2">
                                <label for="name">Kelas</label>
                                <select class="form-control" name="kategori_id" id="kategoriInan">
                                    <option value="">Pilih Kelas</option>
                                </select>
                            </div>

                            <div class="my-2">
                                <label>Kolam</label>
                                <select required id="selectKolaman" name="kolam_id[]" class="form-control select2" multiple="" style="width: 100%">
                                    <option value="">Pilih Kolam</option>
                                </select>
                            </div>

                            <div class="my-2">
                                <label for="unit">Unit</label>
                                <input required id="unitan" type="text" name="unit" class="form-control" placeholder="Masukan Unit">
                            </div>

                            <div class="my-2">
                                <label for="qty">Qty</label>
                                <input required type="number" id="qtyan" name="qty" class="form-control"
                                    placeholder="Masukan Quantity">
                            </div>

                            <div class="my-2">
                                <label for="harga">Harga</label>
                                <input required type="number" id="hargaan" name="harga" class="form-control"
                                    placeholder="Masukan Harga">
                            </div>

                            <div class="my-2">
                                <label for="total">Total</label>
                                <input type="number" id="totalan" name="total" class="form-control"
                                    placeholder="Total">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="edit_TU_btn" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="section-header">
                <h1>Halaman Penjualan</h1>
            </div>
            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Penjualan</h3>
                                @can('penjualan_create')
                                    <button id="tambahPenjualanModal" class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                            class="bi-plus-circle me-2"></i>Tambah Penjualan</button>

                                @endcan
                            </div>
                            <div class="">
                                <div class="card-body" id="TU_all">
                                    <h1 class="text-center text-secondary my-5">Loading...</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $(function() {
            $(document).on('click', '.editIcon', function() {
                var penjualanId = $(this).data('id');
                $("#editTUModal").modal('show');

                $.get('/dashboard/penjualan/'+penjualanId+'/edit', function(data){
                    var selectedData = data.selectedData;
                    var allData = data.allData;
                    $('#id').val(data.penjualan.id)
                    $('#tanggalan').val(data.penjualan.tanggal);
                    $('#pembelian').val(data.penjualan.pembeli);
                    $.get('/dashboard/penjualan/get-categories', function(options){
                        var katogoriOptionDropdown = $('#kategoriInan');
                        katogoriOptionDropdown.empty();

                        //loop melalui opsi dan tentukan yang sesuai sebagai terpilih(selected)
                        $.each(options, function(key, value){
                            var option = $('<option></option>');
                            option.attr('value', value.id).text(value.nama_kategori);

                            if (value.id === data.penjualan.kategori_id) {
                                option.attr('selected','selected');
                            }

                            katogoriOptionDropdown.append(option);
                        })
                    });
                    var $relatedData = $('#selectKolaman')
                    $relatedData.empty();
                    $relatedData.select2({
                        data: allData.map(function (item) {
                            return {
                                id: item.id,
                                text: item.nama_kolam,
                                selected: selectedData.includes(item.id)
                            }
                        })
                    });
                    $('#unitan').val(data.penjualan.unit);
                    $('#qtyan').val(data.penjualan.qty);
                    $('#hargaan').val(data.penjualan.harga);
                    $('#totalan').val(data.penjualan.total);
                });
            });

            $("#add_TU_form").submit(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var tanggal = $("input[name='tanggal']").val();
                var pembeli = $("input[name='pembeli']").val();
                var kategori_id = $("#kategoriIn").val();
                var kolam_id = $("#selectKolam").val() || [];
                var unit = $("input[name='unit']").val();
                var harga = $("input[name='harga']").val();
                var qty = $("input[name='qty']").val();
                var total = $("#total").val();

                // Hide the submit text and show the loading animation
                $("#textSimpan").hide();
                $("#loadingButton").show();

                $.ajax({
                    url: "{{ route('penjualan-store') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        tanggal: tanggal,
                        pembeli: pembeli,
                        kategori_id: kategori_id,
                        kolam_id: kolam_id,
                        unit: unit,
                        harga: harga,
                        qty: qty,
                        total: total
                    },
                    success: function(response) {
                        $("#loadingButton").hide();
                        $("#textSimpan").show();
                        if ($.isEmptyObject(response.error)) {
                            printSuccessMsg(response.success);
                            $("#add_TU_form")[0].reset();
                            $("#add_TU_modal").modal('hide');
                            TU_all();
                        } else {
                            printErrorMsg(response.error);
                        }
                    }
                });
            });

            $("#edit_TU_form").submit(function(e) {
                e.preventDefault();
                var id = $("#id").val();
                var _token = $("input[name='_token']").val();
                var tanggal = $("#tanggalan").val();
                var pembeli = $("#pembelian").val();
                var kategori_id = $("#kategoriInan").val();
                var kolam_id = $("#selectKolaman").val() || [];
                var unit = $("#unitan").val();
                var harga = $("#hargaan").val();
                var qty = $("#qtyan").val();
                var total = $("#totalan").val();
                $("#edit_TU_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('penjualan-update') }}',
                    method: 'post',
                    data: {
                        _token: _token,
                        id: id,
                        tanggal: tanggal,
                        pembeli: pembeli,
                        kategori_id: kategori_id,
                        kolam_id: kolam_id,
                        unit: unit,
                        harga: harga,
                        qty: qty,
                        total: total
                    },
                    dataType: 'json',
                    success: function(response) {
                        if ($.isEmptyObject(response.error)) {
                            printSuccessMsg(response.success);
                            $("#edit_TU_btn").text('Update');
                            $("#edit_TU_form")[0].reset();
                            $("#editTUModal").modal('hide');
                            TU_all();
                        } else {
                            printErrorMsg(response.error);
                            $("#edit_TU_btn").text('Update');
                        }
                    },
                });
            });

            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('penjualan-delete') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                printSuccessMsg(response.success)
                                TU_all();
                            }
                        });
                    }
                })
            });
            TU_all();

            function TU_all() {
                $.ajax({
                    url: '{{ route('penjualan-all') }}',
                    method: 'get',
                    success: function(response) {
                        $("#TU_all").html(response);
                        $("table").DataTable({
                            rowReorder: {
                                selector: 'td:nth-child(2)'
                            },
                            destroy: true,
                            responsive: true
                        });
                    }
                });
            }

            function printErrorMsg(msg) {
                $.each(msg, function(key, value) {
                    iziToast.error({
                        title: 'Ups!!',
                        message: value,
                        position: 'topRight'
                    });
                });
            }

            function printSuccessMsg(msg) {
                iziToast.success({
                    title: 'Selamat',
                    message: msg,
                    position: 'topRight'
                });
            }

        });
    </script>
    <script>

        // lihat password insert
        $(document).ready(function() {
            $('#tambahPenjualan').click(function() {
                $.ajax({
                    url: '{{ route('get-categories') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#kategoriIn').empty();
                        $.each(data, function (key, value) {
                            $('#kategoriIn').append('<option value="' + value.id + '">' + value.nama_kategori + '</option>');
                        })
                    }
                });
                $.ajax({
                    url: '{{ route('get-kolam') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#selectKolam').empty();
                        $.each(data, function (key, value) {
                            $('#selectKolam').append('<option value="' + value.id + '">' + value.nama_kolam + '</option>');
                        })
                    }
                });

            });

            $("#harga, #qty").keyup(function() {
                let harga = $("#harga").val();
                let qty = $("#qty").val();
                let total = harga * qty;
                $("#total").val(total);
            });

            $("#hargaan, #qtyan").keyup(function() {
                let harga = $("#hargaan").val();
                let qty = $("#qtyan").val();
                let total = harga * qty;
                $("#totalan").val(total);
            });
        });
    </script>
@endsection
