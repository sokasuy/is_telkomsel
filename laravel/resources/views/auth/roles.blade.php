{{-- @php
    use App\Models\Permission;
@endphp --}}
@extends('layouts.auth')
@section('title')
    <title>{{ Config::get('app.name') }} | Data Roles</title>
@endsection

@section('headertitle')
    <h1>DATA ROLES</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item">Roles</li>
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
                    <h3 class="card-title">Roles</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="showinfo"></div>
                    @if (session('message-success'))
                        <div class="alert alert-success">
                            {{ session('message-success') }}
                        </div>
                    @endif
                    @if (session('message-failed'))
                        <div class="alert alert-danger">
                            {{ session('message-failed') }}
                        </div>
                    @endif
                    {{-- @if (Permission::where('role', Auth::user()->role)->where('view', 'roles')->where('create', true)->exists()) --}}
                    @if ($hasCreateNewRoles)
                        <div class="row mb-0">
                            <div class="col-md-3" style="margin-bottom: 23px;">
                                {{-- <button type="submit" class="btn btn-primary" id="btn_adduser">Add User</button> --}}
                                <a class="btn btn-primary btn-sm" href="{{ route('auth.addroles') }}" id="btn_adduser">
                                    <i class="fas fa-plus">&nbsp Add Roles</i></a>
                            </div>
                        </div>
                    @endif
                    <table id="tbl_role" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ROLE</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <!-- Modal -->
                        <div class="modal fade" id="modal_container" tabindex="-1" role="dialog"
                            aria-labelledby="modal_containerlabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content" id="modal_content">
                                    <div class="overlay">
                                        <i class="fas fa-2x fa-sync fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <tfoot>
                            <tr>
                                <th>ID</th>
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
        var hasUpdateRoles = @json($hasUpdateRoles);
        var hasDeleteRoles = @json($hasDeleteRoles);

        document.addEventListener('DOMContentLoaded', (event) => {
            var tblUser = $("#tbl_role").DataTable({
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
                    "url": "{{ route('auth.getroles') }}",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    },
                    "xhrFields": {
                        withCredentials: true
                    }
                },
                "columns": [{
                    "data": "id",
                    "visible": false
                }, {
                    "data": "role_name"
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

                        // if (hasUpdateRoles) {
                        //     button_update =
                        //         '<a class="btn_changeroles btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_container"><i class="fas fa-user-edit">&nbsp Change Password</i></a>';
                        // } else {
                        //     button_update = '';
                        // }
                        if (hasDeleteRoles) {
                            button_delete =
                                '<a class="btn_delete btn btn-danger btn-sm" data-toggle="modal" href="#containermodal"><i class="fas fa-trash-alt">&nbsp Delete</i></a>';
                        } else {
                            button_delete = '';
                        }

                        return button_update + button_delete;
                        // return button_delete;
                    }
                    // render: function(data, type, row) {
                    //     return '<a class="btn_changeroles btn btn-primary btn-sm" data-toggle="modal" href="#editusermodal"><i class="fas fa-user-edit">&nbsp Edit</i></a> <a class="btn btn-danger btn-sm" data-toggle="modal" href="#deleteusermodal"><i class="fas fa-trash-alt">&nbsp Delete</i></a>';
                    // }
                    // "defaultContent": '<input type="button" class="btn_changeroles" value="Ganti Password"/><input type="button" class="btn_delete" value="Delete"/>'
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
                //     const btnChangePassword = document.querySelector('.btn_changeroles');
                //     btnChangePassword.addEventListener('click', changePassword);
                // },
                "buttons": ['pageLength', "copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tbl_user_wrapper .col-md-6:eq(0)');
        });

        // $('#tbl_role').on('click', '.btn_changeroles', function() {
        //     let className = $(this).closest('tr').attr("class");
        // let row;
        // // harus dilakukan pengecekkan, apakah tombolnya ini di child atau tetap di parent nya
        // if (className === 'child') {
        //     row = $(this).before();
        // } else {
        //     row = $(this).closest('tr');
        // }

        //     let data = $("#tbl_role").DataTable().row(row).data().id;
        //     changePassword(data);
        // });

        // function changePassword(id) {
        //     $.ajax({
        //         type: 'POST',
        //         url: '{{ route('auth.changeuserpassword') }}',
        //         data: {
        //             _token: "{{ csrf_token() }}",
        //             'id': id
        //         },
        //         success: function(data) {
        //             $("#modal_content").html(data.msg);
        //         },
        //         error: function(data, textStatus, errorThrown) {
        //             console.log(data);
        //         }
        //     });
        // };

        $('#tbl_role').on('click', '.btn_delete', function() {
            let className = $(this).closest('tr').attr("class");
            let row;
            // harus dilakukan pengecekkan, apakah tombolnya ini di child atau tetap di parent nya
            if (className === 'child') {
                row = $(this).before();
            } else {
                row = $(this).closest('tr');
            }

            let data = $("#tbl_role").DataTable().row(row).data().id;
            alert(data);
        });

        // function actionUpdatePassword(id) {
        //     // let id = $("#id").val();
        //     let name = $("#name").val();
        //     let email = $("#email").val();
        //     let password = $("#password").val();

        //     $.ajax({
        //         type: 'POST',
        //         url: '{{ route('auth.actionchangeuserpwd') }}',
        //         data: {
        //             _token: "{{ csrf_token() }}",
        //             id: id,
        //             name: name,
        //             email: email,
        //             password: password
        //         },
        //         success: function(data) {
        //             if (data.status == 'ok') {
        //                 $('#showinfo').html(data.msg);
        //             }
        //         },
        //         error: function(data, textStatus, errorThrown) {
        //             console.log(data);
        //         }
        //     });
        // };
    </script>
@endsection
