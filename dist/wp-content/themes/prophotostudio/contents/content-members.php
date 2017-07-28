<?php
switch (ICL_LANGUAGE_CODE) {
	case 'uk':
		$member_name = get_user_option('user_firstname', $global_user_id );
		$member_last_name = get_user_option('user_lastname', $global_user_id );
		$member_image = get_field('member_image', 'user_' . $global_user_id );
		$member_image_hover = get_field('member_image_hover', 'user_' . $global_user_id );
		$member_specialisation = get_field('member_specialisation','user_' . $global_user_id );
		$member_post = get_field('member_post', 'user_' . $global_user_id );
		break;
	default:
		$member_name = get_field('member_name_'.ICL_LANGUAGE_CODE, 'user_' . $global_user_id );
		$member_last_name = get_field('member_last_name_'.ICL_LANGUAGE_CODE, 'user_' . $global_user_id );
		$member_image = get_field('member_image', 'user_' . $global_user_id );
		$member_image_hover = get_field('member_image_hover', 'user_' . $global_user_id );
		$member_specialisation = get_field('member_specialisation_'.ICL_LANGUAGE_CODE,'user_' . $global_user_id );
		$member_post = get_field('member_post_'.ICL_LANGUAGE_CODE, 'user_' . $global_user_id );
		break;
}

?>
<!-- team__item -->
<div class="team__item">

	<!-- team__item-picture -->
	<div class="team__item-picture">
		<span style="background-image: url(<?= $member_image['url']; ?>)"></span>
		<span style="background-image: url(<?= $member_image_hover['url']; ?>)"></span>
	</div>
	<!-- /team__item-picture -->

	<!-- team__name -->
	<strong class="team__name"><span><?= $member_name; ?></span> <?= $member_last_name; ?></strong>
	<!-- /team__name -->

	<!-- team__profession -->
	<dl class="team__profession">
		<dt><?= $member_specialisation; ?></dt>
		<dd><?= $member_post; ?></dd>
	</dl>
	<!-- /team__profession -->

</div>
<!-- /team__item -->

