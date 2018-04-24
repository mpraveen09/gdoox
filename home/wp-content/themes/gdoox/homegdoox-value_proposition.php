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
                    <div class="service_box_con centered">
                      <?php //if (!empty(the_title()) ) { ?>
                        <h3 id="service-title-<?php echo $ii; ?>">
                            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo the_title(); ?></a>
                        </h3>
                      <?php
                      //}
                      ?>
                      <div id="service-desc-<?php echo $ii; ?>" class="desc">                          
                        <?php 
                        if (!empty(get('summary_to_show_on_homepage')) ) { 
                          echo get('summary_to_show_on_homepage'); 
                        }else{
                          echo the_excerpt();
                        }?>
                      </div>
                        
                      <a id="service-link-<?php echo $ii; ?>" href="<?php echo esc_url( get_permalink() ); ?>" class="ser-box-link"><span></span>
                            <?php echo $label_readmore; ?>                              
                        </a>
                        
                      <?php
                      if (!empty(get('link_to')) ) { ?>
<!--                        <a id="service-link-<?php echo $ii; ?>" href="<?php echo esc_url( get_permalink( get('link_to') ) ); ?>#service-icon-<?php echo $ii; ?>" class="ser-box-link"><span></span>
                            <?php echo $label_readmore; ?>                              
                        </a>-->
                      <?php
                      }else{?>
<!--                        <a id="service-link-<?php echo $ii; ?>" href="#service-icon-<?php echo $ii; ?>"
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
