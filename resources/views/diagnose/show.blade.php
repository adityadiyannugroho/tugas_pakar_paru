@extends('layouts.dashboard')

@section('title', 'Detail Diagnosis')

@section('dashboard.content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex justify-content-between">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle"></i>
                            Detail Diagnosis
                        </h3>
                        <div class="card-tools ml-auto">
                            <a href="/" class="btn btn-dark">Kembali</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Penyakit</th>
                                        <th>Skor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($diagnose->diseases()->orderBy('score', 'desc')->get() as $d)
                                        <tr>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->pivot->score }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
