<?php
/*
Template Name: Clients
*/
get_header();
get_template_part('contents/content', 'submenu');
$post_id = 50;
$clients = get_field('clients_list', $post_id);
if($clients) {
	foreach ($clients as $row) {
		$clients_list .= '<!-- clients__item --><a href="'.$row['link'].'" class="clients__item">';
		if(!empty($row['image'])) {
          $clients_list .= '<img src="'.$row['image']['url'].'" alt="'.$row['image']['alt'].'" title="'.$row['image']['title'].'" class="clients__item-back" />';
		}
		if(!empty($row['logo'])) {
          $clients_list .= '<img src="'.$row['logo']['url'].'" alt="'.$row['logo']['alt'].'" title="'.$row['logo']['title'].'" class="clients__item-front" />';
		}
		$clients_list .='</a><!-- /clients__item -->';
	}
}
?>

	<!-- clients -->
	<div class="clients">

		<!-- clients__title -->
		<div class="clients__title">
			<?= get_post_field('post_content', $post_id); ?>
		</div>
		<!-- /clients__title -->

		<!-- clients__wrap -->
		<div class="clients__wrap">

			<?= $clients_list; ?>

		</div>
		<!-- /clients__wrap -->

	</div>
	<!-- /clients -->

<?php get_footer(); ?>