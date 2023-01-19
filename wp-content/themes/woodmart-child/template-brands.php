<?php /* Template Name: برگه برند ها */ ?>
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 */

get_header(); ?>

<?php

	// Get content width and sidebar position
	$content_class = woodmart_get_content_class();

?>


<div class="site-content col-md-12  col-sm-12 col-xs-12" role="main">
    <div class="row">
<?php

$args = array(
    'taxonomy' => 'car_brand',
    'hide_empty' => false,
    'parent' => 0
);
$terms = get_terms($args);
foreach($terms as $term):
$link = get_term_link($term->term_id);
 $pic_term = get_term_meta($term->term_id,'pic_term',true);
?>
 <div class="col-lg-2  col-md-2  col-sm-6 col-xs-6 col-6"><article class="single_product shadow-sm">
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
