<?php
$id = pll_get_post(107);

$contacts = get_field('contacts_list', $id);
if(!empty($contacts)) {
	foreach ($contacts as $row) {

		if(!empty($row['contact_href'])) {
			$url = '<a href="'.$row['contact_href'].'">'.$row['contact_name'].'</a>';
		} else {
			$url = $row['contact_name'];
		}
        if(!empty($row['contact_image'])) {
            $image = '<i>'.file_get_contents($row['contact_image']).'</i>';
        }
	        $contact .= '<li>'.$image.$url.'</li>';

	}
}

$socials = get_field('socials_list', $id);
if(!empty($socials)) {
	foreach ( $socials as $row ) {
			if(!empty($row['social_image'])) {
				$icon = '<i>'.file_get_contents($row['social_image']).'</i>';
			}
			$socials_list .= '<!-- social__item --><a class="social__item" href="'.$row['social_url'].'" target="_blank">'.$icon.'</a><!-- /social__item -->';
		}
}
?>
<!-- contacts -->
<div class="contacts">

    <!-- contacts__map -->
    <div class="contacts__map" data-zoom="6" data-center="[<?= get_field('map_lat', $id).','.get_field('map_lng', $id);?>]"></div>
    <!-- /contacts__map -->

    <!-- contacts__row -->
    <div class="contacts__row">

        <!-- title -->
        <div class="title title_transparent title_light">

            <h2><span><?= get_post_field('post_content', $id); ?></span></h2>

        </div>
        <!-- /title -->

        <!-- social -->
        <div class="social">

	        <?= $socials_list;  ?>

        </div>
        <!-- /social -->

    </div>
    <!-- /contacts__row -->

    <!-- contacts__row -->
    <div class="contacts__row">

        <!-- contacts__info -->
        <ul class="contacts__info">

	        <?= $contact; ?>

        </ul>
        <!-- /contacts__info -->

    </div>
    <!-- /contacts__row -->

</div>
<!-- /contacts -->