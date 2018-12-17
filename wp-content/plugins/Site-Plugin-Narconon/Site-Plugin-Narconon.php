<?php
/*
Plugin Name: Site Plugin Narconon Sites
Description: Site specific code changes for Narconon Sites
*/
/* Start Adding Functions Below this Line */
//Disable File Editor in theme
define('DISALLOW_FILE_EDIT', true);

// prevent direct access
defined( 'ABSPATH' ) || exit;

// register Social_Phone_Widget
add_action( 'widgets_init', function(){
	register_widget( 'Social_Phone_Widget' );
});

class Social_Phone_Widget extends WP_Widget {
	// class constructor
	public function __construct() {
	$widget_ops = array(
		'classname' => 'social_phone_widget',
		'description' => 'A plugin to display phone and social media links',
	);
	parent::__construct( 'social_phone_widget', 'Social Links and Phone Number', $widget_ops );
	}

	// output the widget content on the front-end
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
        ?>
      <ul class="social-icons">
      <?php
        if ( ! empty( $instance['facebook'] ) ) {
          	?>
	    <li>
          <a href="<?php echo $instance['facebook'];?>" target='blank'>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook.png" alt="Facebook" />
        </a>
          </li>
     		<?php
  		}
        if ( ! empty( $instance['twitter'] ) ) {
          	?>
          <li>
	    <a href="<?php echo $instance['twitter'];?>" target='blank'>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter.png" alt="Twitter" />
        </a>
          </li>
     		<?php
  		}
        if ( ! empty( $instance['gplus'] ) ) {
          	?>
          <li>
	    <a href="<?php echo $instance['gplus'];?>" target='blank'>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/gplus.png" alt="Google Plus" />
        </a>
          </li>
     		<?php
  		}
        if ( ! empty( $instance['instagram'] ) ) {
          	?>
          <li>
	    <a href="<?php echo $instance['instagram'];?>" target='blank'>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/instagram.png" alt="Instagram" />
        </a>
          </li>
     		<?php
  		}
        if ( ! empty( $instance['linkedin'] ) ) {
          	?>
          <li>
	    <a href="<?php echo $instance['linkedin'];?>" target='blank'>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/linkedin.png" alt="LinkedIn" />
        </a>
          </li>
     		<?php
  		}
        if ( ! empty( $instance['pinterest'] ) ) {
          	?>
          <li>
	    <a href="<?php echo $instance['pinterest'];?>" target='blank'>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/pinterest.png" alt="Pinterest" />
        </a>
          </li>
     		<?php
  		}
       if ( ! empty( $instance['youtube'] ) ) {
          	?>
         <li>
	    <a href="<?php echo $instance['youtube'];?>" target='blank'>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/youtube.png" alt="YouTube" />
        </a>
         </li>
     		<?php
  		}
        ?>
        </ul>
        <?php
         	 	if ( ! empty( $instance['phone'] ) ) {
        ?>

          <a class="banner-floater phone hidden-xs autofill-phone-number-href michroma" href="tel:<?php echo $instance['clickphone'];?>">
            <span class="small-call michroma">CALL</span>
            <span dir="ltr" class="autofill-phone-number michroma"><?php echo $instance['phone'];?> </span>
            <div class="small-call available-24hours michroma">AVAILABLE 24 HOURS A DAY, 7&nbsp;DAYS&nbsp;A&nbsp;WEEK</div>
       	  </a>
          <a class="banner-floater michroma get-help-link double-bracket-after hidden-xs" href="/get-help/now.html">Get Help Now</a>



         <?php

  		}



