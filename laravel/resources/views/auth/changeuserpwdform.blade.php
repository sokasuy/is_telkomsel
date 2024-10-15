<div class="modal-header">
    <h5 class="modal-title" id="modal_containerlabel">Change User Password</h5>
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
                    {{-- NAMA --}}
                    <div class="form-group">
                        <label for="name">Full name</label>
                        <div class="input-group mb-3">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Full name" value="{{ $data->name }}" readonly required
                                autocomplete="name" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- EMAIL --}}
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <div class="input-group mb-3">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="Email" value="{{ $data->email }}" readonly required autocomplete="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- PASSWORD --}}
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group mb-3">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Password" required autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- RETYPE PASSWORD --}}
                    <div class="form-group">
                        <label for="password-confirm"> Password Confirmation </label>
                        <div class="input-group mb-3">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" placeholder="Retype password" required
                                autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal" id="actionUpdatePassword"
        onclick="actionUpdatePassword('{{ $data->id }}')">Save changes</button>
</div>
