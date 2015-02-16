<section class="list-container" id="list-container">
	<div class="row">
		<div class="loading-overlay" id="list-loader"><div class="spinner"></div></div>
		<div class="large-12 columns">
			<h1 id="form_title">List of users</h1>
			<dl class="sub-nav">
				<dt><b>Actions:</b></dt>
				<dd class="active"><a href="users/add" id="add-user">Add a new user</a></dd>
				<dd class="active"><a href="#" id="list-refresh">Refresh</a></dd>
			</dl>
			<table class="full-width">
				<thead>
					<tr>
						<th style="width:50px;">Id</th>
						<th>Username</th>
						<th>Role</th>
						<th style="width:230px;"></th>
					</tr>
				</thead>
				<tbody id="list">
				</tbody>
			</table>
		</div>
	</div>
</section>