@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                {{-- <div class="card">
                    <div class="card-header">
                        News / {!! Str::limit($new->title, 100) !!}
                    </div>

                    <div class="card-body">
                        <h2>{{ $new->title }}</h3>
                            <hr>
                            {!! Str::markdown($new->text) !!}
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        News / {!! Str::limit($new->title, 10) !!} / Comments
                    </div>

                    <div class="card-body">
                        <h1>Comments</h1>
                        <hr>
                        @foreach ($new->comments as $comment)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <a href="{{-- route('user.view',['user' => $new->user->id]) --}} {{-- "
                                        style="color: @foreach ($comment->user->roles as $role) {{ $role->color }} @endforeach">{{ $comment->user->name }}</a>
                                </div>

                                <div class="card-body text-break">
                                    {{ $comment->text }}
                                </div>
                            </div>
                        @endforeach
                        @if ($new->comments == '[]')
                            No comments found.
                        @endif
                        <hr>
                        <div class="card">
                            <div class="card-header">
                                News / {!! Str::limit($new->title, 10) !!} / Comments / Create
                            </div>
                            <div class="card-body">
                                <form action="{{ route('news.comments.create', ['new' => $new->id]) }}" method="POST">
                                    @csrf

                                    <textarea name="text" id="text" class="form-control @error('text') is-invalid @enderror">{{ old('text') }}</textarea>
                                    <div id="textHelp" class="form-text">Max 500 characters. Markdown is supported.</div>
                                    @error('text')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="card">
                    <div class="card-header">
                        News / {!! Str::limit($new->title, 100) !!}
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                News / {!! Str::limit($new->title, 100) !!}
                            </div>

                            <div class="card-body">
                                <h2>{{ $new->title }}</h3>
                                    <hr>
                                    {!! Str::markdown($new->text) !!}
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                News / {!! Str::limit($new->title, 10) !!} / Comments
                            </div>
    
                            <div class="card-body">
                                @foreach ($new->comments as $comment)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <a href="{{-- route('user.view',['user' => $new->user->id]) --}}"
                                                style="color: @foreach ($comment->user->roles as $role) {{ $role->color }} @endforeach">{{ $comment->user->name }}</a>
                                        </div>
    
                                        <div class="card-body text-break">
                                            {{ $comment->text }}
                                        </div>
                                    </div>
                                @endforeach
                                @if ($new->comments == '[]')
                                    No comments found.
                                @endif
                                <hr>
                                <div class="card">
                                    <div class="card-header">
                                        News / {!! Str::limit($new->title, 10) !!} / Comments / Create
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('news.comments.create', ['new' => $new->id]) }}" method="POST">
                                            @csrf
    
                                            <textarea name="text" id="text" class="form-control @error('text') is-invalid @enderror">{{ old('text') }}</textarea>
                                            <div id="textHelp" class="form-text">Max 500 characters. Markdown is supported.
                                            </div>
                                            @error('text')
                                                <div class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
    
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
