<?php foreach ($articles as $article): ?>
	<tr class="status-<?php echo $article['status']; ?>">
		<td>
			<?php echo $article['id'] ?>
		</td>
		<td>
			<?php echo (is_null($article['user']) ? '<span class="small">Removed user</em>' : $article['user']['username']); ?>
		</td>
		<td>
			<?php echo date('d/m/Y', $article['date']) ?>
		</td>
		<td>
			<?php if ($article['link'] === '' || is_null($article['link'])): ?>
				<?php echo $article['name']; ?>
			<?php else: ?>
				<a href="<?php echo $article['link']; ?>" target="_blank"><?php echo $article['name']; ?></a>
			<?php endif; ?>
			<div style="margin: 4px 0 4px 0;">
				<?php if ($is_admin): ?>
					<?php
					\Presenter\Form\Htmllist\Select::render(\Enum\Article\Status::$data, $article['status'], array(
						'id'				 => 'status-' . $article['id'],
						'name'				 => 'status-' . $article['id'],
						'style'				 => 'margin:0;',
						'data-market-status' => $article['id']
					)
					);
					?>

				<?php else: ?>
					<strong><?php echo \Enum\Article\Status::get_label($article['status']); ?></strong>
				<?php endif; ?>
			</div>
			<?php if ($article['content'] !== '' && !is_null($article['content'])): ?>
				<br>
				<em>
					<?php echo str_replace("\n", "<br>", $article['content']) ?>
				</em>
			<?php endif; ?>
		</td>
		<td>
			<?php echo $article['quantity'] ?>
		</td>
		<td>
			<?php echo ($article['unit_price'] == 0 ? '-' : $article['unit_price']); ?>
		</td>
		<td>
			<?php $total		 = intval($article['quantity']) * floatval($article['unit_price']); ?>
			<?php echo ($total == 0 ? '-' : $total); ?>
		</td>
		<td>
			<?php $is_owner	 = $user_id == (is_null($article['user']) ? null : $article['user']['id']); ?>
			<?php $is_pending	 = $article['status'] == \Enum\Article\Status::PENDING; ?>

			<?php if ($is_admin): ?>
				<a data-articles-edit="<?php echo $article['id'] ?>" href="#">Edit</a>
				/
				<a data-articles-delete="<?php echo $article['id'] ?>" href="#">Delete</a>
			<?php elseif ($is_owner): ?>
				<?php if ($is_pending): ?>
					<a data-articles-edit="<?php echo $article['id'] ?>" href="#">Edit</a>
					/
					<a data-articles-cancel="<?php echo $article['id'] ?>" href="#">Cancel</a>
				<?php endif; ?>
			<?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>