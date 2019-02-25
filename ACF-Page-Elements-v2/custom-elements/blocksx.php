<?php /*

	ACF Blocks Element Template

*/ ?>

<?php
	$eClass = get_sub_field('element_class');
	$uniqueID = 'eID-'.get_sub_field('unique_id');
	$cWidth = get_sub_field('content_width');
	$block_cols = get_sub_field('block_columns');
	$blocks_link = get_sub_field('blocks_link');
	$blocks_link_text = get_sub_field('blocks_link_text');
	$blocks_link_url = get_sub_field('blocks_link_url');
	$i = 0;
?>

<div class="p-element blocks-element clearfix <?php echo $eClass; ?>" id="<?php echo $uniqueID; ?>">

	<div class="container">
		<?php if(have_rows('block_items')): ?>

			<div class="row">
	
				<?php while(have_rows('block_items')): the_row();?>
					<?php
						$block_title = get_sub_field('block_title');
						$block_image_id = get_sub_field('block_image');
						$block_image_url = wp_get_attachment_image_src( $block_image_id, 'block_thumb' );
						$block_description = get_sub_field('block_description');
						$block_link = get_sub_field('block_link');
						$block_link_text = get_sub_field('block_link_text');
						$i++;
					?>

					<div class="blocks <?php echo $block_cols; ?>">

						<?php if(get_sub_field("image_as_background")){?>

							<style>
								#block-<?= $i; ?>{
									background: transparent url(<?php echo $block_image_url[0]; ?>);
								}

							</style>

							<?php if($block_link){?>
								<a id="block-<?= $i; ?>" class="image_block matchHeight" href="<?php echo $block_link; ?>" title="<?php echo $block_title; ?>">
							<?php }else{?>
								<div class="image_block matchHeight"  <?php if(get_sub_field("image_as_background")){?>style="background: transparent url('<?php echo $block_image_url[0]; ?>') no-repeat top center; background-size:100%; height:250px;" <?php }; ?>>
							<?php }; ?>

								
								<div class="p-content block_desc">
									<h3 class="p-title"><?php echo $block_title; ?></h3>
									<?php echo $block_description; ?>
								</div>

							<?php if($block_link){?>
								</a>
							<?php }else{; ?>
								</div>
							<?php }; ?>

						<?php }else{?>

							<div class="description_block matchHeight">

								<?php if($block_link){ ?>
									<a class="" href="<?php echo $block_link; ?>" title="<?php echo $block_title; ?>">
								<?php }; ?>
								<h3 class="p-titlex"><?php echo $block_title; ?></h3>
								<?php if($block_link){ ?>
									</a>
								<?php }; ?>

								<div class="p-content block_desc">
									<?php if(!get_sub_field("image_as_background")){?>
										<div class="block_img">
										<?php if($block_link){ ?>
											<a class="" href="<?php echo $block_link; ?>" title="<?php echo $block_title; ?>">
										<?php }; ?>
										<img src='<?php echo $block_image_url[0]; ?>' alt="block image" />
										<?php if($block_link){ ?>
											</a>
										<?php }; ?>
										</div>
									<?php }; ?>
									<?php echo $block_description; ?>
								</div>

								<?php if($block_link){?>
									<a class="btn btn-sm btn-info btn-block" href="<?php echo $block_link; ?>" title="<?php echo $block_title; ?>">
										<?php if($block_link_text){echo $block_link_text;}else{echo 'Read More';}; ?> <i class="fa fw fa-chevron-right"></i>
									</a>
								<?php }; ?>

							</div>

						<?php }; ?>

					</div>

				<?php endwhile; ?>
			</div>	
		
		<?php endif; ?>
		
		<?php if($blocks_link){ ?>

			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
					<a class="btn btn-ls btn-info btn-block" href="<?php echo $blocks_link_url; ?>"><?php echo $blocks_link_text; ?></a>
				</div>
			</div>

		<?php }; ?>

	</div>

	<div class="clearfix"></div>

</div>
