@extends('layouts.dashboard')

@section('title', 'Buat Diagnosis')

@section('dashboard.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-4">
            <div class="card shadow-sm border-0 p-3">
                <div class="card-body">
                    <h2 class="card-title mb-3">Buat Diagnosis</h2>
                    <div class="card-text">
                        <form action="/diagnose" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Diagnosis</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Diagnosis Pasien A" aria-describedby="nameHelp" value="{{ old('name') }}">
                                @error('name')
                                    <small id="nameHelp" class="text-danger">Nama diagnosis wajib disi</small>
                                @else
                                    <small id="nameHelp" class="text-muted">Namai diagnosis yang akan dibuat</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                @php
                                    setlocale(LC_TIME, 'id');
                                @endphp
                                <div class="mb-1"><strong>Tanggal diagnosis</strong></div>
                                {{ strftime('%A, %e %B %Y') }}
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary">Buat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
