<?php 

$args = array(
	'post_type' => 'home_banner'
);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php
      if( !empty( get('feature_label') ) ){
        $label_feature=get('feature_label'); 
      }  
      if( !empty( get('read_more_label') ) ){
        $label_readmore=get('read_more_label'); 
      }    
      if( !empty( get('news_label') ) ){
        $label_news=get('news_label'); 
      }  
      if( !empty( get('marketplace_label') ) ){
        $label_market=get('marketplace_label'); 
      }  
      if( !empty( get('number_of_feature_columns') ) ){
        $feature_cols=get('number_of_feature_columns'); 
      }        
      if( !empty( get('marketplace_text') ) ){
        $marketplace_text=get('marketplace_text'); 
      } 
      if( !empty( get('marketplace_link') ) ){
        $marketplace_link =get('marketplace_link'); 
      }
      if( !empty( get('invitation_code_request_link') ) ){
        $invite_link =get('invitation_code_request_link'); 
      }      
      if( !empty( get('value_proposition_label') ) ){
        $value_proposition_label =get('value_proposition_label'); 
      }      


    ?>

	<div id="kyma_owl_slider" class="owl-carousel">
	<?php 
    $members = get_order_group('slides_title');
    $i = 1;
    foreach($members as $member){
      ?>
      <div class="item">
      <img src="<?php echo get('slides_image',$member);?>" class="img-responsive" alt="<?php echo get('slides_title',$member);?>">          
      
      <div class="owl_slider_con">
        <?php if( !empty(get('slides_title',$member)) ){?>
        <span class="owl_text_a">
          <span>
              <span id="slide-title-<?php echo $i; ?>"><?php echo ( get('slides_title',$member) ); ?></span>
          </span>
        </span>
        <?php } ?>
        <?php if( !empty( get('slides_description',$member) ) ){?>
        <span class="owl_text_b">
          <span id="slide-subtitle-<?php echo $i; ?>"><?php echo ( get('slides_description',$member) ); ?></span>
        </span>
        <?php } ?>
        <?php if( !empty( get('slides_read_more_link', $member) ) ){?>
          <span class="owl_text_c">
            <span>
              <a id="slide-description-<?php echo $i; ?>"  href="<?php echo esc_url( get_permalink( get('slides_read_more_link',$member) ) ); ?>" target="_self">
                <?php echo $label_readmore; ?>          
              </a>
            </span>
          </span>
        <?php } ?>          

      </div>
      </div><?php
      $i++;
    } 

?>    
    
    
    
	</div>	


	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
<?php else : ?>
	
<?php endif; ?>
