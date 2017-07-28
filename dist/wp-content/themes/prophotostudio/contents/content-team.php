<?php
$id = pll_get_post(93);
$post_custom = get_post($id);
?>
<!-- title -->
<div class="title">

    <h2><span><?= $post_custom->post_content; ?></span></h2>

    <p><?= get_field('team_description', $id);?></p>

</div>
<!-- /title -->

<!-- team -->
<div class="team">

    <!-- team__layout -->
    <div class="team__layout">

	    <?php
	    $args_users = array(
		    'role__not_in' => 'subscriber',
		    'orderby' => 'registered',
		    'count_total' => false,
		    'fields' => array('ID')
	    );

	    $user_ids = get_users($args_users);
	    global $id;

	    foreach ($user_ids as $user_id) {
		    $global_user_id = $user_id->ID;
		    set_query_var( 'global_user_id', absint( $global_user_id ) );
		    get_template_part( 'contents/content', 'members');
	    }

	    ?>
    </div>
	<!-- /team__layout -->

</div>
<!-- /team -->