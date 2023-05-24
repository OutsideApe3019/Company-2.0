@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Panel / News
                    </div>
                    <div class="card-body">
                        <span class="d-flex align-items-center justify-content-between">
                            <h1>News</h1>
                            @can('panel.new.create')
                                <a href="{{ route('panel.news.create') }}" class="btn btn-primary">New new</a>
                            @endcan
                        </span>
                        @if ($news->count() > 0)
                            <div class="table-responsive">
                                {{ $news->links() }}
                                <table class="table table-striped table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Sender</th>
                                            <th scope="col">Comments</th>
                                            <th scope="col">Created at</th>
                                            @can('panel.new.delete')
                                                <th scope="col"></th>
                                            @endcan
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($news as $new)
                                            <tr>
                                                <th scope="row">{{ $new->id }}</th>
                                                <td>{{ Str::limit($new->title, 50) }}</td>
                                                <td>
                                                    <a href="{{-- route('user.view', ['user' => $new->user->id]) --}}" style="color: @foreach ($new->user->roles as $role) {{ $role->color }} @endforeach">{{ $new->user->name }}</a>
                                                </td>
                                                <td>{{ $new->comments->count() }}</td>
                                                <td>
                                                    {{ Carbon::createFromFormat('Y-m-d H:i:s', $new->created_at)->format('d/m/Y H:i') }}
                                                </td>
                                                @can('panel.new.delete')
                                                    <td>
                                                        <form action="{{ route('panel.news.delete', ['new' => $new->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">
                                                                Delete
                                                            </button>
                                                        </form>

                                                    </td>
                                                @endcan
                                                <td>
                                                    <a href="{{ route('news.view', ['new' => $new->id]) }}"
                                                        class="btn btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $news->links() }}
                            </div>
                        @else
                            <div class="d-flex justify-content-center">
                                No news found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
