@props(['disabled' => false])
<button type="button" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'btn btn-orange']) !!}>
    <i class="fas fa-plus text-white"></i>
    Tambah
</button>
