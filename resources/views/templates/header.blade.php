<header class="main-header">
    <img class="main-header__logo" src="<?= image_path('twinings_of_london.png'); ?>" alt="Twinings of London" />
    <div class="main-header__menu"><span></span></div>
</header>
<div class="profile-menu">
	<div class="vertical-align--xs">
		<div class="profile-menu__card">
		    <div class="profile-menu__photo profile-photo">
	            <div class="profile-photo__image"><img src="{{ $participante->photo }}" /></div>
	            <div class="profile-photo__name">{{ $participante->name }}</div>
	            <div class="profile-photo__score">{{ $participante->points }}</div>
		    </div>
		    <div class="profile-menu__links">
		    	<div class="profile-menu__links__item">
		    		<a class="tw-popup-trigger" href="tyco" target="_blank">Términos y condiciones</a>
		    	</div>
		    	<div class="profile-menu__links__item profile-menu__links__item--social">
		    		<a href="https://twitter.com/twiningsmexico" target="_blank"><i class="fa fa-twitter"></i></a>
		    		<a href="https://www.facebook.com/TwiningsMexico" target="_blank"><i class="fa fa-facebook"></i></a>
		    	</div>
		    </div>
		</div>
    </div>
</div>