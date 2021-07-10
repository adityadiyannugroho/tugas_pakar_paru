@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="my-4 text-center">
    <h1 class="display-4">Sistem Pakar</h1>
    <p class="h3">Diagnosa Penyakit Paru-Paru</p>
</div>
<div class="container pt-3">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-4">
            <div class="card shadow border-0 ">
                <div class="card-body">
                    <h2 class="card-title mb-4">Daftar</h2>
                    <form class="card-text" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>

                            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" required autocomplete="current-password_confirmation">

                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col text-right mb-3">
                            <a href="/login">Sudah punya akun?</a>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary px-4">
                                Daftar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .index-layout {
        background: url('/img/blue-and-silver-stetoscope-40568.jpg');
        background-size: cover;
        background-repeat: no-repeat
    }
</style>
@endpush
