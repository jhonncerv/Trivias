<?php require_once "functions.php"; ?>
@include('templates.head')
<body class="{{ Auth::check() ? 'has-menu app' : 'login' }}">
<main class="main" role="document">
    @if(Auth::check())
        @include('templates.home')
    @else
        @include('templates.login')
    @endif
    @include('templates.tw-message')
    @include('templates.tw-popup')
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