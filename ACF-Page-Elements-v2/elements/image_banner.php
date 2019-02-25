<?php /*

	ACF Image Banner Element Template

*/ ?>

<?php
	$eClass = get_sub_field('element_class');
	$uniqueID = 'eID-'.get_sub_field('unique_id');
	$banner_imageID = get_sub_field('banner_image');
	$banner_image_src = wp_get_attachment_image_src($banner_imageID, 'full');
	$banner_lg_src = wp_get_attachment_image_src($banner_imageID, 'large');
	$banner_sm_src = wp_get_attachment_image_src($banner_imageID, 'medium_large');
?>

<div class="p-element banner-image clearfix <?php echo $eClass; ?>" id="<?php echo $uniqueID; ?>">

	<picture>
		<source srcset="<?php echo $banner_sm_src[0]; ?>" media="(max-width: 991px)">
		<source srcset="<?php echo $banner_lg_src[0]; ?>" media="(max-width: 1140px)">
		<img src="<?php echo $banner_image_src[0]; ?>" alt="Banner Image">
	</picture>

</div>