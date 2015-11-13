	<input class="radio" checked type=radio name=respond id=desktop />
	<input class="radio" type=radio name=respond id=tablet />
	<input class="radio" type=radio name=respond id=mobile />
	<article id=slider>
		


		
	
		<!-- Slider Setup -->
	
		<input checked type=radio class="radio" name=slider id=slide1 />
		<input class="radio" type=radio name=slider id=slide2 />
		<input class="radio" type=radio name=slider id=slide3 />
		<input class="radio" type=radio name=slider id=slide4 />
		<input class="radio" type=radio name=slider id=slide5 />
	
	
		<!-- The Slider -->

		
		<div id=slides>
		
			<div id=overflow>
			
				<div class=inner>
				    <article>
						<!--<div class=info><h3>Cliffs</h3> by <a href="http://voyager3.tumblr.com">Brendan Zabarauskas</a></div>-->
						<a href="http://garantmarket.by/catalog/prizhimnye_ustrojstva/ustrojstvo-frezernoe-md-01"><img  src="http://garantmarket.by/sl/ustrfrez.jpg" alt=""></a>
					</article>
					
				    <article>
						<!--<div class=info><h3>Cliffs</h3> by <a href="http://voyager3.tumblr.com">Brendan Zabarauskas</a></div>-->
						<a href="http://garantmarket.by/catalog/stanki/"><img  src="http://garantmarket.by/sl/bankurs.jpg" alt=""></a>
					</article>
				
					<article>
												<!--<div class=info><h3>Cloud Dragon</h3> by <a href="http://voyager3.tumblr.com">Brendan Zabarauskas</a></div>-->
						<a href="http://garantmarket.by/catalog/prizhimnye_ustrojstva/"><img src="http://garantmarket.by/sl/banrejs.jpg" alt=""></a> 
					</article>

					
					<article>
						<!--<div class=info><h3>Mountain Fort</h3> by <a href="http://voyager3.tumblr.com">Brendan Zabarauskas</a></div>-->
						 <a href="http://garantmarket.by/sale/"><img  src="http://garantmarket.by/sl/banner5.jpg" alt=""></a>
					</article>
					
					<!--	<article>
																	<div class=info><h3>Mountain Outpost</h3> by <a href="http://voyager3.tumblr.com">Brendan Zabarauskas</a></div>

												 <a href="#"> <img src="http://garantmarket.by/sl/hotbanner.jpg"></a>
					</article>-->
					
					
					<!--<article>

						<div class=info><h3>Hill Fort</h3> by <a href="http://voyager3.tumblr.com">Brendan Zabarauskas</a></div>
						<img src="http://csscience.com/responsiveslidercss3/HillFortByBjzaba.png" />
					</article>-->
					
				</div> <!-- .inner -->
				
			</div> <!-- #overflow -->
		
		</div> <!-- #slides -->

	
	
		<!-- Controls and Active Slide Display -->
	
		<div id=controls>

			<label for=slide1></label>
			<label for=slide2></label>
			<label for=slide3></label>
		    <label for=slide4></label>

  <!--  добавить слайды
			<label for=slide5></label>-->
		
		</div> <!-- #controls -->

		
		<div id=active>

			<label for=slide1></label>
			<label for=slide2></label>
			<label for=slide3></label>
		    <label for=slide4></label>
			
   <!--добавить слайды
			<label for=slide5></label>
			-->
		</div> <!-- #active -->
</article>
<style type="text/css">






label, a {
	color: teal;
	cursor: pointer;
	text-decoration: none;
}
label:hover, a:hover {
	color: #000 !important;
}

.catch { display: block; height: 0; overflow: hidden; }
#slider {
	margin: 0 auto;
}
#description {
	margin: 25px auto;
	text-align: left;
	max-width: 650px;
	padding: 0 25px;
}
.respond {
	margin: 0 auto;
	max-width: 370px;
}



.inner img {
	width: 100%;
}





/* NEW EXPERIMENT */
/* 
r Setup */

.radio {
	display: none;
}

