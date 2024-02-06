<?php
/*
Template Name: Home Template Page
*/

get_header();
?>

<?php $sectionfirst = get_post_meta( get_the_ID(), 'sectionfirst', true ); 
	if ( ! empty( $sectionfirst['videolink'] ) ):
?>
<section>
	<div class="container-fluid">
		<div class="row">
			<video width="100%" id="vid" src="<?php echo esc_html( $sectionfirst['videolink'] ); ?>" type="video/mp4" frameborder="0" allowfullscreen controls autoplay loop muted></video>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $section_two = get_post_meta( get_the_ID(), 'sectiontwo', true ); ?>
<section class="sectionscamyou">
	<div class="container">
		<div class="row">
        		<?php if ( ! empty( $section_two['heading'] ) ): ?>
				<h3 class="wow fadeInUp"><?php echo esc_html( $section_two['heading'] ); ?></h3>
                <?php endif; ?>
				<div class="userpic1">
                	<?php if ( ! empty( $section_two['image1'] ) ): 
						$img1 = wp_get_attachment_url($section_two['image1']);
					?>
                    	<div class="userblock1 wow pulse" id="loan">
                            <img src="<?php echo esc_url($img1) ?>" alt="FB Digital">
                            <h4><?php echo esc_html( $section_two['title1'] ); ?></h4>
                        </div>
					<?php endif; ?>
                    <?php if ( ! empty( $section_two['image2'] ) ): 
						$img2 = wp_get_attachment_url($section_two['image2']);
					?>
                        <div class="userblock1 wow pulse" id="lottery">
                            <img src="<?php echo esc_url($img2) ?>" alt="FB Digital">
                            <h4><?php echo esc_html( $section_two['title2'] ); ?></h4>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $section_two['image3'] ) ): 
						$img3 = wp_get_attachment_url($section_two['image3']);
					?>
                        <div class="userblock1 wow pulse" id="ecommerce">
                            <img src="<?php echo esc_url($img3) ?>" alt="FB Digital">
                            <h4><?php echo esc_html( $section_two['title3'] ); ?></h4>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $section_two['image4'] ) ): 
						$img4 = wp_get_attachment_url($section_two['image4']);
					?>
					<div class="userblock1 wow pulse" id="romantic">
						<img src="<?php echo esc_url($img4) ?>" alt="FB Digital">
						<h4><?php echo esc_html( $section_two['title4'] ); ?></h4>
					</div>
                    <?php endif; ?>
                    <?php if ( ! empty( $section_two['image5'] ) ): 
						$img5 = wp_get_attachment_url($section_two['image5']);
					?>
					<div class="userblock1 wow pulse" id="job">
						<img src="<?php echo esc_url($img5) ?>" alt="FB Digital">
						<h4><?php echo esc_html( $section_two['title5'] ); ?></h4>
					</div>
                    <?php endif; ?>
				</div>
			</div>
		</div>
