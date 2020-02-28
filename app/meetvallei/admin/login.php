<?php

add_action('login_enqueue_scripts', function () {
	?>
	<style type="text/css">
			body.login {
				background-color: #f4f4f4;
			}
			body.login a {
				color: #5fb11b;
				transition: all 0.3s ease;
			}
			p#backtoblog {
  				display: none;
			}
			body.login #backtoblog a, body.login #nav a {
				color: #5fb11b;
				transition: all 0.3s ease;
				font-size: 16px;
			}
			body.login #backtoblog a:hover, body.login #nav a:hover {
				color: #313131;
			}
			.privacy-policy-link {
				display: none;
			}
			body.login form {
				padding: 25px;
			}
			body.login .button {
				border-radius: 0;
				text-shadow: none;
				background: #313131;
				border: none;
				box-shadow: none;
				outline: none;
				transition: all 0.3s ease;
			}
			body.login .button:hover, body.login .button:focus {
				background: #5fb11b;
				outline: none;
			}
			#login h1 a, .login h1 a {
				background-image: url(<?php echo get_field("logo", "option"); ?>);
				height: 65px;
				width: 100%;
				background-size: auto 100%;
				background-repeat: no-repeat;
			}
	</style>
	<?php
});
