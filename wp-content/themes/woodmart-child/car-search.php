<?php
/**
 * The main template file
 */

if( function_exists( 'woodmart_is_woo_ajax' ) && woodmart_is_woo_ajax() ) {
	do_action( 'woodmart_main_loop' );
	die();
}

get_header(); ?>

<?php 

	// Get content width and sidebar position
	$content_class = woodmart_get_content_class();

?>

<div class="site-content <?php echo esc_attr( $content_class ); ?>" role="main">

    <?php
        global $wp_query;

        $prefix = '';
        $taxonomy = 'car_brand';
        $post_type = 'car';

        // print_r($wp_query);
        if (isset($_GET['brand'])) {
            $brand = filter_input(INPUT_GET, 'brand', FILTER_SANITIZE_URL);
        }
        if (isset($_GET['model'])) {
            $model = filter_input(INPUT_GET, 'model', FILTER_SANITIZE_URL);
        }

        $term_id = $brand;
        if(isset($model) && !empty($model)){
            $term_id = $model;
        }
        else{
            $term_id = $brand;
        }

        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'tax_query' => array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                // 'operator' => 'EXISTS',
                // 'tag_id'=> array($term_id)
                'terms'    => array($term_id)
            )
        );

        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) :
            while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <div class="col-lg-3  col-md-4  col-sm-6 col-xs-6 col-6">
                    <article class="single_product shadow-sm">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="<?php the_permalink(); ?>">
                                    <img class="image-car" src="<?php the_post_thumbnail_url(''); ?>" alt="<?php the_title_attribute(); ?>">
                                </a>
                                <div class="label_product">
                                    <?php
                                    global $post;
                                    $terms = wp_get_post_terms($post->ID, 'car_brand');
                                    foreach ($terms as $term) :
                                    ?>
                                        <span class="label_sale"> <?php echo $term->name; ?></span>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>

                            </div>
                            <div class="product_content grid_content">
                                <div class="product_content_inner">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-danger btn-sm  btn-carts">مشاهده محصولات</a>
                                </div>

                            </div>
                        </figure>
                    </article>
                </div>
        <?php
            endwhile;
        endif;
        wp_reset_query();
    ?>

</div><!-- .site-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
