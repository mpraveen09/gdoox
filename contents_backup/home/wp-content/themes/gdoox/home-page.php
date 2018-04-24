<?php
/* Template Name: Gdoox Home */
get_header();
$label_feature="Main Features";
$label_readmore="Read More";
$label_news="News and Updates";
$label_market="View Marketplace";
$marketplace_link="#";
$marketplace_text="";
$feature_cols=4;

//get_template_part('homegdoox', 'slider');
//get_template_part('homegdoox', 'about');
//get_template_part('homegdoox', 'feature');

include 'homegdoox-slider.php';
include 'homegdoox-about.php';
include 'homegdoox-feature.php';
include 'homegdoox-market.php';
include 'homegdoox-blog.php';
include 'homegdoox-market.php';

get_footer();
?>