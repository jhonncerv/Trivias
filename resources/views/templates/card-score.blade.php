<div class="tw-dynamic__score">
    <div class="tw-dynamic__score__name">Hola {{ $participante->name }}</div>
    <div class="tw-dynamic__score__image"><img src="{{ $participante->photo }}" /></div>
    <div class="tw-dynamic__score__points">
        <div class="tw-dynamic__score__points__item">
            Puntos por aciertos <span class="dy-score_time">200</span>
        </div>
        <div class="tw-dynamic__score__points__item">
            Puntos por tiempo <span class="dy-score_dynamic">900</span>
        </div>
    </div>
    <div class="tw-dynamic__score__label">
        Nuevo puntaje
    </div>
    <div class="tw-dynamic__score__new dy-score_new">
        88888
    </div>
    <div class="tw-dynamic__score__message">
        En 5min estará disponible un nuevo juego.
    </div>
    <button class="twn-form__button tw-dynamic__close">Aceptar</button>
</div>