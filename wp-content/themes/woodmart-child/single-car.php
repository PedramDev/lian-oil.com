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


<div class="site-content col-md-12  col-sm-12 col-xs-12" role="main">

    <?php
    if (have_posts()):
        while (have_posts()): the_post(); ?>
            <section class="section p-t-100 p-b-80">
                <div class="container">
                    <article class="blog-detail-1">
                        <header class="entry-header text-right">
                            <h2 class="entry-title"><?php the_title(); ?></h2>
                        </header>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>

                </div>
            </section>
        <?php
        endwhile;
    endif; ?>

</div><!-- .site-content -->


<?php get_footer(); ?>
