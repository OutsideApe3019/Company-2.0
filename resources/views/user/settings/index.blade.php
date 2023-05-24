@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ Auth::user()->name }} / Settings
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p>
                                    {!! Avatar::create(Auth::user()->name)->setDimension(150)->setFontSize(54)->toSvg() !!}
                                </p>
                                <p class="p-2 rounded-2 fs-3">
                                    @foreach (Auth::user()->roles as $role)
                                        <span class="badge p-2 fs-4" style="background-color: {{ $role->color }};">{{ $role->prefix }}</span>
                                    @endforeach
                                    {{ Auth::user()->name }}
                                </p>
                            </div>
                            <div class="col-9">
                                <form action="{{ route('user.settings.edit.index') }}" method="POST">
                                    @csrf

                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" aria-describedby="name"
                                                value="{{ Auth::user()->name }}" disabled>
                                            <button class="btn btn-primary" type="button" id="editName">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            @error('name')
                                                <div class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" aria-describedby="email"
                                                value="{{ Auth::user()->email }}" disabled>
                                            <button class="btn btn-primary" type="button" id="editEmail">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            @error('email')
                                                <div class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                {{ Auth::user()->name }} / Settings / Change Password
                            </div>

                            <div class="card-body">
                                <form action="{{ route('user.settings.edit.password') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Current Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" aria-describedby="password">
                                        @error('password')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">New Password</label>
                                        <input type="password" class="form-control @error('newPassword') is-invalid @enderror"
                                            id="newPassword" name="newPassword" aria-describedby="newPassword">
                                        @error('newPassword')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control @error('newPassword_confirmation') is-invalid @enderror"
                                            id="newPassword_confirmation" name="newPassword_confirmation" aria-describedby="newPassword_confirmation">
                                        @error('newPassword_confirmation')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">
                                            Change
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        editName = document.getElementById('editName');
        editName.addEventListener('click', function() {
            document.getElementById('name').removeAttribute('disabled');
        });

        editEmail = document.getElementById('editEmail');
        editEmail.addEventListener('click', function() {
            document.getElementById('email').removeAttribute('disabled');
        });
    </script>
@endsection
