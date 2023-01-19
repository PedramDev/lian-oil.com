<?php
define( 'LOGGER_PATH', __FILE__  );
define( 'LOGGER_DIR_PATH',__DIR__ );
require_once( dirname( __FILE__ ) . '/logger.php' );

require_once dirname( __FILE__ ) . '/cmb2/init.php';
require_once dirname( __FILE__ ) . '/cmb-functions.php';
require_once dirname( __FILE__ ) . '/car-search-filter.php';
add_action( 'wp_enqueue_scripts', 'wdc_enqueue_styles' );
function wdc_enqueue_styles() {
	$theme        = wp_get_theme();
	wp_enqueue_style( 'woodmart-child-theme', get_stylesheet_directory_uri() . '/assets/css/theme.css', [], $theme->get( 'Version' ) );
	wp_enqueue_script('ajax-script', get_stylesheet_directory_uri() . '/assets/js/theme.js', ['jquery'], $theme->get( 'Version' ), true);
	 wp_localize_script( 'ajax-script', 'search_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'admin_enqueue_scripts', 'wdc_enqueue_styles_admin' );
function wdc_enqueue_styles_admin() {
	$theme        = wp_get_theme();
	
	wp_enqueue_style( 'woodmart-child-select2', get_stylesheet_directory_uri() . '/assets/css/select2.min.css', [], $theme->get( 'Version' ) );
	wp_enqueue_style( 'woodmart-child-admin', get_stylesheet_directory_uri() . '/assets/css/admin.css', [], $theme->get( 'Version' ) );
	
	wp_enqueue_script('woodmart-child-select2', get_stylesheet_directory_uri() . '/assets/js/select2.min.js', [], $theme->get( 'Version' ), true);
	wp_enqueue_script('woodmart-child-admin', get_stylesheet_directory_uri() . '/assets/js/admin.js', ['jquery'], $theme->get( 'Version' ), true);
    wp_localize_script( 'woodmart-child-admin', 'wdc_object', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'ajax_nonce' => wp_create_nonce( 'admin-ajax' ),
    ]);

    
}

add_action( 'init', 'wdc_register_custom_post_type' );
function wdc_register_custom_post_type() {
	$args = array(
		'labels'             => [
        	'name'                  => 'خودرو‌ها',
        	'singular_name'         => 'خودرو',
        	'menu_name'             => 'خودرو‌ها',
        	'name_admin_bar'        => 'خودرو',
        	'add_new'               => 'افزودن جدید',
        	'add_new_item'          => 'افزودن خودرو جدید',
        	'new_item'              => 'خودروی جدید',
        	'edit_item'             => 'ویرایش خودرو',
        	'view_item'             => 'مشاهده خودرو',
        	'all_items'             => 'همه خودرو‌ها',
        	'search_items'          => 'جستجوی خودرو',
        	'parent_item_colon'     => __( 'Parent Books:', 'textdomain' ),
        	'not_found'             => 'خودروی یافت نشد.',
        	'not_found_in_trash'    => 'خودرویی در زباله دان یافت نشد.',
        	'featured_image'        => 'تصویر شاخص خودرو',
        	'set_featured_image'    => 'انتخاب تصویر شاخص',
        	'remove_featured_image' => 'حذف تصویر شاخص',
        	'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        	'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        	'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        	'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        	'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        	'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        	'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),    
	    ],
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => [
	        'slug' => 'car'    
	    ],
		'capability_type'    => 'post',
		'has_archive'        => 'cars',
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-car',
		'supports'           => [
		    'title',
		    'editor',
		    'author',
		    'thumbnail',
		    'excerpt',
	    ],
	);

	register_post_type( 'car', $args );
}

add_action( 'init', 'wdc_register_custom_taxonomies');
function wdc_register_custom_taxonomies() {
	$args = [
		'labels'            => [
    		'name'              => 'برند‌ها',
    		'singular_name'     => 'برند',
    		'search_items'      => 'جستجوی برند',
    		'all_items'         => 'تمام برند‌ها',
    		'parent_item'       => 'برند والد',
    		'parent_item_colon' => 'برند والد:',
    		'edit_item'         => 'ویرایش برند',
    		'update_item'       => 'بروزرسانی برند',
    		'add_new_item'      => 'افزودن برند جدید',
    		'new_item_name'     => 'New Genre Name',
    		'menu_name'         => 'برند‌ها',    
	    ],
		'hierarchical'      => true,
		
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
// 		'rewrite'           => [
// 		    'slug' => 'brand',    
// 	    ],
	];

	register_taxonomy( 'car_brand', 'car', $args );
}


/*this  for  brand  category  car   image*/
function car_brand_add_meta_box($taxonomy){
	?>
	<div class="form-field term-group">
		<label for="sec_term">تصویر</label>
		<input type="text button" name="pic_term">
	</div>
	<?php
}
add_action('car_brand_add_form_fields','car_brand_add_meta_box',10,1);

function car_brand_edit_meta_box($term,$taxonomy){
	$pic_term = get_term_meta($term->term_id,'pic_term',true);
	?>
	<tr class="form-field term-group-wrap">
	<th scope="row"><label for="sec_term">تصویر:</label></th>
		<td><input type="text" name="pic_term" value="<?php if(isset($pic_term))echo $pic_term;?>"></td>
</tr>
	<?php

}
add_action('car_brand_edit_form_fields','car_brand_edit_meta_box',10,2);

function save_car_brand_meta_box($term_id){
	
	if(isset($_POST['pic_term'])){
		$pic_term = sanitize_text_field($_POST['pic_term']);
		update_term_meta($term_id,'pic_term',$pic_term);
	}
}
add_action('created_car_brand','save_car_brand_meta_box',10,1);
add_action('edited_car_brand','save_car_brand_meta_box',10,1);
