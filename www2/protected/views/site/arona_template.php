<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />
	<link rel="shortcut icon" href="img/fav.png">

	<title>WEBSITE <?=Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA')?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- CSS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Archivo+Narrow' rel='stylesheet' type='text/css'>

	<!-- pricing table style (style_1.css - style_12.css) -->
	<link rel="stylesheet" type="text/css" href="<?=$path?>pricingTable/Table_1/www/styles/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?=$path?>pricingTable/Table_1/www/styles/active.css"/>
	<link rel="stylesheet" type="text/css" href="<?=$path?>pricingTable/Table_1/www/styles/style_10.css"/>

	<link href='<?=$path?>css/bootstrap.min.css' rel='stylesheet' type='text/css'>
	<link href="<?=$path?>css/font-awesome.min.css" rel="stylesheet" type='text/css'>
	<link href="<?=$path?>css/superfish.css" rel="stylesheet" type='text/css'>
	<link href="<?=$path?>css/jquery.dlmenu.css" rel="stylesheet" type='text/css'>

	<!-- Magnific Popup styles -->
	<link rel="stylesheet" href="<?=$path?>css/magnific-popup.css" type="text/css">

	<!-- LayerSlider styles -->
	<link rel="stylesheet" href="<?=$path?>css/layerslider.css" type="text/css">

	<!--[if IE 7]><link type='text/css' rel="stylesheet" href="css/font-awesome-ie7.min.css"><![endif]-->
	<link href='<?=$path?>css/custom.css' rel='stylesheet' type='text/css'>
	<link href='<?=$path?>css/responsive.css' rel='stylesheet' type='text/css'>

	<!--[if lte IE 8]>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:600" />
	<![endif]-->

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="css/lte-ie9.css" type="text/css">
	<![endif]-->

	<style type="text/css" id="parallax-lines">
		.met_parallax_item_1{
			background: url("<?=$path?>photos/parallax/1.jpg") repeat 50% -3px fixed transparent;
		}

		.met_parallax_line_2{
			height: 500px;
		}

		.met_parallax_item_2{
			height: 500px;
			background: url("<?=$path?>photos/parallax/2.jpg") repeat 50% -3px fixed transparent;
		}

		.met_parallax_item_3{
			background: url("<?=$path?>photos/parallax/3.jpg") repeat 50% -3px fixed transparent;
		}

		.touch .met_parallax_item_1,
		.touch .met_parallax_item_2,
		.touch .met_parallax_item_3{background-attachment: scroll!important}
	</style>

	<style id="colorChanges" type="text/css"></style>
	<script src="<?=$path?>js/modernizr.js"></script>
</head>
<body class="clearfix " data-smooth-scrolling="1">
<div id="met_page_loading_bar"></div>
<div class="met_page_wrapper ">
<div class="met_header_wrap met_fixed_header met_header_1">
	<header class="met_content clearfix">
		<a href="index.html" class="met_logo"><img src="<?=$path?>img/logo.png" alt="" height="44px"/></a>

		<nav class="met_vcenter">
			<ul class="met_clean_list met_vcenter">
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/index&art=inicio" title="Home"><span>Inicio </span></a></li>
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/index&art=quienes" title="Home"><span>Quienes Somos </span></a></li>
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/propiedades" title="Home"><span>Propiedades </span></a></li>
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/index&art=servicios" title="Home"><span>Servicios</span> </a></li>
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/index&art=contactanos"><span>Contactanos</span></a></li>
			</ul>
		</nav>

		<div class="met_header_search met_transition">
			<form method="get" action="?" class="met_vcenter">
				<input type="text" class="met_header_search_term" name="SearchTerm" placeholder="Search Term" />
				<button><i class="icon-search"></i></button>
			</form>
		</div>

		<div class="met_header_socials met_vcenter">
		</div>

		<div id="dl-menu" class="dl-menuwrapper">
			<button class="met_bgcolor met_bgcolor_transition2">MENU</button>
			<ul class="dl-menu met_bgcolor7">
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/index&art=inicio" title="Home"><span>Inicio </span></a></li>
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/index&art=quienes" title="Home"><span>Quienes Somos </span></a></li>
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/propiedades" title="Home"><span>Propiedades </span></a></li>
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/index&art=servicios" title="Home"><span>Servicios</span> </a></li>
					<li class="met_vcenter"><a class="met_vcenter" href="index.php?r=site/index&art=contactanos"><span>Contactanos</span></a></li>
			</ul>
		</div><!-- /dl-menuwrapper -->

	</header>
</div>

<div class="met_split_60"></div>
<?=$contenido?>

