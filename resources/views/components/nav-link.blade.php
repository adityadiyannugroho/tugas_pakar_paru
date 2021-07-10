<a href="{{ $href }}" class="nav-link{{ url()->current() == $href ? ' active' : '' }}">
    {{ $slot }}
</a>
