<?php
/*
Template Name: Order
*/
 get_header();
$post_id = 16;
?>

 <!-- place-order -->
 <div class="place-order">

  <!-- place-order__preface -->
  <div class="place-order__preface">
    <?= get_post_field('post_content', $post_id); ?>
  </div>
  <!-- /place-order__preface -->

  <!-- place-order__order -->
  <div class="place-order__order">

   <?= get_field('order_content', $post_id); ?>

  </div>
  <!-- /place-order__order -->

  <!-- place-order__warning -->
  <div class="place-order__warning">

	  <?= get_field('order_warning', $post_id); ?>

  </div>
  <!-- /place-order__warning -->

  <!-- place-order__form -->
  <div class="place-order__form">

   <?= do_shortcode('[contact-form-7 id="239" title="Order"]'); ?>

  </div>
  <!-- /place-order__form -->

 </div>
 <!-- /place-order -->

<?php get_footer(); ?>