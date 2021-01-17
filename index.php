<?php
	session_start();
	$page =  $_GET['page'] ?? 'home';
	$menu = require_once'menu.php';		
	require_once 'libs/session.php';
	require_once 'libs/form.php';	
?>
<!-- https://bootstrap-4.ru/docs/4.2.1/getting-started/introduction -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	 <link rel="stylesheet" href="library/slick/slick.css">
  	<link rel="stylesheet" href="library/slick/slick-theme.css">
  	<link rel="stylesheet" href="library/fancybox-master/dist/jquery.fancybox.min.css">
  	<link rel="stylesheet" href="css/style.css">
	<title>Project_Elenskaya</title>

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Navbar</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    	<?php
    	foreach ($menu as $link =>$text):
    	?>    	
		<li class="nav-item <?= $page==$link ? 'active' : null ?>">
			<a class="nav-link" href="index.php?page=<?= $link ?>"> <?= $text ?></a>    
		</li>
  		<?php endforeach ?>
    </ul>

	<?php if( $_SESSION['user'] ) :?>
	<ul class="navbar-nav ml-auto">
		<li class="nav-item"><p style="margin-top:7px; color:#2560F6">You are logged in as, <?= issetSession('user') ?> </p></li>
		<li class="nav-item ml-3">
		<form action="index.php" method="POST">
			<button class="btn btn-primary" name="action" value="output">Output</button>
		</form>
		</li>
	</ul> 
	
	<?php else: ?>		
		<ul class="navbar-nav ml-auto">
			<li class="nav-item"><a href="index.php?page=registration" class="nav-link">Registration</a></li>
			<li class="nav-item"><a href="index.php?page=entrance" class="nav-link">Entrance</a></li>
		</ul>		
	<?php endif ?>	

	<https://teams.microsoft.com/l/message/19:c564f379db9b429da66d296acc9ae008@thread.tacv2/1585591436328?tenantId=1c2aa41e-5b92-4906-827e-0c10f9d73859&amp;groupId=67e25a03-329c-46be-acbe-f7d65a12ad55&amp;parentMessageId=1584265250369&amp;teamName=Веб-505&amp;channelName=Общий&amp;createdTime=1585591436328>
	</div>
	</nav>

	<?php 	
		if(file_exists("pages/{$page}.php")) {
		require_once "pages/{$page}.php";
		}
		else {
			echo "<p>Pages not found</p>";
		}
		/*clearMessage();*/
		removeSession('message');
	?>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="js/jquery.Jcrop.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
	<script src="library/slick/slick.min.js"></script>
	<script src="library/fancybox-master/dist/jquery.fancybox.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>

