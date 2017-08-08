<?php
add_action('wp_ajax_gallery', 'gallery_ajax');
add_action('wp_ajax_nopriv_gallery', 'gallery_ajax');
function gallery_ajax() {
	$type = $_GET['type'];
	$page = $_GET['page']+1;

	$posts_per_page = 9;
	if($type === 'headshot') {
		$posts_per_page = 6;
	}
	if($type === 'all' || $type === '') {
		$categories = get_field('show_category', 2);
		foreach ($categories as $row) {
			$categories_arr[] = $row->slug;
		}
		$args = array(
			'post_type'      => 'portfolio',
			'paged' => $page,
			'posts_per_page' => $posts_per_page,
			'orderby'        => 'menu_order',
			'post_status'    => 'publish',
			'fields'         => 'ids',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio',
					'field'    => 'slug',
					'terms'    => $categories_arr,
				)
			)
		);
	} else {
		$args = array(
			'post_type'      => 'portfolio',
			'paged' => $page,
			'posts_per_page' => $posts_per_page,
			'orderby'        => 'menu_order',
			'post_status'    => 'publish',
			'fields'         => 'ids',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio',
					'field'    => 'slug',
					'terms'    => $type,
				)
			)
		);
	}

	$query = new WP_Query();
	$posts = $query->query($args);

	$portfolio_items = '';
	if(!empty($posts)) {
		foreach ($posts as $row) {
			$class = implode(' ', wp_get_post_terms($row, 'portfolio', array('fields' => 'id=>slug', )));
			$image = get_field('image', $row)['url'];
			$image_overlay = get_field('image_overlay', $row)['url'];
			$video = get_field('project_show', $row);
			if($video === '1') {
				$image_overlay = get_field('video', $row, false, false);
				$image = explode('/', $image_overlay);
				$image = 'http://img.youtube.com/vi/'.$image[count($image)-1].'/maxresdefault.jpg';
			}
			$portfolio_items .= '{"type": "all '.$class.'","dummy": "'.$image.'","dummy__big": "'.$image_overlay.'","title": "'.get_field('title_overlay', $row).'","video": "'.$video.'"}, ';
		}
	}
	$portfolio_items = substr($portfolio_items,0, -2);
	if($query->max_num_pages > $page) {
		$has_items = 1;
	} else {
		$has_items = 0;
	}
	echo '{"has_items": '.$has_items.',"items":[
                        '.$portfolio_items.'
                    ]
                }';
	exit;
}

add_action('wp_ajax_order', 'order_ajax');
add_action('wp_ajax_nopriv_order', 'order_ajax');
function order_ajax() {

	//var_dump( $_FILES);


	$name_of_uploaded_file = $_FILES[0];
	$formData = $_POST;

	getFile( $name_of_uploaded_file, $formData );

	exit;
}

function getFile( $filename , $formData ) {

	$allowedExts = array("csv","pdf");
	$temp = explode(".", $filename["name"]);
	$extension = end($temp);
	$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv','application/pdf');

	if (in_array($filename['type'],$mimes )
	    && ($filename["size"] < 2000000)
	    && in_array($extension, $allowedExts))
	{
		if ($filename["error"] > 0)
		{
			echo "Return Code: " . $filename["error"] . "<br>";
		}
		else
		{
			sendMailAsAttachment( $filename["tmp_name"], $filename["name"], $formData );
		}
	}
	else
	{
		echo "Invalid file";
	}
}

function prepareEmail( $formData, $mime_boundary ) {

	// email fields: to, from, subject, and so on
	$to = "akumuliation@gmail.com";
	$from = "wordpress@pro-photo-studio.websters.com.ua";
	$subject ="";
	$message = "Uploaded File\n";
	$message .= "Firs Name :". $formData['firs-name']."\n";
	$message .= "Last Name :". $formData['last-name']."\n";
	$message .= "Company Name :". $formData['company-name']."\n";
	$message .= "Phone Number :". $formData['phone-number']."\n";
	$message .= "Street Address :". $formData['address']."\n";
	$message .= "City :". $formData['city']."\n";
	$message .= "State :". $formData['state']."\n";
	$message .= "Zip Code :". $formData['zip-code']."\n";
	$message .= "Email :". $formData['email']."\n";
	$message .= "Website :". $formData['website']."\n";
	$message .= "Uniqe code :". $formData['uniqe-code']."\n";
	$message .= "Total shot quantity needed :". $formData['total-shot']."\n";
	$message .= "Group shot quantity needed :". $formData['group-shot']."\n";
	$message .= "Price :". $formData['price']."\n";
	$message .= "Background :". $formData['background']."\n";
	$message .= "Turn-around time :". $formData['time']."\n";
	$message .= "Clipping path :". $formData['clipping-path']."\n";
	$message .= "Hand image :". $formData['hand-image']."\n";
	$message .= "Imag category :". $formData['image-category']."\n";
	$message .= "Image purpose :". $formData['image-purpose']."\n";
	$message .= "Coupon code :". $formData['coupon-code']."\n";
	$message .= "How did you hear about us? :". $formData['about-us']."\n";
	$message .= "Comments :". $formData['comments']."\n";
	$message .= "Electronic signature :". $formData['svg']."\n";
	$message .= "Need prodect back :". $formData['prodect-back']."\n";
	$headers = "From: $from";


	// headers for attachment
	$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

	// multipart boundary
	$message .= "This is a multi-part message in MIME format.\n\n" .
	            "--{$mime_boundary}\n" .
	            "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
	            "Content-Transfer-Encoding: 7bit\n\n" .
	            $message .= "\n\n";

	$emailData = array (
		'to' => $to,
		'from' => $from,
		'subject' => $subject,
		'headers' => $headers,
		'message' => $message
	);

	return $emailData;

}

function prepareAttachment( $filename ,$fileorgname, $mime_boundary ) {
	$attachContent = '';
	$file = fopen($filename,"rb");
	$data = fread($file,filesize($filename));
	fclose($file);
	$cvData = chunk_split(base64_encode($data));
	$attachContent .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$fileorgname\"\n" .
	                  "Content-Disposition: attachment;\n" . " filename=\"$fileorgname\"\n" .
	                  "Content-Transfer-Encoding: base64\n\n" . $cvData . "\n\n";
	$attachContent .= "--{$mime_boundary}\n";

	return $attachContent;

}

function sendMailAsAttachment( $filename, $fileorgname, $formData ) {

	// boundary
	$semi_rand = md5(time());
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

	$emailData = prepareEmail( $formData, $mime_boundary);
	$attachContent = prepareAttachment( $filename, $fileorgname, $mime_boundary );
	$message = $emailData['message'].$attachContent;
	var_dump($message);
	$ok = @mail($emailData['to'], $emailData['subject'], $message, $emailData['headers']);
	if ($ok) {
		echo "<p>mail sent to ".$emailData['to']."!</p>";
	} else {
		echo "<p>mail could not be sent!</p>";
	}
}