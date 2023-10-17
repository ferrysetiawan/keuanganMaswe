@extends('layouts.BE.template.template')

@section('title')
    Kolam
@endsection

@section('content')
    <div class="main-content">
        <div class="modal fade" id="add_kolam_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kolam</h5>
                    </div>
                    <form action="#" method="POST" id="add_kolam_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Nama Kolam</label>
                                <input type="text" name="nama_kolam" class="form-control" placeholder="Masukan Nama Kolam">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                            <button type="submit" id="add_kolam_btn" class="btn btn-primary">
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

        <div class="modal fade" id="editKolamModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    </div>
                    <form action="#" method="POST" id="edit_KOLAM_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="my-2">
                                <label for="name">Nama Kolam</label>
                                <input type="text" id="nama_kolam" name="nama_kolam" class="form-control"
                                    placeholder="Masukan Nama">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="edit_kolam_btn" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="section-header">
                <h1>Halaman Kolam</h1>
            </div>
            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Tabel Kolam</h3>
                                <button class="btn btn-light" data-toggle="modal" data-target="#add_kolam_modal"><i
                                        class="bi-plus-circle me-2"></i>Tambah Kolam</button>
                            </div>
                            <div class="">
                                <div class="card-body" id="KOLAM_all">
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
        $(function(){
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('kolam-edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#nama_kolam").val(response.nama_kolam);
                        $("#id").val(response.id);
                    }
                });
            });
            $("#edit_KOLAM_form").submit(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var id = $("#id").val();
                var nama_kolam = $("input[id='nama_kolam']").val();
                $("#edit_kolam_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('kolam-update') }}',
                    method: 'post',
                    data: {
                        _token: _token,
                        id: id,
                        nama_kolam: nama_kolam
                    },
                    dataType: 'json',
                    success: function(response) {
                        if ($.isEmptyObject(response.error)) {
                            printSuccessMsg(response.success);
                            $("#edit_kolam_btn").text('Update');
                            $("#edit_KOLAM_form")[0].reset();
                            $("#editKolamModal").modal('hide');
                            KOLAM_all();
                        } else {
                            printErrorMsg(response.error);
                            $("#edit_kolam_btn").text('Update');
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
                            url: '{{ route('kolam-delete') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                printSuccessMsg(response.success)
                                KOLAM_all();
                            }
                        });
                    }
                })
            });

            KOLAM_all();

            function KOLAM_all() {
                $.ajax({
                    url: '{{ route('kolam-all') }}',
                    method: 'get',
                    success: function(response) {
                        $("#KOLAM_all").html(response);
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
            $("#add_kolam_form").submit(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var nama_kolam = $("input[name='nama_kolam']").val();

                // Hide the submit text and show the loading animation
                $("#textSimpan").hide();
                $("#loadingButton").show();

                $.ajax({
                    url: "{{ route('kolam-store') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        nama_kolam: nama_kolam
                    },
                    success: function(response) {
                        $("#loadingButton").hide();
                        $("#textSimpan").show();
                        if ($.isEmptyObject(response.error)) {
                            printSuccessMsg(response.success);
                            $("#add_kolam_form")[0].reset();
                            $("#add_kolam_modal").modal('hide');
                            KOLAM_all();
                        } else {
                            printErrorMsg(response.error);
                        }
                    }
                });
            });

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
        })
    </script>
@endsection
