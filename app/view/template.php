<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
		<link rel="stylesheet" href="//cdn.foundation5.zurb.com/foundation.css">
		<link rel="stylesheet" href="/assets/css/main.css">
		<?php echo $css; ?>
		<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    </head>
    <body>
		<?php require_once VIEW_PATH . $view . '.php'; ?>
		<?php require_once VIEW_PATH . 'modal.php'; ?>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="//cdn.foundation5.zurb.com/foundation.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
		<script src="/assets/js/main.js"></script>	
		<?php echo $js; ?>
    </body>
</html>