</section>
<section id="loansection" class="sectiontwo" style="background-image: url(https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/bg3.jpg);">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-7 col-sm-12 sectiontwo-images">
				<div class="wow bounceInDown jerry-img1" data-wow-delay="0.2s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s21.png" alt="FB Digital">
				</div>
                <div class="wow bounceInDown jerry-img2" data-wow-delay="0.4s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s22.png" alt="FB Digital">
				</div>
                <div class="wow bounceInDown jerry-img3" data-wow-delay="0.6s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s23.png" alt="FB Digital">
				</div>
			</div>
            <div class="col-md-5 col-sm-12 sectiontwo-content wow fadeInUp">
            	<?php $loan_scamster = get_post_meta( get_the_ID(), 'loan_scamster', true ); ?>
                <?php if ( ! empty( $loan_scamster['heading'] ) ): ?>
					<h1> <?php echo esc_html( $loan_scamster['heading'] ); ?>  </h1>
                <?php endif; 
				if ( ! empty( $loan_scamster['subheading'] ) ): ?>
					<h2>  <?php echo esc_html( $loan_scamster['subheading'] ); ?> </h2>
                <?php endif; 
				if ( ! empty( $loan_scamster['description'] ) ): ?>
				<p>  <?php echo $loan_scamster['description']; ?> </p>
               	<?php endif; 
				if ( ! empty( $loan_scamster['videolink'] ) ): ?>
				<p class="clip"> <?php echo esc_html( $loan_scamster['videolabel'] ); ?> <i class="fas fa-play-circle video-btn" data-toggle="modal" data-src="<?php echo esc_html( $loan_scamster['videolink'] ); ?>" data-target="#myModal"></i> </p>
                <?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section id="lotterysection" class="sectionthree" style="background-image: url(https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/bg6.jpg);">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-12 sectionthree-images">
				<div class="wow bounceInDown alistair-img1" data-wow-delay="0.2s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s31.png" alt="FB Digital">
				</div>
                <div class="wow bounceInDown alistair-img2" data-wow-delay="0.5s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s32.png" alt="FB Digital">
				</div>
			</div>
            <div class="col-md-6 col-sm-12 sectionthree-content wow fadeInUp">
            	<?php $lottery_scamster = get_post_meta( get_the_ID(), 'lottery_scamster', true ); ?>
				<?php if ( ! empty( $lottery_scamster['heading'] ) ): ?>
					<h1> <?php echo esc_html( $lottery_scamster['heading'] ); ?>  </h1>
                <?php endif; 
				if ( ! empty( $lottery_scamster['subheading'] ) ): ?>
					<h2>  <?php echo esc_html( $lottery_scamster['subheading'] ); ?> </h2>
                <?php endif; 
				if ( ! empty( $lottery_scamster['description'] ) ): ?>
					<?php echo $lottery_scamster['description']; ?>
               	<?php endif; 
				if ( ! empty( $lottery_scamster['videolink'] ) ): ?>
                	<p class="clip"> <?php echo esc_html( $loan_scamster['videolabel'] ); ?> <i class="fas fa-play-circle video-btn" data-toggle="modal" data-src="<?php echo esc_html( $lottery_scamster['videolink'] ); ?>" data-target="#myModal"></i> </p>
                <?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section id="romanticsection" class="sectionfour" style="background-image: url(https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/bg8.jpg);">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-7 col-sm-12 sectionfour-images">
				<div class="wow bounceInDown ellen-img1" data-wow-delay="0.2s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s41.png" alt="FB Digital">
				</div>
                <div class="wow bounceInDown ellen-img2" data-wow-delay="0.4s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s42.png" alt="FB Digital">
				</div>
                <div class="wow bounceInDown ellen-img3" data-wow-delay="0.6s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s43.png" alt="FB Digital">
				</div>
			</div>
            <div class="col-md-5 col-sm-12 sectionfour-content wow fadeInUp">
            	<?php $romantic_scamster = get_post_meta( get_the_ID(), 'romantic_scamster', true ); ?>
				<?php if ( ! empty( $romantic_scamster['heading'] ) ): ?>
					<h1> <?php echo esc_html( $romantic_scamster['heading'] ); ?>  </h1>
                <?php endif; 
				if ( ! empty( $romantic_scamster['subheading'] ) ): ?>
					<h2>  <?php echo esc_html( $romantic_scamster['subheading'] ); ?> </h2>
                <?php endif; 
				if ( ! empty( $romantic_scamster['description'] ) ): ?>
					<?php echo $romantic_scamster['description']; ?>
               	<?php endif; 
				if ( ! empty( $romantic_scamster['videolink'] ) ): ?>
					<p class="clip"> <?php echo esc_html( $loan_scamster['videolabel'] ); ?> <i class="fas fa-play-circle video-btn" data-toggle="modal" data-src="<?php echo esc_html( $romantic_scamster['videolink'] ); ?>" data-target="#myModal"></i> </p>
                <?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section id="jobsection" class="sectionfive" style="background-image: url(https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/bg9.jpg);">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5 col-sm-12 sectionfive-content wow fadeInUp">
            	<?php $job_scamster = get_post_meta( get_the_ID(), 'job_scamster', true ); ?>
				<?php if ( ! empty( $job_scamster['heading'] ) ): ?>
					<h1> <?php echo esc_html( $job_scamster['heading'] ); ?>  </h1>
                <?php endif; 
				if ( ! empty( $job_scamster['subheading'] ) ): ?>
					<h2>  <?php echo esc_html( $job_scamster['subheading'] ); ?> </h2>
                <?php endif; 
				if ( ! empty( $job_scamster['description'] ) ): ?>
					<?php echo $job_scamster['description']; ?>
               	<?php endif; 
				if ( ! empty( $job_scamster['videolink'] ) ): ?>
                	<p class="clip"> <?php echo esc_html( $loan_scamster['videolabel'] ); ?> <i class="fas fa-play-circle video-btn" data-toggle="modal" data-src="<?php echo esc_html( $job_scamster['videolink'] ); ?>" data-target="#myModal"></i> </p>
                <?php endif; ?>
			</div>
            <div class="col-md-7 col-sm-12 sectionfive-images">
				<div class="wow bounceInDown robert-img1" data-wow-delay="0.2s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s51.png" alt="FB Digital">
				</div>
                <div class="wow bounceInDown robert-img2" data-wow-delay="0.4s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/s52.png" alt="FB Digital">
				</div>
			</div>
		</div>
	</div>
