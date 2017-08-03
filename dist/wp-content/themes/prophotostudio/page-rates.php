<?php
/*
Template Name: Rates
*/
 get_header();
 $post_id = 10;
 $sub_menu = get_field('submenu', $post_id);
 if($sub_menu) {
     foreach ($sub_menu as $row) {
         $sub_menu_string .= '<a href="#'.$row['anchor'].'" class="sub-menu__item swiper-slide anchor">'.$row['title'].'</a>';
     }
 }
$templates = get_field('templates', $post_id);
 if($templates) {
     foreach ($templates as $row) {
	     $image = $row['image'];
         if($row['show_template'] === '0') {
	         $price_list_string = '';
	         $price_list = $row['price_list'];
	         if($price_list) {
	             foreach ($price_list as $row2) {
			        $price_list_string .= '<li>'.$row2['item'].'</li>';
                 }
             }

	         $list_middle_string = '';
	         $list_middle = $row['list_middle'];
	         if($list_middle) {
		         foreach ($list_middle as $row2) {
			         $list_middle_string .= '<li>'.$row2['item'].'</li>';
		         }
	         }

	         $list_bottom_string = '';
	         $list_bottom = $row['list_bottom'];
	         if($list_bottom) {
		         foreach ($list_bottom as $row2) {
			         $list_bottom_string .= '<li>'.$row2['item'].'</li>';
		         }
	         }
	         $templates_string .= '<!-- rates__item -->
              <div class="rates__item" id="basic">
            
               <h2 class="rates__item-topic">'.$row['title'].'</h2>
            
               <!-- rates__item-half -->
               <div class="rates__item-half">
                <h3>'.$row['subtitle_price'].'</h3>
            
                <ul class="rates__price">
                 '.$price_list_string.'
                </ul>
            
                <div class="rates__topic">'.$row['title_list_middle'].'</div>
            
                <ul class="rates__list">
                '.$list_middle_string.'              
                </ul>
               </div>
               <!-- /rates__item-half -->
            
               <!-- rates__item-img -->
               <div class="rates__item-img">
                <img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
               </div>
               <!-- /rates__item-img -->
            
               <div class="rates__topic">'.$row['title_list_bottom'].'</div>
            
               <ul class="rates__offers">
               '.$list_bottom_string.'
               </ul>
            
               <div class="rates__btn-wrap">
                <a href="'.get_permalink(16).'" class="btn">'.get_field('title_buttons', $post_id).'</a>
               </div>
            
               <p class="rates__note">'.$row['notice'].'</p>
            
               '.$row['content'].'
            
              </div>
              <!-- /rates__item -->';
         } elseif($row['show_template'] === '1') {
	         $price_list_string = '';
	         $price_list = $row['price_list'];
	         if($price_list) {
		         foreach ($price_list as $row2) {
			         $price_list_string .= '<li>'.$row2['item'].'</li>';
		         }
	         }

	         $list_middle_string = '';
	         $list_middle = $row['list_middle'];
	         if($list_middle) {
		         foreach ($list_middle as $row2) {
			         $list_middle_string .= '<li>'.$row2['item'].'</li>';
		         }
	         }

	         $slider_string = '';
	         $slider = $row['slider'];
	         if($slider) {
		         foreach ($slider as $row2) {
                     $image_slider = $row2['image'];
			         $slider_string .= '<div class="rates__slide swiper-slide">
                   <img src="'.$image_slider['url'].'" alt="'.$image_slider['alt'].'" title="'.$image_slider['title'].'"/>
                  </div>';
		         }
	         }

	         $templates_string .= '<!-- rates__item -->
              <div class="rates__item" id="jewlery">
            
               <h2 class="rates__item-topic">'.$row['title'].'</h2>
            
               <!-- rates__item-half -->
               <div class="rates__item-half rates__item-half_2">
                <h3>'.$row['subtitle_price'].'</h3>
            
                <ul class="rates__price">
                 '.$price_list_string.'
                </ul>
            
               </div>
               <!-- /rates__item-half -->
            
               <!-- rates__item-img -->
               <div class="rates__item-swiper">
            
                <div class="rates__swiper-prev"></div>
            
                <div class="rates__swiper swiper-container">
            
                 <div class="swiper-wrapper">
                    
                    '.$slider_string.'
            
                 </div>
            
                </div>
            
                <div class="rates__swiper-next"></div>
            
               </div>
               <!-- /rates__item-img -->
            
               <div class="rates__topic">'.$row['title_list_middle'].'</div>
            
               <ul class="rates__offers rates__offers_2">
                '.$list_middle_string.'
               </ul>
            
               <div class="rates__btn-wrap">
                <a href="'.get_permalink(16).'" class="btn">'.get_field('title_buttons', $post_id).'</a>
               </div>
            
              </div>
              <!-- /rates__item -->';
         } elseif($row['show_template'] === '2') {

	         $paragrafs_string = '';
	         $paragrafs = $row['paragrafs'];
	         if($paragrafs) {
		         foreach ($paragrafs as $row2) {
					$paragrafs_string .= '<dt>'.$row2['title'].'</dt><dd>'.$row2['content'].'</dd>';
		         }
	         }

	         $templates_string .= '<!-- rates__item -->
              <div class="rates__item" id="custom-shots">
            
               <h2 class="rates__item-topic">'.$row['title'].'</h2>
            
               <!-- rates__item-half -->
               <div class="rates__item-half">
            
                <dl>
                 '.$paragrafs_string.'
            
                 <dd></dd>
                </dl>
            
                <div class="rates__note rates__note_2">
                 <div>'.$row['notice'].'</div>
                 <div>'.$row['content'].'</div>
                </div>
            
               </div>
               <!-- /rates__item-half -->
            
               <!-- rates__item-img -->
               <div class="rates__item-img">
                <img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
               </div>
               <!-- /rates__item-img -->
            
              </div>
              <!-- /rates__item -->';
         } elseif($row['show_template'] === '3') {
	         $price_list_string = '';
	         $price_list = $row['price_list'];
	         if($price_list) {
		         foreach ($price_list as $row2) {
			         $price_list_string .= '<li>'.$row2['item'].'</li>';
		         }
	         }

	         $slider_string = '';
	         $slider = $row['slider'];
	         if($slider) {
		         foreach ($slider as $row2) {
			         $image_slider = $row2['image'];
			         $slider_string .= '<div class="rates__slide swiper-slide">
                   <img src="'.$image_slider['url'].'" alt="'.$image_slider['alt'].'" title="'.$image_slider['title'].'"/>
                  </div>';
		         }
	         }
	         $templates_string .= '<!-- rates__item -->
              <div class="rates__item" id="apparel-fashion">
            
               <h2 class="rates__item-topic">'.$row['title'].'</h2>
            
               <!-- rates__item-half -->
               <div class="rates__item-half rates__item-half_2">
                <h3>'.$row['subtitle_price'].'</h3>
            
                <ul class="rates__price">
                 '.$price_list_string.'
                </ul>
            
                <div class="rates__btn-wrap">
                 <a href="'.get_permalink(16).'" class="btn">'.get_field('title_buttons', $post_id).'</a>
                </div>
            
               </div>
               <!-- /rates__item-half -->
            
               <!-- rates__item-img -->
               <div class="rates__item-swiper rates__item-swiper_2">
            
                <div class="rates__swiper-prev"></div>
            
                <div class="rates__swiper swiper-container">
            
                 <div class="swiper-wrapper">
            
                  '.$slider_string.'
            
                 </div>
            
                </div>
            
                <div class="rates__swiper-next"></div>
            
               </div>
               <!-- /rates__item-img -->
            
              </div>
              <!-- /rates__item -->';
         } elseif($row['show_template'] === '4') {
	         $price_list_string = '';
	         $price_list = $row['price_list'];
	         if($price_list) {
		         foreach ($price_list as $row2) {
			         $price_list_string .= '<li>'.$row2['item'].'</li>';
		         }
	         }

	         $slider_string = '';
	         $slider = $row['slider'];
	         if($slider) {
		         foreach ($slider as $row2) {
			         $image_slider = $row2['image'];
			         $slider_string .= '<div class="promo__slide swiper-slide">
                   <img src="'.$image_slider['url'].'" alt="'.$image_slider['alt'].'" title="'.$image_slider['title'].'"/>
                  </div>';
		         }
	         }
	         $templates_string .= '<!-- rates__item -->
              <div class="rates__item" id="360">
            
               <h2 class="rates__item-topic">'.$row['title'].'</h2>
            
               <!-- rates__item-half -->
               <div class="rates__item-half rates__item-half_2">
                <h3>'.$row['subtitle_price'].'</h3>
            
                <ul class="rates__price">
                    '.$price_list_string.'
                </ul>
            
                <div class="rates__btn-wrap">
                 <a href="'.get_permalink(16).'" class="btn">'.get_field('title_buttons', $post_id).'</a>
                </div>
            
               </div>
               <!-- /rates__item-half -->
            
               <div class="promo__slider">
            
                <div class="promo__swiper swiper-container">
            
                 <div class="swiper-wrapper">
                 
                    '.$slider_string.'
            
                 </div>
            
                </div>
            
                <div class="promo__swiper-prev"></div>
                <div class="promo__swiper-next"></div>
            
               </div>
            
               <div class="rates__note rates__note_3">'.$row['notice'].'</div>
            
              </div>
              <!-- /rates__item -->';
         }
     }
 }
?>

 <!-- sub-menu -->
 <div class="sub-menu">

  <!-- swiper-wrapper -->
  <div class="sub-menu__swiper swiper-container">

   <!-- swiper-wrapper -->
   <div class="swiper-wrapper">

    <?= $sub_menu_string; ?>

   </div>
   <!-- /swiper-wrapper -->

  </div>

 </div>
 <!-- /sub-menu -->

 <!-- rates -->
 <div class="rates">

  <!-- rates__preface -->
  <div class="rates__preface">

	  <?= get_post_field('post_content', $post_id); ?>

  </div>
  <!-- /rates__preface -->

    <?= $templates_string; ?>

  <div class="rates__footer">
   <?= get_field('footer', $post_id); ?>
  </div>

 </div>
 <!-- /rates -->

<?php get_footer(); ?>