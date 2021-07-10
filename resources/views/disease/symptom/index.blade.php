@extends('layouts.dashboard')

@section('title', 'Daftar Hubungan')

@section('header.title', 'Daftar Hubungan')

@section('header.title.class', 'col-md-6')

@section('dashboard.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-alert></x-alert>
            @if ($diseases->count() != 0)
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Daftar Penyakit</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th style="width: 60px">ID</th>
                                    <th>Nama Penyakit</th>
                                    <th style="width: 160px">Hubungan Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diseases as $d)
                                    <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>
                                            <button type="button" data-name="{{ $d->name }}" data-id="{{ $d->id }}" class="btn btn-view btn-sm btn-primary mr-2">
                                                Lihat
                                            </button>
                                            <a href="/disease-symptom/{{ $d->id }}/edit" class="btn btn-sm btn-primary">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $diseases->links() }}
            @else
                <div class="callout callout-info">
                    <h5>Tidak ada penyakit</h5>

                    <p>Silakan tambahkan <a href="/disease/create">penyakit</a> terlebih dahulu.</p>
                    <a href="/disease/create" class="btn btn-primary text-white text-decoration-none">Tambahkan Penyakit</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gejala ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th style="width: 60px">No.</th>
                                <th>Nama gejala</th>
                                <th style="width: 80px">Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</div>
    <script>
        $('.btn-view').click(function() {
            axios({
                    method:'get',
                    url: `/api/symptoms?disease_id=${$(this).data('id')}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(res => {
                    const $modal = $('#modal')
                    let html = ''

                    $modal.find('.modal-title').text(`Gejala ${$(this).data('name')}`);
                    $modal.find('tbody tr').remove()

                    $.each(res.data, function (i, v) {
                        html += `
                            <tr>
                                <td>${i+1}</td>
                                <td>${v.name}</td>
                                <td>${v.weight}</td>
                            </tr>
                        `
                    });

                    $modal.find('tbody').html(html)
                    $modal.find('a').attr('href', `/disease-symptom/${$(this).data('id')}/edit`);
                    $modal.modal();
                })
                .catch(err => {
                    console.error(err);
                })
        })
    </script>
@endpush
