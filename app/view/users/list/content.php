<?php foreach ($users as $user): ?>
	<tr>
		<td>
			<?php echo $user->id ?>
		</td>
		<td>
			<?php echo $user->username; ?>
		</td>
		<td>
			<?php echo \Enum\User\Role::get_label($user->role); ?>
		</td>
		<td>
			<a data-user-edit="<?php echo $user->id ?>" href="#">Edit</a>
			/
			<a data-user-password="<?php echo $user->id ?>" href="#">Update password</a>
			/
			<a data-user-delete="<?php echo $user->id ?>" href="#">Delete</a>
		</td>
	</tr>
<?php endforeach; ?>