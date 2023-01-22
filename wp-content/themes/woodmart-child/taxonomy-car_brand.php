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
		<?php if (woodmart_needs_header()) : ?>
			<?php if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('header')) : ?>
				<header <?php woodmart_get_header_classes(); // phpcs:ignore 
						?>>
					<?php whb_generate_header(); ?>
				</header>
			<?php endif ?>

		<?php endif ?>

		<div class="page-title  page-title-default title-size-default title-design-centered color-scheme-light title-blog" style="">
			<div class="container">
				<h3 class="entry-title title"><?php the_title(); ?></h3>
				<?php woocommerce_breadcrumb(); ?>
			</div>
		</div>


		<?php

		// Get content width and sidebar position
		$content_class = woodmart_get_content_class();
        global $wp_query;
		?>

		<div class="container">
			<div class="row">
				<div class="site-content col-md-12  col-sm-12 col-xs-12" role="main">
					<div class="row">
						<?php
						if (have_posts()) :
							while (have_posts()) : the_post(); ?>
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
						endif; ?>
					</div>
				</div><!-- .site-content -->
			</div>
		</div>

		<?php get_footer(); ?>