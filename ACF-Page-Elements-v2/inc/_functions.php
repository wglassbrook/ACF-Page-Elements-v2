<?php // _functions.php

function acfps2_get_version() {
    $plugin_data = get_plugin_data( __FILE__ );
    $plugin_version = $plugin_data['Version'];
    return $plugin_version;
}

function acfps2_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values. $rgb[0] = red, $rgb[1] = green, $rgb[2} = blue 
}

function acfps2_contrastYIQ($hex){
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
	   $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	   $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	   $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
	   $r = hexdec(substr($hex,0,2));
	   $g = hexdec(substr($hex,2,2));
	   $b = hexdec(substr($hex,4,2));
	}
	$yiq = (($r*299)+($g*587)+($b*114))/1000;
	return ($yiq >= 128) ? 'black' : 'white';
}

function acfps2_get_element_file($filePath) {
	ob_start();
	include $filePath;
	$output = ob_get_clean();
	return $output;
}

function acfps2_append_to_content($content) {
	$acfps2_content = $content;

	if(have_rows('page_section')):
		$elementID = 0;
		while(have_rows('page_section')): the_row();

			if( get_sub_field('enable_section')):

				$elementID++;
				$elementIDstring = str_pad($elementID, 3, '0', STR_PAD_LEFT);
				$acfps2_content .= "<a id='page_section_" . $elementIDstring . "'></a>";

				// Get the Wrapper

				if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/elements_wrapper.php") ) {
					$openSection = (plugin_dir_path( __DIR__ ) . "custom-elements/elements_wrapper.php");
				} else {
					$openSection = (plugin_dir_path( __DIR__ ) . "elements/elements_wrapper.php");
				};
				$acfps2_content .= acfps2_get_element_file($openSection);

				if(have_rows('section_element')):
					
					// Loop through Sections in this Wrapper

					while (have_rows('section_element')):
						the_row();

						// Get this Sections width options
						$sectionWidths = get_sub_field('section_widths');
						// echo 'section widths array details:<br>';
						// print_r($sectionWidths);
						// echo '<br/>';
						$contentWidth = '';
						if(!is_array($sectionWidths['content_width'])) {
							$contentWidth = $sectionWidths['content_width'];
						}else{
							$contentWidth = $sectionWidths['content_width'][0];
						};
						$contentConstraint = '';
						if(!is_array($sectionWidths['content_constraint'])) {
							$contentConstraint = $sectionWidths['content_constraint'];
						}else{
							$contentConstraint = $sectionWidths['content_constraint'][0];
						};
						$acfps2_content .= '<div class="'.$contentWidth.'"><div class="row"><div class="'.$contentConstraint.'">';

						if(have_rows('element_type')):
							
							// Loop through Elements in this Section

							while (have_rows('element_type')):
								the_row();

								$layout = get_row_layout();

								$filePath = "";
								switch ($layout) {
									case "basic_content":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/basic_content.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/basic_content.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/basic_content.php");
										};
										break;
									case "blocks":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/blocks.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/blocks.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/blocks.php");
										};
										break;
									case "buttons":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/buttons.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/buttons.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/buttons.php");
										};
										break;
									case "columned_content":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/content_columns.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/content_columns.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/content_columns.php");
										};
										break;
									case "document_list":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/document_list.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/document_list.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/document_list.php");
										};
										break;
									case "faq_list":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/faq_list.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/faq_list.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/faq_list.php");
										};
										break;
									case "featured_content":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/featured_content.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/featured_content.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/featured_content.php");
										};
										break;
									case "gallery":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/gallery.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/gallery.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/gallery.php");
										};
										break;
									case "image_banner":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/image_banner.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/image_banner.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/image_banner.php");
										};
										break;
									case "map":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/map.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/map.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/map.php");
										};
										break;
									case "post_list":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/post_list.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/post_list.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/post_list.php");
										};
										break;
									case "project_list":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/project_list.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/project_list.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/project_list.php");
										};
										break;
									case "slider":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/slider.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/slider.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/slider.php");
										};
										break;
									case "title_element":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/title.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/title.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/title.php");
										};
										break;
									case "testimonials":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/testimonials.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/testimonials.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/testimonials.php");
										};
										break;
									case "board_members":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/board_members.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/board_members.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/board_members.php");
										};
										break;
									case "board_meetings":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/board_meetings.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/board_meetings.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/board_meetings.php");
										};
										break;
										case "elements_wrapper":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/elements_wrapper.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/elements_wrapper.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/elements_wrapper.php");
										};
										break;
									case "close_wrapper":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/close_wrapper.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/close_wrapper.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/close_wrapper.php");
										};
										break;
									case "jumbotron":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/jumbotron_wrapper.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/jumbotron_wrapper.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/jumbotron_wrapper.php");
										};
										break;
									case "close_jumbotron":
										if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/close_jumbotron.php") ) {
											$filePath = (plugin_dir_path( __DIR__ ) . "custom-elements/close_jumbotron.php");
										} else {
											$filePath = (plugin_dir_path( __DIR__ ) . "elements/close_jumbotron.php");
										};
										break;
								} // end switch

								$acfps2_content .= acfps2_get_element_file($filePath);
							endwhile;
						endif;

						$acfps2_content .= "</div></div></div>";


					endwhile;
				endif;

				if( file_exists( plugin_dir_path( __DIR__ ) . "custom-elements/close_wrapper.php") ) {
					$closeSection = (plugin_dir_path( __DIR__ ) . "custom-elements/close_wrapper.php");
				} else {
					$closeSection = (plugin_dir_path( __DIR__ ) . "elements/close_wrapper.php");
				};
				$acfps2_content .= acfps2_get_element_file($closeSection);
				//$acfps2_content .= 'Close Section <br/>';

			endif; // enable_section

		endwhile;

	endif;

	
	return $acfps2_content;
}

add_filter("the_content", "acfps2_append_to_content", 100);