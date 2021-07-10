@extends('layouts.dashboard')

@section('title', 'Daftar gejala')

@section('header.title', 'Daftar gejala')

@section('header.title.class', 'col-md-6')

@section('dashboard.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-alert></x-alert>
            <x-form-error></x-form-error>
            <form method="get">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="q" id="q" class="form-control" placeholder="Cari gejala" required
                            value="{{ Request::input('q') }}">
                        <button class="input-group-append btn btn-primary">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
            @if ($symptoms->count() != 0)
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Daftar gejala</h3>
                    <div class="card-tools">
                        <button class="btn btn-sm btn-dark btn-add" type="button">
                            <i class="fas fa-plus mr-1"></i>
                            Gejala baru
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th style="width: 90px">ID</th>
                                <th>Nama</th>
                                <th>Bobot</th>
                                <th style="width: 1px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($symptoms as $s)
                            <tr>
                                <td>{{ $s->id }}</td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->weight }}</td>
                                <td>
                                    <form action="/symptom/{{ $s->id }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="name" value="{{ $s->name }}">
                                        <button class="btn btn-sm btn-outline-dark btn-edit" type="button"
                                            data-id="{{ $s->id }}" data-name="{{ $s->name }}"
                                            data-weight="{{ $s->weight }}">
                                            Edit
                                        </button>
                                    </form>
                                    <form action="/symptom/{{ $s->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger bg-gradient-danger btn-delete mt-2"
                                            type="button">
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
            {{ $symptoms->links() }}
            @else
            <div class="callout callout-info">
                <h5>Tidak ada gejala</h5>

                <p>Silakan tambahkan <a href="/symptom/create">gejala</a> terlebih dahulu.</p>
                <a href="/symptom/create" class="btn btn-primary text-white text-decoration-none">Tambahkan gejala</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form class="modal-content" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Gejala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama Gejala</label>
                    <textarea name="name" cols="30" rows="4" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Deskripsikan gejala">{{ old('name') }}</textarea>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="weight">Bobot</label>
                    <input type="text" name="weight" id="weight"
                        class="form-control @error('weight') is-invalid @enderror" required value="{{ old('weight') }}"
                        placeholder="Contoh: 0.25" autocomplete="off">
                    @error('weight')
                    <small class="text-danger">{{ $message }}</small>
                    @else
                    <small class="text-mute">Masukkan bobot gejala (0-1)</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form action="/symptom/1" class="modal-content" method="post">
            @csrf
            @method('put')
            <div class="modal-header">
                <h5 class="modal-title">Edit Gejala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama Gejala</label>
                    <textarea name="name" cols="30" rows="4"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Deskripsikan gejala">{{ old('name') }}</textarea>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="weight">Bobot</label>
                    <input type="text" name="weight" id="weight"
                        class="form-control @error('weight') is-invalid @enderror" required
                        value="{{ old('weight') }}" placeholder="Contoh: 0.25" autocomplete="off">
                    @error('weight')
                    <small class="text-danger">{{ $message }}</small>
                    @else
                    <small class="text-mute">Masukkan bobot gejala (0-1)</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('.btn-add').click(function() {
        let $modal = $('#addModal'),
            $name = $modal.find('[name=name]'),
            $weight = $modal.find('[name=weight]')

        $modal.modal()
        setTimeout(() => {
            $name.focus()
        }, 500);
    })

    $('.btn-edit').click(function() {
        let $modal = $('#editModal'),
            $name = $modal.find('[name=name]'),
            $weight = $modal.find('[name=weight]'),
            $form = $modal.find('form'),
            id = $(this).data('id')

        $form.attr('action', '/symptom/' + id)
        $name.val($(this).data('name'))
        $weight.val($(this).data('weight'))
        $modal.modal()
        setTimeout(() => {
            $name.select()
        }, 500);
    })

    $('.btn-delete').click(function() {
        if (confirm('Apakah Anda yakin ingin menghapus gejala ini? Segala hal yang berkaitan akan ikut terhapus!'))
            $(this).parents('form').submit()
    })
</script>

@endpush
