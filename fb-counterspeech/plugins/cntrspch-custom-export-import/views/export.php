<div class="wrap">
	<h1>Export Content</h1>
	<p>Use this tool to export existing site content for translation.</p>
	<p>Clicking the button below will download an XML file to your computer.</p>
	<p>The downloaded file will contain your selected post and page content.</p>
	<p>Shortcodes are converted into custom tags which are compatible with the Facebook translation tool.</p>

	<form action="<?php echo esc_url( $form_action ) ?>" method="post">
		<h2>Export Options</h2>
		<ul>
			<li>
				<label>
					<span class="label-responsive">Export from:</span>
				</label>
				<select name="site" class="">
					<?php foreach ($sites as $site): ?>
						<option value="<?php echo esc_attr( $site['blog_id'] ) ?>"><?php echo esc_html( $site['path'] ) ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label>
					<span class="label-responsive">Include Country Regions?</span>
					<select name="include_regions" class="">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
				</label>
			</li>
			<li>
				<label>
					<span class="label-responsive">Include Resource Languages?</span>
					<select name="include_resource" class="">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
				</label>
			</li>
			<li>
				<label>
					<span class="label-responsive">Include Sitewide Lables?</span>
					<select name="include_globals" class="">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
				</label>
			</li>
		<ul>
		<h2>Export Full Site</h2>
		<ul>
			<li>
				<label>
					<span class="label-responsive">Content type:</span>
					<select name="type" class="">
						<option value="any">Any</option>
						<?php foreach ($types as $type): ?>
							<option value="<?php echo esc_attr( $type ) ?>"><?php echo esc_html( $type ) ?></option>
						<?php endforeach; ?>
					</select>
				</label>
			</li>
			<li>
				<label>
					<span class="label-responsive">Status:</span>
					<select name="status" class="">
						<?php foreach ($statuses as $status): ?>
							<option value="<?php echo esc_attr( $status ) ?>"><?php echo esc_html( $status ) ?></option>
						<?php endforeach; ?>
					</select>
				</label>
			</li>
			<li>
				<label>
					<span class="label-responsive">Author:</span>
					<select name="author" class="">
						<option value="0">All</option>
						<?php foreach ( $users as $user ): ?>
							<option value="<?php echo esc_attr( $user->ID ) ?>"><?php echo esc_html( $user->display_name ) ?></option>
						<?php endforeach; ?>
					</select>
				</label>
			</li>
			<li>
				<label>
					<span class="label-responsive">Start date:</span>
					<input type="text" name="start_date" value="" class="datepicker" />
				</label>
			</li>
			<li>
				<label>
					<span class="label-responsive">End date:</span>
					<input type="text" name="end_date" value="" class="datepicker" />
				</label>
			</li>
		</ul>
		<h2>Export Specific Posts/Pages</h2>
		<p>Entering specific post/page IDs will override Export Full Site settings above</p>
		<label>
			<span class="label-responsive">Post/Page IDs (Example: 167,456,1987)</span>
			<input type="text" name="ids" value="" class="" />
		</label>
		</ul>

		<?php wp_nonce_field( 'cntrspch_cei_export', 'nonce' ); ?>

		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Download Export File">
		</p>
	</form>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.datepicker').datepicker();
});
</script>