#slide1:checked ~ #slides .inner { margin-left:0; }
#slide2:checked ~ #slides .inner { margin-left:-100%; }
#slide3:checked ~ #slides .inner { margin-left:-200%; }
#slide4:checked ~ #slides .inner { margin-left:-300%; }
#slide5:checked ~ #slides .inner { margin-left:-400%; }


#overflow {
	width: 100%;
	overflow: hidden;
}



#slides .inner {
	width: 500%;
	line-height: 0;
}

#slides article {
	width: 20%;
	float: left;
}

/* Slider Styling */

/* Control Setup */

#controls {
	margin: -25% 0 0 2.4%;
	width:95%;
	height: 20px;
}

#controls label { 
	display: none;
	width: 50px;
	height: 50px;
	opacity: 0.3;
}

#active {
	margin: 23% 0 0;
	text-align: center;
}

#active label {
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	display: inline-block;
	width: 10px;
	height: 10px;
	background: gray;
}

#active label:hover {
	background: black;
	border-color: black !important;
}

#controls label:hover {
	opacity: 0.8;
}

#slide1:checked ~ #controls label:nth-child(2), 
#slide2:checked ~ #controls label:nth-child(3), 
#slide3:checked ~ #controls label:nth-child(4), 
#slide4:checked ~ #controls label:nth-child(5), 
#slide5:checked ~ #controls label:nth-child(1) {
	background: url('http://csscience.com/responsiveslidercss3/next.png') no-repeat;
	float: right;
	margin: 0 -70px 0 0;
	display: block;
}


#slide1:checked ~ #controls label:nth-child(5),
#slide2:checked ~ #controls label:nth-child(1),
#slide3:checked ~ #controls label:nth-child(2),
#slide4:checked ~ #controls label:nth-child(3),
#slide5:checked ~ #controls label:nth-child(4) {
	background: url('http://csscience.com/responsiveslidercss3/prev.png') no-repeat;
	float: left;
	margin: 0 0 0 -70px;
	display: block;
}

#slide1:checked ~ #active label:nth-child(1),
#slide2:checked ~ #active label:nth-child(2),
#slide3:checked ~ #active label:nth-child(3),
#slide4:checked ~ #active label:nth-child(4),
#slide5:checked ~ #active label:nth-child(5) {
	background: #333;
	border-color: #333 !important;
}

/* Info Box */

.info {
	line-height: 20px;
	margin: 0 0 -150%;
	position: absolute;
	font-style: italic;
	padding: 30px 30px;
	opacity: 0;
	color: #000;
	text-align: left;
}

.info h3 {
	color: #333;
	margin: 0 0 5px;
	font-weight: normal;
	font-size: 22px;
	font-style: normal;
}

/* Slider Styling */

#slides {
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	box-shadow: 1px 1px 4px #666;
	padding: 1%;
	
}


/* Animation */

#slides .inner {
	-webkit-transform: translateZ(0);
	-webkit-transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000); 
	-moz-transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000); 
    -ms-transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000); 
     -o-transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000); 
        transition: all 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000); /* easeInOutQuart */

	-webkit-transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000); 
	-moz-transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000); 
    -ms-transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000); 
     -o-transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000); 
        transition-timing-function: cubic-bezier(0.770, 0.000, 0.175, 1.000); /* easeInOutQuart */
}

#slider {
	-webkit-transform: translateZ(0);
	-webkit-transition: all 0.5s ease-out;
	-moz-transition: all 0.5s ease-out;
	-o-transition: all 0.5s ease-out;
	transition: all 0.5s ease-out;
}

#controls label{
	-webkit-transform: translateZ(0);
	-webkit-transition: opacity 0.2s ease-out;
	-moz-transition: opacity 0.2s ease-out;
	-o-transition: opacity 0.2s ease-out;
	transition: opacity 0.2s ease-out;
}

#slide1:checked ~ #slides article:nth-child(1) .info,
#slide2:checked ~ #slides article:nth-child(2) .info,
#slide3:checked ~ #slides article:nth-child(3) .info,
#slide4:checked ~ #slides article:nth-child(4) .info,
#slide5:checked ~ #slides article:nth-child(5) .info {
	opacity: 1;
	-webkit-transition: all 1s ease-out 0.6s;
	-moz-transition: all 1s ease-out 0.6s;
	-o-transition: all 1s ease-out 0.6s;
	transition: all 1s ease-out 0.6s;
}

