<?php ob_flush(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>@Guitar Backing Tracks</title>
	<meta charset="UTF-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<meta name="author" content=""/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<!-- Your stuff -->
	<link rel="stylesheet" type="text/css" href="stylesheets/css.css">
  <!-- Include Sidr bundled CSS theme -->
  <link rel="stylesheet" href="stylesheets/jquery.sidr.light.css">
  <!-- Include jQuery -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <!-- Include the Sidr JS -->
  <script src="js/jquery.sidr.min.js"></script>
	<style type="text/css" media="screen">
		.header{ padding-top: 10px; background-color: #eee; border-bottom: 1px solid #ddd; height: 100px;}
		.header h1, .header nav{ display: inline;}
		.input-append{ margin: 5px; }
		.menu-alfa a{text-decoration: none; padding: 3px;}
		nav .menu .menu-alfa{padding-top: 5px;}
		nav .menu .menu-alfa a{ font-size: 130%;}
		nav li{list-style: none;}
	</style>
</head>
<body>

		<!-- cabeçalho da página -->
		<header class="header">
			<div class="container">
				<h1>@Guitar Backing Traks</h1>
				<form class="form form-inline pull-right" 
					action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?menu=list"; ?>" 
					method="post" 
					enctype="multipart/form-data" 
					name="search" >
					<div class="form-group">
						<input type="text" class="span2 form-control" placeholder="Search..." name="src" value="">
					</div>
					<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>  Search</button>
				</form>
			</div>
		</header>

		<div class="container">

			<!-- menu de links -->
			<nav>
				<div class="menu">
					<ul class="pull-right">
						<li class="span1"><a href="http://localhost/bkt/index.php?menu=home">Home</a></li>
						<li class="span1"><a href="#">Forum</a></li>
						<li class="span1"><a href="http://localhost/bkt/index.php?menu=submit">Submit</a></li>
						<li class="span1"><a href="http://localhost/bkt/index.php?menu=contact">Contact</a></li>
					</ul>
					<div class="menu-alfa">
						<a href="http://localhost/bkt/index.php?menu=list&l=@">@</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=A">A</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=B">B</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=C">C</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=D">D</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=E">E</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=F">F</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=G">G</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=H">H</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=I">I</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=J">J</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=K">K</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=L">L</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=M">M</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=N">N</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=O">O</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=P">P</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=Q">Q</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=R">R</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=S">S</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=T">T</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=U">U</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=V">V</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=W">W</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=X">X</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=Y">Y</a>
						<a href="http://localhost/bkt/index.php?menu=list&l=Z">Z</a>
					</div>
				</div>

				<!-- menus responsivos (a opção menu só ira aparecer quando a tela fica menor )-->
			    <div id="mobile-header">
			    	<div class="navbar navbar-fixed-top">
      				<div class="navbar-inner">
       					<div class="container">
       					 	<a class="brand" href="#">@Guitar Backing Traks</a>
			    				<a id="responsive-menu-button" class="btn pull-right" href="#sidr-main">Menu</a>
			    			</div>
			    		</div>
			    	</div>
			    </div>
			    <div id="navigation">
			    	<div id="sidr-remote-content">
				      <ul>
				        <li><a href="index.php">Home</a></li>
				        <li><a href="submit.php">Submit</a></li>
				        <li><a href="list.php">list</a></li>
				        <li><a href="#">Forum</a></li>
				      </ul>
				      <form>
				      	<div class="input-append">
				        	<input type="text" class="pull-left" placeholder="Search...">
				        	<input type="submit" class="btn" right="search">
				        </div>
				      </form>
				    </div>
			    </div>
			    <script>
			        $('#responsive-menu-button').sidr({
			          name: 'sidr-main',
			          source: '#navigation'
			        });
			    </script>
			</nav>

			<!-- primeira section -->
			<div class="container">
				<?php 
					
					if(isset($_GET['menu'])){

						if($_GET['menu'] == "home")
							include "home.php";

						if($_GET['menu'] == 'submit')
							include "submit.php";

						if($_GET['menu'] == 'contact')
							include "contact.php";

						if($_GET['menu'] == 'list')
							include "list.php";

						if($_GET['menu'] == 'control')
							include "control.php";

					}else{
						include "home.php";
					}

				?>
			</div>

			<section>

				<div class="container">

					<div class="pull-left" style="margin-top: 30px;">
						<div class="container">
							<p><h4>Check out these great video guitar lessons at <a href="">GuitarTricks.com</a></h4></p>
						</div>
					</div>		

					<!-- rodapé -->
					<footer class="span12">
						<div class="container">
							<p>Copyright 2016 <a href="">GuitarBackingTrack.com</a> - <a href="">list</a> - <a href="">Privacy</a> - <a href="">Lessons</a> - <a href="">FAQ</a> - <a href="">Custom Backing Tracks</a></p>
						</div>
					</footer> <!-- fim rodapé -->
				</div>
				
			</section>

		</div>	<!-- container end -->				
</body> 
</html>  