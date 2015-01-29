<li class="has-dropdown">
	<a href="#"><b><?php echo $_SESSION['user']['username']; ?></b></a>
	<ul class="dropdown">
		<li><a href="/user/update/<?php echo $_SESSION['user']['id']; ?>">Edit my profil</a></li>
		<li><a id="logout" href="#">Log out</a></li>
	</ul>
</li>