		echo $args['after_widget'];
		}

	// output the option form field in admin Widgets screen
	public function form( $instance ) {
    $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : esc_html__( '', 'text_domain' );
    $clickphone = ! empty( $instance['clickphone'] ) ? $instance['clickphone'] : esc_html__( 'ex. +18005555555', 'text_domain' );
    $facebook = ! empty( $instance['facebook'] ) ? $instance['facebook'] : esc_html__( '', 'text_domain' );
    $twitter = ! empty( $instance['twitter'] ) ? $instance['twitter'] : esc_html__( '', 'text_domain' );
    $gplus = ! empty( $instance['gplus'] ) ? $instance['gplus'] : esc_html__( '', 'text_domain' );
    $instagram = ! empty( $instance['instagram'] ) ? $instance['instagram'] : esc_html__( '', 'text_domain' );
    $linkedin = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : esc_html__( '', 'text_domain' );
    $pinterest = ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : esc_html__( '', 'text_domain' );
    $youtube = ! empty( $instance['youtube'] ) ? $instance['youtube'] : esc_html__( '', 'text_domain' );
	?>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>">
	<?php esc_attr_e( 'Phone:', 'text_domain' ); ?>
	</label>
      	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $phone ); ?>">
      </p>
     <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'clickphone' ) ); ?>">
	<?php esc_attr_e( 'Click To Call:', 'text_domain' ); ?>
	</label>
      	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'clickphone' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'clickphone' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $clickphone ); ?>">
      </p>
       <p>
    	<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">
		<?php esc_attr_e( 'Facebook URL:', 'text_domain' ); ?>
		</label>
      	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $facebook ); ?>">
      </p>
       <p>
    	<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">
		<?php esc_attr_e( 'Twitter URL:', 'text_domain' ); ?>
		</label>
      	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $twitter ); ?>">
      </p>
       <p>
    	<label for="<?php echo esc_attr( $this->get_field_id( 'gplus' ) ); ?>">
		<?php esc_attr_e( 'Google Plus URL:', 'text_domain' ); ?>
		</label>
      	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'gplus' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'gplus' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $gplus ); ?>">
      </p>
        <p>
    	<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>">
		<?php esc_attr_e( 'Instagram URL:', 'text_domain' ); ?>
		</label>
      	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $instagram ); ?>">
      </p>
         <p>
    	<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>">
		<?php esc_attr_e( 'Linkedin URL:', 'text_domain' ); ?>
		</label>
      	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $linkedin ); ?>">
      </p>
         <p>
    	<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>">
		<?php esc_attr_e( 'Pinterest URL:', 'text_domain' ); ?>
		</label>
      	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $pinterest ); ?>">
      </p>
         <p>
    	<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>">
		<?php esc_attr_e( 'YouTube URL:', 'text_domain' ); ?>
		</label>
      	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $youtube ); ?>">
      </p>
	<?php
	}

	// save options
    public function update( $new_instance, $old_instance ) {
	$instance = array();
    $instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
    $instance['clickphone'] = ( ! empty( $new_instance['clickphone'] ) ) ? strip_tags( $new_instance['clickphone'] ) : '';
    $instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
    $instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
    $instance['gplus'] = ( ! empty( $new_instance['gplus'] ) ) ? strip_tags( $new_instance['gplus'] ) : '';
	$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
    $instance['linkedin'] = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
    $instance['pinterest'] = ( ! empty( $new_instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : '';
    $instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';

	return $instance;
}
};
//Enqueue stylesheet for plugin.
function narconon_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style', $plugin_url . 'css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'narconon_load_plugin_css' );

function wpb_list_child_pages() {

global $post;

$childpages = wp_list_pages( 'title_li=&child_of='.$post->ID.'&echo=0' );

if ( $childpages ) {

    $string = '<ul>' . $childpages . '</ul>';
}

return $string;

}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');

// Add in code for widget in menu
/**
 * The current version
 *
 * @since 0.1.0
 */
define( 'YAWP_WIM_VERSION', '1.0.0' );
/**
 * Filters the prefix used in class/id attributes in html display.
 *
 * @since 0.1.0
 *
 * @param string $default_prefix The default prefix: 'yawp_wim'
 */
$attr_prefix = apply_filters( 'yawp_wim_attribute_prefix', 'yawp_wim' );
/**
 *
 * A string prefix for internal names and ids
 *
 * @since 0.1.0
 */
define( 'YAWP_WIM_PREFIX', $attr_prefix );
/**
 * Plugin's file path
 *
 * @since 0.1.0
 */
define( 'YAWP_WIM_PATH', plugin_dir_path( __FILE__ ) );
/**
 * Plugin's url path
 *
 * @since 0.1.0
 */
define( 'YAWP_WIM_URL', plugin_dir_url( __FILE__ ) );
/**
 * Include main plugin class
 *
 * @since 0.1.0
 */
include_once YAWP_WIM_PATH . 'classes/class-yawp-wim.php';
/**
 * Include walker class to override menu walker
 *
 * @since 0.1.0
 */
include_once YAWP_WIM_PATH . 'classes/class-yawp-wim-walker.php';
$yawp_wim = new YAWP_WIM();
$yawp_wim->hook();
$yawp_wim_walker = new YAWP_WIM_Walker();
$yawp_wim_walker->hook();



// Adds support for editor color palette.
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Light gray', 'genesis-sample' ),
		'slug'  => 'light-gray',
		'color'	=> '#f5f5f5',
	),
	array(
		'name'  => __( 'Medium gray', 'genesis-sample' ),
		'slug'  => 'medium-gray',
		'color' => '#999',
	),
	array(
		'name'  => __( 'Dark gray', 'genesis-sample' ),
		'slug'  => 'dark-gray',
		'color' => '#333',
       ),
) );
// Adds support for editor font sizes.
add_theme_support( 'editor-font-sizes', array(
	array(
		'name'      => __( 'small', 'genesis-sample' ),
		'shortName' => __( 'S', 'genesis-sample' ),
		'size'      => 12,
		'slug'      => 'small'
	),
	array(
		'name'      => __( 'regular', 'genesis-sample' ),
		'shortName' => __( 'M', 'genesis-sample' ),
		'size'      => 16,
		'slug'      => 'regular'
	),
	array(
		'name'      => __( 'large', 'genesis-sample' ),
		'shortName' => __( 'L', 'genesis-sample' ),
		'size'      => 20,
		'slug'      => 'large'
	),
	array(
		'name'      => __( 'larger', 'genesis-sample' ),
		'shortName' => __( 'XL', 'genesis-sample' ),
		'size'      => 24,
		'slug'      => 'larger'
	)
) );
?>
