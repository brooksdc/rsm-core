<?php
/**
 * Testimonial List Shortcode Template.
 *
 * This template can be overriden by copying this file to your-theme/rsm-templates/
 *
 * @author 		RSM
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Don't allow direct access


// start query
$testiminial_posts = get_posts( array(
   'posts_per_page' => -1, //gets all posts
   'post_status'    => 'publish',
   'post_type'       => 'rsm_testimonial',
) );

if ( $testiminial_posts ):

	foreach ( $testiminial_posts as $post ) :
		
		$id = get_post($post->ID);

		$testimonial_byline = get_field('rsm_testimonial_name_byline', $id);
		$testimonial_source = get_field('rsm_testimonial_source', $id);
		$testimonial_rating = get_field('rsm_testimonial_star_rating', $id);
		$testimonial_summary = get_field('rsm_testimonial_summary', $id);
		$testimonial_full = get_field('rsm_testimonial_full', $id);

		// setup path to icon files
		$testimonial_source_path = plugin_dir_url( __FILE__ ).'../assets/images/networks';

		// output
		if($testimonial_summary || $testimonial_full):

			echo '<div class="rsm-testimonial">';

				echo '<div class="rsm-testimonial__box">';
					
					echo '<div class="rsm-testimonial__box__inner">';

						echo '"'.$testimonial_summary.'"';

					echo '</div>';

				echo '</div>';

				echo '<div class="rsm-testimonial__bottom">';
						
					echo '<div class="left-block">';
						
						if($testimonial_rating) {
							echo '<span class="rsm-testimonial__rating rating--'.$testimonial_rating.'"></span>';
						} 

					echo '</div>';

					echo '<div class="right-block">';
						
						echo '<span class="rsm-testimonial__name">'.$post->post_title;
						
						if($testimonial_byline){
							echo '<span class="rsm-testimonial__name-byline">'.$testimonial_byline.'</span>';
						}

						echo '</span>';

						if($testimonial_source) {

							if($testimonial_source == 'facebook') {
								$testimonial_source_url = $testimonial_source_path.'/network-facebook.png';
							}
							elseif($testimonial_source == 'google') {
								$testimonial_source_url = $testimonial_source_path.'/network-google.png';
							}
							elseif($testimonial_source == 'homestars') {
								$testimonial_source_url = $testimonial_source_path.'/network-homestars.png';
							}
							elseif($testimonial_source == 'houzz') {
								$testimonial_source_url = $testimonial_source_path.'/network-houzz.png';
							}
							elseif($testimonial_source == 'instagram') {
								$testimonial_source_url = $testimonial_source_path.'/network-instagram.png';
							}
							elseif($testimonial_source == 'twitter') {
								$testimonial_source_url = $testimonial_source_path.'/network-twitter.png';
							}
							elseif($testimonial_source == 'yelp') {
								$testimonial_source_url = $testimonial_source_path.'/network-yelp.png';
							} 

							echo '<span class="rsm-testimonial__source source--'.$testimonial_source.'"><img src="'.$testimonial_source_url.'" class="rsm-testimonial__source-image" alt="'.$testimonial_source.'"></span>';
						}
					echo '</div>';	

				echo '</div>';

			echo '</div>';
				
		endif;
	endforeach;
endif;
wp_reset_postdata();
