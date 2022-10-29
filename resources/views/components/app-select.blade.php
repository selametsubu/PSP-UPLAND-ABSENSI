<select {!! $attributes->merge(['class' => 'form-select ']) !!} {{ $attributes['disabled'] ? 'disabled' : '' }}>
    {{ $slot }}
</select>
