@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Panel / Permissions</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center align-middle">
                            <h1>Permissions</h1>
                            @can('panel.perm.create')
                                <a href="{{ route('panel.perms.create') }}" class="btn btn-primary">New permission</a>
                            @endcan
                        </div>
                        {!! $permsUl !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
