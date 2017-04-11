<?php require_once "functions.php"; ?>
@include('templates.head')
<body class="page postal-page">
    <main class="main" role="document">
        <div class="tw-page">
            <a href="/" class="tw-page__logo">
                <img src="<?= image_path('twinings_of_london.png'); ?>" alt="Twinings of London" />
            </a>
            <div class="tw-page__title">
                <span>Twinings</span> <span>Twinings #TéDeAltura</span>
            </div>
            <div class="tw-page__body">
                @foreach ($postales->where('ciudad_id', 1) as $postal) @if($postal->ciudad_id == 1)
                @if ($loop->first)
                <div class="tw-page__title">
                    <span>01</span> <span>Marruecos</span>
                </div>
                <div class="container">
                    <div class="row">
                @endif
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="tw-postal">
                                <figure class="tw-postal__image">
                                    <a href="{{route('postal',$postal->name)}}"><img class="img-fluid" src="{{ $postal->url }}" alt="{{ $postal->name }}"></a>
                                </figure>
                                <div class="tw-postal__share">
                                    <a href="{{route('postal',$postal->name)}}" class="tw" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="{{route('postal',$postal->name)}}" class="fb" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                @if ($loop->last)
                    </div>
                </div>
                @endif
                @endif @endforeach

                @foreach ($postales->where('ciudad_id', 2) as $postal) @if($postal->ciudad_id == 2)
                @if ($loop->first)
                <div class="tw-page__title">
                    <span>02</span> <span>Japón</span>
                </div>
                <div class="container">
                    <div class="row">
                @endif
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="tw-postal">
                                <figure class="tw-postal__image">
                                    <a href="{{route('postal',$postal->name)}}"><img class="img-fluid" src="{{ $postal->url }}" alt="{{ $postal->name }}"></a>
                                </figure>
                                <div class="tw-postal__share">
                                    <a href="{{route('postal',$postal->name)}}" class="tw" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="{{route('postal',$postal->name)}}" class="fb" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                @if ($loop->last)
                    </div>
                </div>
                @endif
                @endif @endforeach

                @foreach ($postales->where('ciudad_id', 3) as $postal) @if($postal->ciudad_id == 3)
                @if ($loop->first)
                <div class="tw-page__title">
                    <span>03</span> <span>India</span>
                </div>
                <div class="container">
                    <div class="row">
                @endif
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="tw-postal">
                                <figure class="tw-postal__image">
                                    <a href="{{route('postal',$postal->name)}}"><img class="img-fluid" src="{{ $postal->url }}" alt="{{ $postal->name }}"></a>
                                </figure>
                                <div class="tw-postal__share">
                                    <a href="{{route('postal',$postal->name)}}" class="tw" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="{{route('postal',$postal->name)}}" class="fb" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                @if ($loop->last)
                    </div>
                </div>
                @endif
                @endif @endforeach
                
                @foreach ($postales->where('ciudad_id', 4) as $postal) @if($postal->ciudad_id == 4)
                @if ($loop->first)
                <div class="tw-page__title">
                    <span>04</span> <span>Argentina</span>
                </div>
                <div class="container">
                    <div class="row">
                @endif
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="tw-postal">
                                <figure class="tw-postal__image">
                                    <a href="{{route('postal',$postal->name)}}"><img class="img-fluid" src="{{ $postal->url }}" alt="{{ $postal->name }}"></a>
                                </figure>
                                <div class="tw-postal__share">
                                    <a href="{{route('postal',$postal->name)}}" class="tw" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="{{route('postal',$postal->name)}}" class="fb" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                @if ($loop->last)
                    </div>
                </div>
                @endif
                @endif @endforeach

                @foreach ($postales->where('ciudad_id', 5) as $postal) @if($postal->ciudad_id == 5)
                @if ($loop->first)
                <div class="tw-page__title">
                    <span>05</span> <span>Inglaterra</span>
                </div>
                <div class="container">
                    <div class="row">
                @endif
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="tw-postal">
                                <figure class="tw-postal__image">
                                    <a href="{{route('postal',$postal->name)}}"><img class="img-fluid" src="{{ $postal->url }}" alt="{{ $postal->name }}"></a>
                                </figure>
                                <div class="tw-postal__share">
                                    <a href="{{route('postal',$postal->name)}}" class="tw" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="{{route('postal',$postal->name)}}" class="fb" data-id="{{ $postal->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                @if ($loop->last)
                    </div>
                </div>
                @endif
                @endif @endforeach
            </div>
            <a href="/" class="tw-form__button tw-page__return">Regresar</a>
        </div>
    </main>
    <script type='text/javascript' src='<?=main_js()?>'></script>
</body>
</html>