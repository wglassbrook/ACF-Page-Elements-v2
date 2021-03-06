<?php /*

	ACF Buttons Element Template

*/ ?>

<?php
	$eClass = get_sub_field('element_class');
	$uniqueID = 'eID-'.get_sub_field('unique_id');
	$cols = get_sub_field('button_columns');
	switch ($cols){
		case 1:
			$cols_outer = "col-md-4 col-md-offset-4";
			$cols_inner = "col-xs-12";
			break;
		case 2:
			$cols_outer = "col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2";
			$cols_inner = "col-sm-6";
			break;
		case 3:
			$cols_outer = "col-xs-12";
			$cols_inner = "col-sm-4";
			break;
		case 4:
			$cols_outer = "col-xs-12";
			$cols_inner = "col-xs-12 col-sm-6 col-md-3";
			break;
		case 6:
			$cols_outer = "col-xs-12";
			$cols_inner = "col-xs-6 col-md-2";
			break;
		default:
			$cols_outer = "col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3";
			$cols_inner = "col-sm-6";
			break;
	};
?>

<div class="p-element buttons-element clearfix <?php echo $eClass; ?>" id="<?php echo $uniqueID; ?>">
	<div class="row justify-content-center">

			<?php while(have_rows('buttons')): the_row(); ?>

				<div style="margin-bottom:15px;" class="button <?php echo $cols_inner; ?>">
					<?php
						$button_text = get_sub_field('button_text');
						$button_url = get_sub_field('button_url');
						$button_style = get_sub_field('button_style');
						$button_size = get_sub_field('button_size');
					?>
					<a href="<?php echo $button_url; ?>" class="btn btn-block <?php echo $button_size; ?> <?php echo $button_style; ?>"><?php echo $button_text; ?></a>
				</div>

			<?php endwhile; ?>

	</div>
</div>