</section>
<section id="ecommercesection" class="sectionsix" style="background-image: url(https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/bg12.jpg);">
	<div class="container-fluid">
    	<div class="row">
			<div class="col-md-5 col-sm-12 sectionsix-content wow fadeInUp">
            	<?php $ecommerce_scamster = get_post_meta( get_the_ID(), 'ecommerce_scamster', true ); ?>
				<?php if ( ! empty( $ecommerce_scamster['heading'] ) ): ?>
					<h1> <?php echo esc_html( $ecommerce_scamster['heading'] ); ?>  </h1>
                <?php endif; 
				if ( ! empty( $ecommerce_scamster['subheading'] ) ): ?>
					<h2>  <?php echo esc_html( $ecommerce_scamster['subheading'] ); ?> </h2>
                <?php endif; 
				if ( ! empty( $ecommerce_scamster['description'] ) ): ?>
					<?php echo $ecommerce_scamster['description']; ?>
               	<?php endif; 
				if ( ! empty( $ecommerce_scamster['videolink'] ) ): ?>
					<p class="clip"> <?php echo esc_html( $loan_scamster['videolabel'] ); ?> <i class="fas fa-play-circle video-btn" data-toggle="modal" data-src="<?php echo esc_html( $ecommerce_scamster['videolink'] ); ?>" data-target="#myModal"></i> </p>
                <?php endif; ?>
			</div>
            <div class="col-md-7 col-sm-12">
				<div class="wow bounceInDown ron-img" data-wow-delay="0.4s">
                    <img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/7.png" alt="FB Digital">
                </div>
            </div>
        </div>
	</div>
</section>
<section class="sectionseven">
	<div class="container-fluid">
    	<div class="row">
			<div class="col-md-12 sectionseven-content">
            	<?php $all_scamster = get_post_meta( get_the_ID(), 'all_scamster', true ); ?>
				<?php if ( ! empty( $all_scamster['heading'] ) ): ?>
					<h1> <?php echo esc_html( $all_scamster['heading'] ); ?>  </h1>
                <?php endif; 
				if ( ! empty( $all_scamster['videolink'] ) ): ?>
				<p class="clip"> <?php echo esc_html( $loan_scamster['videolabel'] ); ?> <i class="fas fa-play video-btn" data-toggle="modal" data-src="<?php echo esc_html( $all_scamster['videolink'] ); ?>" data-target="#myModal"></i> </p>
                <?php endif; ?>
			</div>
            <div class="col-md-12 sectionseven-images">
				<div class="wow bounceInDown peopleall-img" data-wow-delay="0.2s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/FB_SC_015_V6_All_02.png" alt="FB Digital">
				</div>
                <div class="wow bounceInDown peopleall-img1" data-wow-delay="0.4s">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/FB_SC_015_V6_Dog_02.png" alt="FB Digital">
				</div>
			</div>
            <div class="col-md-12 doggif">
            <?php if ( ! empty( $all_scamster['gif'] ) ): 
					$bg = wp_get_attachment_url($all_scamster['gif']);
			?>
				<img src="<?php echo esc_url($bg) ?>" alt="FB Digital">
			<?php endif; ?>
            </div>
		</div>
	</div>
</section>

<?php
get_footer();
