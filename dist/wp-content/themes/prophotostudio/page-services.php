<?php
/*
Template Name: Services
*/
 get_header();
$post_id = 8;
$services = get_field('services', $post_id);
$services_string = '';
if($services) {
 foreach ($services as $row) {
  $url = $row['link']['url'];

  if($row['show'] === '1') {
	  $url .= '?category='.$row['category']->slug;
  }
	 $services_string .= '<!-- services__item -->
  <a href="'.$url.'" class="services__item">
   <div class="services__img">
    <img src="'.$row['image']['url'].'" alt="'.$row['image']['alt'].'" title="'.$row['image']['title'].'"/>
   </div>';
  if ($row['link']['title']) {
	  $services_string .= '<span>'.$row['link']['title'].'</span>';
  }
	 $services_string .= '</a><!-- /services__item -->';
 }
}
 ?>

 <!-- services -->
 <div class="services">

  <?= $services_string; ?>

 </div>
 <!-- /services -->

<?php get_footer(); ?>