@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Panel / Users
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="btn btn-primary text-center">
                                <span class="fs-1">{{ $totalUsers }}</span>
                                <br>
                                <span class="fs-4">Total users.</span>
                            </div>

                            <div
                                class="btn text-center @if ($totalLastUsers >= 10) btn-success @elseif($totalLastUsers < 10 && $totalLastUsers !== 0) btn-warning @else btn-danger @endif">
                                <span class="fs-1">{{ $totalLastUsers }}</span>
                                <br>
                                <span class="fs-4">Total users in</span>
                                <span class="fs-4">the last 7 days.</span>
                            </div>
                        </div>

                        <h1>Users</h1>
                        <div class="table-responsive">
                            {{ $users->links() }}
                            <table class="table table-striped table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Banned</th>
                                        <th scope="col">Created at</th>
                                        @can('panel.user.edit')
                                            <th scope="col"></th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{!! Avatar::create($user->name)->setDimension(40)->setFontSize(16)->toSvg() !!}</td>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <span class="badge p-2" style="background-color: {{ $role->color }};">{{ $role->prefix }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($user->isBanned())
                                                    <span class="badge p-2 bg-danger">Banned</span>
                                                @else
                                                    <span class="badge p-2 bg-success">Not banned</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d/m/Y') }}
                                            </td>
                                            @can('panel.user.edit')
                                                <td>
                                                    <a href="{{ route('panel.users.edit', ['user' => $user->id]) }}"
                                                        class="btn btn-secondary">Edit</a>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
