<section class="form-container" id="form-container">
	<div class="loading-overlay" id="form-loader"><div class="spinner"></div></div>
	<div class="row">
		<div class="large-6 large-offset-3 medium-8 medium-offset-2 columns">
			<h1 id="form-title">Edit my profile</h1>
			<form id="form" data-abide="ajax">
				<input type="hidden" id="id" name="id" value="<?php echo $user['id']; ?>">
				<div class="row">
					<div class="large-12 columns">
						<label>Username *
							<input type="text" placeholder="Username" id="username" name="username" required value="<?php echo $user['username']; ?>" />
						</label>
						<small class="error">Username is required and must be a string.</small>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns text-right">
						<input class="button small secondary" type="reset" value="Cancel" id="form-cancel">
						<input class="button small" type="submit" value="Submit" id="form-submit">
					</div>
				</div>
			</form>

			<h1 id="form-title">Change my password</h1>
			<form id="form-password" data-abide="ajax">
				<input type="hidden" id="password-id" name="id" value="<?php echo $user['id']; ?>">
				<div class="row">
					<div class="large-12 columns">
						<label>Current password *
							<input type="password" placeholder="Password" id="password-current" name="password-current" required />
						</label>
						<small class="error">Current password is required.</small>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>New password *
							<input type="password" placeholder="Password" id="password" name="password" required />
						</label>
						<small class="error">New password is required.</small>
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
				<div class="row">
					<div class="large-12 columns text-right">
						<input class="button small secondary" type="reset" value="Cancel" id="form-password-cancel">
						<input class="button small" type="submit" value="Submit" id="form-password-submit">
					</div>
				</div>
			</form>
		</div>
	</div>
</section>