<!DOCTYPE html>
<html lang="en-GB" style="margin-top: 0px !important;">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?><?php
	$title = get_the_title();
	if (is_404()) {
		$title = "Page Not Found";
	}else{
		if(!empty($post) && !isset($_GET['s'])){
			if ($post->post_parent) {
				$title_parent = get_the_title($post->post_parent) . " | ";
			}
		}else{
			$title = "Search";
		}
	}?>

	<title><?php echo $title; echo " | "; if(isset($title_parent)){echo $title_parent;} echo get_bloginfo("name", "display"); if(!empty(get_bloginfo("description", "display"))){ echo ' | '.get_bloginfo("description", "display");} ?></title>
	<meta name="theme-color" content="#FF6D60">

	<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png" />
	<link rel="alternate icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png" >
	<link rel="mask-icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png" color="#FF6D60">
</head>

<body <?php body_class(); ?>>

<div class="wrapper">
    <div class="main-container">

		<header class="main-header">
			
		</header>