@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Panel / User / {{ $user->name }} / Edit</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p>
                                    {!! Avatar::create($user->name)->setDimension(150)->setFontSize(54)->toSvg() !!}
                                </p>
                                
                                <br>
                                <p class="p-2 rounded-2 fs-3">
                                    @foreach ($user->roles as $role)
                                        <span class="badge p-2 fs-4" style="background-color: {{ $role->color }};">{{ $role->prefix }}</span>
                                    @endforeach
                                    {{ $user->name }}
                                </p>
                            </div>
                            <div class="col-9">
                                <form action="{{ route('panel.users.edit', ['user' => $user->id]) }}" method="POST">
                                    @csrf

                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" aria-describedby="name"
                                                value="{{ $user->name }}" disabled>
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
                                                value="{{ $user->email }}" disabled>
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

                                    <div>
                                        <label for="role" class="form-label">Role</label>
                                        <div class="input-group mb-3">
                                            <select id="role" class="form-select" name="role" disabled>
                                                @foreach (Role::all() as $role)
                                                    <option value="{{ $role->name }}"
                                                        @if ($user->hasRole($role->name)) selected @endif>
                                                        {{ $role->prefix }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-primary" type="button" id="editRole">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            @error('role')
                                                <div class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input class="form-check-input" type="checkbox" name="banned" id="banned" @if($user->isBanned()) checked @endif>
                                        <label class="form-check-label" for="banned">
                                            Banned
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('panel.users.index') }}" class="btn btn-danger">
                                            Cancel
                                        </a>
                                        <button class="btn btn-primary" type="submit">
                                            Save
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

        editRole = document.getElementById('editRole');
        editRole.addEventListener('click', function() {
            document.getElementById('role').removeAttribute('disabled');
        });
    </script>
@endsection
