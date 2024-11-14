@extends('layouts.auth')
@section('title')
    <title>LARAVEL | Add Permission</title>
@endsection


@section('headertitle')
    <span>
        <h1>Permission
        </h1>
        Add Permission. <a href="{{ route('permissions.index') }}"><i class="fas fa-angle-double-left"></i>&nbsp;Back to all
            <span>Permission</span></a>
    </span>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item">Authentication</li>
    <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permission</a></li>
    <li class="breadcrumb-item active">Add Permission</li>
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-7">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Register New User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                    <div class="card-body">
                        {{-- ROLE --}}
                        <div class="form-group">
                            <label for="role">Role</label>
                            <div class="input-group mb-3">
                                <select class="form-control select2bs4placeholderrole" id="role" name="role"
                                    style="width: 100%;" required>
                                    @foreach ($datarole as $d)
                                        <option selected disabled></option>
                                        <option value="{{ $d->id }}">{{ $d->role_name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- SIDEBAR MENU --}}
                        <div class="form-group">
                            <label for="name">Akses Menu</label>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="select2" multiple="multiple" data-placeholder="Pilih Menu"
                                        style="width: 100%;" name="data_menu[]" required>
                                        @foreach ($datamenu as $d)
                                            <option value="{{ $d->id }}">{{ $d->menu_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- HAK AKSES --}}
                        {{-- <div class="form-group">
                            <label for="role">Right of Access</label>
                            <div class="input-group mb-3">

                            </div>
                        </div> --}}
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary" data-value="save_and_back"><i
                                    class="fas fa-save"></i>&nbsp;Save and
                                back</button>
                            <button type="submit" class="btn btn-outline-primary dropdown-toggle"
                                data-toggle="dropdown"></button>
                            <ul class="dropdown-menu">
                                <button type="submit" class="btn btn-block btn-outline-primary" data-value="save_and_edit">
                                    <li class="dropdown-item">Save and edit
                                        this
                                        item</li>
                                </button>
                                <button type="submit" class="btn btn-block btn-outline-primary" data-value="save_and_new">
                                    <li class="dropdown-item">Save and new
                                        item</li>
                                </button>
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-default float-right"><i
                                class="fas fa-ban"></i>&nbsp;Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('jsbawah')
    <script defer>
        document.addEventListener('DOMContentLoaded', (event) => {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4placeholderrole').select2({
                theme: 'bootstrap4',
                placeholder: "User Role",
                allowClear: false
            });
        });
    </script>
@endsection
