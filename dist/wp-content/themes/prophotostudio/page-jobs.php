<?php
/*
Template Name: Jobs
*/
 get_header();
$post_id = 175;
$jobs = get_field('jobs', $post_id);
$jobs_string = '';
if ($jobs) {
 foreach ($jobs as $row) {
	 $jobs_string .= '<dd>'.$row['propose'].'</dd>';
 }
}
?>

 <!-- jobs -->
 <div class="jobs">

  <!-- jobs__title -->
  <div class="jobs__title">
	  <?= get_post_field('post_content', $post_id); ?>
  </div>
  <!-- /jobs__title -->

  <!-- jobs__propose -->
  <dl class="jobs__propose">

   <dt><?= get_field('propose_title', $post_id); ?></dt>

   <?= $jobs_string; ?>

  </dl>
  <!-- /jobs__propose -->

  <!-- jobs__form -->
  <div class="jobs__form">

   <?= do_shortcode('[contact-form-7 id="182" title="Jobs"]'); ?>

  </div>
  <!-- /jobs__form -->

 </div>
 <!-- /jobs -->

<?php get_footer(); ?>