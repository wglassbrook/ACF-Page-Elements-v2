<?php /*

	ACFPE Elements Wrapper Template

*/ ?>

<?php
	$uniqueID = get_sub_field('unique_id');
	$wrapperClass = get_sub_field('wrapper_class');
	$bgWidth = get_sub_field('background_width');
	$backgroundType = get_sub_field('background_type');
	$backgroundColor = 'rgba(0,0,0,0)';

	if(get_sub_field('enable_jumbotron')){
		$elementType = 'jumbo';
		$jumboScale = get_sub_field('jumbotron_scale');
		$jumboScalemobile = $jumboScale - 15;
		$topPadding = '';
		$bottomPadding = '';
	} else {
		$elementType = 'element';
		$padding = get_sub_field('padding');
		$rightPadding = $padding['right_padding'];
		$leftPadding = $padding['left_padding'];
		if($padding){
			$topPadding = $padding['top_padding'];
			$bottomPadding = $padding['bottom_padding'];
		};
		
	};

	if($backgroundType == 'image') {

	};
	if($backgroundType == 'video') {
		$videoOptions = get_sub_field('video_options');
		$backgroundVideo = $videoOptions['background_video'];
	};
	if($backgroundType == 'image' || 'video'){
		$backgroundOptions = get_sub_field('background_options');
		$backgroundImageID = $backgroundOptions['background_image'];
		if($backgroundImageID){
			$backgroundImage = wp_get_attachment_image_src($backgroundImageID, 'full');
		};
		$backgroundLayout = get_sub_field('background_layout');
		$backgroundPlacement = $backgroundLayout['background_placement'];
		$backgroundPosition = $backgroundLayout['background_position'];
		$backgroundRepeat = $backgroundLayout['background_repeat'];
	};
	if($backgroundType == 'color'){
		$backgroundColor = 'transparent';
		$backgroundOptions = get_sub_field('background_options');
		if($backgroundOptions['background_color']){
			$backgroundColor = $backgroundOptions['background_color'];
		};
	};

	$overlayOptions = get_sub_field('overlay_options');
	$opaque = $overlayOptions['enable_color_overlay'];
	$opaqueHex = $overlayOptions['opaque_overlay_color'];
	$opaqueRGB = acfps2_hex2rgb($opaqueHex);
	$opaqueAmount = $overlayOptions['opacity_amount'];

	$sectionTextOptions = get_sub_field('section_text_options');
	$hl_color = $sectionTextOptions['headline_color'];
	$text_color = $sectionTextOptions['text_color'];
	
	$downArrow = get_sub_field('down_arrow');	
?>
<!-- ACFPS Section Wrapper Dynamic Styles -->
<style>
	
	#wrap-<?php echo $uniqueID; ?>.<?php echo $elementType; ?>-outer{
		<?php if( get_sub_field('enable_jumbotron') ){
			echo 'height:'.$jumboScalemobile.'vh;';
		};?>
		<?php if( $backgroundPlacement !== 'parallax' ){?>
			background-color:<?php echo $backgroundColor; ?>;
			background-image:url('<?php echo $backgroundImage[0]; ?>');
			background-attachment: <?php echo $backgroundPlacement === 'fixed' ? 'fixed' : 'scroll' ; ?>;
			<?php if($backgroundPosition === 'cover'){?>
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $backgroundImage[0]; ?>', sizingMethod='scale');
				-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $backgroundImage[0]; ?>', sizingMethod='scale')";
				background-repeat: no-repeat;
				background-position: center center;
			<?php } else{ ?>
				background-repeat: <?php echo $backgroundRepeat; ?>;
				background-position: <?php echo $backgroundPosition; ?>;
			<?php }; ?>
			color: <?php echo $text_color; ?>;
		<?php }; ?>
	}
	
	@media only screen and (min-width: 768px) {
		#wrap-<?php echo $uniqueID; ?>.<?php echo $elementType; ?>-outer{
			<?php if( get_field('enable_jumbotron') ){
				echo 'height:'.$jumboScale.'vh;';
			};?>
		}
	}
	
	#wrap-<?php echo $uniqueID; ?> .<?php echo $elementType; ?>-middle{
		<?php if($opaque){?>
			background-color:rgba(<?php echo $opaqueRGB[0]; ?>,<?php echo $opaqueRGB[1]; ?>,<?php echo $opaqueRGB[2]; ?>,0.<?php echo $opaqueAmount; ?>);
		<?php };?>
	}
	
	#wrap-<?php echo $uniqueID; ?> .<?php echo $elementType; ?>-inner .title{
		color: <?php echo $hl_color; ?>;
	}
	
	#wrap-<?php echo $uniqueID; ?> .<?php echo $elementType; ?>-inner{
		color: <?php echo $text_color; ?>;
	}

