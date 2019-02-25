<?php /*

	ACF Board Meeting List Element Template

*/ ?>

<?php 
	$date_now = date('Y-m-d H:i:s');
	$tomorrow = date("Y-m-d", time() + 86400);
	$yesterday = date("Y-m-d", time() - 86400);
	$year0 = date('Y');
	$year1 = date('Y', strtotime('-1 year'));
	$year2 = date('Y', strtotime('-2 year'));
	$year3 = date('Y', strtotime('-3 year'));
	$year4 = date('Y', strtotime('-4 year'));
?>

<?php
	$board_meeting_args = array(
		'posts_per_page'	=> -1,
		'post_type'			=> 'board_meetings',
		'meta_query' 		=> array(
			'relation' 			=> 'AND',
			array(
				'key'			=> 'meeting_date',
				'compare'		=> '>=',
				'value'			=> $tomorrow,
				'type'			=> 'DATETIME'
			)
		),
		'order'				=> 'ASC',
		'orderby'			=> 'meta_value',
		'meta_key'			=> 'meeting_date',
		'meta_type'			=> 'DATE'
	);
?>
<?php 	
	$board_meeting_query = new WP_Query( $board_meeting_args );
	if ( $board_meeting_query->have_posts() ) {
?>
	<h2 class="text-center upcoming-title">Upcoming Board Meetings</h2>
	<div class="row justify-content-center">
		<div class="board-meeting-list upcoming-meetings col-12 col-md-6">
			<?php while ( $board_meeting_query->have_posts() ) : $board_meeting_query->the_post();?>
				<div class="board-meeting">
					<h3><?php the_title(); ?></h3>
					<?php if( have_rows('meeting_documents') ): ?>
						<ul>
						<?php while ( have_rows('meeting_documents') ) : the_row();
							$docTitle = get_sub_field('document_title');
							$docFileID = get_sub_field('document_file');
							if( $docFileID ) {
								$docFileUrl = wp_get_attachment_url( $docFileID );					
							}; ?>

							<li class="meeting-doc"><a class="link-icon" href="<?= $docFileUrl; ?>" target="_blank"><?= $docTitle; ?></a></li>
							
						<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>

<?php }; ?>
<?php wp_reset_postdata(); ?>

<?php
	function meetingsPrevious($year){
?>

	<a class="year-title collapsed" data-toggle="collapse" href="#Collapse<?= $year; ?>" role="button" aria-expanded="false" aria-controls="Collapse<?php echo $year; ?>"><h2 class=""><?= $year; ?></h2></a>
	<?php
		$yearStart = $year.'-01-01 00:00:00';
		$yearEnd = $year.'-12-31 23:59:59';
		$old_board_meeting_args = array(
			'posts_per_page'	=> -1,
			'post_type'			=> 'board_meetings',
			'meta_query' 		=> array(
				'relation' 			=> 'AND',
				array(
					'key'			=> 'meeting_date',
					'compare'		=> '>=',
					'value'			=> $yearStart,
					'type'			=> 'DATETIME'
				),
				array(
					'key'			=> 'meeting_date',
					'compare'		=> '<=',
					'value'			=> date("Y-m-d", time() - 86400),
					'type'			=> 'DATETIME'
				)
			),
			'order'				=> 'DESC',
			'orderby'			=> 'meta_value',
			'meta_key'			=> 'meeting_date',
			'meta_type'			=> 'DATE'
		);
	?>
	<?php 	
		$old_board_meeting_query = new WP_Query( $old_board_meeting_args );
		if ( $old_board_meeting_query->have_posts() ) {
	?>
		<div class="collapse" id="Collapse<?= $year; ?>">
			<div class="board-meeting-list previous-meetings">

				<?php while ( $old_board_meeting_query->have_posts() ) : $old_board_meeting_query->the_post();?>
					<div class="board-meeting">
					<!-- <?php the_field('meeting_date'); ?> -->
						<h3><?php the_title(); ?></h3>
						<?php if( have_rows('meeting_documents') ): ?>
							<ul>
							<?php while ( have_rows('meeting_documents') ) : the_row();
								$docTitle = get_sub_field('document_title');
								$docFileID = get_sub_field('document_file');
								if( $docFileID ) {
									$docFileUrl = wp_get_attachment_url( $docFileID );					
								}; ?>

								<li class="meeting-doc"><a class="link-icon" href="<?= $docFileUrl; ?>" target="_blank"><?= $docTitle; ?></a></li>
								
							<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php }else{ ?>
		<div class="collapse" id="Collapse<?= $year; ?>">
			<div class="board-meeting-list previous-meetings">
				Sorry. No previous meetings for this year.
			</div>
		</div>
	<?php }; ?>
	<?php wp_reset_postdata(); ?>
<?php }; ?>

<?php
	function meetingsByYear($year){
?>

	<a class="year-title collapsed" data-toggle="collapse" href="#Collapse<?= $year; ?>" role="button" aria-expanded="false" aria-controls="Collapse<?php echo $year; ?>"><h2 class=""><?= $year; ?></h2></a>
	<?php
		$yearStart = $year.'-01-01 00:00:00';
		$yearEnd = $year.'-12-31 23:59:59';
		$old_board_meeting_args = array(
			'posts_per_page'	=> -1,
			'post_type'			=> 'board_meetings',
			'meta_query' 		=> array(
				'relation' 			=> 'AND',
				array(
					'key'			=> 'meeting_date',
					'compare'		=> '>=',
					'value'			=> $yearStart,
					'type'			=> 'DATETIME'
				),
				array(
					'key'			=> 'meeting_date',
					'compare'		=> '<=',
					'value'			=> $yearEnd,
					'type'			=> 'DATETIME'
				)
			),
			'order'				=> 'DESC',
			'orderby'			=> 'meta_value',
			'meta_key'			=> 'meeting_date',
			'meta_type'			=> 'DATE'
		);
	?>
	<?php 	
		$old_board_meeting_query = new WP_Query( $old_board_meeting_args );
		if ( $old_board_meeting_query->have_posts() ) {
	?>
		<div class="collapse" id="Collapse<?= $year; ?>">
			<div class="board-meeting-list previous-meetings">
				<?php while ( $old_board_meeting_query->have_posts() ) : $old_board_meeting_query->the_post();?>
					<div class="board-meeting">
					<!-- <?php the_field('meeting_date'); ?> -->
						<h3><?php the_title(); ?></h3>
						<?php if( have_rows('meeting_documents') ): ?>
							<ul>
							<?php while ( have_rows('meeting_documents') ) : the_row();
								$docTitle = get_sub_field('document_title');
								$docFileID = get_sub_field('document_file');
								if( $docFileID ) {
									$docFileUrl = wp_get_attachment_url( $docFileID );					
								}; ?>

								<li class="meeting-doc"><a class="link-icon" href="<?= $docFileUrl; ?>" target="_blank"><?= $docTitle; ?></a></li>
								
							<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php }; ?>
	<?php wp_reset_postdata(); ?>
<?php }; ?>

<h2 class="text-center previous-title">Previous Board Meetings</h2>
<div class="row justify-content-center">
	<div class="col-12 col-md-6 col-lg-5 meeting-list year1"><?php meetingsPrevious($year0); ?></div>
	<div class="col-12 col-md-6 col-lg-5 meeting-list year2"><?php meetingsByYear($year1); ?></div>
	<div class="col-12 col-md-6 col-lg-5 meeting-list year3"><?php meetingsByYear($year2); ?></div>
	<div class="col-12 col-md-6 col-lg-5 meeting-list year4"><?php meetingsByYear($year3); ?></div>
</div>
