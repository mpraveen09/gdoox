<?php
//Template Name: Value Proposition Page
get_header(); ?>
    <!-- Page Title -->
<?php get_template_part('breadcrumbs'); ?>

	<?php
	$label_feature="Value Proposition";
	$value_proposition_label="Value Proposition";
	$label_readmore="Read More";
	$label_news="News and Updates";
	$label_market="View Marketplace";
	$marketplace_link="#";
	$marketplace_text="";
	$feature_cols=1;
	?>

    <section class="content_section features-main">
        <div class="content">

          <div class="internal_post_con clearfix">
                  <!-- All Content -->
                  <div class="content_block col-md-12">
                      <div class="hm_blog_full_list hm_blog_list clearfix">
                          <!-- Post Container -->
                          <?php
                          if (have_posts()):
                          while (have_posts()):
                          the_post(); ?>
                          <div id="<?php get_the_id(); ?>" <?php post_class('clearfix'); ?> >
                <div class="blog_grid_con">
								  <?php //$label_feature = the_title( '', '', false ); ?>
                                  <?php the_content(); ?>
                              </div>

                        </div>
            <?php
                      endwhile;
                      endif;
                      ?>
                  </div>
                </div>
          </div>
      </div>
				
			
			
			
			
			
			
			<?php 
$args = array(
	'post_type' => 'value_proposition',
  'orderby' => 'meta_value_num',
  'meta_key' => 'sort_order',
	'order'   => 'ASC',
  'posts_per_page' => -1
);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
  <?php
    $col = 12 / (int)$feature_cols;
    $color = array('', 'color1', 'color2', 'color3');
    $ii = 1;
    $i = 1;
  ?>
  <section class="content_section bg_gray">
    <div class="container icons_spacer">
      <div class="main_title centered upper">
          <h2 id="service_heading"><span class="line"><span class="dot"></span></span>          
            <?php echo $value_proposition_label; ?>
          </h2>
      </div>
      <div class="icon_boxes_con style1 clearfix">
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

              <div class="service col-md-<?php echo esc_attr($col); ?>">
                  <div class="service_box">
                      <?php if( !empty(get('icon')) ){
                        $service_icon = get('icon');
                      }else{
                        $service_icon = "fa fa-wrench";
                      } ?>
                      <?php if( !empty(get('icon_background_color')) && get('icon_background_color') 
                              !=="#fff" &&  get('icon_background_color') !=="#ffffff" ){
                        $service_bg_color = get('icon_background_color');
                      }else{
                        $service_bg_color = "";
                      } ?>                        
                      <span class="icon">                        
                          <i id="service-icon-<?php echo $ii; ?>" 
                             class="fa <?php echo esc_attr($service_icon . ' ' . $color[$i - 1]); ?>" 
                             <?php if(!empty($service_bg_color)){ echo 'style="background:'.$service_bg_color.'"';} ?> ></i></span>
                    <div class="service_box_con ">

                      <div id="service-desc-<?php echo $ii; ?>" class="desc row service-desc">   
                        <div class="col-md-4 float-dir-<?php echo ($ii % 2); ?>">
                          <?php
                          if (has_post_thumbnail()) {
                            $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                          }else{ 
                            $url = get_stylesheet_directory_uri() . '/images/gdoox-placeholder.jpg'  ;
                          } 
                          ?>
                          <img src="<?php echo $url;?>" alt="gdoox" style="width: 100%;height:auto;" />

                        </div>
                        <div class="col-md-8 float-dir2-<?php echo ($ii % 1); ?>">
                          <h3 id="service-title-<?php echo $ii; ?>" class="feature-title">
                              <a href="<?php echo esc_url(get_permalink() ); ?>"><?php echo the_title(); ?></a>
                          </h3>

                          <?php the_content(); ?>
                        </div>
                      </div>
                      <?php
                      if (!empty(get('link_to')) ) { ?>
<!--                        <a id="service-link-<?php echo $ii; ?>" href="<?php echo esc_url( get('link_to') ); ?>"
                           class="ser-box-link"><span></span>
                            <?php echo $label_readmore; ?>                              
                        </a>-->
                      <?php
                      }else{?>
<!--                        <a id="service-link-<?php echo $ii; ?>" href="#"
                           class="ser-box-link"><span></span>
                            <?php echo $label_readmore; ?>                              
                        </a>                        -->
                        <?php 
                      } ?>
                    </div>
                </div>
                </div>

        <?php 
          $i++; $ii++; 
          if($i > 4){$i=1;}
        ?>
      <?php endwhile; ?>
      </div>
    </div>
  </section>          
	<?php wp_reset_postdata(); ?>
<?php else : ?>
	
<?php endif; ?>

    </section>
    <!-- End All Content -->
<?php get_footer(); ?>			