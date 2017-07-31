<?php
/*
Template Name: Contact
*/
 get_header();
$post_id = 18;
$address = get_field('address', $post_id);
$address_string= '';
if($address) {
 foreach ($address as $row) {
	 $address_string .= '<dd><a href="'.$row['item']['url'].'" target="'.$row['item']['target'].'">'.$row['item']['title'].'</a></dd>';
 }
}
 ?>

 <!-- contact-us -->
 <div class="contact-us">

  <!-- contact-us__title -->
  <div class="contact-us__title">
	  <?= get_post_field('post_content', $post_id); ?>
  </div>
  <!-- /contact-us__title -->

  <!-- contact-us__form -->
  <div class="contact-us__form">
   <?= do_shortcode('[contact-form-7 id="110" title="Contact"]'); ?>
  </div>
  <!-- /contact-us__form -->
   <?php if($address) { ?>
    <!-- contact-us__address -->
    <address class="contact-us__address">

     <dl>
      <dt><?= get_field( 'address_title', $post_id ); ?></dt>
		   <?= $address_string; ?>
     </dl>

    </address>
    <!-- /contact-us__address -->
	   <?php } ?>
 </div>
 <!-- /contact-us -->
        
<?php get_footer(); ?>