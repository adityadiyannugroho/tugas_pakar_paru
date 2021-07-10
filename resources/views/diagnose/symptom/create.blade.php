@extends('layouts.dashboard')

@section('title', 'Diagnosis')

@section('dashboard.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-4">
            <div class="callout callout-info">
                Silakan jawab pertanyaan diagnosa berikut sampai selesai dengan menekan tombol <strong>YA</strong> atau <strong>TIDAK</strong>.
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-4">
            <div class="progress mb-3">
                @php
                    $current_percentage = \App\Symptom::count();
                @endphp
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $symptom->id }}" aria-valuemin="0" aria-valuemax="{{ $current_percentage }}" style="width: {{ $symptom->id/$current_percentage*100 }}%">
                    <span class="sr-only">40% Complete (success)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-4">
            <div class="card shadow-sm border-0 p-3">
                <div class="card-body">
                    <div class="card-text">
                        <form action="{{ url("/diagnose/$diagnose->id/symptom/$symptom->id") }}" method="post">
                            @csrf
                            <input id="condition" type="hidden" name="condition">
                            <strong>Pertanyaan {{ $symptom->id }}</strong><br>
                            Apakah {{ lcfirst($symptom->name) }}?
                            <div class="mt-3 text-center d-flex justify-content-between">
                                <button type="button" class="btn-yes btn bg-gradient-primary btn-lg px-4">
                                    <strong>YA</strong>
                                </button>
                                <button type="button" class="btn-no btn bg-gradient-danger btn-lg px-4">
                                    <strong>TIDAK</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                @if ($previous_symptom != null)
                    <a href="{{ url("/diagnose/$diagnose->id/symptom/" . ($last_symptom_id - 1)) }}">
                        Sebelumnya
                    </a>
                @else
                    <div></div>
                @endif
                @if ($next_symptom != null)
                    <a href="{{ url("/diagnose/$diagnose->id/symptom/" . ($last_symptom_id + 1)) }}">
                        Selanjutnya
                    </a>
                @else
                    <div></div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@push('scripts')
    <script>
        $('.btn-yes').click(function() {
            $('#condition').val(1)
            $(this).parents('form').submit();
        })


        $('.btn-no').click(function() {
            $('#condition').val(0)
            $(this).parents('form').submit();
        })
    </script>
@endpush
