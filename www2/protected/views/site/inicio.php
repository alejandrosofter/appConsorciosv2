<?php if(Settings::model()->getValorSistema('WEB_NOMBREPLANTILLA')=='thinker_template'){?>
<div class="slideshow">
				<div id="slides">
					<div id="slider-big">
						<div class="slides_container big-slider">
							<!-- SLIDER STARTS-->
							<!-- SLIDER CONTENT STARTS-->
							<div class="slide">
								<img src="images/<?=Settings::model()->getValorSistema("WEB_IMAGEN1")?>" alt=" " width="1000" height="350"/>
								
								
							</div>
							<?php if(Settings::model()->getValorSistema("WEB_IMAGEN2")!=""){?>
							<div class="slide">
								<img src="images/<?=Settings::model()->getValorSistema("WEB_IMAGEN2")?>" alt=" " width="1000" height="350"/>
								
							
							</div>
							<?php }?>
							<?php if(Settings::model()->getValorSistema("WEB_IMAGEN3")!=""){?>
							<div class="slide">
								<img src="images/<?=Settings::model()->getValorSistema("WEB_IMAGEN3")?>" alt=" " width="1000" height="350"/>
								
							</div>
							<?php }?>
							<?php if(Settings::model()->getValorSistema("WEB_IMAGEN4")!=""){?>
							<div class="slide">
								<img src="images/<?=Settings::model()->getValorSistema("WEB_IMAGEN4")?>" alt=" " width="1000" height="350"/>
								
							</div>
							<?php }?>
						</div>
						<!-- SLIDESHOW CONTAINER ENDS-->
					</div>
					<div class="slides-nav">
						<a href="#" class="prev">Previous Slide</a>
						<a href="#" class="next">Next Slide</a>
					</div>
				</div>
</div>
<?php }?>
<?php if(Settings::model()->getValorSistema('WEB_NOMBREPLANTILLA')=='arona_template'){?>
<div id="layerslider-container-fw">
	<div id="layerslider" style="width: 100%; height: 600px; margin: 0 auto; ">
		<div class="ls-layer" style="slidedirection: right; transition2d: 73,21,33,55,75,77,79,101,94,88,80,82,84;">
			<img src="photos/slider/4.png" class="ls-bg" alt="Slide background">
			<img class="ls-s-1" src="photos/slider/slider_4_man.png" alt="layer1-sublayer1" style="left: 75%; top: 59px; slidedirection : right; slideoutdirection : right;">
			<h5 class="ls-s-2 met-ls-title-6" style="left: 50px; top: 220px;">Welcome to your new virtual office of the future<br>Online office available 24 hours a day / 365 days a year</h5>
			<div class="ls-s-5 met-ls-text-3" style="left: 50px; top: 306px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
			<div class="ls-s-7 met-ls-button-1" style="left: 50px; top: 350px;"><a href="#" class="btn btn-primary btn-sm">Learn More</a></div>
		</div>
		<div class="ls-layer" style="slidedirection: bottom;  transition2d: 73,21,33,55,75,77,79,101,94,88,80,82,84;">
			<img src="photos/slider/2.jpg" class="ls-bg" alt="Slide background">
			<img class="ls-s-4" src="photos/slider/slider_2_baloon.png" alt="layer2-sublayer1" style="left: 50px; top: 0; slidedirection: bottom; slideoutdirection: bottom; delayin: 2500;">
			<img class="ls-s-1" src="photos/slider/slider_2_man.png" alt="layer2-sublayer2" style="left: 700px; top: 10px; slidedirection: right; slideoutdirection: right; delayin: 2000;">
			<img class="ls-s-5" src="photos/slider/slider_2_met.png" alt="layer2-sublayer3" style="left: 834px; top: 390px; slidedirection : fade; delayin: 3000;">
			<h5 class="ls-s-2 met-ls-title-2" style="left: 50px; top: 250px; slidedirection: left; slideoutdirection: left;">Arona Business Theme</h5>
			<h6 class="ls-s-4 met-ls-title-3" style="left: 50px; top: 303px; slidedirection: left; slideoutdirection: left; delayin: 500;">HTML5 & Responsiveness</h6>

			<img class="ls-s-8" src="photos/slider/slider_2_html5.png" alt="layer2-sublayer2" style="left: 50px; top: 366px; slidedirection: top; slideoutdirection: bottom; delayin: 1000;">
			<img class="ls-s-8" src="photos/slider/slider_2_plus.png" alt="layer2-sublayer3" style="left: 137px; top: 394px; delayin: 2000;">
			<img class="ls-s-9" src="photos/slider/slider_2_css3.png" alt="layer2-sublayer3" style="left: 173px; top: 366px; slidedirection: bottom; slideoutdirection: top; delayin: 1500;">
		</div>
		<div class="ls-layer" style="slidedirection: right; transition2d: 73,21,33,55,75,77,79,101,94,88,80,82,84;">
			<img src="photos/slider/1.jpg" class="ls-bg" alt="Slide background">
			<img class="ls-s-1" src="photos/slider/slider_1_phone.png" alt="layer1-sublayer1" style="left: 75%; top: 109px; slidedirection : right; slideoutdirection : right;">
			<h5 class="ls-s-2 met-ls-title-1" style="left: 50px; top: 220px;">Multi-Purpose Business Theme</h5>
			<div class="ls-s-5 met-ls-text-1" style="left: 50px; top: 286px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus.</div>
			<div class="ls-s-7 met-ls-button-1" style="left: 50px; top: 350px;"><a href="#" class="btn btn-primary btn-sm">Read More</a></div>
		</div>
		<div class="ls-layer" style="slidedirection: left;  transition2d: 73,21,33,55,75,77,79,101,94,88,80,82,84; ">
			<img src="photos/slider/3.png" class="ls-bg" alt="Slide background">
			<img class="ls-s-1" src="photos/slider/slider_3_desktop.png" alt="layer1-sublayer1" style="left: 640px; top: 108px; easingin: easeOutExpo; rotatein: 180; rotateout: -90; scalein: 2; scaleout: 0.5; delayin: 300;">
			<img class="ls-s-2" src="photos/slider/slider_3_phone.png" alt="layer1-sublayer1" style="left: 580px; top: 335px; easingin: easeOutExpo; rotatein: 180; rotateout: -90; scalein: 2; scaleout: 0.5; delayin: 600;">
			<img class="ls-s-3" src="photos/slider/slider_3_tablet.png" alt="layer1-sublayer1" style="left: 1000px; top: 285px; easingin: easeOutExpo; rotatein: 180; rotateout: -90; scalein: 2; scaleout: 0.5; delayin: 900;">

			<h3 class="ls-s-2 met-ls-title-4" style="left: 50px; top: 180px;">LIKE DREAMING</h3>
			<h4 class="ls-s-2 met-ls-title-5" style="left: 50px; top: 225px;">Multi-Purpose Business Theme</h4>
			<div class="ls-s-5 met-ls-text-2" style="left: 50px; top: 280px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus.</div>
			<div class="ls-s-7 met-ls-button-1" style="left: 50px; top: 350px;"><a href="#" class="btn btn-primary btn-sm">Read More</a></div>
		</div>
	</div>
</div>
<?php }?>
			<!-- SLIDER ENDS-->
			<!-- SLIDESHOW ENDS-->
			<div class="post-info-bar">
				<?=Settings::model()->getValorSistema('WEB_INICIO')?>
			</div>
			<section id="content">
			
			<?=Settings::model()->getValorSistema('WEB_CUERPOINICIO')?>
			</section>