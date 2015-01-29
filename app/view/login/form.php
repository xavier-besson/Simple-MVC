<section class="form-container" id="form-container">
	<div class="loading-overlay" id="form-loader"><div class="spinner"></div></div>
	<div class="row">
		<div class="large-6 large-offset-3 medium-8 medium-offset-2 columns">
			<h1 id="form-title">Login</h1>
			<form id="form" data-abide="ajax">
				<div class="row">
					<div class="large-12 columns">
						<label>Username *
							<input type="text" placeholder="Username" id="username" name="username" required />
						</label>
						<small class="error">Username is required.</small>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>Password *
							<input type="password" placeholder="Password" id="password" name="password" required />
						</label>
						<small class="error">Password is required.</small>
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