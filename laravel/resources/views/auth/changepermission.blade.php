<div class="modal-header">
    <h5 class="modal-title" id="modal_containerlabel">Change Permission</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <!-- left column -->
        <div class="col-md-7">
            <!-- general form elements -->
            <!-- form start -->
            <form enctype="multipart/form-data" role="form" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    {{-- ID --}}
                    <input type="hidden" class="form-control" id="id" name="id" placeholder="-"
                        value="{{ $data->id }}" readonly>
                    {{-- Role --}}
                    <div class="form-group">
                        <label for="role">Role</label>
                        <div class="input-group mb-3">
                            <input id="role" type="text" class="form-control" name="role"
                                value="{{ $data->role }}" readonly required autocomplete="role" autofocus>
                        </div>
                    </div>
                    {{-- View --}}
                    <div class="form-group">
                        <label for="view">View</label>
                        <div class="input-group mb-3">
                            <input id="view" type="text" class="form-control" name="view"
                                value="{{ $data->view }}" readonly required autocomplete="view" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <div class="d-flex align-items-center">
                            <!-- Create -->
                            <div class="icheck-success d-inline mx-2">
                                <input type="checkbox" id="create" name="create"
                                    {{ $data->create == true ? 'checked' : '' }}>
                                <label for="create">Create</label>
                            </div>
                            <!-- Read -->
                            <div class="icheck-success d-inline mx-2">
                                <input type="checkbox" id="read" name="read"
                                    {{ $data->read == true ? 'checked' : '' }}>
                                <label for="read">Read</label>
                            </div>
                            <!-- Update -->
                            <div class="icheck-success d-inline mx-2">
                                <input type="checkbox" id="update" name="update"
                                    {{ $data->update == true ? 'checked' : '' }}>
                                <label for="update">Update</label>
                            </div>
                            <!-- Delete -->
                            <div class="icheck-success d-inline mx-2">
                                <input type="checkbox" id="delete" name="delete"
                                    {{ $data->delete == true ? 'checked' : '' }}>
                                <label for="delete">Delete</label>
                            </div>
                        </div>
                    </div>

            </form>

        </div>
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal" id="actionUpdatePassword"
        onclick="actionUpdatePermission('{{ $data->id }}')">Save changes</button>
</div>
