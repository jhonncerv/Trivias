@if ($current = $ciudades->where('is_publish',1)->count() > 0 ? $ciudades->where('is_publish',1)[$ciudades->where('is_publish',1)->count() - 1]->id : 1) @endif
<div class="tw-map tw-map--{{$current}}">
    <div class="tw-map__stage vertical-align--xs">
        <div class="tw-map__pins">
            <img class="tw-map__pins__map" src="<?=image_path('mapa.png')?>" alt="" />
            @foreach($ciudades as $ciudad)
                 @if($ciudad->available == 0)
                    @continue
                @endif
            <div class="tw-map__pins__item tw-map__pins__item--{{ $ciudad->id }}" data-id="{{ $ciudad->id }}">
                <div class="tw-map__pins__item__pin" data-trigger-city="{{ $ciudad->name }}"></div>
                <div class="tw-map__pins__item__postal">
                    <a href="#" class="fb" data-id="" target="_blank"><i class="fa fa-facebook"></i></a>
                    <div class="tw-map__pins__item__postal__share"></div>
                    <figure>
                        <img src="" />
                    </figure>
                    <figcaption>Comparte y suma puntos.</figcaption>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="tw-map__ctrls">
        <div class="tw-map__titles">
            @foreach($ciudades as $ciudad)
                @if($ciudad->available == 0)
                    @continue
                @endif
            <div class="tw-map__titles__item tw-map__titles__item--{{ $ciudad->id }}" data-trigger-city="{{ $ciudad->name }}">
                <span>0{{ $ciudad->id }}</span> <span>{{ $ciudad->name == 'JAPON' ? 'JAPÓN' : $ciudad->name }}</span>
            </div>
            @endforeach
        </div>
        <div class="tw-map__dots">
            @foreach($ciudades as $ciudad)
                @if($ciudad->available == 0)
                    @continue
                @endif
            <div class="tw-map__dots__item tw-map__dots__item--{{$ciudad->id}} {{ $ciudad->is_publish ? 'tw-map__dots__item--available':'' }}" data-id="{{$ciudad->id}}" {!! $ciudad->is_publish ? '':'data-trigger-city="'. $ciudad->name .'"' !!}></div>
            @endforeach
        </div>
    </div>
</div>