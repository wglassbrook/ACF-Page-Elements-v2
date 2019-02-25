<?php /*

	ACF Additional Content Element Template

*/ ?>

<?php
	$eClass = get_sub_field('element_class');
	$uniqueID = 'eID-'.get_sub_field('unique_id');
	$sectionContent = get_sub_field('content');
?>

<div class="p-element basic-content clearfix <?php echo $eClass; ?>" id="<?php echo $uniqueID; ?>">

	<?php echo $sectionContent; ?>

</div>