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
		<div data-alert class="alert-box alert">
			Hey I'm an dummy application, don't use  a serious password or important personal data, all of that is easy to access by your grandma or your little sister!
			<a href="#" class="close">&times;</a>
		</div>
		<?php require_once VIEW_PATH . $view . '.php'; ?>
		<?php require_once VIEW_PATH . 'modal.php'; ?>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="//cdn.foundation5.zurb.com/foundation.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
		<script src="/assets/js/main.js"></script>	
		<?php echo $js; ?>
		<script>
<?php if (isset($user)): ?>
				window.user = {
					id: <?php echo $user['id'] ?>,
					username: '<?php echo $user['username'] ?>',
					role: <?php echo $user['role'] ?>
				};
<?php endif; ?>
		</script>
    </body>
</html>