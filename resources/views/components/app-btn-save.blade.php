@props(['disabled' => false])
<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'btn btn-orange']) !!}>
    <i class="fa fa-save text-white"></i> {{ $value ?? 'Simpan' }}
</button>
