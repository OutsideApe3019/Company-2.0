@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Panel / Roles
                    </div>
                    <div class="card-body">
                        <span class="d-flex align-items-center justify-content-between">
                            <h1>Roles</h1>
                            @can('panel.role.create')
                                <a href="{{ route('panel.roles.create') }}" class="btn btn-primary">New Role</a>
                            @endcan
                        </span>
                        <div class="table-responsive">
                            {{ $roles->links() }}
                            <table class="table table-striped table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Prefix</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Display</th>
                                        <th scope="col">Created at</th>
                                        @can('panel.role.edit')
                                            <th scope="col"></th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($roles as $role)
                                        <tr>
                                            <th scope="row">{{ $role->id }}</th>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->prefix }}</td>
                                            <td>{{ $role->color }}</td>
                                            <td>
                                                <span class="badge p-2"
                                                    style="background-color: {{ $role->color }};">{{ $role->prefix }}</span>
                                            </td>
                                            <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $role->created_at)->format('d/m/Y') }}
                                            </td>
                                            @can('panel.role.edit')
                                                <td>
                                                    <a href="{{ route('panel.roles.edit', ['role' => $role->id]) }}"
                                                        class="btn btn-secondary">Edit</a>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
