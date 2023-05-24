@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Panel / Roles / {{ $role->prefix }} / Edit</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p class="badge p-2 fs-4" style="background-color: {{ $role->color }}">{{ $role->prefix }}
                                </p>
                                <h1>Preview</h1>
                                <p class="badge p-2 fs-4" id="preview" style="background-color: {{ $role->color }}">
                                    {{ $role->prefix }}</p>
                            </div>
                            <div class="col-9">
                                <form action="{{ route('panel.roles.edit', ['role' => $role->id]) }}" method="POST">
                                    @csrf

                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" aria-describedby="name"
                                                value="{{ $role->name }}" disabled>
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
                                        <label for="color" class="form-label">Color</label>
                                        <div class="input-group mb-3">
                                            <input type="color" class="form-control @error('color') is-invalid @enderror"
                                                id="color" name="color" aria-describedby="color"
                                                value="{{ $role->color }}" disabled>
                                            <button class="btn btn-primary" type="button" id="editColor">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            @error('color')
                                                <div class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="prefix" class="form-label">Prefix</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control @error('prefix') is-invalid @enderror"
                                                id="prefix" name="prefix" aria-describedby="prefix"
                                                value="{{ $role->prefix }}" disabled>
                                            <button class="btn btn-primary" type="button" id="editPrefix">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            @error('prefix')
                                                <div class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <h1 class="d-flex justify-content-between align-items-center align-middle">
                                        <span>Permissions</span>
                                        @can('panel.perm.create')
                                            <span>
                                                <a href="{{ route('panel.perms.create') }}" class="btn btn-primary">New
                                                    permission</a>
                                            </span>
                                        @endcan
                                    </h1>

                                    {!! $permsUl !!}

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('panel.roles.index') }}" class="btn btn-danger">
                                            Cancel
                                        </a>
                                </form>
                                @can('panel.role.delete')
                                    <a class="btn btn-danger" href="{{ route('panel.roles.delete', ['role' => $role->id]) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                        Delete
                                    </a>

                                    <form id="delete-form" action="{{ route('panel.roles.delete', ['role' => $role->id]) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endcan
                                <button class="btn btn-primary" type="submit">
                                    Save
                                </button>
                            </div>
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

        editColor = document.getElementById('editColor');
        editColor.addEventListener('click', function() {
            document.getElementById('color').removeAttribute('disabled');
        });

        editPrefix = document.getElementById('editPrefix');
        editPrefix.addEventListener('click', function() {
            document.getElementById('prefix').removeAttribute('disabled');
        });

        document.getElementById('color').addEventListener('input', function() {
            document.getElementById('preview').style.backgroundColor = document.getElementById('color').value;
        });

        document.getElementById('prefix').addEventListener('input', function() {
            document.getElementById('preview').innerHTML = document.getElementById('prefix').value;
        });

        document.getElementById('allPerm').addEventListener('input', function() {
            if (this.checked) {
                document.querySelectorAll('.otherPerm').forEach(function(checkbox) {
                    checkbox.setAttribute('disabled', '');
                })
                document.querySelectorAll('.otherPerm').forEach(function(checkbox) {
                    checkbox.setAttribute('checked', '');
                })
            } else {
                document.querySelectorAll('.otherPerm').forEach(function(checkbox) {
                    checkbox.removeAttribute('disabled');
                });
                document.querySelectorAll('.otherPerm').forEach(function(checkbox) {
                    checkbox.removeAttribute('checked');
                });
            }
        });

        if (document.getElementById('allPerm').checked) {
            document.querySelectorAll('.otherPerm').forEach(function(checkbox) {
                checkbox.setAttribute('disabled', '');
            })
        } else {
            document.querySelectorAll('.otherPerm').forEach(function(checkbox) {
                checkbox.removeAttribute('disabled');
            });
        }
    </script>
@endsection
