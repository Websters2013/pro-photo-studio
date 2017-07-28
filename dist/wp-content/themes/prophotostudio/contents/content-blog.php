<?php

$id = icl_object_id( 449, true );
$title = get_the_title($id);

$tag = $_GET['tag'];
$category = $_GET['category'];
$tag_checkbox = $_GET['tag-checkbox'];
$category_checkbox = $_GET['category-checkbox'];

if(!$tag_checkbox) {
	$tag_and = '';
	$tag_in = $tag;
} else {
	$tag_in = '';
	$tag_and = $tag;
}

if(!$category_checkbox) {
	$category_and = array();
	$category_in = $category;
} else {
	$category_in = array();
	$category_and = $category;
}

global $post;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$query = new WP_Query();
if ($tag || $category) {
	$paged = 1;
}

$args = array(
	'posts_per_page' => 2,
	'orderby'     => 'date',
	'order'       => 'DESC',
	'post_type'   => 'post',
	'post_status' => 'publish',
	'fields'      => 'ids',
	'suppress_filters' => false,
	'paged' => $paged,
	'tag__in' => $tag_in,
	'tag__and' => $tag_and,
	'category__in' => $category_in,
	'category__and' => $category_and
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

//echo do_shortcode('[contact-form-7 id="640" title="Contact form 1"]');
?>

<h2 class="blog"><?= $title; ?></h2>
<form action="#" method="get">
    <div>
        <label for="tag-checkbox">Cтрогий режим :</label>
        <input type="checkbox" id="tag-checkbox" name="tag-checkbox" <?php
				if($tag_checkbox) {
					echo 'checked';
				}
				?>>
        <label for="tag">Tag :</label>
        <select id="tag" name="tag[]" data-placeholder="Choose a country..." style="width:200px;" multiple class="chosen-select">
					<?php

                        $post_tag = get_terms( array(
                            'taxonomy'      => array( 'post_tag' ),
                            'fields'        => 'id=>name',
                            'hide_empty'    => '1'
                        ));

                        $options = '';

                        foreach($post_tag as $key => $value) {
                            $options .= '<option value="'.$key.'"';
                            if(is_numeric(array_search($key, $tag))) {
                                $options .= ' selected ';
                            }
                            $options .= '>'.$value.'</option>';
                        }

                        echo $options;

					?>
        </select>
    </div>
    <div>
        <label for="category-checkbox">Cтрогий режим :</label>
        <input type="checkbox" id="category-checkbox" name="category-checkbox"<?php
				if($category_checkbox) {
					echo 'checked';
				}
				?>>
        <label for="category">Катагория :</label>
        <select id="category" name="category[]" data-placeholder="Choose a country..." style="width:200px;" multiple class="chosen-select">
					<?php
					$post_tag = get_terms( array(
						'taxonomy'      => array( 'category' ),
						'fields'        => 'id=>name',
						'hide_empty'    => '1'
					));
					$options = '';
					foreach($post_tag as $key => $value) {
						$options .= '<option value="'.$key.'"';
						if(is_numeric(array_search($key, $category))) {
							$options .= ' selected ';
						}
						$options .= '>'.$value.'</option>';
					}
					echo $options;
					?>
        </select>
    </div>
    <button type="submit">Поиск</button>
</form>

<?php

foreach($posts as $post) {
	setup_postdata($post);
	get_template_part('contents/content', 'post');
}

$navigation = '<div class="navigation">';
$navigation_links = paginate_links($a);
if (is_array($navigation_links) || is_object($navigation_links)) {
	foreach($navigation_links as $key => $value) {
		$navigation .= $value;
	}
}

echo $navigation .= '</div>';

wp_reset_postdata();
?>
<!--<link rel="stylesheet" href="<?/*= get_template_directory_uri(); */?>/test/chosen.min.css">
<script src="<?/*= get_template_directory_uri(); */?>/test/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
    });
</script>-->