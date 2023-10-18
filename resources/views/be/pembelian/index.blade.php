@extends('layouts.BE.template.template')

@section('title')
    Pembelian
@endsection
@section('content')
    <div class="main-content">
        <div class="modal fade" id="add_TU_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembelian</h5>
                    </div>
                    <form action="#" method="POST" id="add_TU_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Masukan tanggal">
                            </div>

                            <div class="my-2">
                                <label for="email">Keterangan</label>
                                <input type="text" id="keterangan" name="keterangan" class="form-control"
                                    placeholder="Masukan Keterangan">
                            </div>

                            <div class="my-2">
                                <label for="name">Kategori</label>
                                <select class="form-control" name="kategori_id" id="kategoriOut">
                                    <option value="">Pilih Kategori</option>
                                </select>
                            </div>

                            <div class="my-2">
                                <label for="email">Total</label>
                                <input type="number" id="total" name="total" class="form-control"
                                    placeholder="Masukan Total Belanja">
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
                                <label for="name">Tanggal</label>
                                <input type="date" id="tanggalan" name="tanggal" class="form-control" placeholder="Masukan tanggal">
                            </div>

                            <div class="my-2">
                                <label for="email">Keterangan</label>
                                <input type="text" id="keterangans" name="keterangan" class="form-control"
                                    placeholder="Masukan Keterangan">
                            </div>

                            <div class="my-2">
                                <label for="name">Kategori</label>
                                <select class="form-control" name="kategori_id" id="kategoriOutan">
                                    <option value="">Pilih Kategori</option>
                                </select>
                            </div>

                            <div class="my-2">
                                <label for="email">Total</label>
                                <input type="number" id="totalan" name="total" class="form-control"
                                    placeholder="Masukan Total Belanja">
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
                <h1>Halaman Pembelian</h1>
            </div>
            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Pembelian</h3>
                                @can('pembelian_create')
                                <button id="tambahPembelian" class="btn btn-light" data-toggle="modal" data-target="#add_TU_modal"><i
                                    class="bi-plus-circle me-2"></i>Tambah Pembelian</button>
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
        $(function() {
            $("#add_TU_form").submit(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var tanggal = $("input[name='tanggal']").val();
                var keterangan = $("input[name='keterangan']").val();
                var kategori_id = $("#kategoriOut").val();
                var total = $("#total").val();

                // Hide the submit text and show the loading animation
                $("#textSimpan").hide();
                $("#loadingButton").show();

                $.ajax({
                    url: "{{ route('pembelian-store') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        tanggal: tanggal,
                        keterangan: keterangan,
                        kategori_id: kategori_id,
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

            $(document).on('click', '.editIcon', function() {
                var pembelianId = $(this).data('id');
                $.get('/dashboard/pembelian/'+pembelianId+'/edit', function(data){
                    console.log(data);
                    $('#id').val(data.id);
                    $('#tanggalan').val(data.tanggal);
                    $('#keterangans').val(data.keterangan);
                    $.get('/dashboard/pembelian/get-kategori', function(options){
                        var katogoriOptionDropdown = $('#kategoriOutan');
                        katogoriOptionDropdown.empty();

                        //loop melalui opsi dan tentukan yang sesuai sebagai terpilih(selected)
                        $.each(options, function(key, value){
                            var option = $('<option></option>');
                            option.attr('value', value.id).text(value.nama_kategori);

                            if (value.id === data.kategori_id) {
                                option.attr('selected','selected');
                            }

                            katogoriOptionDropdown.append(option);
                        })
                    });
                    $('#totalan').val(data.total);
                });
            });
            $("#edit_TU_form").submit(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var id = $("#id").val();
                var tanggal = $("#tanggalan").val();
                var keterangan = $("#keterangans").val();
                var kategori_id = $("#kategoriOutan").val();
                var total = $("#totalan").val()
                $("#edit_TU_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('pembelian-update') }}',
                    method: 'post',
                    data: {
                        _token: _token,
                        id: id,
                        tanggal: tanggal,
                        keterangan: keterangan,
                        kategori_id: kategori_id,
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
                            url: '{{ route('pembelian-delete') }}',
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
                    url: '{{ route('pembelian-all') }}',
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
        $(document).ready(function() {
            $('#tambahPembelian').click(function() {
                $.ajax({
                    url: '{{ route('get-kategori') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#kategoriOut').empty();
                        $.each(data, function (key, value) {
                            $('#kategoriOut').append('<option value="' + value.id + '">' + value.nama_kategori + '</option>');
                        })
                    }
                });
            });
        });
    </script>
@endsection
