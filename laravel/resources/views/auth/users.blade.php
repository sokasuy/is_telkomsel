{{-- @php
    use App\Models\Permission;
@endphp --}}
@extends('layouts.auth')
@section('title')
    <title>{{ Config::get('app.name') }} | Data Users</title>
@endsection

@section('headertitle')
    <h1>DATA USER</h1>
@endsection


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item">Authentication</li>
    <li class="breadcrumb-item active">Users</li>
@endsection

{{-- @section('cssatas')
    <style>
        img .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
    </style>
@endsection --}}

@section('content')
    <!-- /.row -->
    <div class="row">
        <!-- /.col -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="showinfo"></div>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    {{-- @if (Permission::where('role', Auth::user()->role)->where('view', 'users')->where('create', true)->exists()) --}}
                    @if ($hasCreateNewUsers)
                        <div class="row mb-0">
                            <div class="col-md-3" style="margin-bottom: 23px;">
                                {{-- <button type="submit" class="btn btn-primary" id="btn_adduser">Add User</button> --}}
                                <a class="btn btn-primary btn-sm" href="{{ route('auth.adduser') }}" id="btn_adduser">
                                    <i class="fas fa-plus">&nbsp Add User</i></a>
                            </div>
                        </div>
                    @endif

                    <table id="tbl_user" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        {{-- <div class="modal container fade" id="containermodal" tabindex="-1" role="basic"
                            aria-hidden="true">
                            <div class="modal-content" id="contentmodal">
                                <img src="{{ asset('assets/images/loading-buffering.gif') }}" height='200px' />
                            </div>
                        </div> --}}
                        <!-- Modal -->
                        <div class="modal fade" id="modal_container" tabindex="-1" role="dialog"
                            aria-labelledby="modal_containerlabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content" id="modal_content">
                                    <div class="overlay">
                                        <i class="fas fa-2x fa-sync fa-spin"></i>
                                    </div>
                                    {{-- <img src="{{ asset('assets/images/loading-buffering.gif') }}" height='150px'
                                    width='150px' class="center" /> --}}
                                </div>
                            </div>
                        </div>

                        {{-- <tfoot>
                            <tr>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTION</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('jsbawah')
    <script defer>
        var hasUpdateUsers = @json($hasUpdateUsers);
        var hasDeleteUsers = @json($hasDeleteUsers);

        document.addEventListener('DOMContentLoaded', (event) => {
            var tblUser = $("#tbl_user").DataTable({
                "dom": 'Bfrtip',
                "paging": true,
                "pageLength": 10,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "deferRender": true,
                "processing": true,
                // "serverSide": true,
                "ajax": {
                    "url": '{{ route('auth.getuserslist') }}',
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    },
                    "xhrFields": {
                        withCredentials: true
                    }
                },
                "columns": [{
                    "data": "name"
                }, {
                    "data": "email"
                }, {
                    "data": "role"
                }, {
                    "data": "created_at",
                    render: $.fn.dataTable.render.moment('YYYY-MM-DDTHH:mm:ss.SSSSZ',
                        'D MMM YYYY HH:mm:ss')
                }, {
                    "data": "updated_at",
                    render: $.fn.dataTable.render.moment('YYYY-MM-DDTHH:mm:ss.SSSSZ',
                        'D MMM YYYY HH:mm:ss')
                }, {
                    "data": null,
                    render: function(data, type, row) {
                        var button_update = "";
                        var button_delete = "";

                        if (hasUpdateUsers) {
                            button_change_role =
                                '<a class="btn_changerole btn btn-success btn-sm" data-toggle="modal" data-target="#modal_container"><i class="fas fa-user-tag">&nbsp Role</i></a>';
                            button_change_password =
                                '<a class="btn_changepassword btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_container"><i class="fas fa-key">&nbsp Password</i></a>';
                        } else {
                            button_update = '';
                        }
                        if (hasDeleteUsers) {
                            button_delete =
                                '<a class="btn_delete btn btn-danger btn-sm" data-toggle="modal" href="#containermodal"><i class="fas fa-trash-alt">&nbsp Delete</i></a>';
                        } else {
                            button_delete = '';
                        }

                        return button_change_role + button_change_password + button_delete;
                    }
                    // render: function(data, type, row) {
                    //     return '<a class="btn_changepassword btn btn-primary btn-sm" data-toggle="modal" href="#editusermodal"><i class="fas fa-user-edit">&nbsp Edit</i></a> <a class="btn btn-danger btn-sm" data-toggle="modal" href="#deleteusermodal"><i class="fas fa-trash-alt">&nbsp Delete</i></a>';
                    // }
                    // "defaultContent": '<input type="button" class="btn_changepassword" value="Ganti Password"/><input type="button" class="btn_delete" value="Delete"/>'
                }],
                order: {
                    name: 'id',
                    dir: 'desc'
                },
                lengthMenu: [10, 25, 50, {
                    label: 'All',
                    value: -1
                }],
                select: true,
                // fnInitComplete: function(oSettings, json) {
                //     //CHANGE PASSWORD BUTTON
                //     const btnChangePassword = document.querySelector('.btn_changepassword');
                //     btnChangePassword.addEventListener('click', changePassword);
                // },
                "buttons": ['pageLength', "copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tbl_user_wrapper .col-md-6:eq(0)');

            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4placeholderrole').select2({
                theme: 'bootstrap4',
                placeholder: "User Role",
                allowClear: false
            });
        });

        $('#tbl_user').on('click', '.btn_changepassword', function() {
            let className = $(this).closest('tr').attr("class");
            let row;
            // harus dilakukan pengecekkan, apakah tombolnya ini di child atau tetap di parent nya
            if (className === 'child') {
                row = $(this).before();
            } else {
                row = $(this).closest('tr');
            }
            let data = $("#tbl_user").DataTable().row(row).data().id;
            changePassword(data);
        });

        function changePassword(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('auth.changeuserpassword') }}',
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function(data) {
                    $("#modal_content").html(data.msg);
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                }
            });
        };

        function actionUpdatePassword(id) {
            // let id = $("#id").val();
            let name = $("#name").val();
            let email = $("#email").val();
            let password = $("#password").val();

            $.ajax({
                type: 'POST',
                url: '{{ route('auth.actionchangeuserpwd') }}',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    name: name,
                    email: email,
                    password: password
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        $('#showinfo').html(data.msg);
                    }
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                }
            });
        };

        $('#tbl_user').on('click', '.btn_changerole', function() {
            let className = $(this).closest('tr').attr("class");
            let row;
            // harus dilakukan pengecekkan, apakah tombolnya ini di child atau tetap di parent nya
            if (className === 'child') {
                row = $(this).before();
            } else {
                row = $(this).closest('tr');
            }
            let data = $("#tbl_user").DataTable().row(row).data().id;
            changeRole(data);
        });

        function changeRole(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('auth.changeuserrole') }}',
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function(data) {
                    $("#modal_content").html(data.msg);

                    //Initialize Select2 Elements
                    $('.select2').select2();

                    //Initialize Select2 Elements
                    $('.select2bs4placeholderrole').select2({
                        theme: 'bootstrap4',
                        allowClear: false,
                        dropdownParent: $("#modal_content")
                    });
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                }
            });
        };

        function actionUpdateRole(id) {
            // let id = $("#id").val();
            let name = $("#name").val();
            let email = $("#email").val();
            let role = $("#role").val();

            $.ajax({
                type: 'POST',
                url: '{{ route('auth.actionchangeuserrole') }}',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    name: name,
                    email: email,
                    role: role
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        $('#showinfo').html(data.msg);
                    }
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                }
            });
        };

        $('#tbl_user').on('click', '.btn_delete', function() {
            let className = $(this).closest('tr').attr("class");
            let row;
            // harus dilakukan pengecekkan, apakah tombolnya ini di child atau tetap di parent nya
            if (className === 'child') {
                row = $(this).before();
            } else {
                row = $(this).closest('tr');
            }

            let data = $("#tbl_user").DataTable().row(row).data().email;
            alert(data);
        });
    </script>
@endsection
