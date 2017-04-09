<header class="main-header">
    <img class="main-header__logo" src="<?= image_path('twinings_of_london.png'); ?>" alt="Twinings of London" />
    <div class="main-header__menu"><span></span></div>
</header>
<div class="profile-menu">
    <div class="profile-photo">
            <div class="profile-photo__image"><img src="{{ $participante->photo }}" /></div>
            <div class="profile-photo__name">{{ $participante->name }}</div>
            <div class="profile-photo__score">{{ $participante->points }}</div>
    </div>
</div>