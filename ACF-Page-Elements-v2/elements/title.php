<?php /*

	ACFPE Title Element Template

*/ ?>

<?php
	$eClass = get_sub_field('element_class');
	$uniqueID = 'eID-'.get_sub_field('unique_id');
	$sectionTitle = get_sub_field('title');
?>

<div class="p-element title_element clearfix <?php echo $eClass; ?>" id="<?php echo $uniqueID; ?>">

	<?php echo $sectionTitle; ?>

</div>