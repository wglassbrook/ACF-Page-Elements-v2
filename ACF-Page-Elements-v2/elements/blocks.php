<?php /*

	ACF Blocks Element Template

*/ ?>

<?php
	$eClass = get_sub_field('element_class');
	$uniqueID = 'eID-'.get_sub_field('unique_id');
	$cWidth = get_sub_field('condensed_width');
	$blocks_link = get_sub_field('blocks_link');
	$blocks_link_text = get_sub_field('blocks_link_text');
	$blocks_link_url = get_sub_field('blocks_link_url');
	$justify_blocks = get_sub_field('justify_blocks');
?>

<div class="p-element blocks_element clearfix <?= $eClass; ?>" id="<?= $uniqueID; ?>">

	<?php if(have_rows('block_items')): ?>
		<div class="row justify-content-<?= $justify_blocks; ?>">
		<?php $i = 0; while(have_rows('block_items')): the_row();?>
			<?php
				$block_class = get_sub_field('block_class');
				$block_title = get_sub_field('block_title');
				$block_column_width = get_sub_field('block_column_width');
				$block_background_type = get_sub_field('block_background_type');
				$block_background_color = get_sub_field('block_color');
				$block_background_image = get_sub_field('background_image');
				if($block_background_image){
					$block_background_image_url = wp_get_attachment_image_src( $block_background_image, 'block_thumb' );
				};

				$block_media = get_sub_field('block_media');
				if ($block_media === 'image'){
					$block_media_image = get_sub_field('block_media_image');
					$block_media_orientation = get_sub_field('block_media_image_orientation');
					if ($block_media_orientation === 'original'){
						$block_media_imageurl = wp_get_attachment_image_src( $block_media_image, 'full' );
					}else{
						$block_thumb_size = 'block_thumb_'.$block_media_orientation;
						$block_media_imageurl = wp_get_attachment_image_src( $block_media_image, $block_thumb_size );
					}
					
				}

				if( $block_media !== 'none') {
					$block_media_location = get_sub_field('block_media_location');
					if ( is_array($block_media_location) ) {
						$block_media_location = 'none';
					};
				}else{
					$block_media_location = 'none';
				};

				$block_media_video = get_sub_field('block_media_video');
				$block_media_audio = get_sub_field('block_media_audio');
				$block_media_audio_file = $block_media_audio['url'];

				$block_invert_text_color = false;
				if (get_sub_field('invert_text_color')) {
					$block_invert_text_color = get_sub_field('invert_text_color');
				};
			
				

				$block_description = get_sub_field('block_description');

				$block_link = get_sub_field('block_link');
				$block_link_text = get_sub_field('block_link_text');
				$block_link_style = get_sub_field('block_link_style');
				$block_link_external = get_sub_field('block_link_external');
				$i++;
			?>

			<style>
				#block_<?= $uniqueID . $i; ?>{
				<?php if($block_background_type === 'image'){?>
					background: transparent url('<?= $block_background_image_url[0]; ?>');
					background-repeat: no-repeat;
					background-size: cover;
					background-position: center;
				<?php }else if($block_background_type === 'color'){?>
					background-color: <?= $block_background_color; ?>;"
				<?php }; ?>
				}
			</style>

			<div class="block_column <?= $block_class; ?> <?= $block_column_width; ?>" id="block_<?= $uniqueID . $i; ?>">
				<div class="block block-<?= $block_media;?> block_bg_<?= $block_background_type; ?> <?= $block_invert_text_color ? 'color_invert' : ''; ?> media_location_<?= $block_media_location; ?> mb-6 mb-lg-0" >
					<?php if($block_title){?>
						<h3 class="block_title"><?= $block_title; ?></h3>
					<?php }; ?>

					<?php if($block_media_location != 'top'){?>
						<div class="block_description">
							<?= $block_description; ?>
						</div>
					<?php }; ?>
					<?php if($block_media === 'image'){ ?>
						<?php if($block_link){?>
							<a class="block_image_link" href="<?= $block_link; ?>" title="<?= $block_title; ?>" target="<?= $block_link_external ? '_blank' : '_top'; ?>">
						<?php }; ?>
						<img class="block_media_image" src="<?= $block_media_imageurl[0]; ?>"/>
						<?php if($block_link){?>
							</a>
						<?php }; ?>
					<?php }; ?>
					<?php if($block_media === 'video'){ ?>
						<div class="block-media-video embed-responsive embed-responsive-16by9">
							<?= $block_media_video; ?>
						</div>
					<?php }; ?>
					<?php if($block_media === 'audio'){ ?>
						<div class="block_media_audio">
						
							<audio preload="auto" controls id="audio_<?= $i; ?>">
								<source src="<?= $block_media_audio_file; ?>" type="audio/mp3"/>
								Your browser does not support the audio element. <a href="<?= $block_media_audio_file; ?>" title="mp3 audio file">Download</a>
							</audio>

							<script type="text/javascript">
								window.onload = function() {
									jQuery( 'audio' ).audioPlayer();
								};
							</script>

						</div>
					<?php }; ?>
					<?php if($block_media === 'map'){ ?>

						<?php
							global $mapScripts;
						   	$mapScripts = true;
							$location = get_sub_field('block_media_map');
							$mapheight = get_sub_field('block_media_map_height');;
							$mapID = 'map-'.get_sub_field('unique_id');
						?>

						<style>
						.map-element #map-<?php echo $mapID; ?>{
							height:<?php echo $mapheight;?>px;
						}
						</style>

						<div class="map-element">
							<div class="post-map acf-map" id="map-<?= $mapID; ?>">
								<div class="marker" data-lat="<?= $location['lat']; ?>" data-lng="<?= $location['lng']; ?>"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<?php if (get_sub_field('get_directions')):?>
							<?php
								$addr = $location['address'];
								$addr = str_replace(" ", "+", $addr);
							?>
							<a class="get-directions pull-rightx" href="http://maps.google.com/maps?f=d&hl=en&geocode=&daddr=<?= $addr; ?>" target="_blank">Get directions from Google Maps&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></a>
						<?php endif; ?>




					<?php }; ?>

					<?php if($block_media_location === 'top'){?>
						<div class="block_description">
							<?= $block_description; ?>
						</div>
					<?php }; ?>

					<?php if($block_link && $block_link_text){?><a class="clearfix block_link btn btn-sm <?= $block_link_style; ?>" href="<?= $block_link; ?>" title="<?= $block_title; ?>" target="<?= $block_link_external ? '_blank' : '_top'; ?>">
						<?= $block_link_text ? $block_link_text : 'Read More'; ?>
					</a><?php }; ?>

				</div>
			</div>

		<?php endwhile; ?>
		</div>

	<?php endif; ?>

	<div class="clearfix"></div>
</div>