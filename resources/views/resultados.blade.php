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
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <h1>Resultados</h1>
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>email</td>
                                    <td style="min-width: 220px">Facebook ID</td>
                                    <td>Registro</td>
                                    <td>Puntaje</td>
                                </tr>
                                @foreach($participantes as $participante)
                                    <tr>
                                        <td>{{ $loop->iteration  }}</td>
                                        <td>{{ $participante->name  }}</td>
                                        <td>{{ $participante->email  }}</td>
                                        <td>{{ $participante->facebook_id  }}</td>
                                        <td>{{ $participante->created_at  }}</td>
                                        <td>{{ $participante->points  }}</td>
                                    </tr>
                                @endforeach
                            </table>
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