</style>


<!-- ACFPS Section Wrapper -->
<?php switch ($backgroundType) { ?>
<?php case 'none': ?>

	<div class="<?php echo $elementType; ?>-outer <?php echo $backgroundType; ?> <?php echo $bgWidth; ?> <?php echo $wrapperClass; ?> clearfix" id="wrap-<?php echo $uniqueID; ?>">
		<?php if($downArrow){?>
			<div class="toscroll"><a class="scroll-down" id="down-<?php echo $uniqueID; ?>" href="#down-<?php echo $uniqueID; ?>"><span class="glyphicon glyphicon-menu-down"></span></a></div>
		<?php }; ?>
		<div class="<?php echo $elementType; ?>-middle ">
			<div class="<?php echo $elementType; ?>-inner <?php echo $topPadding; ?> <?php echo $bottomPadding; ?>">

<?php break; ?>
<?php case "image": ?>

	<div class="<?php echo $elementType; ?>-outer <?php echo $backgroundType; ?> <?php echo $bgWidth; ?> <?php echo $wrapperClass; ?> clearfix" id="wrap-<?php echo $uniqueID; ?>" >
		<?php if($downArrow){?>
			<div class="toscroll"><a class="scroll-down" id="down-<?php echo $uniqueID; ?>" href="#down-<?php echo $uniqueID; ?>"><span class="glyphicon glyphicon-menu-down"></span></a></div>
		<?php }; ?>
		<div class="<?php echo $elementType; ?>-middle <?php echo $backgroundPlacement === 'parallax' ? 'parallax-window' : ''; ?>" <?php echo $backgroundPlacement === 'parallax' ? 'data-parallax="scroll" data-image-src="' . $backgroundImage[0] . '"' : ''; ?>>
			<div class="<?php echo $elementType; ?>-inner <?php echo $topPadding; ?> <?php echo $bottomPadding; ?>">

<?php break; ?>
<?php case "video": ?>

	<?php
		global $ytScript;
		$ytScript = true;

		$opaque = get_sub_field('enable_color_overlay');
		if($videoOptions['mute_video']){
			$mute = 'true';
		}else{
			$mute = 'false';
		};
		if($videoOptions['loop_video']){
			$loop = 'true';
		}else{
			$loop = 'false';
		};
		$video_start = $videoOptions['start_video_at'];
	?>

	<script>
		window.onload = function(){
			jQuery('.player').YTPlayer();
		}
	</script>

	<div class="<?php echo $elementType; ?>-outer <?php echo $backgroundType; ?> <?php echo $bgWidth; ?> <?php echo $wrapperClass; ?> clearfix" id="wrap-<?php echo $uniqueID; ?>">
		<div id="videoElement-<?php echo $uniqueID; ?>" class="player videoElement" data-property="{videoURL:'<?php echo $backgroundVideo; ?>',containment:'#videoElement-<?php echo $uniqueID; ?>', showControls:false, showYTLogo: false, autoPlay:true, loop:<?php echo $loop; ?>, mute:<?php echo $mute; ?>, startAt:<?php echo $video_start; ?>, opacity:1, addRaster:true, quality:'hd1080'}"></div>
		<?php if($downArrow){?>
			<a class="scrollto scroll-down" id="down-<?php echo $uniqueID; ?>" href="#down-<?php echo $uniqueID; ?>"><span class="glyphicon glyphicon-menu-down"></span></a>
		<?php }; ?>
		<div class="<?php echo $elementType; ?>-middle <?php echo $vAlign; ?>">
			<div class="<?php echo $elementType; ?>-inner <?php echo $topPadding; ?> <?php echo $bottomPadding; ?>">

<?php break; ?>
<?php case "color": ?>

	<div class="<?php echo $elementType; ?>-outer <?php echo $backgroundType; ?> <?php echo $bgWidth; ?> <?php echo $wrapperClass; ?> clearfix" id="wrap-<?php echo $uniqueID; ?>">
		<?php if($downArrow){?>
			<div class="toscroll"><a class="scroll-down" id="down-<?php echo $uniqueID; ?>" href="#down-<?php echo $uniqueID; ?>"><i class="fa fa-chevron-down"></i></a></div>
		<?php }; ?>
		<div class="<?php echo $elementType; ?>-middle">
			<div class="<?php echo $elementType; ?>-inner <?php echo $topPadding; ?> <?php echo $bottomPadding; ?>">

<?php break; ?>
<?php }; ?>
