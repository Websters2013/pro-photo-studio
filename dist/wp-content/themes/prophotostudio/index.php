<?php
/*
Template Name: Home
*/
get_header();

$clients = get_field('clients_list', 50);
if($clients) {
 foreach ($clients as $row) {
  if(!$row['show_in_home']) {
   continue;
  }
   $clients_list .= '<div class="partners__slide swiper-slide">
     <img src="'.$row['image_home']['url'].'" alt="'.$row['image_home']['alt'].'" title="'.$row['image_home']['title'].'"/>
    </div>';
 }
}
?>

 <!-- partners -->
 <div class="partners">

  <div class="partners__swiper-prev"></div>

  <div class="partners__swiper swiper-container">

   <div class="swiper-wrapper">

    <?=  $clients_list; ?>

   </div>

  </div>

  <div class="partners__swiper-next"></div>

 </div>
 <!-- /partners -->

 <!-- media-gallery -->
 <section class="media-gallery" data-loaded-group="0">

  <h2 class="media-gallery__title">Portfolio</h2>

  <!-- media-gallery__switcher -->
  <div class="media-gallery__switcher">

   <button class="media-gallery__check active" data-type="all">All</button>
   <button class="media-gallery__check" data-type="on-white">On White</button>
   <button class="media-gallery__check" data-type="apparel">Apparel</button>
   <button class="media-gallery__check" data-type="jewelry">Jewelry</button>
   <button class="media-gallery__check" data-type="custom-shots">Custom shots</button>
   <button class="media-gallery__check" data-type="video">Video</button>

  </div>
  <!-- /media-gallery__switcher -->

  <!-- media-gallery__cover -->
  <div class="media-gallery__cover">

   <!--media-gallery__inner-->
   <div class="media-gallery__wrap">

    <div class="media-gallery__sizer"></div>

   </div>
   <!--/media-gallery__inner-->

  </div>
  <!-- /media-gallery__cover -->

  <!--preloader-->
  <div class="preloader">

   <!--preloader__inner-->
   <span class="preloader__inner">

                    <!--preloader__item-->
                    <span class="preloader__item"></span>
    <!--/preloader__item-->

                </span>
   <!--/preloader__inner-->

  </div>
  <!--/preloader-->

  <!-- btn -->
  <a href="php/gallery-content.php" class="media-gallery__more">View more >></a>
  <!-- /btn -->

 </section>
 <!-- /media-gallery -->
        
<?php get_footer(); ?>