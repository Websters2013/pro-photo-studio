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
  $title = $row['link']['title'];
  if($row['show'] === '1') {
	  $url = get_permalink(165).'?category='.$row['category']->slug;
	  $title = $row['title'];
  }
	 $services_string .= '<!-- services__item -->
  <a href="'.$url.'" class="services__item">
   <div class="services__img">
    <img src="'.$row['image']['url'].'" alt="'.$row['image']['alt'].'" title="'.$row['image']['title'].'"/>
   </div>';
  if ($title) {
	  $services_string .= '<span>'.$title.'</span>';
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