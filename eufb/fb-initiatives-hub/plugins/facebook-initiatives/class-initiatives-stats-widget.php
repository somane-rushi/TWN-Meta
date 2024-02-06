<?php
/**
 * Define the widget to use for the stats section
 * @package facebook-initiatives
 */

class Initiatives_Stats_Widget extends WP_Widget {

	// Set up the widget name and description.
	public function __construct() {
		$widget_options = array(
			'classname'   => 'facebook_initiatives_stats_widget',
			'description' => __( 'Add Stats to the homepage.', 'facebook-initiatives-plugin' ),
		);

		// Add image upload scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );

		// Create the widget
		parent::__construct( 'facebook_initiatives_stats_widget', __( 'Stat Widget', 'facebook-initiatives-plugin' ), $widget_options );

		// Create the sidebar
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name'          => __( 'Headline Stat Area', 'facebook-initiatives-plugin' ),
					'id'            => 'headline-stat-area',
					'description'   => __( 'This widget area show the single headline stat on the homepage.', 'facebook-initiatives-plugin' ),
					'before_widget' => 'stat--big',
				)
			);
			register_sidebar(
				array(
					'name'          => __( 'Stats Area', 'facebook-initiatives-plugin' ),
					'id'            => 'stats-area',
					'description'   => __( 'This widget area displays the stats on the homepage.', 'facebook-initiatives-plugin' ),
					'before_widget' => 'stat--small',
				)
			);
		}
	}

	// Display the widget
	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$value = ! empty( $instance['value'] ) ? $instance['value'] : '';
		$units = ! empty( $instance['units'] ) ? $instance['units'] : '';
		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		$citation_number = ! empty( $instance['citation_number'] ) ? $instance['citation_number'] : '';
		?>
		<div class="stat <?php echo esc_attr( $args['before_widget'] ); ?>" style="background-image:url(<?php echo esc_attr( $image ); ?>)">
			<h1 class="number"><?php echo esc_html( $value ); ?><?php echo esc_html( $units ); ?></h1>
			<h2 class="sub"><?php echo esc_html( $title ); ?> 
				<?php
				if ( '' !== $citation_number ) {
				?>
					<a href="#" class="stat__cite_link"><sup>[<?php echo esc_html( $citation_number ); ?>]</sup></a>
				<?php
				}
				?>
			</h2>
		</div>
		<?php
	}

	// Create the admin area widget settings form.
	// Create the custom fields for this page
	// Stat
	// 		Title
	// 		Value
	// 		Units
	// 		Background image
	// 		Citation Number (number to ref)
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$value = ! empty( $instance['value'] ) ? $instance['value'] : '';
		$units = ! empty( $instance['units'] ) ? $instance['units'] : '';
		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		$citation_number = ! empty( $instance['citation_number'] ) ? $instance['citation_number'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'facebook-initiatives-plugin' ); ?></label><br/>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'value' ) ); ?>"><?php esc_html_e( 'Value', 'facebook-initiatives-plugin' ); ?></label><br/>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'value' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'value' ) ); ?>" value="<?php echo esc_attr( $value ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'units' ) ); ?>"><?php esc_html_e( 'Units  (eg. M/Mil/Million)', 'facebook-initiatives-plugin' ); ?></label><br/>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'units' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'units' ) ); ?>" value="<?php echo esc_attr( $units ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image', 'facebook-initiatives-plugin' ); ?></label><br/>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
			<button class="upload_image_button button button-primary"><?php esc_html_e( 'Add Image', 'facebook-initiatives-plugin' ); ?></button>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'citation_number' ) ); ?>"><?php esc_html_e( 'Citation Number', 'facebook-initiatives-plugin' ); ?></label><br/>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'citation_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'citation_number' ) ); ?>" value="<?php echo esc_attr( $citation_number ); ?>" />
		</p>
		<?php
	}

	// Set up admin js for media uploader in widget
	public function scripts() {
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
		wp_enqueue_script( 'admin_widget_media_manager', plugin_dir_url( __FILE__ ) . 'assets/js/admin_widget_media_manager.js', array( 'jquery' ) );
	}

	// Apply settings to the widget instance.
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['value'] = strip_tags( $new_instance['value'] );
		$instance['units'] = strip_tags( $new_instance['units'] );
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
		$instance['citation_number'] = strip_tags( $new_instance['citation_number'] );
		return $instance;
	}

}

// Register the widget.
function register_facebook_initiatives_stats_widget() {
	register_widget( 'Initiatives_Stats_Widget' );
}
add_action( 'widgets_init', 'register_facebook_initiatives_stats_widget' );
