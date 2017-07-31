<?php
/*
Template Name: Our team
*/
 get_header();
get_template_part('contents/content', 'submenu');
$post_id = 83;

$team = get_field('team', $post_id);
$team_string = '';

if($team) {
 foreach ($team as $row) {
  if($row['choice_template'] === '0'){
    $team_string .= '<!-- team__item -->
  <div class="team__item">

   <!-- team__content -->
   <div class="team__content">

    <h3 class="team__name">'.$row['name'].'</h3>
    <p class="team__post">'.$row['post'].'</p>
    '.$row['content'].'
   </div>
   <!-- /team__content -->

   <!-- team__img -->
   <div class="team__img">
    <img src="'.$row['image']['url'].'" alt="'.$row['image']['alt'].'" title="'.$row['image']['title'].'"/>
   </div>
   <!-- /team__img -->

  </div>
  <!-- /team__item -->';
  } elseif ($row['choice_template'] === '1') {
	  $team_string .= '<!-- team__wrap -->
  <div class="team__wrap">

   <!-- team__wrap-item -->
   <div class="team__wrap-item">

    <h3 class="team__name">'.$row['name_one'].'</h3>
    <p class="team__post">'.$row['post_one'].'</p>

    <div class="team__img">
     <img src="'.$row['image_one']['url'].'" alt="'.$row['image_one']['alt'].'" title="'.$row['image_one']['title'].'"/>
    </div>

   </div>
   <!-- /team__wrap-item -->

   <!-- team__wrap-item -->
   <div class="team__wrap-item">

    <h3 class="team__name">'.$row['name_two'].'</h3>
    <p class="team__post">'.$row['post_two'].'</p>

    <div class="team__img">
     <img src="'.$row['image_two']['url'].'" alt="'.$row['image_two']['alt'].'" title="'.$row['image_two']['title'].'"/>
    </div>

   </div>
   <!-- /team__wrap-item -->

  </div>
  <!-- /team__wrap -->';
  }
 }
}
?>

 <!-- team -->
 <article class="team">

  <h1><?= get_post_field('post_content', $post_id) ?></h1>

 <?= $team_string; ?>

 </article>
 <!-- /team -->
        
<?php get_footer(); ?>