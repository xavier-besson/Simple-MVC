<li class="has-dropdown">
	<a href="#"><b id="header-username"><?php echo $user['username']; ?></b></a>
	<ul class="dropdown">
		<?php if ($is_admin): ?>
			<li><a href="/users">Users</a></li>
		<?php endif; ?>
		<li><a href="/profile">Edit my profile</a></li>
		<li><a id="logout" href="#">Log out</a></li>
	</ul>
</li>