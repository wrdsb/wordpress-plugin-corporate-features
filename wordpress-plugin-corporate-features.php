<?php
/*
Plugin Name: wordpress-plugin-corporate-features
Description: This plugin adds Quick Links, Featured Items and Featured Video widgets.
Version: 1.0
Author: Charanpreet Singh
*/

// The widget class
class Corp_Featured_Item extends WP_Widget {

	// Main constructor
	public function __construct() {
		parent::__construct(
			'corp_Featured_Item',
			__( 'Corp Featured Item', 'text_domain' ),
			array(
				'customize_selective_refresh' => true,
			)
		);
		if ( is_active_widget() )
			add_action('admin_enqueue_scripts', array($this, 'mfc_assets'));
	}

	public function mfc_assets()
	{
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('corp-media-upload', plugin_dir_url(__FILE__) . 'corp-media-upload.js', array('jquery'));
		wp_enqueue_style('thickbox');
	}

	// The widget form (for the backend )
	public function form( $instance ) {
		// Set widget defaults
		$defaults = array(
			'image'    => '',
			'title'     => '',
			'link' => '',
		);
		
		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

		<?php // Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Caption:', 'text_domain' ); ?></label>
			<input class="widefat title" style="height:30px" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php // Link ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php _e( 'Link:', 'text_domain' ); ?></label>
			<input class="widefat" style="height:30px" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" value="<?php echo esc_attr( $link ); ?>" ?>
		</p>
		
		<p>
		<input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" class="regular-text">
		<input type="button" name="upload-btn-item" id="<?php echo esc_attr( $this->get_field_id( 'uploadBtn' ) ); ?>" class="button-secondary" value="Upload Image"></br></br>
		<img id="<?php echo esc_attr( $this->get_field_id( 'previewImage' ) ); ?>" style="max-width:250px; max-height:250px; height: auto; width: auto;" src="<?php echo esc_attr( $image ); ?>">
		</p>
		
	<?php }

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['image']    = isset( $new_instance['image'] ) ? wp_strip_all_tags( $new_instance['image'] ) : '';
		$instance['title']     = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['link'] = isset( $new_instance['link'] ) ? wp_kses_post( $new_instance['link'] ) : '';
		return $instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {

		extract( $args );

		// Check the widget options
		$image    = isset( $instance['image'] ) ? $instance['image']  : '';
		$title     = isset( $instance['title'] ) ? $instance['title'] : '';
		$link = isset( $instance['link'] ) ?$instance['link'] : '';
		if($image!='' && $title!="" && $link !=''){
			// WordPress core before_widget hook (always include )
		echo $before_widget;

		echo '<div class="item"><a href='.$link.' target="_blank" rel="noopener">
				<figure>
					<img src='.$image.' alt="Ontario School Screener Daily Screening Checklist" />
					<figurecaption><h3>'.$title.'</h3></figurecaption>
				</figure>
				</a></div>';

		// WordPress core after_widget hook (always include )
		echo $after_widget;
		}
		

	}

}

class Corp_Quick_Links extends WP_Widget {

	// Main constructor
	public function __construct() {
		parent::__construct(
			'Corp_Quick_Links',
			__( 'Corp Quick Links', 'text_domain' ),
			array(
				'customize_selective_refresh' => true,
			)
		);
	}

