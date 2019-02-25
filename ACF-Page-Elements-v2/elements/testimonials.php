<?php /*

	ACF Testimonials Element Template

*/ ?>

<?php 
	$home_testimonials_args = array(
		'post_type' => 'testimonials',
		'posts_per_page' => 1,
		'orderby' => 'rand',
	);
?>
<?php 	
	$test_query = new WP_Query( $home_testimonials_args );
	if ( $test_query->have_posts() ) {
?>
	<div class="fp-testimonials">
		<h2 class="text-center">WHAT OUR CLIENTS SAY</h2>

		<?php while ( $test_query->have_posts() ) : $test_query->the_post();?>
			<div class="fp-testimonial">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	</div>
<?php }; ?>
<?php wp_reset_postdata(); ?>