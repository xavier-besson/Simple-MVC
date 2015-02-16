<section class="list-container" id="promo-container">
	<div class="row">
		<div class="loading-overlay" id="promo-loader"><div class="spinner"></div></div>
		<div class="large-12 columns">
			<h1>Promotions</h1>
			<dl class="sub-nav">
				<dt><b>Actions:</b></dt>
				<dd class="active"><a href="#" id="promo-refresh">Refresh</a></dd>
			</dl>
			<div id="promo" class="row" data-equalizer></div>
		</div>
	</div>
</section>
<section class="" id="list-container">
	<div class="row">
		<div class="loading-overlay" id="list-loader"><div class="spinner"></div></div>
		<div class="large-12 columns">
			<h1>List of articles</h1>
			<dl class="sub-nav">
				<dt><b>Actions:</b></dt>
				<dd class="active"><a href="#" id="list-refresh">Refresh</a></dd>
			</dl>
			<dl class="sub-nav">
				<dt><b>Filter by:</b></dt>
				<dt>
				Status:
				<?php
				\Presenter\Form\Htmllist\Select::render(\Enum\Article\Status::$data, null, array(
					'id'	 => 'filter-status',
					'name'	 => 'filter-status',
					'style'	 => 'margin:0;'
				),
				array(
					'-1' => 'All'
				)
				);
				?>
				</dt>
				<dt>
				User:
				<?php
				\Presenter\Form\Htmllist\Select::render($users, null, array(
					'id'	 => 'filter-user',
					'name'	 => 'filter-user',
					'style'	 => 'margin:0;'
				),
				array(
					'-1' => 'All'
				)
				);
				?>
				</dt>
			</dl>
			<table class="full-width">
				<thead>
					<tr>
						<th style="width:40px;">Id</th>
						<th style="width:70px;">User</th>
						<th style="width:80px;">Date</th>
						<th>Title / Remarks</th>
						<th style="width:45px;">Qty</th>
						<th style="width:110px;">Unit price <small>(€)</small></th>
						<th style="width:80px;">Total <small>(€)</small></th>
						<th style="width:105px;"></th>
					</tr>
				</thead>
				<tbody id="list">
				</tbody>
			</table>
		</div>
	</div>
</section>