@if (isset($href) && isset($label))
    <a class="{{ isset($class) ? $class : '' }}" href="{{ $href }}">{{ $label }}</a>
@endif