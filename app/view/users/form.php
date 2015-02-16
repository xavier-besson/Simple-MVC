<section class="form-container hide" id="form-container">
	<div class="loading-overlay" id="form-loader"><div class="spinner"></div></div>
	<div class="row">
		<a href="#" id="form-close">&#215;</a>
		<div class="large-12 columns">
			<h1 id="form-title">Add a new user</h1>
			<form id="form" data-abide="ajax">
				<input type="hidden" id="id" name="id">
				<div id="form-default-container">
					<div class="row">
						<div class="large-12 columns">
							<label>Username *
								<input type="text" placeholder="Username" id="username" name="username" required />
							</label>
							<small class="error">Username is required and must be a string.</small>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Role *
								<?php
								\Presenter\Form\Htmllist\Select::render(\Enum\User\Role::$data, null, array(
									'id'		 => 'role',
									'name'		 => 'role',
									'required'	 => null)
								);
								?>
							</label>
							<small class="error">Role is required.</small>
						</div>
					</div>
				</div>
				<div id="form-password-container">
					<div class="row">
						<div class="large-12 columns">
							<label>Password *
								<input type="password" placeholder="Password" id="password" name="password" required />
							</label>
							<small class="error">Password is required.</small>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Confirm password *
								<input type="password" placeholder="Confirm password" id="password-confirm" name="password-confirm" data-equalto="password" required />
							</label>
							<small class="error">The password did not match.</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns text-right">
						<input class="button small secondary" type="reset" value="Cancel" id="form-cancel">
						<input class="button small" type="submit" value="Submit" id="form-submit">
					</div>
				</div>
			</form>
		</div>
	</div>
</section>