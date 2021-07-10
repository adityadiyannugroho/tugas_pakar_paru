@extends('layouts.dashboard')

@section('title', "Hubungan Gejala $disease->name")

@section('header.title', "Hubungan Gejala $disease->name")

@section('header.title.class', 'col-md-6')

@section('dashboard.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-alert></x-alert>
            <div class="card">
                <div class="card-body border-0">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Nama Penyakit</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $disease->name }}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <strong>Gejala</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group position-relative">
                                <div id="reset-form" class="d-flex align-items-center position-absolute" title="Hapus pencarian" data-placement="right">
                                    <i class="fas fa-times"></i>
                                </div>
                                <input type="text" id="search" class="form-control" placeholder="Cari gejala" autocomplete="off">
                                <small class="text-muted">Silakan ketikkan nama gejala yang ingin dicari</small>
                            </div>
                            <form action="/disease-symptom/{{ $disease->id }}" method="post" id="disease-symptom">
                                @csrf
                                @method('put')
                                @foreach (\App\Symptom::all() as $s)
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="symptom[]" value="{{ $s->id }}" {{ $disease->symptoms()->where('symptom_id', $s->id)->exists() ? 'checked' : '' }}>
                                                {{ $s->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="/disease-symptom" class="btn btn-primary mr-2">
                                        Batalkan
                                    </a>
                                    <button class="btn btn-primary text-right">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$('#search').keyup(function(ev) {
    const val = $(this).val(),
          $ds = $('#disease-symptom').find('.form-group')

    // show all symptoms
    $ds.show()

    // hide unmatched symptoms
    $ds.each(function(i, el) {
        const $symptom = $(el),
              symptom_name = $symptom.find('label').text()

        if (symptom_name.toLowerCase().indexOf(val.toLowerCase()) === -1) {
            $symptom.hide();
        }
    })

    if (ev.code === 'Escape') {
        $(this).val('')
        $ds.show()
    }
})

$('#reset-form').click(function() {
    $('#search').val('')
    $('#disease-symptom').find('.form-group').show()
})
</script>
@endpush

@push('styles')
<style>
#reset-form {
    cursor: pointer;
    top: 12px;
    right: 10px;
    color: #5f5f5f;
}
</style>
@endpush
