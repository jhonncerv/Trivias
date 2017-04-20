<?php require_once "functions.php"; ?>
@include('templates.head')
    <body class="ending">
        <main class="main" role="document">
            <div class="vertical-align--xs">
                <div class="ending-page">
                    <img class="ending-page__map" src="<?=image_path('mapa.png')?>" alt="" />
                    <div class="ending-page__wrapper">
                        <img class="ending-page__logo" src="<?= image_path('twinings_of_london.png'); ?>" alt="Twinings of London" />
                        <img class="ending-page__pin" src="<?=image_path('pin.png')?>" alt="" />
                        <div class="ending-page__title">Gracias por participar</div>
                        <p>Pronto anunciaremos a los ganadores.<br />Sigue todos los detalles en nuestras redes sociales.</p>
                        <div class="ending-page__links">
                            <a href="https://www.facebook.com/TwiningsMexico" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/twiningsmexico" target="_blank"><i class="fa fa-twitter"></i></a>
                        </div>
                        <p><a href="https://twitter.com/twiningsmexico" target="_blank">@TwiningsMexico</a></p>
                    </div>
                </div>
            </div>
        </main>
        <script type='text/javascript' src='<?=main_js()?>'></script>
    </body>
</html>