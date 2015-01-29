<section class="form-container hide" id="form-container">
	<div class="loading-overlay" id="form-loader"><div class="spinner"></div></div>
	<div class="row">
		<a href="#" id="form-close">&#215;</a>
		<div class="large-12 columns">
			<h1 id="form-title">Add a new article</h1>
			<p>
				<b>Useful links</b>
				<br>
				<small>
				<a href="http://www.cora.fr/amphion" target="_blank">> Cora Amphion</a>
				<br>
				<a href="http://www.coradrive.fr/amphion/" target="_blank">> Cora Drive Amphion</a>
				</small>
			</p>
			<form id="form" data-abide="ajax">
				<input type="hidden" id="id" name="id">
				<div class="row">
					<div class="large-12 columns">
						<label>Name *
							<input type="text" placeholder="Name" id="name" name="name" required />
						</label>
						<small class="error">Name is required and must be a string.</small>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>Link
							<input type="text" placeholder="Link" id="link" name="link" pattern="url" />
						</label>
						<small class="error">Link must be an URL.</small>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>Quantity *
							<input type="text" placeholder="Quantity" id="quantity" name="quantity" required pattern="number" />
						</label>
						<small class="error">Quantity is required and must be a number.</small>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>Unit price <small>(€)</small>
							<input type="text" placeholder="Unit price" id="unit_price" name="unit_price" pattern="number" />
						</label>
						<small class="error">Quantity must be a number.</small>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>Remarks
							<textarea placeholder="Remarks" id="content" name="content" rows="6"></textarea>
						</label>
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