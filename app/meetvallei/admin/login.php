<?php

add_action('login_enqueue_scripts', function () {
	?>
	<style type="text/css">
			body.login {
				background-color: #f4f4f4;
			}
			body.login a {
				color: white;
				transition: all 0.3s ease;
			}
			body.login #backtoblog a, body.login #nav a {
				color: white;
				transition: all 0.3s ease;
				font-size: 16px;
			}
			body.login #backtoblog a:hover, body.login #nav a:hover {
				color: #313131;
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
				background: #4e4e4e;
				outline: none;
			}
			#login h1 a, .login h1 a {
				background-image: url(<?php echo get_template_directory_uri().'/../app/meetvallei/admin/logo.svg'; ?>);
				height: 65px;
				width: 100%;
				background-size: auto 100%;
				background-repeat: no-repeat;
			}
	</style>
	<?php
});
