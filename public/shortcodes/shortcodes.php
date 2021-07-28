<?php

/*========================================
*
* Timeline Shortcode
*
*==========================================*/
function ufclasTimeLine($atts){
	global $post;

	extract( shortcode_atts( array(
		 'category'   => '',
		 'link_posts' => 'yes',
	 ), $atts ) );

  $today = current_time('m/d/Y g:i a');

	//Query
	$args = array(
    'meta_key'    => 'event-date',
		'orderby' 		=> 'meta_value',
    'order'       => 'ASC',
    'meta_type'      => 'DATETIME',
    'meta_query'  => array(
        array(
          'key'       => 'event-date',
          'value'     => $today,
          'compare'   => '>=',
        ),

        array(
          'key'   => '_wp_page_template',
          'value' => 'public/templates/single-event.php'
        )
    ),
		'category_name'  	=> $category,
	);

	$ufclasPosts = new WP_Query($args);

		$output = "<div id='cd-timeline' class='cd-container'>";

			if($ufclasPosts->have_posts()){
				while($ufclasPosts->have_posts()){
					$ufclasPosts->the_post();

					// Checks to see what side of the timeline the post will show up.
					$timelineSide = '';

					if(get_field('timeline-side') == 'left'){
						$timelineSide = "timeline-left ";
            $slideEffect = "js--fadeInLeft";
					}else{
						$timelineSide = "timeline-right";
            $slideEffect = "js--fadeInRight";
					}

					$output .= '<div class="cd-timeline-block '. $timelineSide . '">';
					$output .= '<div class="cd-timeline-img cd-picture"></div>';

				  $output .= '<div class="cd-timeline-content '. $slideEffect .'">';
				  $output .= '<div class="timeline-content-info">';

         if(get_field('event-color') == ''){
           $backgroundColor = "#00337A";
         }else{
           $backgroundColor = get_field('event-color');
         }

				 //If user wants the posts to link to individual posts, this will run. This will show the excerpt.
				 if($link_posts == "yes"){

					 $output .= '<a href="' . get_the_permalink(). '">' . get_the_post_thumbnail() . '</a>';
					 $output .=  '<h3 style="background-color:'. $backgroundColor . ';"><a href="' . get_the_permalink(). '">' . get_the_title() .'</a></h3>';

           if(get_field('event-type') != '' || get_field('event-date') != '' || get_field('clas-register-event') != '' ){
             $output .= '<div class="date-type-container">';

  					 if(get_field('event-type') != ''){
  						 	$output .= '<span class="timeline-content-info-title">';
  						  $output .= '<i class="fas fa-folder"></i>' . get_field('event-type');
  							$output .= '</span>';
  					 }

  					 if(get_field('event-date') != ''){
  						 $output .= '<span class="timeline-content-info-date">';
  						 $output .= '<i class="fa fa-calendar-o" aria-hidden="true"></i>' . get_field('event-date');
  						 $output .= '</span>';
  					 }

						 if(get_field('clas-register-event') != ''){
							 $eventRegisterLink = get_field('clas-register-event');

							 $output .= '<span class="timeline-content-info-register">';
							 $output .= '<i class="fas fa-user-plus"></i><a href="'. $eventRegisterLink . '" target="_blank" title="Register for ' . get_the_title() . '">Register for Event</a>';
							 $output .= '</span>';
						 }

             $output .= '</div>';
           }

					 $output .= '<p>' . get_the_excerpt() . '</p>';
					 $output .= '</div></div></div>';
				 }

				 //If user doesn't want the posts to link to individual posts, this will run. This will show the content in a toggle field.
				 if($link_posts == "no"){
					 $output .= get_the_post_thumbnail();
					 $output .=  '<h3 style="background-color:'. $backgroundColor . ';">' . get_the_title() . '</h3>';

					 if(get_field('event-type') != '' || get_field('event-date') != '' || get_field('clas-register-event') != '' ){
             $output .= '<div class="date-type-container">';

  					 if(get_field('event-type') != ''){
  						 	$output .= '<span class="timeline-content-info-title">';
  						  $output .= '<i class="fas fa-folder"></i>' . get_field('event-type');
  							$output .= '</span>';
  					 }

  					 if(get_field('event-date') != ''){
  						 $output .= '<span class="timeline-content-info-date">';
  						 $output .= '<i class="fa fa-calendar-o" aria-hidden="true"></i>' . get_field('event-date');
  						 $output .= '</span>';
  					 }

						 if(get_field('clas-register-event') != ''){
							 $eventRegisterLink = get_field('clas-register-event');

							 $output .= '<span class="timeline-content-info-register">';
							 $output .= '<i class="fas fa-user-plus"></i><a href="'. $eventRegisterLink . '" target="_blank" title="Register for ' . get_the_title() . '">Register for Event</a>';
							 $output .= '</span>';
						 }

             $output .= '</div>';
           }

					 $output .= '<p><details><summary>View Event Information</summary>' . get_the_content() . '</details></p>';
					 $output .= '</div></div></div>';
				 }
				}

				$output .= '</div>';
				return $output;
			}
}

add_shortcode('ufclas-timeline','ufclasTimeLine');

?>
