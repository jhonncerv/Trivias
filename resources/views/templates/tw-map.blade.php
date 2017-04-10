<div class="tw-map">
    <div class="tw-map__stage vertical-align--xs">
        <div class="tw-map__stage__pins">
            <img src="<?=image_path('mapa.png')?>" alt="" />
            <div class="tw-map__stage__pins__item tw-map__stage__pins__item--m" data-trigger-city="MARRUECOS"></div>
        </div>
    </div>
    <div class="tw-map__ctrls">
        <div class="tw-map__ctrls__titles">
            <div class="tw-map__ctrls__titles__item" data-trigger-city="MARRUECOS">
                <span>01</span> <span>Marruecos</span>
            </div>
        </div>
        <div class="tw-map__ctrls__dots">
            @foreach($ciudades as $ciudad)
                @if($ciudad->available == 0)
                    @continue
                @endif
            <div class="tw-map__ctrls__dots__item {{ $ciudad->is_publish ? 'tw-map__ctrls__dots__item--available':'' }}" data-trigger-city="{{ $ciudad->name }}"></div>
            @endforeach
        </div>
    </div>
</div>