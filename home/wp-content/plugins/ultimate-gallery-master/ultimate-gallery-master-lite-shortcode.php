<?php
add_shortcode( 'UGML', 'ultimateGalleryMasterLiteShortCode' );
function ultimateGalleryMasterLiteShortCode( $Id ) {
    ob_start();

	/**
	 * Load All Image Gallery Custom Post Type
	 */
	$CPT_Name = "ugml_cpt";
	$AllGalleries = array( 'post_id' => $Id['id'], 'post_type' => $CPT_Name, 'orderby' => 'ASC');
	$loop = new WP_Query( $AllGalleries );

	while ( $loop->have_posts() ) : $loop->the_post();

	/**
     * Load Saved Ultimate Gallery Settings
     */

    if(!isset($AllGalleries['post_id'])) {
        $AllGalleries['post_id'] = "";
    } else {
		$UGML_Id = $AllGalleries['post_id'];
		$UGML_Settings = "UGML_Gallery_Settings_".$UGML_Id;
		$UGML_Settings = unserialize(get_post_meta( $UGML_Id, $UGML_Settings, true));
		if(count($UGML_Settings)) {
			$UGML_Grid_Layout  				= $UGML_Settings['UGML_Grid_Layout'];
			$UGML_Grid_Orientation			= $UGML_Settings['UGML_Grid_Orientation'];
			$UGML_cvThumbnail				= $UGML_Settings['UGML_cvThumbnail'];
			$UGML_useIconButtons    		= $UGML_Settings['UGML_useIconButtons'];
			$UGML_IconStyle					= $UGML_Settings['UGML_IconStyle'];
			$UGML_hoverColor 				= $UGML_Settings['UGML_hoverColor'];
			$UGML_spaceBwThumbnails			= $UGML_Settings['UGML_spaceBwThumbnails'];
			$UGML_showMenu					= $UGML_Settings['UGML_showMenu'];
			$UGML_menuPosition				= $UGML_Settings['UGML_menuPosition'];
			$UGML_showSearchBox				= $UGML_Settings['UGML_showSearchBox'];
			$UGML_menuBgColor				= $UGML_Settings['UGML_menuBgColor'];
			$UGML_disableThumbnails			= $UGML_Settings['UGML_disableThumbnails'];
			$UGML_Color_Opacity				= $UGML_Settings['UGML_Color_Opacity'];
			$UGML_Font_Style				= $UGML_Settings['UGML_Font_Style'];
			$UGML_maxWidth					= $UGML_Settings['UGML_maxWidth'];
			$UGML_maxHeight					= $UGML_Settings['UGML_maxHeight'];
			$UGML_imageHoverTextColor		= $UGML_Settings['UGML_imageHoverTextColor'];
			$UGML_showZoomButton			= $UGML_Settings['UGML_showZoomButton'];
			$UGML_showDescriptionButton		= $UGML_Settings['UGML_showDescriptionButton'];
			$UGML_descriptionByDefault		= $UGML_Settings['UGML_descriptionByDefault'];
			$UGML_Custom_CSS				= $UGML_Settings['UGML_Custom_CSS'];

			$gridType	= $UGML_Grid_Layout.$UGML_Grid_Orientation;
		}
	}

	?>
	
	<style> 
		@font-face{
			font-family:myFont;
			src: url(<?php echo UGML_PLUGIN_URL.'content/font/Lato-Lig.ttf'; ?>);
		}
		
		/* Menu Background color */
		.UGPMenuBackground{
			background-color:<?php echo $UGML_menuBgColor; ?>; 
		}

		.UGPMenuButtonBackgroundSelected{
			background-color: <?php echo $UGML_menuBgColor; ?>;
			pointer-events: none;
			color:<?php echo $UGML_menuBgColor; ?>;
		}

		.centerDark, .centerWhite, .centerNormalDark {
			color:<?php echo $UGML_imageHoverTextColor; ?>;
		}

		.UGPMenuButtonTextNormal,.UGPMenuButtonTextSelected,.searchClassName,.searchNotFound,.UGPLoadMoreButtonTextNormal,.UGPLoadMoreButtonTextSelected,.centerWhite,.centerDark,.centerNormalDark,.centerNormalWhite,.gallery1DecHeader,.gallery1DescP,.extraContent1,.extraContent2P1,.extraContent2P2,.extraContent2P3,.extraContent2P3-1,.extraContent2P4,.extraContent2P6,.youtubeTitle1,.youtubeDescription1,.soundCloudTitle1,.soundCloudTrack1,.pinterestDescription,.pinterestDescription2,.flickrTitle,.facebookTitle,.facebookDescription
		{
			font-family:<?php echo $UGML_Font_Style; ?> !important;
		}

	</style>
	<?php

	include("dcmlpage.php");

    return ob_get_clean();
	endwhile;
}
?>