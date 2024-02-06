<?php
  $bannerText = $heroImages['hero_banner_text'];
  $images = $heroImages['images'];

  //
  // The home page masthead needs to be new everytime a user revisits
  // the landing page. But we are unsure about the caching layer,
  // so this logic needs to be done in the HomePageView.js file.
  // Here we just render all the options out.
  // We Also place a first-hero class for no script use to render a default.
  //
  // reference:
  // https://stackoverflow.com/questions/1070244/how-to-determine-the-first-and-last-iteration-in-a-foreach-loop
  reset($images);
  $firstImage = key($images);

?>
<div class="masthead homepage">
  <?php foreach ($images as $key => $image) {
    ?>
    <div class="hide <?php if ($key === $firstImage) {
        echo 'first-hero ';
    } ?>image resize-image masthead-image-container" >
      <div class="overlay"></div>
      <img src="<?php echo esc_url(wp_get_attachment_url($image['hero_image'])); ?>" />
    </div>
  <?php
} ?>
	<div class="masthead-copy-wrapper">
	  <h1 class="masthead-copy">
	    <?php echo esc_html($bannerText) ?>
	  </h1>

	  <?php foreach ($images as $key => $image) {
	    ?>
	    <div class="hide masthead-caption-wrapper <?php if ($key === $firstImage) {
	        echo 'first-hero ';
	    } ?>">
	      <span class="masthead-caption">
	        <?php echo esc_html($image['hero_subtext']); ?>
	      </span>
	    </div>
	  <?php
	} ?>
	</div>
</div>
