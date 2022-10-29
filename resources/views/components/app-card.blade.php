<div {!! $attributes->merge(['class' => 'card border']) !!}>
    @if (isset($title) || isset($toolbar))
        <div class="card-header border-0 pt-6">
            <div class="card-title w-90">
                {{ $title ?? '' }}
            </div>
            @if (isset($toolbar))
                <div class="card-toolbar w-10">
                    <div class="d-flex justify-content-end">
                        {{ $toolbar ?? '' }}
                    </div>
                </div>
            @endif

        </div>
    @endif
    <div class="card-body py-4">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
