@props(['disabled' => false])
<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'btn btn-danger']) !!}>
    <i class="fas fa-trash text-white"></i> {{ $value ?? 'Hapus' }}
</button>
