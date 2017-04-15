<!doctype html>
<html lang="es-MX">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>Twinings</title>
    <link rel='stylesheet' href='<?=main_css()?>' type='text/css' media='all' />
    <script type='text/javascript' src='<?=jquery_js()?>'></script>
    
    @if(isset($postal))
    <meta property="og:title" content="Postales Twinings" />
    <meta property="og:url" content="{{route('postal',$postal[0]->name)}}" />
    <meta property="og:image" content="http:<?=get_template_directory_uri()?>{{ $postal[0]->url }}" />
    <meta property="og:description" content="{{ $postal[0]->meta }}" />
    @endif

    <script>
        window.config = {
            login:'/login/participante',
            appid:'120356661840963',
            scope:'',//'user_posts,user_friends',
            dynamic:'/dynamic',
            start:'/start',
            save:'/save',
            hashtag:'#TéDeAltura',
            postal:'/postales/share',
            postalto:'/postales/toshare'
        };
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-97224420-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>