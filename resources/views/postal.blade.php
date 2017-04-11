<?php require_once "functions.php"; ?>
@include('templates.head')
<body class="page postal-page">
    <main class="main" role="document">
        <div class="tw-page" data-body-classes="postal-page">
            <a href="/" class="tw-page__logo">
                <img src="<?= image_path('twinings_of_london.png'); ?>" alt="Twinings of London" />
            </a>
            <div class="tw-page__title">
                <span>01</span> <span>Marruecos</span>
            </div>
            <div class="tw-page__body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="tw-postal">
                                <figure class="tw-postal__image">
                                    <a href="{{route('postal',$postal[0]->name)}}"><img class="img-fluid" src="{{ $postal[0]->url }}" alt="{{ $postal[0]->name }}"></a>
                                </figure>
                                <div class="tw-postal__body">
                                    <h1>Sabías que...</h1>
                                    <p>{{ $postal[0]->meta }}</p>
                                </div>
                                <div class="tw-postal__share">
                                    <!--a href="{{route('postal',$postal[0]->name)}}" class="tw" data-id="{{ $postal[0]->id }}" target="_blank"><i class="fa fa-twitter"></i></a-->
                                    <a href="{{route('postal',$postal[0]->name)}}" class="fb" data-id="{{ $postal[0]->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/" class="tw-form__button tw-page__return">Regresar</a>
        </div>
    </main>
    <script type='text/javascript' src='<?=main_js()?>'></script>
</body>
</html>