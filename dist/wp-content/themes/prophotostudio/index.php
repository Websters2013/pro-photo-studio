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

$categories = get_field('show_category', 2);

/*$args = array(
	'taxonomy'      => 'portfolio',
	'hide_empty'    => false,
    'hierarchical'  => false,
    'orderby'       => 'term_order',
    'parent'        => '0',

);*/
//$categories = get_terms($args);

$categories_list = '<button class="media-gallery__check active" data-type="all">All</button>';
if(!empty($categories)) {
    foreach ($categories as $row) {
	    $categories_list .= '<button class="media-gallery__check" data-type="'.$row->slug.'">'.$row->name.'</button>';
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
    <section class="media-gallery" data-loaded-group="0" data-loaded-type="all">

        <h2 class="media-gallery__title"><?= get_field('title_portfolio', 2); ?></h2>

        <!-- media-gallery__switcher -->
        <div class="media-gallery__switcher">
	        <?= $categories_list; ?>
        </div>
        <!-- /media-gallery__switcher -->

        <!-- media-gallery__cover -->
        <div class="media-gallery__cover">

            <!--media-gallery__inner-->
            <div class="media-gallery__wrap">

                <div class="media-gallery__sizer"></div>

            </div>
            <!--/media-gallery__inner-->

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

        </div>
        <!-- /media-gallery__cover -->

        <!-- btn -->
        <a href="#" class="media-gallery__more"><?= get_field('title_button_portfolio', 2); ?></a>
        <!-- /btn -->

    </section>
    <!-- /media-gallery -->



        
<?php get_footer(); ?>