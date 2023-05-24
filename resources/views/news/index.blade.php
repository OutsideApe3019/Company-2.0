@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        News
                    </div>

                    <div class="card-body">
                        {{ $news->links() }}
                        @foreach ($news as $new)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <a class="btn btn-link text-secondary p-0 fs-5"
                                        href="{{ route('news.view', ['new' => $new->id]) }}">{{ Str::limit($new->title, 100) }}</a>
                                </div>

                                <div class="card-body text-break">
                                    {!! Str::limit(Str::markdown($new->text), 1000) !!}
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>
                                            By <a href="{{-- route('user.view',['user' => $new->user->id]) --}}"
                                                style="color: @foreach ($new->user->roles as $role) {{ $role->color }} @endforeach">{{ $new->user->name }}</a>, {{ Carbon::createFromFormat('Y-m-d H:i:s', $new->created_at)->format('d/m/Y H:i') }}
                                        </span>
                                        <span>
                                            {{ $new->comments()->count() }} comments.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($news->count() == 0)
                            <div class="d-flex justify-content-center">
                                No news found.
                            </div>
                        @endif
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
