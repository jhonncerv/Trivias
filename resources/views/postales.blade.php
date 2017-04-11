<?php require_once "functions.php"; ?>
@include('templates.head')
<body class="page">
    <main class="main" role="document">
        <div class="tw-page">
            <a href="/" class="tw-page__logo">
                <img src="<?= image_path('twinings_of_london.png'); ?>" alt="Twinings of London" />
            </a>
            <div class="tw-page__title">
                <span>Twinings</span> <span>Twinings #TéDeAltura</span>
            </div>
            <div class="tw-page__body">
                <div class="container">
                    @foreach($postales as $postal)
                        <img src="{{ $postal->url }}" alt="{{ $postal->name }}">
                    @endforeach
                </div>
            </div>
            <a href="/" class="tw-form__button tw-page__return">Regresar</a>
        </div>
    </main>
    <script type='text/javascript' src='<?=main_js()?>'></script>
</body>
</html>