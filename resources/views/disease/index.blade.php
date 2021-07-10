@extends('layouts.dashboard')

@section('title', 'Daftar Penyakit')

@section('header.title', 'Daftar Penyakit')

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
                        <div class="card-tools">
                            <form method="post">
                                @csrf
                                <input type="hidden" name="name" value="">
                                <button class="btn btn-sm btn-dark btn-add" type="button">
                                    <i class="fas fa-plus mr-1"></i>
                                    Penyakit baru
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th style="width: 90px">ID</th>
                                    <th>Nama</th>
                                    <th style="width: 1px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diseases as $d)
                                    <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>
                                            <form action="/disease/{{ $d->id }}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="name" value="{{ $d->name }}">
                                                <button class="btn btn-sm btn-outline-dark btn-edit" type="button">
                                                    Edit
                                                </button>
                                            </form>
                                            <form action="/disease/{{ $d->id }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger bg-gradient-danger btn-delete mt-2" type="button">
                                                    Hapus
                                                </button>
                                            </form>
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
    <script>
        $('.btn-add').click(function() {
            let $prev = $(this).prev(),
                new_name = prompt('Masukkan nama penyakit baru.')

            if (new_name) {
                $prev.val(new_name)
                $prev.parents('form').submit()
            }
        })

        $('.btn-edit').click(function() {
            let $prev = $(this).prev(),
                old_name = $prev.val(),
                new_name = prompt('Silakan edit nama penyakit.', old_name)

            if (new_name) {
                $prev.val(new_name)
                $prev.parents('form').submit()
            }
        })

        $('.btn-delete').click(function() {
            if (confirm('Apakah Anda yakin ingin menghapus penyakit ini? Segala hal yang berkaitan akan ikut terhapus!'))
                $(this).parents('form').submit()
        })
    </script>

@endpush
