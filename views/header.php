<!DOCTYPE html>
<html>
<head>
	<title>camagru</title>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Press+Start+2P');
		@import url('https://fonts.googleapis.com/css?family=Rye');
	</style>
	<link href="/template/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header>
	<div class="enter">
		<?php if (User::isGuest()): ?>
		<li><a href="/user/login/">Login</a></li>
		<li><a href="/user/register/">Registration</a></li>
		<?php else: ?>
		<li><a href="/user/logout/">Logout</a></li>
		<?php endif; ?>
	</div>

	<nav>
		<li><a href="/camagru/">camagru</a></li>
		<li><a href="/gallery/">gallery</a></li>
		<?php if (!User::isGuest()): ?>
		<li><a href="/camera/">photo</a></li>
		<li><a href="/account/">account</a></li>
		<?php endif; ?>
	</nav>
</header>