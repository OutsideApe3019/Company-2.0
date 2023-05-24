@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Panel / Permissions / Create') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h1>Permissions</h1>
                                {!! $permsUl !!}
                            </div>
                            <div class="col-9">
                                <form action="{{ route('panel.perms.create') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" aria-describedby="name"
                                            value="{{ old('name') }}">
                                        <div class="form-text"><span class="text-danger fw-bold">Use "wildcard" permissions, es: post.edit, post.delete, post.*. ALERT: THE * means ALL, so if a user have post.edit and post.delete, if instead of them he have post.* means that he will have access to everything under post.*</span></div>
                                        @error('name')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('panel.perms.index') }}" class="btn btn-danger">
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
@endsection
