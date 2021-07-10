@if (session('alert'))
    @php
        $alert = session('alert');
    @endphp
    <div class="callout callout-{{ $alert['type'] }}">
        {{ $alert['message'] }}
    </div>
@endif
