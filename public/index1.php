<?php 
	require_once "functions.php";
	template("head");
?>
	<body class="<?=user_is_logged_in()?'has-menu app':'login'?>">
		<main class="main" role="document">
			<?php 
				if(user_is_logged_in()){
					template("home");
				} else {
					template("login");
				} ?>
		</main>
		<div class="tw-loader">
	      <div class="tw-loader__bg"></div> 
	      <div class="tw-loader__body">
	        <img class="svg" src="<?=image_path('puff.svg')?>" alt="" />
	      </div>
	    </div>
		<script type='text/javascript' src='<?=main_js()?>'></script>
	</body>
<?php 
	template("footer");
?>