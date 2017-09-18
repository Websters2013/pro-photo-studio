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
		$categories_arr = '';
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
					'taxonomy' => 'portfolio_cat',
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
					'taxonomy' => 'portfolio_cat',
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
			$class = implode(' ', wp_get_post_terms($row, 'portfolio_cat', array('fields' => 'id=>slug', )));
			$image = get_field('image', $row)['url'];
			$image_overlay = get_field('image', $row)['url'];
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
	$mimes = array('application/vnd.ms-excel','text/html','text/csv','text/tsv','application/pdf');
	sendMailAsAttachment( $filename["tmp_name"], $filename["name"], $formData );
	/*if (in_array($filename['type'],$mimes )
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
	}*/
}

function prepareEmail( $formData, $mime_boundary ) {

	// email fields: to, from, subject, and so on
	//$to = "info@prophotostudio.net, billing@prophotostudio.net, careers@prophotostudio.net";
	$to = 'akumuliation@gmail.com, vetalia777@mail.ru';
	$from = "wordpress@beta.prophotostudio.net";
	$subject = "New job-";
	$message = "Uploaded File<br>";
	$message .= "Firs Name: ". urldecode ($formData['firs-name'])."<br>";
	$message .= "Last Name: ". urldecode ($formData['last-name'])."<br>";
	$message .= "Company Name: ". urldecode ($formData['company-name'])."<br>";
	$message .= "Phone Number: ". urldecode ($formData['phone-number'])."<br>";
	$message .= "Street Address: ". urldecode ($formData['address'])."<br>";
	$message .= "City: ". urldecode ($formData['city'])."<br>";
	$message .= "State: ". urldecode ($formData['state'])."<br>";
	$message .= "Zip Code: ". urldecode ($formData['zip-code'])."<br>";
	$message .= "Email: ". urldecode ($formData['email']) ."<br>";
	$message .= "Website: ". urldecode ($formData['website']) ."<br>";
	$message .= "Uniqe code: ". urldecode ($formData['uniqe-code'])."<br>";
	$message .= "Total shot quantity needed: ". urldecode ($formData['total-shot']) ."<br>";
	$message .= "Group shot quantity needed: ". urldecode ($formData['group-shot']) ."<br>";
	$message .= "Price: ". urldecode ($formData['price']) ."<br>";
	$message .= "Background: ". urldecode ($formData['background']) ."<br>";
	$message .= "Turn-around time: ". urldecode ($formData['time']) ."<br>";
	$message .= "Clipping path: ". urldecode ($formData['clipping-path']) ."<br>";
	$message .= "Hand image: ". urldecode ($formData['hand-image']) ."<br>";
	$message .= "Imag category: ". urldecode ($formData['image-category']) ."<br>";
	$message .= "Image purpose: ". urldecode ($formData['image-purpose']) ."<br>";
	$message .= "Coupon code: ". urldecode ($formData['coupon-code']) ."<br>";
	$message .= "How did you hear about us?: ". urldecode ($formData['about-us']) ."<br>";
	$message .= "Comments: ". urldecode ($formData['comments']) ."<br>";
	$headers = "From: $from";


	// headers for attachment
	$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

	// multipart boundary
	$message .= "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
	$message .= "--{$mime_boundary}\n";

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
	$semi_rand = md5(time());
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

	$emailData = prepareEmail( $formData, $mime_boundary);
	$attachContent = prepareAttachment( $filename, $fileorgname, $mime_boundary );

	$text = urldecode ($formData['svg']);
	$fp = fopen("file.svg", "w");
	fwrite($fp, $text);
	fclose($fp);
	$file = fopen("file.svg","rb");
	$data = fread($file,filesize($filename));
	fclose($file);
	$cvData = chunk_split(base64_encode($data));
	$attachContent .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"file.svg\"\n" .
	                  "Content-Disposition: attachment;\n" . " filename=\"file.svg\"\n" .
	                  "Content-Transfer-Encoding: base64\n\n" . $cvData . "\n\n";
	$attachContent .= "--{$mime_boundary}\n";
	$message = $emailData['message'].$attachContent;
	$ok = @mail($emailData['to'], $emailData['subject'], $message, $emailData['headers']);
	if ($ok) {
		echo "<p>mail sent to ".$emailData['to']."!</p>";
	} else {
		echo "<p>mail could not be sent!</p>";
	}
}