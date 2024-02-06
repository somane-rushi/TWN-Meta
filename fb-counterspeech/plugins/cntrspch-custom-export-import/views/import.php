<div class="wrap">
	<h1>Import Content</h1>
	<p>Use this tool to import translated content into the appropriate site.</p>

	<form action="<?php echo  esc_url( $form_action ) ?>" method="post" enctype="multipart/form-data">
		<h2>Import Options</h2>
		<ul>
			<li>
				<label>
					<span class="label-responsive">Import to:</span>
					<select name="site" class="">
						<?php foreach ($sites as $site): ?>
							<option value="<?php echo esc_attr( $site['blog_id'] ) ?>"><?php echo esc_html( $site['path'] ) ?></option>
						<?php endforeach; ?>
					</select>
				</label>
			</li>
			<li>
				<label>
					<span class="label-responsive">Import all posts/pages as drafts?</span>
					<input type="checkbox" name="all_draft" checked/>
				</label>
				<p><small>If you do not want imported content to be publicly visible after import, leave this box checked</small></p>
			</li>
			<li>
				<label>
					<span class="label-responsive">Replace existing content?</span>
					<input type="checkbox" name="rewrite_ids" checked/>
				</label>
				<p><small>If you do not want to create duplicate content, leave this box checked</small></p>
			</li>
			<li>
				<label>
					<span class="label-responsive">Select import file:</span>
					<input type="file" name="import-file" value="" />
				</label>
			</li>
		</ul>

		<?php wp_nonce_field( 'cntrspch_cei_import', 'nonce' ); ?>

		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Upload Import File"></p>
	</form>
</div>

<!--Should be moved into it's own js file-- John McAlester - 9/9/2016-->
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.example-datepicker').datepicker();
	});
</script>
