<?php
/**
 * Define the widget to use for the footnotes section
 * @package facebook-initiatives
 */

class Footnote_Widget extends WP_Widget {

	// Set up the widget name and description.
	public function __construct() {
		$widget_options = array(
			'classname'   => 'facebook_initiatives_footnote_widget',
			'description' => __( 'Add footnotes to the footer', 'facebook-initiatives-plugin' ),
		);

		// Create the widget
		parent::__construct( 'facebook_initiatives_footnote_widget', __( 'Footnote', 'facebook-initiatives-plugin' ), $widget_options );

		// Create the sidebar
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name'          => __( 'Footnotes Area', 'facebook-initiatives-plugin' ),
					'id'            => 'footnotes-area',
					'description'   => __( 'This widget area displays the footnotes in the footer.', 'facebook-initiatives-plugin' ),
				)
			);
		}
	}

	// Display the widget
	public function widget( $args, $instance ) {
		$citation_number = ! empty( $instance['citation_number'] ) ? $instance['citation_number'] : '';
		$footnote = ! empty( $instance['footnote'] ) ? $instance['footnote'] : '';
		?>

		<p class="footnote">
			<sup>[<?php echo esc_html( $citation_number ); ?>]</sup>
			<?php echo esc_html( $footnote ); ?>
		</p>

		<?php
	}

	public function form( $instance ) {
		$citation_number = ! empty( $instance['citation_number'] ) ? $instance['citation_number'] : '';
		$footnote = ! empty( $instance['footnote'] ) ? $instance['footnote'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'citation_number' ) ); ?>"><?php esc_html_e( 'Citation Number', 'facebook-initiatives-plugin' ); ?></label><br/>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'citation_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'citation_number' ) ); ?>" value="<?php echo esc_attr( $citation_number ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'footnote' ) ); ?>"><?php esc_html_e( 'Footnote', 'facebook-initiatives-plugin' ); ?></label><br/>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'footnote' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'footnote' ) ); ?>" style="width:100%"><?php echo esc_html( $footnote ); ?></textarea>
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
		$instance['citation_number'] = strip_tags( $new_instance['citation_number'] );
		$instance['footnote'] = strip_tags( $new_instance['footnote'] );
		return $instance;
	}

}

// Register the widget.
function register_facebook_initiatives_footnotes_widget() {
	register_widget( 'Footnote_Widget' );
}
add_action( 'widgets_init', 'register_facebook_initiatives_footnotes_widget' );
