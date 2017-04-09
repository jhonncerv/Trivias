<?php require_once "functions.php"; ?>
@include('templates.head')
<body class="<?=user_is_logged_in()?'has-menu app':'login'?>">
<main class="main" role="document">
    @if(Auth::check())
        @include('templates.home')
    @else
        @include('templates.login')
    @endif
</main>
<div class="tw-loader">
    <div class="tw-loader__bg"></div>
    <div class="tw-loader__body">
        <img class="svg" src="<?=image_path('puff.svg')?>" alt="" />
    </div>
</div>
<script type='text/javascript' src='<?=main_js()?>'></script>

<script>

    $data = {data:[{
        "id": "tarUwqxYD",
        "v": "RWipjf3Vb"
    },{
        "id": "DztiQO1Vs",
        "v": "twwvB0aiK"
    },{
        "id": "WDToEgk5I",
        "v": "W85yJldpv"
    },{
        "id": "BstSsR8E5",
        "v": "x5J5Ox2hu"
    }]};
    $.ajax({
        url:'/trivia/stop',
        data: $data,
        dataType: 'json',
        method: 'post',
        success: function (e) {
            console.log(e);
        }
    })

</script>
</body>


</html>