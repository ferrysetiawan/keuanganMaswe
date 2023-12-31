@extends('layouts.BE.template.template')
@section('title')
    Role
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Ubah Role</h1>
            </div>
            <div class="section-body">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Ubah Role</h3>
                            </div>
                            <div class="">
                                <form action="{{ route('role-update', $role->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="input_role_name" class="font-weight-bold">
                                                Nama
                                            </label>
                                            <input id="input_role_name" value="{{ old('name', $role->name) }}" name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" />
                                            @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <!-- permission -->
                                        <div class="form-group">
                                            <label for="input_role_permission" class="font-weight-bold">
                                                Wewenang
                                            </label>
                                            <div class="form-control overflow-auto h-100 @error('permissions') is-invalid @enderror"
                                                id="input_role_permission">
                                                <div class="row">
                                                    <!-- list manage name:start -->
                                                    @foreach ($authorities as $menageName => $permissions)
                                                    <ul class="list-group col-lg-3">
                                                        <li class="list-group-item bg-dark text-white">
                                                            {{ str_replace("_"," ", $menageName) }}
                                                        </li>
                                                        <!-- list permission:start -->
                                                        @foreach ($permissions as $permission)
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                @if (old('permissions', $permissionChecked))
                                                                <input id="{{ $permission }}" name="permissions[]" class="form-check-input"
                                                                    type="checkbox" value="{{ $permission }}"
                                                                    {{ in_array($permission, old('permissions', $permissionChecked)) ? 'checked' : null }}>
                                                                @else
                                                                <input id="{{ $permission }}" name="permissions[]" class="form-check-input"
                                                                    type="checkbox" value="{{ $permission }}">
                                                                @endif

                                                                <label for="{{ $permission }}" class="form-check-label">
                                                                    {{ str_replace("_"," ", $permission) }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                        @endforeach

                                                        <!-- list permission:end -->
                                                    </ul>
                                                    @endforeach

                                                    <!-- list manage name:end  -->
                                                </div>
                                            </div>
                                            @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="float-right mb-4">
                                            <a class="btn btn-info px-4 mx-2" href="{{ route('role') }}">
                                                Kembali
                                            </a>
                                            <button type="submit" class="btn btn-success px-4">
                                                Ubah
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')

@endsection
