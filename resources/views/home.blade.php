@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Home
                    </div>

                    <div class="card-body">
                        @auth
                            Welcome, {{ Auth::user()->name }}!
                        @else
                            Welcome!
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
