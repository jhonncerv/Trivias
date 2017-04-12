@if ($current = $ciudades->where('is_publish',1)[$ciudades->where('is_publish',1)->count()-1]->id) @endif
<div class="tw-map tw-map--{{$current}}">
    <div class="tw-map__stage vertical-align--xs">
        <div class="tw-map__pins tw-map__pins">
            <img src="<?=image_path('mapa.png')?>" alt="" />
            @foreach($ciudades->where('is_publish',1) as $ciudad)
                 @if($ciudad->available == 0)
                    @continue
                @endif
            <div class="tw-map__pins__item tw-map__pins__item--{{ $ciudad->id }}" data-trigger-city="{{ $ciudad->name }}"></div>
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
            <div class="tw-map__dots__item tw-map__dots__item--{{$ciudad->id}} {{ $ciudad->is_publish ? 'tw-map__dots__item--available':'' }}" data-id="{{$ciudad->id}}" {{ $ciudad->is_publish ? '':'data-trigger-city="'. $ciudad->name .'"' }}></div>
            @endforeach
        </div>
    </div>
</div>