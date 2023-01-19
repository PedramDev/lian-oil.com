<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


	<div class="website-wrapper">
		<?php if ( woodmart_needs_header() ) : ?>
			<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>
				<header <?php woodmart_get_header_classes(); // phpcs:ignore ?>>
					<?php whb_generate_header(); ?>
				</header>
			<?php endif ?>

		<?php endif ?>

<div class="page-title  page-title-default title-size-default title-design-centered color-scheme-light title-blog"
     style="">
    <div class="container">
        <h3 class="entry-title title"><?php the_title(); ?></h3>
        <?php  woocommerce_breadcrumb();?>
    </div>
</div>
<?php

	// Get content width and sidebar position
	$content_class = woodmart_get_content_class();

?>

<div class="container">
    <div class="row">
        <?php

        $args = array(
            'taxonomy' => 'car_brand',
            'hide_empty' => false,
            'parent' => 0
        );
        $terms = get_terms($args);
        foreach ($terms as $term):
            $link = get_term_link($term->term_id);
            $pic_term = get_term_meta($term->term_id, 'pic_term', true);
            ?>
            <div class="col-lg-2  col-md-2  col-sm-6 col-xs-6 col-6">
                <article class="single_product shadow-sm">
                    <figure>
                        <div class="product_thumb">
                            <a class="primary_img" href="<?php echo $link; ?>">
                                <img src="<?php echo $pic_term; ?>" alt="<?php echo $term->name; ?>">
                            </a>


                        </div>
                        <div class="product_content grid_content">
                            <div class="product_content_inner">
                                <a href="<?php echo $link; ?>"><?php echo $term->name; ?></a>

                            </div>

                        </div>
                    </figure>
                </article>
            </div>
        <?php
        endforeach;
        ?>
    </div>
   
</div><!-- .site-content -->
  




<?php get_footer(); ?>
