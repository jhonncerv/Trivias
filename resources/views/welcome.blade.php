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
        "id": "Dg5RBWcFp",
        "v": "BreN1rCeo"
    },{
        "id": "pdt8HvrQS",
        "v": "T9FSpTvN4"
    },{
        "id": "Aybe61Fwa",
        "v": "fsCACG9hw"
    },{
        "id": "mcKiFiLZ2",
        "v": "rs9jjp4Yh"
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