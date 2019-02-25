<?php /*

	ACFPE Slider Element Template

*/

	$eClass = get_sub_field('element_class');
	$uniqueID = 'eID-'.get_sub_field('unique_id');
	$sliderTheme = get_sub_field('slider_theme');
	$sliderEffect = get_sub_field('slider_effect');
	$randomSlide = get_sub_field('random_slide');
	$pauseDuration = get_sub_field('pause_duration');
	$showArrows = get_sub_field('show_navigation_arrows');
	$showControl = get_sub_field('show_navigation_controls');
?>

<section class="slider-wrapper clearfix theme-<?php echo $sliderTheme; ?> <?php echo $eClass; ?>" id="<?php echo $uniqueID; ?>">

	<div id="slider-<?php echo $uniqueID; ?>" class="carousel slide carousel-<?php echo $sliderEffect;?> carousel-theme-<?php echo $sliderTheme; ?>" data-ride="carousel">

		<!-- controls -->
		<?php if ($showControl === 'indicators') { ?>
			<ol class="carousel-indicators">
				<?php $i = 0;
					while(have_rows('slides')): the_row();
					$active = '';
					if($i == 0){$active = "active";};
				?>
					<li class="<?php echo $active; ?>" data-target="#slider-<?php echo $uniqueID; ?>" data-slide-to="<?php echo $i; ?>">
					</li>
					<?php $i++; ?>
				<?php endwhile; ?>
			</ol>
		<?php }; ?>

		<?php if ($showControl === 'thumbnails') { ?>
			<div class="carousel-thumbs">
			<ol >
				<?php $i = 0;
					while(have_rows('slides')): the_row();
					$slide_imageID = get_sub_field('slide_image');
					$thumb_image_src = wp_get_attachment_image_src($slide_imageID, 'slide_thumb');
					$active = '';
					if($i == 0){$active = "active";};
				?>
					<li class="<?php echo $randomSlide ? '' : $active; ?>" data-target="#slider-<?php echo $uniqueID; ?>" data-slide-to="<?php echo $i; ?>">
						<img src="<?php echo $thumb_image_src[0]; ?>"/>
					</li>
					<?php $i++; ?>
				<?php endwhile; ?>
			</ol>
			</div>
		<?php }; ?>

		<!-- Slides -->
		<div class="carousel-inner">

			<?php $n = 0;
				while(have_rows('slides')): the_row();
				$slide_title = get_sub_field('slide_title');
				$slide_title_slug = sanitize_title( $slide_title );
				$slide_content = get_sub_field('slide_content');
				$slide_imageID = get_sub_field('slide_image');
				$slide_link = get_sub_field('slide_link');
				$slide_url = get_sub_field('slide_url');
				$slide_link_text = get_sub_field('slide_link_text');
				$active = '';
				if($n == 0){$active = "active";};
				if($slide_imageID){
					$slide_image_src = wp_get_attachment_image_src($slide_imageID, 'page_banner');
					$slide_large_src = wp_get_attachment_image_src($slide_imageID, 'page_banner_large');
					$slide_mobile_src = wp_get_attachment_image_src($slide_imageID, 'page_banner_mobile');
					//$slide_thumb_src = wp_get_attachment_image_src($slide_imageID, 'slide_thumb');
				}; ?>

				<div class="carousel-item <?php echo $randomSlide ? '' : $active; ?>">

					<?php if($slide_link){?>
						<a href="<?php echo $slide_link;?>">

							<picture>
								<source srcset="<?php echo $slide_mobile_src[0]; ?>" media="(max-width: 991px)">
								<source srcset="<?php echo $slide_large_src[0]; ?>" media="(max-width: 1140px)">
								<img src="<?php echo $slide_image_src[0]; ?>" alt="slide image - <?php echo $slide_title; ?>">
							</picture>


						</a>
					<?php } else { ?>
						<picture>
							<source srcset="<?php echo $slide_mobile_src[0]; ?>" media="(max-width: 991px)">
							<source srcset="<?php echo $slide_large_src[0]; ?>" media="(max-width: 1140px)">
							<img src="<?php echo $slide_image_src[0]; ?>" alt="slide image - <?php echo $slide_title; ?>">
						</picture>
					<?php };?>

					<?php if($slide_title || $slide_content){ ?>
					<div id="<?php echo $slide_title_slug; ?>" class="carousel-caption">
						<?php if($slide_title){ ?><h3 class="slide-title text-center"><?php echo $slide_title; ?></h3><?php }; ?>
						<div class="slide-content"><?php echo $slide_content; ?></div>
						<?php if($slide_link){?><div class="text-center"><a class="btn btn-md btn-warning slide_link" href="<?php echo $slide_url; ?>"><?php echo $slide_link_text; ?> <i class="fa fa-chevron-right"></i></a></div><?php }; ?>
					</div>
					<?php };?>
				</div>

				<?php $n++;?>
			<?php endwhile; ?>
		</div>

		<!-- Controls -->

		<?php if ( $showArrows ){ ?>
			<a class="carousel-control-prev" href="#slider-<?php echo $uniqueID; ?>" role="button" data-slide="prev">
				<i class="fa fa-chevron-left fa-4x" aria-hidden="true"></i>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#slider-<?php echo $uniqueID; ?>" role="button" data-slide="next">
				<i class="fa fa-chevron-right fa-4x" aria-hidden="true"></i>
				<span class="sr-only">Next</span>
			</a>
		<?php }; ?>

	</div>

</section>

<script type="text/javascript">
	window.onload = function() {
		<?php if ( $randomSlide ) { ?>
			$('#slider-<?php echo $uniqueID; ?> .item').eq(Math.floor((Math.random() * $('.item').length))).addClass("active");
		<?php }; ?>
		$('#slider-<?php echo $uniqueID; ?>').carousel({
		  interval: <?php echo $pauseDuration; ?>
		});

	};
</script>

