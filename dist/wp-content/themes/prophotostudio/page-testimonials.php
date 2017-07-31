<?php
/*
Template Name: Testimonials
*/
get_header();
get_template_part('contents/content', 'submenu');
$post_id = 85;
$google_review = get_field('google_review', $post_id);
$google_review_string = '';
if($google_review) {
 foreach ($google_review as $row) {
  $google_review_string .= $row['script'];
 }
}
$testimonials = get_field('testimonials', $post_id);
if($testimonials) {
 foreach ($testimonials as $row) {
  if($row['show'] === '0') {
   $testimonials_string .= '<!-- testimonials__grid-item -->
   <div class="testimonials__grid-item">
    <img src="'.$row['image']['url'].'" alt="'.$row['image']['alt'].'" title="'.$row['image']['title'].'"/>
   </div>
   <!-- /testimonials__grid-item -->';
  } elseif ($row['show'] === '1') {
	  $testimonials_string .= '<!-- testimonials__grid-item -->
   <div class="testimonials__grid-item">

    <div class="testimonials__grid-content">
    '.$row['content'].'
     <p class="testimonials__grid-author">'.$row['author'].'</p>

    </div>

   </div>
   <!-- /testimonials__grid-item -->';
  }
 }
}
 ?>

 <!-- testimonials -->
 <div class="testimonials">

  <h1><?= get_post_field('post_content', $post_id); ?></h1>

  <!-- testimonials__social -->
  <div class="testimonials__social">

   <?= $google_review_string; ?>

  </div>
  <!-- /testimonials__social -->

  <!-- testimonials__grid -->
  <div class="testimonials__grid">

   <?= $testimonials_string; ?>

  </div>
  <!-- /testimonials__grid -->

 </div>
 <!-- /testimonials -->
        
<?php get_footer(); ?>