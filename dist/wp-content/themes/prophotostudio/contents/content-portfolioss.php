<?php
$id = pll_get_post(2);
$title = get_the_title($post);
$content = get_post_field('post_content', $post);
$project_single_thumbnails = get_field('project_single_thumbnails', $post);
$project_about = get_field('project_about', $post);
$to_whom_are_did = get_field('to_whom_are_did', $post);
$project_site = get_field('project_site', $post);
$project_title_about = get_field('project_title_about', $id);
$project_title_made_for = get_field('project_title_made_for', $id);
$project_title_button = get_field('project_title_button', $id);

$project_thumbnail = '';
if (!empty($project_single_thumbnails)) {
  foreach ($project_single_thumbnails as $row) {
    $row = $row['single_thumbnail'];
    $project_thumbnail .= '<p><img src="'.$row['url'].'" alt="'.$row['alt'].'" title="'.$row['title'].'"></p>';
  }
}

if($title) {
    echo '<!-- title -->
    <div class="title">
        <h2><span>'.$title.'</span></h2>
        <p>'.$content.'</p>
    </div>
    <!-- /title -->
    <div class="project">'.$project_thumbnail.'<div class="project__description">
		<h3>'.$project_title_about.'</h3>
        <div class="project__description-texts">'.$project_about.'</div>
		<h3>'.$project_title_made_for.'</h3>
		<p>'.$to_whom_are_did.'</p>
		<p><a target="_blank" class="btn" href="'.$project_site.'"><span>'.$project_title_button.'</span></a></p>
	</div>
</div>';
}