.info, #controls, #slides, #active, #active label, .info h3, .desktop, .tablet, .mobile {
	-webkit-transform: translateZ(0);
	-webkit-transition: all 0.5s ease-out;
	-moz-transition: all 0.5s ease-out;
	-o-transition: all 0.5s ease-out;
	transition: all 0.5s ease-out;
}

/* Respond Options */

#desktop:checked ~ #slider {
	max-width: 900px;
}

#tablet:checked ~ #slider {
	max-width: 900px;
}

#mobile:checked ~ #slider {
	max-width: 450px;
}

#desktop:checked ~ #slider .desktop,
#tablet:checked ~ #slider .tablet,
#mobile:checked ~ #slider .mobile {
	color: #777;
	opacity: 1;
}

.desktop, .tablet, .mobile {
	display: inline-block;
	width: 60px;
	height: 60px;
	padding-top: 50px;
	opacity: 0.35;
	font-size: 12px;
}

.desktop:hover, .tablet:hover, .mobile:hover {
	opacity: 0.2;
}

.desktop {
	background: url('http://csscience.com/responsiveslidercss3/desktop.png') no-repeat;
}

.tablet {
	background: url('http://csscience.com/responsiveslidercss3/tablet.png') no-repeat;
}

.mobile {
	background: url('http://csscience.com/responsiveslidercss3/mobile.png') no-repeat;
}

/* Responsive Styling */

/* Tablet */

#tablet:checked ~ #slider #controls {
	margin: -25% 0 0 12%;
	width: 76%;
	height: 50px;
}

#tablet:checked ~ #slider #controls label {
	-moz-transform: scale(0.8);
	-webkit-transform: scale(0.8);
	-o-transform: scale(0.8);
	-ms-transform: scale(0.8);
	transform: scale(0.8);
}

#tablet:checked  ~ #slider #slides, #mobile:checked  ~ #slider #slides {
	padding: 1% 0;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}

#tablet:checked ~ #slider #active {
	margin: 22% 0 0;
}

@media only screen and (max-width: 750px) and (min-width: 450px) {

	#slider #controls {
		margin: -25% 0 0 15%;
		width: 70%;
		height: 50px;
	}

	#slider #controls label {
		-moz-transform: scale(0.8);
		-webkit-transform: scale(0.8);
		-o-transform: scale(0.8);
		-ms-transform: scale(0.8);
		transform: scale(0.8);
	}

	#slider #slides {
		padding: 1% 0;
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		border-radius: 0px;
	}

	#slider #active {
		margin: 22% 0 0;
	}

}

/* Mobile */

#mobile:checked ~ #slider #controls {
	margin: -28% 0 0 24%;
	width: 50%;
	height: 50px;
}

#mobile:checked ~ #slider #active {
	margin: 23% 0 0;
}

#mobile:checked ~ #slider #slides .info {
	opacity: 0 !important;
}

#mobile:checked ~ #slider #controls label {
	-moz-transform: scale(0.6);
	-webkit-transform: scale(0.6);
	-o-transform: scale(0.6);
	-ms-transform: scale(0.6);
	transform: scale(0.6);
}


@media only screen and (max-width: 450px) {

	#slider #controls {
		margin: -28% 0 0 24%;
		width: 50%;
		height: 50px;
	}

	#slider #active {
		margin: 23% 0 0;
	}

	#slider #slides {
		padding: 1% 0;
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		border-radius: 0px;
	}

	#slider #slides .info {
		opacity: 0 !important;
	}

	#slider #controls label {
		-moz-transform: scale(0.6);
		-webkit-transform: scale(0.6);
		-o-transform: scale(0.6);
		-ms-transform: scale(0.6);
		transform: scale(0.6);
	}

}


@media only screen and (min-width: 850px) {

	body {
		padding: 0 0;
	}
}

</style>