<footer class="clearfix">
	<div class="met_content">
		<div class="row">
			<div class="col-md-3 clearfix">
				<a href="index.html" class="met_footer_logo"><img src="img/footer_logo.png" alt="" height="44px"/></a>
				<p>PO Box 16122 Collins Street West Arizona Victoria 8007 Australia</p>
				<br>
				<div><span class="met_color">Phone:</span> +61 3 8376 6284</div>
				<div><span class="met_color">Mail:</span> support@envato.com</div>

				<div class="met_split_30"></div>
				<h4>Stay In Touch</h4>
				<a class="met_color_transition met_footer_social" target="_blank" href="http://www.facebook.com"><i class="icon-facebook"></i></a>
				<a class="met_color_transition met_footer_social" target="_blank" href="http://www.twitter.com"><i class="icon-twitter"></i></a>
				<a class="met_color_transition met_footer_social" target="_blank" href="https://plus.google.com"><i class="icon-google-plus"></i></a>
				<a class="met_color_transition met_footer_social" target="_blank" href="#"><i class="icon-rss"></i></a>
			</div>
			<div class="col-md-3">
				<h4>Recent Tweets</h4>
				<div class="met_footer_twits_wrapper clearfix">
					<div class="met_footer_twits"></div>
				</div>
			</div>
			<div class="col-md-6">
				<form method="post" action="?" class="met_form met_contact_form">
					<div class="met_half_input met_no_input_margin met_input_header">
						<h4>What is your name?</h4>
						<span class="met_color">Lorem ipsum dolor sit amet</span>
					</div>
					<div class="met_half_input met_input_header">
						<h4>What is your E-Mail address?</h4>
						<span class="met_color">Mauris libero felis, pulvinar</span>
					</div>

					<input type="text" name="name" class="met_half_input met_no_input_margin met_input_text" required="" />
					<input type="text" name="email" class="met_half_input met_input_text" required="" />

					<div class="met_half_input met_no_input_margin met_input_header">
						<h4>What is it about?</h4>
						<span class="met_color">Quisque dapibus vitae</span>
					</div>
					<textarea class="met_full_input met_input_text met_textarea" name="message" required=""></textarea>

					<button type="submit" class="btn btn-primary btn-xs">Send</button>
					<div class="met_contact_thank_you">We received your message!</div>
				</form>
			</div>
		</div>
	</div>
	<div class="met_footer_copyright clearfix">
		<div class="met_content">
			<p>COPYRIGHT © 2013 - ALL RIGHTS RESERVED</p>

			<ul class="met_footer_menu met_clean_list">
				<li><a class="met_color_transition" href="index.html">Home</a></li>
				<li><a class="met_color_transition" href="aboutus.html">About Us</a></li>
				<li><a class="met_color_transition" href="portfolio.html">Portfolio</a></li>
				<li><a class="met_color_transition" href="services.html">Services</a></li>
				<li><a class="met_color_transition" href="blog.html">Blog</a></li>
			</ul>
		</div>
	</div>
</footer>

</div>

<!-- Scripts -->
<script src="<?=$path?>js/met_loading.js"></script>

<script src="<?=$path?>js/jquery.js"></script>
<script src="<?=$path?>js/flexbox-fallback.js"></script>

<!--[if lte IE 8]>
<script src="js/respond.js"></script>
<script src="js/selectivizr-min.js"></script>
<script src="js/excanvas.compiled.js"></script>
<![endif]-->

<script src="<?=$path?>js/retina.js"></script>
<script src="<?=$path?>js/bootstrap.min.js"></script>

<!-- jQuery with jQuery Easing, and jQuery Transit JS -->
<script src="<?=$path?>js/jquery-easing-1.3.js" type="text/javascript"></script>
<script src="<?=$path?>js/jquery-transit-modified.js" type="text/javascript"></script>
<!-- LayerSlider from Kreatura Media with Transitions -->
<script src="<?=$path?>js/layerslider.transitions.js" type="text/javascript"></script>
<script src="<?=$path?>js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="<?=$path?>js/gmaps.js"></script>

<script src="<?=$path?>js/superfish.js"></script>
<script src="<?=$path?>js/fullscreenr.js"></script>
<script src="<?=$path?>js/hoverIntent.js"></script>
<script src="<?=$path?>js/hoverdir.js"></script>
<script src="<?=$path?>js/isotope.js"></script>
<script src="<?=$path?>js/parallax.js"></script>
<script src="<?=$path?>js/jflickrfeed.min.js"></script>
<script src="<?=$path?>js/magnific-popup.js"></script>
<script src="<?=$path?>js/imagesLoaded.js"></script>
<script src="<?=$path?>js/caroufredsel.js"></script>
<script src="<?=$path?>js/knob.js"></script>
<script src="<?=$path?>js/nicescroll.js"></script>
<script src="<?=$path?>js/jquery.dlmenu.js"></script>
<script src="<?=$path?>js/custom.js"></script>

</body>
</html>