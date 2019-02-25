<?php /*

	ACF Board Members List Element Template

*/ ?>

<?php 
	$home_testimonials_args = array(
		'post_type' => 'board_members',
		'posts_per_page' => -1,
		'orderby' => 'menun_order',
		'order' => 'ASC',
	);

	$num = 0;
?>
<?php 	
	$test_query = new WP_Query( $home_testimonials_args );
	if ( $test_query->have_posts() ) {
?>
	<div class="board_member_list row justify-center">
		<?php 
			while ( $test_query->have_posts() ) : $test_query->the_post();
			$num++;
		?>
			<div class="col-12 col-md-6 col-lg-6 board_member">
				<h3 class="board_member_name"><?php the_title(); ?></h3>
				<p><strong class="text-info"><?php the_field('member_title'); ?></strong><br/>
					<?php if ( get_the_content() ){ ?>
						<a href="#" class="member-more" data-toggle="modal" data-target="#memberModal-<?= $num; ?>">Member Bio<i class="fa fa-fw fa-chevron-right"></i></a>
					<?php }; ?>
				</p>
			</div>

			<div class="modal fade" id="memberModal-<?= $num; ?>" tabindex="-1" role="dialog" aria-labelledby="memberModal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><?php the_title(); ?></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<h5><?php the_field('member_title'); ?></h5>
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('', array('class' => 'alignleft member-thumb'));
						}; ?>
						<?php the_content(); ?>
					</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
<?php }; ?>
<?php wp_reset_postdata(); ?>