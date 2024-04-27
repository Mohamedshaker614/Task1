@extends('dashboard.layout.layout')
@section('contant')
    <div class="container-fluid">
        <div class="row" style="font-size: 40px;">


            {{ __('profile.You are logged in! ')  }}

            @if (auth()->check())

            Normal USer
            @endif
        </div>

    </div>
@endsection
