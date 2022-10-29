@if (!$attributes['id'])
    {{ dd('componen ini membutuhkan attribut id') }}
@else
    @props(['disabled' => false])
    <input {{ $disabled ? 'disabled' : '' }} class="form-control" {!! $attributes->merge() !!} />

    @section('scripts')
        <script>
            $("#{{ $attributes['id'] }}").daterangepicker({
                locale: {
                    format: "DD-MM-YYYY"
                },
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"), 10)
            });
        </script>
    @append
@endif
