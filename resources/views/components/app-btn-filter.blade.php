@props(['disabled' => false])
<a role="button" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'btn btn-secondary']) !!} title="Filter">
    <i class="fas fa-filter text-white"></i>
</a>