	// The widget form (for the backend )
	public function form( $instance ) {

		// Set widget defaults
		$defaults = array(
			'icon'    => '',
			'title'     => '',
			'link' => '',
		);
		
		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

		<?php // Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'text_domain' ); ?></label>
			<input class="widefat title" style="height:30px" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php // Link ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php _e( 'Link:', 'text_domain' ); ?></label>
			<input class="widefat" style="height:30px" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" value="<?php echo esc_attr( $link ); ?>" />
		</p>

		<?php // Image?>
		
		<p>
		<input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" class="regular-text">
		<input type="button" name="uploadBtn" class="uploadBtn" id="<?php echo esc_attr( $this->get_field_id( 'uploadBtn' ) ); ?>" class="button-secondary" value="Upload Image"></br></br>
		<img id="<?php echo esc_attr( $this->get_field_id( 'previewImage' ) ); ?>" style="max-width:250px; max-height:250px; height: auto; width: auto;" src="<?php echo esc_attr( $icon ); ?>">
		</p>
		
		
	<?php }

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['icon']    = isset( $new_instance['icon'] ) ? wp_strip_all_tags( $new_instance['icon'] ) : '';
		$instance['title']     = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['link'] = isset( $new_instance['link'] ) ? wp_kses_post( $new_instance['link'] ) : '';
		return $new_instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {

		extract( $args );

		// Check the widget options
		$icon    = isset( $instance['icon'] ) ? $instance['icon'] : '';;
		$title     = isset( $instance['title'] ) ? $instance['title'] : '';
		$link = isset( $instance['link'] ) ? $instance['link'] : '';
		if($icon!='' && $title!='' && $link!=''){
			// WordPress core before_widget hook (always include )
		echo $before_widget;
		// Display the widget
		echo '<div class="quicklink">
				<a href='.$link.'>
				<figure>
					<img src='.$icon.' alt="" />
					<figurecaption>'.$title.'</figurecaption>
				</figure>
				</a>
			 </div>';

		// WordPress core after_widget hook (always include )
		echo $after_widget;
		}
		

	}

}

class Corp_Featured_Video extends WP_Widget {

	// Main constructor
	public function __construct() {
		parent::__construct(
			'corp_Featured_Video',
			__( 'Corp Featured Video', 'text_domain' ),
			array(
				'customize_selective_refresh' => true,
			)
		);
	}

	// The widget form (for the backend )
	public function form( $instance ) {

		// Set widget defaults
		$defaults = array(
			'video'    => '',
			'title'     => '',
			'description' => '',
		);
		
		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

		<?php // Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'text_domain' ); ?></label>
			<input class="widefat title" style="height:30px" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php // Description ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Description:', 'text_domain' ); ?></label>
			<input class="widefat" style="height:30px" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" value="<?php echo esc_attr( $description ); ?>" ?>
		</p>

		<?php // Video ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'video' ) ); ?>"><?php _e( 'Video Link:', 'text_domain' ); ?></label>
			<input class="widefat" style="height:30px" id="<?php echo esc_attr( $this->get_field_id( 'video' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video' ) ); ?>" value="<?php echo esc_attr( $video ); ?>" ?>
		</p>
	<?php }

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['video']    = isset( $new_instance['video'] ) ? wp_strip_all_tags( $new_instance['video'] ) : '';
		$instance['title']     = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['description'] = isset( $new_instance['description'] ) ? wp_kses_post( $new_instance['description'] ) : '';
		return $instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {

		extract( $args );

		// Check the widget options
		$video    = isset( $instance['video'] ) ?  $instance['video'] : '';
		$title     = isset( $instance['title'] ) ? $instance['title'] : '';
		$description = isset( $instance['description'] ) ?$instance['description'] : '';
		if($video!='' && $title!='' && $description!=''){
			echo $before_widget;
			list($a,$url)=explode('=', $video);
			$embedUrl = "https://youtube.com/embed/".$url;
			if(strpos($video, 'embed')==true){
				$embedUrl=$video;
			}
			// Display the widget
			echo '<iframe style="margin-top: 8px;" width="100%" height="200" src='.$embedUrl.' frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	
				<h3>'.$title.'</h3>
	
				<p>'.$description.'</p>';
	
			// WordPress core after_widget hook (always include )
			echo $after_widget;
		}
	}

}

// Register the widget
function my_register_custom_widget() {
	register_widget( 'Corp_Featured_Item' );
	register_widget( 'Corp_Quick_Links' );
	register_widget( 'Corp_Featured_Video' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );
