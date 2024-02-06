<?php
/*
Plugin Name: WP Featured Posts
Version: 1.0.0
Plugin URI: https://stargate.io
Description: For tagging posts as featured and customize display based on this data
Author: YongZhen Low
Author URI: https://stargate.io
*/

class WP_Featured_Posts {

	/**
	 * @var object
	 */
	private static $instance;

	/**
	 * Initialise the Fbiamdigital_Site_Plugin class.
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WP_Featured_Posts;
			self::$instance->setup();
		}

		return self::$instance;
	}

	private function setup() {
		/**
		 * Setup the callback for toggling featured posts
		 * and adding the featured column
		 */
		add_action( 'wp_ajax_wp-feature-post', array( $this, 'feature_post_callback' ) );
		add_action( 'admin_init', array( $this, 'init_featured_column' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'pre_get_posts', array( $this, 'orderby' ) );
	}

	/**
	 * Sets the filters and actions for the addition and content
	 */
	public function init_featured_column() {
		foreach ( $this->get_allowed_post_types() as $post_type ) {
			add_filter( 'manage_edit-' . $post_type . '_columns', array( $this, 'edit_post_type_columns', ) );
			add_filter( 'manage_edit-' . $post_type . '_sortable_columns', array( $this, 'edit_post_type_sortable_columns' ) );
			add_action( 'manage_' . $post_type . '_posts_custom_column', array( $this, 'custom_post_type_columns_content' ), 10, 2 );
		}
	}

	/**
	 * Adds a new column
	 *
	 * @param  array $existing_columns Array of existing columns
	 *
	 * @return array New columns
	 */
	function edit_post_type_columns( $existing_columns ) {
		if ( empty( $existing_columns ) && ! is_array( $existing_columns ) ) {
			$existing_columns = array();
		}

		$columns                  = array();
		$columns['wpfp-featured'] = esc_html__( 'Featured', 'wpfp' );

		return array_merge( $existing_columns, $columns );
	}

	/**
	 * Set column as sortable
	 *
	 * @param $columns
	 *
	 * @return mixed
	 */
	function edit_post_type_sortable_columns( $columns ) {
		$columns['wpfp-featured'] = 'wpfp-featured';

		return $columns;
	}

	/**
	 * @param WP_Query $query
	 */
	function orderby( $query ) {
		if ( ! is_admin() ) {
			return;
		}

		if ( $query->is_main_query() && is_post_type_archive( $this->get_allowed_post_types() ) && $query->get( 'orderby' ) === 'wpfp-featured'  ) {
			$query->set( 'meta_key', 'wpfp_featured' );
			$query->set( 'orderby', 'meta_value_num' );
		}
	}

	/**
	 * Adds the content for custom columns
	 *
	 * @param  string $column The id of current column
	 */
	public function custom_post_type_columns_content( $column_name, $post_id ) {
		if ( $column_name === 'wpfp-featured' ) {
			$url = wp_nonce_url( admin_url( 'admin-ajax.php?action=wp-feature-post&post_id=' . $post_id ), 'wpfp-update-post' );
			?>
			<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Toggle featured', 'wpfp' ); ?>">
				<span class="dashicons dashicons-star-<?php echo esc_attr( $this->is_featured( $post_id ) ? 'filled' : 'empty' ); ?>"></span>
			</a>
			<?php
		}
	}

	/**
	 * Enqueue plugin scripts
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'wpfp', plugins_url( 'assets/styles/wpfp-admin.css', __FILE__ ) );
	}

	/**
	 * Callback when clicking on featured button
	 */
	public function feature_post_callback() {
		if ( current_user_can( 'edit_posts' ) && check_admin_referer( 'wpfp-update-post' ) && ! empty( $_GET['post_id'] ) ) {
			$post_id = intval( $_GET['post_id'] );

			$allowed_post_types = $this->get_allowed_post_types();
			$post_type          = get_post_type( $post_id );

			if ( ! in_array( $post_type, $allowed_post_types, true ) ) {
				wp_die( esc_html__( 'Post type not allowed.', 'wpfp' ) );
			}

			if ( $this->is_featured( $post_id ) ) {
				update_post_meta( $post_id, 'wpfp_featured', 0 );
			} else {
				update_post_meta( $post_id, 'wpfp_featured', 1 );
			}
		}

		wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url() );
		exit();
	}

	/**
	 * Get allowed post types set by user.
	 * @return array Linear array of post type ids
	 */
	public function get_allowed_post_types() {
		return apply_filters( 'wpfp/allowed_post_types', array() );
	}

	/* Helper functions */
	/**
	 * Check if a post is featured
	 *
	 * @param  string/int  $post_id
	 *
	 * @return boolean
	 */
	public static function is_featured( $post_id ) {
		return 1 === (int) get_post_meta( $post_id, 'wpfp_featured', true );
	}
}

WP_Featured_Posts::init();