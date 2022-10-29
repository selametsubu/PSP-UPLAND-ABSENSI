@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label']) }}>
    {{ $value ?? $slot }}

    @if ($attributes['required'] =='true')
        <span class="text-danger">*</span>
    @endif
</label>
