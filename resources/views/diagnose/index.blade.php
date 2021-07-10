@extends('layouts.dashboard')

@section('title', 'Diagnosis')

@section('header.title', 'Diagnosis')

@section('dashboard.content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @if ($diagnoses->count() != 0)
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Sejarah Diagnosis Pengguna</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th style="width: 180px">Tanggal</th>
                                    <th>Pengguna</th>
                                    <th>Hasil</th>
                                    <th style="width: 200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diagnoses as $d)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($d->updated_at) }}</td>
                                        <td>{{ $d->user->name }}</td>
                                        <td>
                                            <div class="diagnosis-info">
                                                @php
                                                    $top_disease = $d->diseases()->orderBy('score', 'desc')->first();
                                                @endphp
                                                @php
                                                    switch (true) {
                                                        case $top_disease->pivot->score >= .8:
                                                            $badge_type = 'danger';
                                                            break;
                                                        case $top_disease->pivot->score >= .5:
                                                            $badge_type = 'warning';
                                                            break;
                                                        default:
                                                            $badge_type = 'success';
                                                            break;
                                                    }
                                                @endphp
                                                <span class="badge badge-{{ $badge_type }}">
                                                    {{ $top_disease->pivot->score*100 }}%
                                                </span>
                                                {{ $top_disease->name }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($d->diseases->count() != 0)
                                                <a href="{{ url("diagnose/$d->id") }}" class="btn btn-sm btn-success mt-2 text-white">
                                                    <i class="fas fa-info-circle d-block d-md-inline-block mb-1 pt-1 pt-md-0 mr-md-1 mb-md-0"></i> Lihat Detail
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $diagnoses->links() }}
            @else
                <div class="callout callout-info">
                    <h5>Tidak ada diagnosis</h5>

                    <p>Silakan lakukan <a href="/diagnose/create">diagnosis</a> terlebih dahulu.</p>
                    <a href="/diagnose/create" class="btn btn-primary text-white text-decoration-none">Buat Diagnosis</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
