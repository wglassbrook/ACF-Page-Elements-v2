<?php /*

	ACF Featured Content Element Template

*/ ?>

<?php
	$eClass = get_sub_field('element_class');
	$pTitle = get_sub_field('title');
	$subTitle = get_sub_field('sub_title');
	$uniqueID = 'eID-'.get_sub_field('unique_id');
	$imageID = get_sub_field('image');
	$cols = '';
	if($imageID){
		$cols=9;
	}else{
		$cols=12;
	};
	$image_mobile = wp_get_attachment_image_src( $imageID, 'block_thumb_landscape' );
	$image = wp_get_attachment_image_src( $imageID, 'block_thumb_square' );
	$imageLoc = get_sub_field('image_location');
	$push = '';
	$pull = '';
	if($imageLoc === 'right'){
		$push = 'col-sm-push-9';
		$pull = 'col-sm-pull-3';
	};
	$content = get_sub_field('content');
	$readmoreBol = get_sub_field('read_more');
	$readmoreURL = get_sub_field('read_more_url');
	$readmoreText = get_sub_field('read_more_text');
?>

<div class="row">
	<div class="p-element featured-content aligned-<?php echo $imageLoc; ?> clearfix <?php echo $eClass; ?>" id="<?php echo $uniqueID; ?>">
		<?php if($imageID) { ?>
			<div class="col-sm-3 <?php echo $push; ?> col-xs-12 f-image">
				<picture>
					<source srcset="<?php echo $image_mobile[0]; ?>" alt="Featured Image" media="(max-width: 768px)">
					<img src="<?php echo $image[0]; ?>" alt="Featured Image">
				</picture>

			</div>
		<?php }; ?>
		<div class="col-sm-<?php echo $cols.' '.$pull; ?>">
			<?php if ($pTitle){?>
				<h3 class="p-title"><?php echo $pTitle; ?></h3>
			<?php }; ?>
			<?php if($subTitle){?>
				<h4 class="sub-title"><?php echo $subTitle; ?></h4>
			<?php }; ?>
			<?php echo $content; ?>
			<?php if($readmoreBol){?>
				<div class="readmore">
					<a class="btn btn-default btn-sm" href="<?php echo $readmoreURL; ?>"><?php echo $readmoreText; ?>&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
