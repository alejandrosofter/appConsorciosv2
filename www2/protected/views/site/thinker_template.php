<!DOCTYPE html>
<!--[if IE 8]>
	<link rel="stylesheet" href="css/ie8.css" type="text/css" media="screen"/>
 <![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" href="css/ie7.css" type="text/css" media="screen"/>
 <![endif]-->
<html class="not-ie no-js" lang="es">
<!--<![endif]-->
<head>
<meta charset="UTF-8"/>
<title>WEBSITE <?=Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA')?></title>
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" type="image/gif" href="<?=$path?>images/favicon.gif"/>
<link rel="stylesheet" href="<?=$path?>css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?=$path?>css/<?=$estilo?>.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?=$path?>css/nivo-slider.css" type="text/css" media="screen"/>
<!--GOOGLE FONTS-->
<!--CHOOSE WICH FONT YOU WANT TO USE AND DELETE THE REST FOR FASTER LOADING-->
<link href='http://fonts.googleapis.com/css?family=Droid+Sans|Droid+Serif:400,400italic' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis:400,200' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Crimson+Text:400,400italic' rel='stylesheet' type='text/css'/>
<!--GOOGLE FONTS-->
<!--JS FILES STARTS-->


<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?=$path?>js/custom.js"></script>
<script type="text/javascript" src="<?=$path?>js/google-map/jquery.gmap.min.js"></script>
<script type="text/javascript" src="<?=$path?>js/elasticSlider/jquery.eislideshow.js"></script>
<script type="text/javascript" src="<?=$path?>js/accordian/jquery.accordion.js"></script>
<script type="text/javascript" src="<?=$path?>js/cycle-slider/cycle.js"></script>
<script type="text/javascript" src="<?=$path?>js/prettyPhoto/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=$path?>js/tabify/jquery.tabify.js"></script>
<script type="text/javascript" src="<?=$path?>js/nivo-slider/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="<?=$path?>js/twitter/jquery.tweet.js"></script>
<script type="text/javascript" src="<?=$path?>js/toolTip/jquery.tooltip.v.1.1.js"></script>
<script type="text/javascript" src="<?=$path?>js/slides/slides.min.jquery.js"></script>
<script type="text/javascript" src="<?=$path?>js/portfolio/filterable.js"></script>
<script type="text/javascript" src="<?=$path?>js/scrolltop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="<?=$path?>js/easing/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=$path?>js/kwicks/jquery.kwicks-1.5.1.pack.js"></script>
<script type="text/javascript" src="<?=$path?>js/prettyPhoto/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=$path?>js/anchor-scroll/jquery.anchorScroll.js"></script>

</head>
<body>
<div id="wrapper">
	<div class="center">
		<div id="container">
			<div class="old-browsers-header">
				<header id="header">
				<!--WRAPPER-->
				<!-- HEADER  -->
				<a title="Inicio" href="index.php"><img src='images/<?=Settings::model()->getValorSistema("LOGOEMPRESA")?>'></img></a>
				<!--LOGO ENDS  -->
				<!--CALL US  -->
				<div class="our-info">
					<h4>Llamanos Ahora!<a href="#" class="colored" title="Llamanos ahora! " id="link-2"><?=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO')?></a></h4>
				</div>
				<!--CALL US ENDS -->
				<nav id="main_navigation" class="main-menu ">
				<!--  MAIN  NAVIGATION-->
				<ul>
					<li><a href="index.php?r=site/index&art=inicio" title="Home">Inicio </a></li>
					<li><a href="index.php?r=site/index&art=quienes" title="Home">Quienes Somos </a></li>
					<li><a href="index.php?r=site/propiedades" title="Home">Propiedades </a></li>
					<li><a href="index.php?r=site/index&art=servicios" title="Home">Servicios </a></li>
					<li><a href="index.php?r=site/index&art=contactanos">Contactanos</a></li>
				</ul>
				<fieldset class="search-place">
					<ul>
					<li><?=Yii::app()->user->isGuest?'<a href="index.php?r=site/login"><span class="colored">LOGIN</span> sistema </a>':'<a href="index.php?r=site/usuario"><span class="colored">M</span>i cuenta</a>';?></li>
					</ul>
				</fieldset>
				</nav>
				<!-- MAIN NAVIGATION ENDS-->
				</header>
			</div>
			
			<!-- SLIDER ENDS-->
			<!-- SLIDESHOW ENDS-->
			
			<script>
				Jquery(document).ready(function($){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
			</script>
			<section id="content"><?=$contenido?></section>
			
			<div id="pre-footer-bg">
			</div>
			<div id="footer-wrapper">
				<!-- FOOTER WRAPPER STARTS-->
				<div id="footer-container">
					<!-- FOOTER CONTAINER STARTS-->
					<div id="old-browsers-footer">
						<footer id="footer">
						<!-- FOOTER STARTS-->
						<div class="one">
							<!-- COLUMN CONTAINER STARTS-->
							<div class="one-fourth ">
								<!-- COLUMN STARTS-->
								<h3><span class="headings-img"></span>Nuestra <span class="bolder">Empresa</span></h3>
								
								<ul id="footer-info">
									<li><?=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION')?></li>
									<li><b>Tel.</b><?=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO')?></li>
									<li><a href="mailto:<?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?>" class="colored"><?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?></a></li>
									<!-- SOCIAL LINKS ENDS-->
								</ul>
							</div>
							<!-- COLUMN ENDS-->
							<div class="one-fourth ">
								<!-- COLUMN STARTS-->
								<h3><span class="headings-img"></span>Links <span class="bolder">Ayuda</span></h3>
								<ul class="simple-nav">
									<li><a target='_blank' href="http://www.cia.org.ar">Camara Inmobiliaria</a></li>
									<li><a target='_blank' href="https://www.google.com.ar/url?sa=t&rct=j&q=&esrc=s&source=web&cd=2&cad=rja&uact=8&ved=0CCsQFjAB&url=http%3A%2F%2Fwww.dolarsi.com%2F&ei=wg5_VOPXMYLwoASl04LQBA&usg=AFQjCNEKNfHvluGrqkhhB2FjZLKMxNZ81Q&sig2=f6cfjKTH0RubYinw3YFG9Q&bvm=bv.80642063,d.cGU">El dolar Hoy</a></li>
									<li><a target='_blank' href="https://www.google.com.ar/url?sa=t&rct=j&q=&esrc=s&source=web&cd=3&cad=rja&uact=8&ved=0CDUQFjAC&url=http%3A%2F%2Fwww.jus.gob.ar%2Fatencion-al-ciudadano%2Fguia-de-derivaciones%2Fdefensa-del-consumidor.aspx&ei=jw5_VOvDMYLsoATRmoL4DA&usg=AFQjCNHKWw_gbXMjyVnLc13H46davr0Ung&sig2=FUMA5-saQ9R-GHyquadEMw&bvm=bv.80642063,d.cGU">Defensa al consumidor</a></li>
								</ul>
								<!--END UL-->
							</div>
							<div class="one-fourth">
								<!-- COLUMN STARTS-->
								<h3><span class="headings-img"></span>Lo <span class="bolder">Destacado</span></h3>
								
								<!--END UL-->
							</div>
							<!-- COLUMN ENDS-->
							<!-- COLUMN ENDS-->
							<div class="one-fourth last">
								<!-- COLUMN STARTS-->
								<h3><span class="headings-img"></span>Ultimas <span class="bolder">Fotos</span></h3>
								<ul id="our-photos-footer">
									
								</ul>
								
							</div>
							<!-- COLUMN ENDS-->
						</div>
						<!-- COLUMN CONTAINER ENDS-->
						</footer>
						<!-- FOOTER ENDS-->
					</div>
				</div>
				<!-- FOOTER CONTAINER ENDS-->
			</div>
			<div id="copyright-wrapper">
				<p>
					&copy; 2014 <a href="about.html" class="colored"></a> Softer - todos los derechos reservados
				</p>
				<ul id="header-icons">
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>