
<?php /*

	ACF Document List Element Template

*/ ?>

<?php
	$eClass= get_sub_field('element_class');
	$uniqueID = 'eID-'.get_sub_field('unique_id');
	$document_preview = get_sub_field('document_preview');
?>

<div class="p-element doclist-element <?php echo $eClass; ?>" id="<?php echo $uniqueID; ?>">

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">	
				<?php if($document_preview){?>
					<?php 
						$rows = get_sub_field('documents' ); // get all the rows
						$first_row = $rows[0]; // get the first row
						$doc_id = $first_row['document_file' ]; // get the sub field value 
						$doc_url = wp_get_attachment_url( $doc_id );
						$doc_ext = pathinfo($doc_url, PATHINFO_EXTENSION);
					?>
					<?php if($doc_ext == 'pdf') {?> 
						<div class="doc_preview intrinsic-container intrinsic-container-8x11">
						
							<!-- <iframe src="http://docs.google.com/gview?url=https://holtfarmersmarket.org/assets/files/HFM_POLICY_2015.pdf&embedded=true" frameborder="0"></iframe> -->
							<iframe src="http://docs.google.com/gview?url=<?php echo bloginfo('url') . $doc_url; ?>&embedded=true" frameborder="0"></iframe>
						</div>
					<?php } else { echo '<!-- ATTN: The first listed document is not a PDF. -->'; }; ?>
				<?php }; ?>
			</div>
		</div>
	</div>

	<?php if (have_rows('documents')):?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">	
				<?php while (have_rows('documents')): the_row();?>
					<?php
						$doc_id = get_sub_field('document_file');
						$doc_url = wp_get_attachment_url( $doc_id );
					?>
					<div class="document-row well">
						<a href="<?php echo $doc_url; ?>" title="<?php the_sub_field('document_title');?>"><h3 class="document_title"><?php the_sub_field('document_title');?></h3>
						</a>
						<div class="clearfix"></div>
						<?php if(get_sub_field('document_description')){?>
							<div class="document_description"><?php the_sub_field('document_description');?></div>
						<?php }; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>

	<?php endif; ?>

	<div class="clearfix"></div>



</div>