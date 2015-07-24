<!DOCTYPE html>
<html lang="en-gb">
<head>
	<title>ianb</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>static/css/normalize.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>static/css/skeleton.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>static/css/custom.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="menu row">
			<div class="two columns">
				<a href="<?php echo base_url(); ?>">Home</a>
			</div>
			<div class="two columns">
				<a href="<?php echo base_url('blog'); ?>">Blog</a>
			</div>
			<div class="two columns">
				<a href="<?php echo base_url('music'); ?>">Music</a>
			</div>
			<div class="two columns">
				<a href="<?php echo base_url('games'); ?>">Games</a>
			</div>
			<div class="two columns">
				<a href="<?php echo base_url('about'); ?>">About</a>
			</div>
			<div class="two columns u-pull-right">
				<a id="steam_avatar" href="http://steamcommunity.com//id/_ianb/">
					<i class="fa fa-spinner fa-pulse"></i>
				</a>
			</div>
		</div>
		<div class="row" style="height:100px;">

		</div>
		<div class="row">
			<div class="u-pull-right" id="recent-music"><i class="fa fa-2x fa-spinner fa-pulse"></i></div>
		</div>