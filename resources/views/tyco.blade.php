<?php require_once "functions.php"; ?>
@include('templates.head')
<body class="{{ Auth::check() ? 'has-menu app' : 'login' }}">
<main class="main" role="document">
    <div class="vertical-align--xs">
        <div class="login-page">
            <img class="login-page__logo" src="<?= image_path('twinings_of_london.png'); ?>" alt="Twinings of London" />
            <div class="login-page__welcome">
                <span class="double-line">Terminos<br/>y condiciones</span> <span>Terminos y condiciones</span>
            </div>
            <p class="login-page__intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut doloremque, doloribus eius, eveniet excepturi fuga illo illum, ipsa iusto possimus rem sed veritatis? Ad labore odio placeat tempora velit.</p>
            <p class="login-page__intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut doloremque, doloribus eius, eveniet excepturi fuga illo illum, ipsa iusto possimus rem sed veritatis? Ad labore odio placeat tempora velit.</p>
            <p class="login-page__intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut doloremque, doloribus eius, eveniet excepturi fuga illo illum, ipsa iusto possimus rem sed veritatis? Ad labore odio placeat tempora velit.</p>
            <p class="login-page__intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut doloremque, doloribus eius, eveniet excepturi fuga illo illum, ipsa iusto possimus rem sed veritatis? Ad labore odio placeat tempora velit.</p>
            <p class="login-page__intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut doloremque, doloribus eius, eveniet excepturi fuga illo illum, ipsa iusto possimus rem sed veritatis? Ad labore odio placeat tempora velit.</p>
            <p class="login-page__intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut doloremque, doloribus eius, eveniet excepturi fuga illo illum, ipsa iusto possimus rem sed veritatis? Ad labore odio placeat tempora velit.</p>
            <p class="login-page__intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut doloremque, doloribus eius, eveniet excepturi fuga illo illum, ipsa iusto possimus rem sed veritatis? Ad labore odio placeat tempora velit.</p>
            <p class="login-page__intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut doloremque, doloribus eius, eveniet excepturi fuga illo illum, ipsa iusto possimus rem sed veritatis? Ad labore odio placeat tempora velit.</p>
            <p class="login-page__intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut doloremque, doloribus eius, eveniet excepturi fuga illo illum, ipsa iusto possimus rem sed veritatis? Ad labore odio placeat tempora velit.</p>
        </div>
    </div>
</main>
<div class="tw-loader">
    <div class="tw-loader__bg"></div>
    <div class="tw-loader__body">
        <img class="svg" src="<?=image_path('puff.svg')?>" alt="" />
    </div>
</div>
<script type='text/javascript' src='<?=main_js()?>'></script>
</body>
</html>