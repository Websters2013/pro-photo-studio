<?php
/*
Template Name: Blog
*/
 get_header();
$post_id = 87;

global $post;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$query = new WP_Query();
if ($tag || $category) {
	$paged = 1;
}
$order_by = 'date';
$active_sort_name = 'Latest Posts';
$order = 'DESC';
if($_GET['sort'] === 'a-b') {
	$order_by = 'title';
	$active_sort_name = 'A-B Posts';
	$order = 'ASC';
}
$args = array(
	'posts_per_page' => 5,
	'orderby'     => $order_by,
	'order'       => $order,
	'post_type'   => 'post',
	'post_status' => 'publish',
	'fields'      => 'ids',
	'paged' => $paged,
);

$posts = $query->query($args);
$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
$a['total'] = $query->max_num_pages;
$a['current'] = $paged;
$a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
$a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
$a['prev_text'] = 'Prev'; //текст ссылки "Предыдущая страница"
$a['next_text'] = 'Next'; //текст ссылки "Следующая страница"
$a['type'] = 'array';

$navigation = '<div class="navigation">';
$navigation_links = paginate_links($a);
if (is_array($navigation_links) || is_object($navigation_links)) {
	foreach($navigation_links as $key => $value) {
		$navigation .= $value;
	}
}
$navigation .= '</div>';

$post_string= '';
if(!empty($posts)) {
 foreach ($posts as $row) {
  $user = get_userdata( get_post_field( 'post_author', $post_id ));
  $tags = wp_get_post_terms($row, 'post_tag', array("fields" => "names"));
  $tags = implode(', ', $tags);
  $post_string .= '<!-- blog__item -->
  <div class="blog__item">

   <!-- blog__content -->
   <div class="blog__content">

    <h2>'.get_the_title($row).'</h2>

    <dl>
     <dt>Published:</dt>
     <dd><time datetime="'.get_the_date('Y-m-d').'">'.get_the_date('d, M, Y').'</time></dd>
     <dt>Author:</dt>
     <dd>'.$user->first_name.' '.$user->last_name.', '.$tags.'.</dd>
    </dl>
    '.get_field('excerpt', $row).'
    <div class="blog__btn-wrap"><a href="'.get_permalink($row).'" class="blog__more">'.get_field('buttons', 87).'</a></div>

   </div>
   <!-- /blog__content -->

   <!-- blog__img -->
   <div class="blog__img">
    '.get_the_post_thumbnail($row, 'full').'
   </div>
   <!-- /blog__img -->

  </div>
  <!-- /blog__item -->';
 }
}
 ?>

 <!-- blog -->
 <div class="blog">

  <!-- blog__title -->
  <div class="blog__title">
	  <?= get_post_field('post_content', $post_id); ?>
   <div class="blog__sort-wrap">

	   <?= get_field('title_sort', $post_id); ?>
       <div class="blog__sort">

           <span class="blog__sort-item"><?= $active_sort_name; ?></span>

           <ul class="blog__sort-popup">
               <li><a href="<?= get_permalink($post_id); ?>">Latest Posts</a></li>
               <li><a href="<?= get_permalink($post_id).'?sort=a-b'; ?>">A-B Posts</a></li>
           </ul>

       </div>
   </div>

  </div>
  <!-- /blog__title -->

  <?= $post_string; ?>


  <?= $navigation; ?>
 </div>
 <!-- /blog -->


        
<?php get_footer(); ?>