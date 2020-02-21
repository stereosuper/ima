'use strict';

$(function(){
	/*var tlMenuWrapper = new TimelineMax();
	var tlCircleDashed = new TimelineMax();
	var tlCircles = new TimelineMax();*/
	var tlWrapperBlocs = new TimelineMax();

	var player = 0;

	var tlBlocAutresVides = new TimelineMax({onComplete: addClassBlocAutresVideos});

	var body = $('body'), htmlTag = $('html');
	var wrapperContent = $("#wrapper-content"), etiquette = $('#etiquette'), blocBtnVideo = $(".bloc-btn-video");
	var blocAdress = $("#bloc-adresse"), menuWrapper = $("#menu-wrapper"), blocActus = $("#bloc-actus");
	var circleDashed = menuWrapper.find("#circle-dashed-container"), menuWrapperUl = menuWrapper.find("ul"), menuWrapperLi = menuWrapperUl.find('li');
	var blocAutresVideos = $("#bloc-autres-videos"), blocBackVideo = $("#bloc-retour-video"), tlBlocVisuContentRetour;
	var wrapperEmbed = $("#wrapper-embed"), wrapperBlocs = $(".wrapper-blocs");

	var header = $('#header');
	var menu = $('#header-menu');



	//////////////////////////////////////////////////
	//////////////// REQUESTANIMFRAME ////////////////
	//////////////////////////////////////////////////

	// (function () {
	//   	var lastTime = 0, vendors = ['ms', 'moz', 'webkit', 'o'], x = 0;
	//   	for(x; x < vendors.length && !window.requestAnimationFrame; ++x) {
	//     	window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
	//     	window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
	//   	}
	//   	if(!window.requestAnimationFrame)
	//     	window.requestAnimationFrame = function (callback, element) {
	// 	      	var currTime = new Date().getTime(), timeToCall = Math.max(0, 16 - (currTime - lastTime));
	// 		    var id = window.setTimeout(function () {
	// 		    	callback(currTime + timeToCall);
	// 		    },
	// 		    timeToCall);
	// 		    lastTime = currTime + timeToCall;
	// 		    return id;
	//   	};
	//   	if(!window.cancelAnimationFrame)
	//     	window.cancelAnimationFrame = function (id) {
	//       		clearTimeout(id);
	//   	};
	// }());

	window.requestAnimFrame = (function(){
	  return  window.requestAnimationFrame       ||
	          window.webkitRequestAnimationFrame ||
	          window.mozRequestAnimationFrame    ||
	          window.oRequestAnimationFrame      ||
	          window.msRequestAnimationFrame     ||
	          function(callback){
	            window.setTimeout(callback, 1000/60);
	          };
	})();


	function animer(){
		requestAnimFrame(function(){
			var scrollTop = $(window).scrollTop();
			/*if (!htmlTag.hasClass("lt-ie9")){
				jsPlumb.setSuspendDrawing(false);
			}
			if(body.hasClass("has-bloc-small")){
				//jsPlumb.repaint($(".bloc-small"));
				/*$(".bloc-small").each(function(index){
					jsPlumb.repaint($(this), { left:Math.round($(this).offset().left), top:Math.round($(this).offset().top)});
				});*/
				//jsPlumb.repaint(blocActus);
			//}
			/*if (!htmlTag.hasClass("lt-ie9")){
				if(body.hasClass("has-video") && (!etiquette.length)){
					if ($(window).width()>=1250) {
						if(!body.hasClass("accueil")){
							if (!htmlTag.hasClass("isSafari") && !htmlTag.hasClass("lt-ie9")) {
								// si ce n'est pas safari
								jsPlumb.repaint(blocBtnVideo, { left:Math.round(blocBtnVideo.offset().left), top:Math.round(blocBtnVideo.offset().top)});
							}
						}
					}
				}

				if(TweenMax.isTweening(wrapperContent) || TweenMax.isTweening($("#container-menu-wrapper")) || TweenMax.isTweening(menuWrapper) || TweenMax.isTweening(menuWrapperUl) || TweenMax.isTweening(menuWrapperLi) || TweenMax.isTweening($("#menu-wrapper ul li a .txt-circle")) || TweenMax.isTweening($("#circle-dashed-container"))){
					if((body.hasClass("has-video"))&&(body.hasClass("accueil")) && (!etiquette.length)){
						if (!htmlTag.hasClass("isSafari") && !htmlTag.hasClass("lt-ie9")) {
							jsPlumb.repaint(menuWrapper);
							jsPlumb.repaint(blocBtnVideo, { left:blocBtnVideo.offset().left, top:(blocBtnVideo.offset().top)});
						}
					}
					if(body.hasClass("contact")){
						if ($(window).width()>=979) {
							jsPlumb.repaint(blocAdress, { left:Math.round(blocAdress.offset().left), top:Math.round(blocAdress.offset().top)});
						}
					}
					//if(body.hasClass("category") || body.hasClass("actus") || body.hasClass("blog") || body.hasClass("category") || body.hasClass("rh") || body.hasClass("recherche")  || body.hasClass("search")){
					//if(body.hasClass("recherche")  || body.hasClass("search")){
					//	jsPlumb.repaint($(".wrapper-blocs .bloc-full"));
					//}
				}*/
			//}
			if(body.hasClass("rh-detail")){
				if((scrollTop>blocActus.offset().top) && (scrollTop<(blocActus.offset().top+blocActus.height()-50))){
					TweenMax.set($("a.btn-postuler"), {position: "fixed", "right": "inherit", "left": (blocActus.offset().left+blocActus.width()-25)+"px"});
				}else{
					TweenMax.set($("a.btn-postuler"), {position: "absolute", "right": "-23px", "left": "inherit"});
				}
			}
			animer();
		});
	}

	////////////////////////////////////////////////////////////////////////////////
	//////////// Fonction pour ouvrir le menu à l'ouvreture de la page /////////////
	////////////////////////////////////////////////////////////////////////////////
	/*function menuOuvertDefault(){
		if($(window).width()>1024 && $.cookie('cookieMenu') == null) {
			$.cookie('cookieMenu', 'open');
			ouvertureMenu();
			setTimeout(fermetureMenu, 2000);
		}
	}

	function ouvertureMenu(){
		TweenMax.set(menuWrapper, {css:{className:'+=active'}});

		tlMenuWrapper.remove();
		tlCircleDashed.remove();
		tlCircles.remove();
		tlWrapperBlocs.remove();
		tlMenuWrapper = new TimelineMax();
		tlCircleDashed = new TimelineMax();
		tlCircles = new TimelineMax();
		tlWrapperBlocs = new TimelineMax();


		TweenMax.to($("#label-menu"), 0.05, {opacity: 0, display: "none", ease:Cubic.easeInOut});

		tlMenuWrapper.to(menuWrapperUl, 0.05, {scale:1.2, ease:Cubic.easeInOut});
		tlMenuWrapper.to(menuWrapperUl, 0.05, {scale:1 , ease:Cubic.easeInOut});
		tlMenuWrapper.to(menuWrapperLi, 0.1, {left: "40%", top: "40%", ease:Cubic.easeInOut});

		tlCircleDashed.to(circleDashed, 0.05, {scale: 1.2, ease:Cubic.easeInOut});
		tlCircleDashed.to(circleDashed, 0.3, {scale: 0.3, ease:Cubic.easeInOut});

		tlMenuWrapper.to($("#container-menu-wrapper"), 0.2, {marginTop:"-110px", ease:Cubic.easeInOut});
		if (!htmlTag.hasClass("lt-ie9")) {
			tlWrapperBlocs.to(wrapperBlocs, 0.2, {marginTop:"-10px", ease:Cubic.easeInOut, delay: 0.2});
		}else{
			tlWrapperBlocs.to(wrapperBlocs, 0.2, {marginTop:"20px", ease:Cubic.easeInOut, delay: 0.2});
		}

		tlMenuWrapper.set(menuWrapperLi, {width:"120px", height:"120px", ease:Cubic.easeInOut});
		//tlMenuWrapper.set($("#menu-wrapper ul li a"), {borderWidth:"10px", ease:Cubic.easeInOut});
		tlMenuWrapper.set($("#menu-wrapper ul li a .txt-circle"), {display:"inline-block", ease:Cubic.easeInOut, onComplete: cerclesAnim});
		tlCircleDashed.set(circleDashed, {width:"312px", height:"312px", marginTop: "-156px", marginLeft: "-156px", ease:Cubic.easeInOut});

		tlCircleDashed.to(circleDashed, 0.2, {scale: 1, delay: 0.3, ease:Cubic.easeInOut});

		function cerclesAnim(){
			tlCircles.to(menuWrapperLi.eq(0), 0.3, {top: "130px", left: "310px", ease:Cubic.easeInOut});
			tlCircles.to(menuWrapperLi.eq(1), 0.3, {top: "280px", left: "258px", delay:0.05, ease:Cubic.easeInOut},0);
			tlCircles.to(menuWrapperLi.eq(2), 0.3, {top: "280px", left: "60px", delay:0.1, ease:Cubic.easeInOut},0);
			tlCircles.to(menuWrapperLi.eq(3), 0.3, {top: "130px", left: "4px", delay:0.2, ease:Cubic.easeInOut},0);
		}
	}

	function fermetureMenu(){
		TweenMax.set(menuWrapper, {css:{className:'-=active'}});

		tlMenuWrapper.remove();
		tlCircleDashed.remove();
		tlCircles.remove();
		tlWrapperBlocs.remove();
		tlMenuWrapper = new TimelineMax();
		tlCircleDashed = new TimelineMax();
		tlCircles = new TimelineMax();
		tlWrapperBlocs = new TimelineMax();
		tlMenuWrapper.set(menuWrapperUl, {scale:1 , ease:Cubic.easeInOut});
		tlMenuWrapper.to(menuWrapperLi, 0.3, {left: "38%", top: "38%", ease:Cubic.easeInOut});

		tlCircleDashed.to(circleDashed, 0.3, {scale: 0.3, ease:Cubic.easeInOut});

		tlMenuWrapper.to($("#container-menu-wrapper"), 0.5, {marginTop:"-180px", ease:Cubic.easeInOut});
		if (!htmlTag.hasClass("lt-ie9")) {
			tlWrapperBlocs.to(wrapperBlocs, 0.2, {marginTop:"-90px", ease:Cubic.easeInOut, delay: 0.3});
		}else{
			tlWrapperBlocs.to(wrapperBlocs, 0.2, {marginTop:"-50px", ease:Cubic.easeInOut, delay: 0.3});
		}

		tlMenuWrapper.set(menuWrapperLi, {width:"20px", height:"20px", ease:Cubic.easeInOut});
		tlMenuWrapper.set($("#menu-wrapper ul li a"), {borderWidth:"0px", ease:Cubic.easeInOut});
		tlMenuWrapper.set($("#menu-wrapper ul li a .txt-circle"), {display:"none", ease:Cubic.easeInOut, onComplete: cerclesAnimRetour});
		tlCircleDashed.set(circleDashed, {width:"224px", height:"224px", marginTop: "-112px", marginLeft: "-112px", ease:Cubic.easeInOut});

		tlCircleDashed.to(circleDashed, 0.3, {scale: 1, delay: 0.7, ease:Cubic.easeInOut});

		function cerclesAnimRetour(){
			tlCircles.to(menuWrapperLi.eq(0), 0.4, {top: "240px", left: "306px", ease:Cubic.easeInOut});
			tlCircles.to(menuWrapperLi.eq(1), 0.4, {top: "298px", left: "255px", delay:0.05, ease:Cubic.easeInOut},0);
			tlCircles.to(menuWrapperLi.eq(2), 0.4, {top: "298px", left: "153px", delay:0.1, ease:Cubic.easeInOut},0);
			tlCircles.to(menuWrapperLi.eq(3), 0.4, {top: "240px", left: "103px", delay:0.2, ease:Cubic.easeInOut},0);
			tlCircles.to($("#label-menu"), 0.15, {opacity: 1, display: "block", ease:Cubic.easeInOut});
		}
	}

	function hoverMenu(){
		var tlMenuWrapper = new TimelineMax();
		var tlCircleDashed = new TimelineMax();
		var tlCircles = new TimelineMax();
		menuWrapper.hover(ouvertureMenu, fermetureMenu);
	}*/

	function updateUrlBlocVideo(){
		var mediaActif = $("ul#autres-videos li.active"), data;
		if(mediaActif.hasClass("has-video")){
			data = "#video#"+mediaActif.data("url-video")+"#"+mediaActif.data("poster-name");
		}else if(mediaActif.hasClass("has-calameo")){
			data = "#calameo#"+mediaActif.data("id-calameo");
		}else if(mediaActif.hasClass("has-image")){
			data = "#image#"+mediaActif.data("image-name");
		}
		window.location.hash = data;
	}

	function ouvrirBlocVideo(){
		$(window).scrollTop(0);
		body.addClass("video-ouverte");
		htmlTag.addClass("video-ouverte");
		// décaler le wrapper content
		if(htmlTag.hasClass("lt-ie10")){
			TweenMax.set(wrapperEmbed, {display: "block"});
		}
		TweenMax.set($("footer"), {display: "none"});
		TweenMax.set(blocBtnVideo, {display: "none"});
		TweenMax.to(wrapperContent, 0.5, {"x":"-100%", ease:Cubic.easeInOut});
		TweenMax.to($("#bloc-menu-responsive"), 0.5, {"x":"-100%", ease:Cubic.easeInOut});
		// centrer la div fond visu
		var tlBlocVisuContent = new TimelineMax();
		tlBlocVisuContent.to($("#bloc-fond-visu .bloc-visu-content"), 0.5, {right:"50%", marginRight: "-21.5%", ease:Cubic.easeInOut});
		tlBlocVisuContent.to($("#bloc-fond-visu .bloc-visu-content"), 0.2, {opacity: 0, ease:Cubic.easeInOut});
		tlBlocVisuContent.to($("#fond-couleur-bloc-visu"), 0.2, {opacity: 0, display: "none", ease:Cubic.easeInOut, onComplete: completeFondCouleur});
		updateUrlBlocVideo();
	}

	// Clic sur le bouton video
	function btnVideoClick(){
		$("a.btn-video").hover(function(){
			if($('#visu-content .shadow').length){
				TweenMax.to($('#visu-content .shadow'), 0.4, {opacity: 1, ease:Cubic.easeInOut});
			}
		}, function(){
			if($('#visu-content .shadow').length){
				TweenMax.to($('#visu-content .shadow'), 0.4, {opacity: 0, ease:Cubic.easeInOut});
			}
		}).click(function(e){
			e.preventDefault();
			if($('#visu-content .shadow').length){
				TweenMax.set($('#visu-content .shadow'), {opacity: 0});
			}
			ouvrirBlocVideo();
		});
	}

	function completeFondCouleur(){
		TweenMax.set($("#bloc-visu"), {display: "none"});
		TweenMax.set($("#container-bloc-visu-content"), {display: "none"});
		tlBlocAutresVides.kill();
		tlBlocAutresVides = new TimelineMax({onComplete: addClassBlocAutresVideos});
		tlBlocAutresVides.to(blocAutresVideos, 0.4, {display: "block", marginRight: "0", ease:Cubic.easeInOut});
		tlBlocAutresVides.to(blocAutresVideos, 0.4, {marginRight: "-196px", delay: 1.2, ease:Cubic.easeInOut});
		if(body.hasClass("video-ouverte")){
			tlBlocAutresVides.to(blocBackVideo, 0.2, {marginLeft: "-20px", ease:Cubic.easeInOut});
		}
	}
	function addClassBlocAutresVideos(){
		blocAutresVideos.addClass("canTween");
	}

	// Clic sur le retour imatech
	function btnRetourVideoClick(){
		$("a#retour-video").click(function(){
			window.location.hash='';
			stopVideos();
			body.removeClass("video-ouverte");
			htmlTag.removeClass("video-ouverte");
			blocAutresVideos.removeClass("canTween");
			TweenMax.set(blocBtnVideo, {display: "block"});
			TweenMax.set(wrapperContent, {display: "block"});
			TweenMax.set($("#bloc-visu"), {display: "block"});
			TweenMax.set($("#container-bloc-visu-content"), {display: "block"});

			TweenMax.to($("#bloc-menu-responsive"), 0.2, {x:"0%", delay:1, ease:Cubic.easeInOut, onComplete: blocMenuResponsiveRetour});

			TweenMax.to(blocBackVideo, 0.2, {marginLeft:"-200px", ease:Cubic.easeInOut});
			TweenMax.to(blocAutresVideos, 0.2, {marginRight: "-250px", x: "0px", display: "none", ease:Cubic.easeInOut});
			tlBlocVisuContentRetour = new TimelineMax();
			tlBlocVisuContentRetour.to($("#fond-couleur-bloc-visu"), 0.2, {opacity: 1, display: "block", ease:Cubic.easeInOut});
			tlBlocVisuContentRetour.to($("#bloc-fond-visu .bloc-visu-content"), 0.2, {opacity: 1, ease:Cubic.easeInOut, onComplete: completeFondCouleurRetour});
			return false;
		});
	}
	function blocMenuResponsiveRetour(){
		TweenMax.set($("footer"), {display: "block"});
		if(htmlTag.hasClass("lt-ie10")){
			TweenMax.set(wrapperEmbed, {display: "none"});
		}
	}
	function completeFondCouleurRetour(){
		TweenMax.to($("#bloc-fond-visu .bloc-visu-content"), 0.5, {right:"0", marginRight: "0%", ease:Cubic.easeInOut});
		TweenMax.to(wrapperContent, 0.5, {x:"0%", ease:Cubic.easeInOut});
	}

	function btnPlusVideos(){
		$("a#plus-autres-videos").hover(function(){
			// au mouse enter
			if((blocAutresVideos.hasClass("canTween")) && (!isMobile.any) && (!blocAutresVideos.hasClass("open"))){
				TweenMax.to(blocAutresVideos, 0.2, {x: "-20px", ease:Cubic.easeInOut});
				TweenMax.to($("a#plus-autres-videos .icon-plus"), 0.2, {scale: "1.1", ease:Cubic.easeInOut});
			}
		}, function(){
			// au mouse leave
			TweenMax.to(blocAutresVideos, 0.2, {x: "0px", ease:Cubic.easeInOut});
			TweenMax.to($("a#plus-autres-videos .icon-plus"), 0.2, {scale: "1", ease:Cubic.easeInOut});
		}).click(function(e){
			e.preventDefault();
			if(!blocAutresVideos.hasClass("open")){
				if((blocAutresVideos.hasClass("canTween"))){
					TweenMax.set(blocAutresVideos, {x: "0"});
					TweenMax.to(blocAutresVideos, 0.2, {marginRight: "0px", ease:Cubic.easeInOut});
					TweenMax.to($("a#plus-autres-videos .icon-plus"), 0.2, {rotation: 45, ease:Cubic.easeInOut});
					blocAutresVideos.toggleClass("open");
				}
			}else{
				if(blocAutresVideos.hasClass("canTween")){
					TweenMax.to(blocAutresVideos, 0.2, {marginRight: "-196px", ease:Cubic.easeInOut});
					TweenMax.to($("a#plus-autres-videos .icon-plus"), 0.2, {rotation: 0, ease:Cubic.easeInOut});
					blocAutresVideos.toggleClass("open");
				}
			}
		});
		$("a#retour-video").hover(function(){
			// au mouse enter
			if(!isMobile.any){
				TweenMax.to(blocBackVideo, 0.2, {x: "20px", ease:Cubic.easeInOut});
				TweenMax.to($("a#retour-video .icon-retour"), 0.2, {scale: "1.1", ease:Cubic.easeInOut});
			}
		}, function(){
			// au mouse leave
			TweenMax.to(blocBackVideo, 0.2, {x: "0px", ease:Cubic.easeInOut});
			TweenMax.to($("a#retour-video .icon-retour"), 0.2, {scale: "1", ease:Cubic.easeInOut});
		});
	}

	////////////////////////////////////////////////////////////////////////////////
	////////////////////// Fonction pour stopper les videos ////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	function stopVideos(){
		if($(".video-js").length){
			if(body.hasClass("video-ouverte")){
				$(".video-js")[0].player.pause();
			}
		}
	}

	////////////////////// Fonction pour gérer la taille des raccords ribbons ////////////////////////
	function categBlocCopies(){
		if (!htmlTag.hasClass("lt-ie9")) {
			setTimeout(function() {
				var blocParent, widthCategBloc, heightCategBloc, widthRibbon, heightRibbon, widthDetailBloc, heightDetailBloc;
				$(".categ-bloc-copie").each(function(index){
					blocParent = $(this).parent();
					widthCategBloc = $(".categ-bloc .txt-categ-bloc", blocParent).width();
					heightCategBloc = $(".categ-bloc .txt-categ-bloc", blocParent).height();
					TweenMax.set($(".txt-categ-bloc-copie",this), {width: widthCategBloc+"px", height: heightCategBloc+"px"});
					TweenMax.set($(this), {display: "block"});
				});

				$(".detail-bloc-copie").each(function(index){
					blocParent = $(this).parent();
					widthDetailBloc = $(".detail-bloc .txt-detail-bloc", blocParent).width();
					heightDetailBloc = $(".detail-bloc .txt-detail-bloc", blocParent).height();
					TweenMax.set($(".txt-detail-bloc-copie",this), {width: widthDetailBloc+"px", height: heightDetailBloc+"px"});
					TweenMax.set($(this), {display: "block"});
				});

				$(".ribbon-copie").each(function(index){
					if ($(window).width()>767) {
						blocParent = $(this).parent();
						widthRibbon = $(".ribbon .ribbon-content", blocParent).width();
						heightRibbon = $(".ribbon .ribbon-content", blocParent).height();
						TweenMax.set($(".ribbon-content",this), {width: widthRibbon+"px", height: heightRibbon+"px"});
						TweenMax.set($(this), {display: "block"});
					}
				});
			}, 500);
		}
	}

	////////////////////// Fonction pour pencher les bloc content en fonction de leur hauteur ////////////////////////
	/*function blocPenche(){
		if (!htmlTag.hasClass("lt-ie9") && !body.hasClass("actus") && !body.hasClass("blog") && !body.hasClass("category") && !body.hasClass("rh") && !body.hasClass("recherche") && !body.hasClass("search")) {
			$(".bloc-penche").each(function(index){
				var heightBlocPenche = $(this).height();
				if(heightBlocPenche>300){
					TweenMax.set($(this), {rotation: 0});
				}else if (heightBlocPenche>200){
					TweenMax.set($(this), {rotation: -3, x:0, y:0, z:0});
				}else{
					TweenMax.set($(this), {rotation: -4, x:0, y:0, z:0});
				}
			});
		}
	}*/

	////////////////////// Fonction pour animer les svg du bloc Innovation ////////////////////////
	function hoverBlocInnovation(){
		if (!htmlTag.hasClass("lt-ie9")) {
			$("#container-pop").parent('.bloc-small').hover(function(){
				// au mouse enter
				TweenMax.fromTo($("#container-pop"), 0.5, {scale: "0"}, {scale: "1", ease:Cubic.easeInOut});
				TweenMax.fromTo($("#container-pop2"), 0.4, {scale: "0"}, {scale: "1", ease:Cubic.easeInOut, delay: 0.1});
				TweenMax.fromTo($("#container-pop3"), 0.7, {scale: "0"}, {scale: "1", ease:Cubic.easeInOut, delay: 0.2});
			}, function(){
				// au mouse leave
			});
		}
	}

	////////////////////// Fonction pour gérer l'apparition du plan du site ////////////////////////
	function lienSitemap(){
		function openModal(){
			TweenMax.to($("#overlay"), 0.4, {display: "block", opacity: 1, ease:Cubic.easeInOut});
			TweenMax.to($("#sitemap-modal"), 0.4, {y: 0, ease:Cubic.easeInOut});
			TweenMax.to($("#wrapper-sitemap-modal"), 0.4, {display: "block", opacity: 1, ease:Cubic.easeInOut});
		}

		function closeModal(){
			TweenMax.to($("#overlay"), 0.4, {display: "none", opacity: 0, ease:Cubic.easeInOut});
			TweenMax.to($("#wrapper-sitemap-modal"), 0.4, {display: "none", opacity: 0, ease:Cubic.easeInOut});
			TweenMax.to($("#sitemap-modal"), 0.4, {y: 50, ease:Cubic.easeInOut});
		}

		TweenMax.set($("#sitemap-modal"), {y: 50});
		$("#lien-sitemap, #link-search, #menu-responsive").on('click', function(e){
			e.preventDefault();
			openModal();
		});
		$("#overlay, #lien-close-modal").on('click', function(e){
			e.preventDefault();
			closeModal();
		});
	}

	////////////////////// Fonction pour gérer l'apparition de l'interlocuteur ////////////////////////
	function lienInterlocuteur(){
		function openInterlocuteurModal(){
			TweenMax.to($("#overlay-interlocuteur"), 0.4, {display: "block", opacity: 1, ease:Cubic.easeInOut});
			TweenMax.to($("#interlocuteur-modal"), 0.4, {y: 0, ease:Cubic.easeInOut});
			TweenMax.to($("#wrapper-interlocuteur-modal"), 0.4, {display: "block", opacity: 1, ease:Cubic.easeInOut});
		}

		function closeInterlocuteurModal(){
			TweenMax.to($("#overlay-interlocuteur"), 0.4, {display: "none", opacity: 0, ease:Cubic.easeInOut});
			TweenMax.to($("#wrapper-interlocuteur-modal"), 0.4, {display: "none", opacity: 0, ease:Cubic.easeInOut});
			TweenMax.to($("#interlocuteur-modal"), 0.4, {y: 50, ease:Cubic.easeInOut});
		}

		TweenMax.set($("#interlocuteur-modal"), {y: 50});
		$("a.btn-interlocuteur").on('click', function(e){
			e.preventDefault();
			openInterlocuteurModal();
		});
		$("#overlay-interlocuteur").on('click', function(e){
			e.preventDefault();
			closeInterlocuteurModal();
		});
		$("#lien-close-interlocuteur-modal").on('click', function(e){
			e.preventDefault();
			closeInterlocuteurModal();
		});
	}

	////////////////////// Fonction pour déplier / replier les titres du menu / sitemap ////////////////////////
	function liensSitemapMobile(){
		$("a.circle-sitemap").click(function(e){
			if ($(window).outerWidth() <= 767){
				e.preventDefault();
				$(this).toggleClass("open");
				$("ul.liste-liens-sitemap", $(this).parent()).slideToggle();
			}
		});
	}

	function initSitemapMobile(){
		$("a.circle-sitemap.open").removeClass("open");
		$(window).outerWidth() <= 767 ? $("ul.liste-liens-sitemap").hide() : $("ul.liste-liens-sitemap").show();
	}

	function initVideo(){
		if($("#id-video-js").length){
			player = videojs("id-video-js", {"techOrder": ["youtube"], "ytcontrols": false});
		}
	}

	////////////////////// Fonction pour remplacer les svg par des img ////////////////////////
	function svgFallback(){
		if (!Modernizr.svg) {
			$("object").each(function(index) {
				$(this).after("<img src='"+$(this).attr('data-fallback')+"' alt='' id='"+$(this).attr('id')+"' />");
				$(this).remove();
			});
		}
	}

	////////////////////// Fonction pour remplacer les nth-child par des classes (ie8 fixing) ////////////////////////
	function ordreBlocSmall(){
		$(".bloc-small").each(function(index){
			$(this).addClass("pos-"+(index+1));
		});
	}

	////////////////////// Fonction pour changer de video / calameo / image ////////////////////////
	function autresVideos(){
		$("ul#autres-videos li a").click(function(e){
			e.preventDefault();
			if(htmlTag.hasClass("lt-ie10")){
				TweenMax.set(wrapperEmbed, {display: "block"});
			}
			$(window).scrollTop(0);
			$("ul#autres-videos li.active").removeClass("active");
			$(this).parent().addClass("active");
			if($(this).parent().hasClass("has-video")){
				var dataUrlVideo = $(this).parent().data("url-video");
				var dataPosterName = $(this).parent().data("poster-name");
				wrapperEmbed.replaceWith("<div id='wrapper-embed'><video id='id-video-js' class='video-js vjs-default-skin' controls preload='auto' width='100%' height='100%' poster='"+dataPosterName+"' src='"+dataUrlVideo+"'></video></div>");
				// if(player != 0){
				// 	console.log(player);
				// 	player.dispose();
				// }
				initVideo();
			}else if($(this).parent().hasClass("has-calameo")){
				var dataIdCalameo = $(this).parent().data("id-calameo");
				wrapperEmbed.replaceWith("<div id='wrapper-embed'><iframe class='calameo-iframe' src='//v.calameo.com/?bkcode="+dataIdCalameo+"&view=book' width='300' height='194' frameborder='0' scrolling='no' allowtransparency allowfullscreen style='margin:0 auto;'></iframe></div>");
			}else if ($(this).parent().hasClass("has-image")){
				var dataImageName = $(this).parent().data("image-name");
				wrapperEmbed.replaceWith("<div id='wrapper-embed'><div class='wrapper-img'><img src='"+dataImageName+"'></div></div>");
			};
			wrapperEmbed = $('#wrapper-embed');
			updateUrlBlocVideo();
		});
	}

	////////////////////// Fonction pour ajouter une classe isSafari si on est sur le navigateur Safari ////////////////////////
	function isSafari(){
		if(navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1){
			htmlTag.addClass("isSafari");
		}
	}

	////////////////////// Fonction pour deployer / retracter le menu des catégories ////////////////////////
	function btnCategoriesArticles(){
		TweenMax.set($("a#btn-categories-articles .txt-btn-categories-articles .icon-arrow-right"), {rotation: 90});
		$("a#btn-categories-articles").click(function(e){
			e.preventDefault();
			if(!$("#categories-articles").hasClass("open")){
				if($(window).width()>1024){
					TweenMax.set($("#categories-articles"), {display:"block"});
					TweenMax.to($("a#btn-categories-articles .txt-btn-categories-articles .icon-arrow-right"), 0.15, {rotation: 0, ease:Cubic.easeInOut});
				}else{
					$("#categories-articles").slideToggle({duration: 300});
					TweenMax.to($("a#btn-categories-articles .txt-btn-categories-articles .icon-arrow-right"), 0.15, {rotation: -90, ease:Cubic.easeInOut});
				}
				$("#categories-articles").addClass("open");
			}else{
				if($(window).width()>1024){
					TweenMax.set($("#categories-articles"), {display:"none"});
				}else{
					$("#categories-articles").slideToggle({duration: 300});
				}
				TweenMax.to($("a#btn-categories-articles .txt-btn-categories-articles .icon-arrow-right"), 0.15, {rotation: 90, ease:Cubic.easeInOut});
				$("#categories-articles").removeClass("open");
			}
		});
	}

	function loader(){
		TweenMax.to($('#infscr-loading').find('img'), 0.5, { rotation:360, repeat:-1, ease:Quad.easeInOut } );
		setTimeout(loader, 500);
	}

	////////////////////// Fonction pour scanner l'url et lancer le media si besoin ////////////////////////

	function scanUrl(){
		var urlPathname = window.location.pathname, urlHashs = window.location.hash.split("#");
		//tester si il y a bien au moins deux hashtags
		if(urlHashs.length >= 3){
			//tester le type de media
			if(htmlTag.hasClass("lt-ie10")){
				TweenMax.set(wrapperEmbed, {display: "block"});
			}
			switch(urlHashs[1]) {
			    case "video":
			    	//tester l'existance du media
			        if ($("ul#autres-videos li.has-video[data-url-video='"+urlHashs[2]+"'][data-poster-name='"+urlHashs[3]+"']").length){
			        	$("ul#autres-videos li.active").removeClass("active");
			        	//$("ul#autres-videos li.has-video[data-url-video='"+urlHashs[2]+"'][data-poster-name='"+urlHashs[3]+"']").parent().addClass("active");
			        	$("ul#autres-videos li.has-video[data-url-video='"+urlHashs[2]+"'][data-poster-name='"+urlHashs[3]+"']").addClass("active");
			        	wrapperEmbed.replaceWith("<div id='wrapper-embed'><video id='id-video-js' class='video-js vjs-default-skin' controls preload='auto' width='100%' height='100%' poster='"+urlHashs[3]+"' src='"+urlHashs[2]+"'></video></div>");
			        	if(player != 0){
			        		player.dispose();
			        	}
			        	initVideo();
			        	ouvrirBlocVideo();
			        }
			        break;
			    case "calameo":
			        if ($("ul#autres-videos li.has-calameo[data-id-calameo='"+urlHashs[2]+"']").length){
			        	wrapperEmbed.replaceWith("<div id='wrapper-embed'><iframe class='calameo-iframe' src='//v.calameo.com/?bkcode="+urlHashs[2]+"&view=book' width='300' height='194' frameborder='0' scrolling='no' allowtransparency allowfullscreen style='margin:0 auto;'></iframe></div>");
			        	ouvrirBlocVideo();
			        }
			        break;
			    case "image":
			        if ($("ul#autres-videos li.has-image[data-image-name='"+urlHashs[2]+"']").length){
			        	wrapperEmbed.replaceWith("<div id='wrapper-embed'><div class='wrapper-img'><img src='"+urlHashs[2]+"'></div></div>");
			        	ouvrirBlocVideo();
			        }
			        break;
			    default:
			        ;
			}
			wrapperEmbed = $('#wrapper-embed');

		}else{
			if( typeof tlBlocVisuContent !== 'undefined'){
				tlBlocVisuContent.kill();
			}
			if( typeof tlBlocAutresVides !== 'undefined'){
				tlBlocAutresVides.kill();
			}

			window.location.hash='';
			stopVideos();
			body.removeClass("video-ouverte");
			htmlTag.removeClass("video-ouverte");
			blocAutresVideos.removeClass("canTween");
			TweenMax.set(blocBtnVideo, {display: "block"});
			TweenMax.set(wrapperContent, {display: "block"});
			TweenMax.set($("#bloc-visu"), {display: "block"});
			TweenMax.set($("#container-bloc-visu-content"), {display: "block"});

			TweenMax.to($("#bloc-menu-responsive"), 0.2, {x:"0%", delay:1, ease:Cubic.easeInOut, onComplete: blocMenuResponsiveRetour});

			TweenMax.to(blocBackVideo, 0.2, {marginLeft:"-200px", ease:Cubic.easeInOut});
			TweenMax.to(blocAutresVideos, 0.2, {marginRight: "-250px", x: "0px", display: "none", ease:Cubic.easeInOut});
			tlBlocVisuContentRetour = new TimelineMax();
			tlBlocVisuContentRetour.to($("#fond-couleur-bloc-visu"), 0.2, {opacity: 1, display: "block", ease:Cubic.easeInOut});
			tlBlocVisuContentRetour.to($("#bloc-fond-visu .bloc-visu-content"), 0.2, {opacity: 1, ease:Cubic.easeInOut, onComplete: completeFondCouleurRetour});
		}
	}

	////////////////////// Fonction pour vérifier si le lien mène vers un media externe ////////////////////////

	function checkMedia(){
		var tableUrl = document.location.pathname.split("/"), pageName;
		if(tableUrl[tableUrl.length-1] === ""){
			pageName = tableUrl[tableUrl.length-2];
		}else{
			pageName = tableUrl[tableUrl.length-1];
		}
		$("a").each(function(index){
			if($(this).attr("href").split("#").length >= 3){
				var tableHref = $(this).attr("href").substr(0,$(this).attr("href").indexOf('#')).split("/"), hrefPageName;
				if(tableHref[tableHref.length-1] === ""){
					hrefPageName = tableHref[tableHref.length-2];
				}else{
					hrefPageName = tableHref[tableHref.length-1];
				}
				if(hrefPageName === pageName){
					$(this).click(function(e){
						e.preventDefault();
						var urlHashs = $(this).attr("href").split("#");

						//tester si il y a bien au moins deux hashtags
						if(urlHashs.length >= 3){
							//tester le type de media
							switch(urlHashs[1]) {
							    case "video":
							    	//tester l'existance du media
							        if ($("ul#autres-videos li.has-video[data-url-video=\""+urlHashs[2]+"\"][data-poster-name=\""+urlHashs[3]+"\"]").length){
							        	initVideo();
							        	$("ul#autres-videos li.active").removeClass("active");
							        	$("ul#autres-videos li.has-video[data-url-video=\""+urlHashs[2]+"\"][data-poster-name=\""+urlHashs[3]+"\"]").addClass("active");
							        	wrapperEmbed.replaceWith("<div id='wrapper-embed'><video id='id-video-js' class='video-js vjs-default-skin' controls preload='auto' width='100%' height='100%' poster='"+urlHashs[3]+"' src='"+urlHashs[2]+"'></video></div>");
							        	if(player != 0){
							        		player.dispose();
							        	}
							        	ouvrirBlocVideo();
							        }
							        break;
							    case "calameo":
							        if ($("ul#autres-videos li.has-calameo[data-id-calameo='"+urlHashs[2]+"']").length){
							        	wrapperEmbed.replaceWith("<div id='wrapper-embed'><iframe class='calameo-iframe' src='//v.calameo.com/?bkcode="+urlHashs[2]+"&view=book' width='300' height='194' frameborder='0' scrolling='no' allowtransparency allowfullscreen style='margin:0 auto;'></iframe></div>");
							        	ouvrirBlocVideo();
							        }
							        break;
							    case "image":
							        if ($("ul#autres-videos li.has-image[data-image-name='"+urlHashs[2]+"']").length){
							        	wrapperEmbed.replaceWith("<div id='wrapper-embed'><div class='wrapper-img'><img src='"+urlHashs[2]+"'></div></div>");
							        	ouvrirBlocVideo();
							        }
							        break;
							    default:
							        ;
							}
							wrapperEmbed = $('#wrapper-embed');

						}
					});
				}
			}
		});
	}


	////////////////////// Fonction pour empêcher d'effectuer une recherche vide dans le wordpress ////////////////////////

	function preventEmptySearch(){
	    $('#search-sitemap').on('submit', function(ev){
	        var input = $('.input-search-sitemap'),
	        	query = input.val(),
	            queryLength = query.length;

	        if ( 0 === queryLength ) {
	            input.focus();
	            ev.preventDefault();
	            return;
	        }
	    });
	}


	//[x, y, dx, dy]
	//x and yare coordinates in the interval [0,1] specifying the position of the anchor
	//dx and dy,which specify the orientation of the curve incident to the anchor
	//,     [[0, 0.6, 0, 1], [1, 0.4, 0, 1]],     [[0, 0.8, 0, 1], [1, 0.2, 0, 1]],     [[0, 0.8, 0, 1], [0.5, 1, 0, 1]],     [[0.8, 0, 0, 1], [0, 0.6, 0, 1]]
	var anchors = [ [[1, 0.6, 0.5, 0.8], [0.1, 0.8, 0, 0.5]],      [[1, 0.4, 0, 1], [0.1, 0.7, 0.2, 0]],      [[0.51, 1, 0, 1], [0.7, 0.1, 0, 0]],     [[0, 0.2, 0, 0.5], [0.5, 0, 0, -1.5]],     [[0.5, 0.9, -1, 1], [0.5, 0.2, 0, -1]]/**/,     [[1, 0.6, 0, 1], [1, 0.4, 0, 1]],     [[1, 0.8, 0, 1], [0, 0.2, 0, 1]],     [[0.6, 0.8, 0, 1], [0.5, 0, 0, 1]],     [[0.8, 0, 0, 1], [0, 0.6, 0, 1]]];
	/*if (!htmlTag.hasClass("lt-ie9")){
		var jsPlumbBlocSmall = jsPlumb.getInstance();
		jsPlumbBlocSmall.setContainer($("#zone-blocs-accueil"));
		var jsPlumbFirstBloc = jsPlumb.getInstance();
		jsPlumbFirstBloc.setContainer(wrapperBlocs);
	}*/

	if (window.history && window.history.pushState) {
		$(window).on('popstate', function() {
		  scanUrl();
		});
	}

	menu.on('mouseenter', 'a', function(){
		if ( !$(this).parent().find('.sub-menu').length ) return;
		$(this).parent().find('.sub-menu').addClass('on').parent().siblings().find('.sub-menu').removeClass('on');
	});
	header.on('mouseleave', function(){
		$(this).find('.sub-menu').removeClass('on');
	})

	checkMedia();
	scanUrl();
	animer();
	/*if ($(window).width()>1024){
		setTimeout(function() {
		      menuOuvertDefault();
		}, 1000);
	}*/
	if (htmlTag.hasClass("lt-ie9")){
		ordreBlocSmall();
	}
	isSafari();
	//hoverMenu();
	categBlocCopies();
	//blocPenche();
	lienSitemap();
	lienInterlocuteur();
	initSitemapMobile();
	liensSitemapMobile();
	initVideo();
	svgFallback();
	//clicLireLaSuite();
	autresVideos();
	btnCategoriesArticles();
	preventEmptySearch();
	if(body.hasClass("accueil")){
		//hoverBlocInnovation();
	}
	if(body.hasClass("has-video")){
		btnVideoClick();
		btnRetourVideoClick();
		btnPlusVideos();
	}
	if( body.hasClass("blog") || body.hasClass("category")){
		loader();
	}
	$( window ).resize(function() {
		initSitemapMobile();
		/*if (!htmlTag.hasClass("lt-ie9")){
			if(body.hasClass("has-bloc-small")){
				jsPlumbBlocSmall.repaint($(".bloc-small"));
				jsPlumbFirstBloc.repaint(blocActus);
			}

			if(body.hasClass("contact")){
				if ($(window).width()>=979) {
					// Relier le contact avec le pin
					jsPlumb.detachAllConnections(blocAdress);
					jsPlumb.detachAllConnections($("#pin-map"));
					jsPlumb.setContainer($("#container-bg-map"));
					jsPlumb.connect({
						source: blocAdress,
						target: $("#pin-map"),
						//[x, y, dx, dy]
						anchors: [[0.5, 0, 0, 0], [1, 0.5, 1, 0]],
						endpoint:"Blank",
						paintStyle:{
						lineWidth:2,
						strokeStyle:'#cacaca',
						dashstyle:" 0 1"
						},
						connector:[ "Bezier", { curviness: 200 }]
					});
				}else{
					jsPlumb.detachAllConnections(blocAdress);
					jsPlumb.detachAllConnections($("#pin-map"));
				}
			}
			if (!htmlTag.hasClass("isSafari") && !htmlTag.hasClass("lt-ie9")) {
				if(body.hasClass("has-video") && (!etiquette.length)){
					if ($(window).width()>=1250) {
						jsPlumb.detachAllConnections(blocBtnVideo);
						if(body.hasClass("accueil")){
							// Relier le menu avec le lien video
							var jsPlumbVisu = jsPlumb.getInstance();
							jsPlumb.setContainer(wrapperContent);
							jsPlumb.connect({
								source: menuWrapper,
								target: blocBtnVideo,
								anchors: [[0.97, 0.5, 1, 0], [0, 0.5, -1, 0]],
								endpoint:"Blank",
								paintStyle:{
								lineWidth:2,
								strokeStyle:'#cacaca',
								dashstyle:" 0 1"
								},
								connector:[ "Flowchart", {stub:400, cornerRadius: 40, gap: 40}]
							});
						}else{
							// Relier le menu avec le lien video
							var jsPlumbVisu = jsPlumb.getInstance();
							jsPlumb.setContainer(wrapperContent);
							jsPlumb.connect({
								source: blocActus,
								target: blocBtnVideo,
								//[x, y, dx, dy]
								anchors: [[0.97, 0.35, 1, 0], [0, 0.5, -0.5, 0]],
								endpoint:"Blank",
								paintStyle:{
								lineWidth:2,
								strokeStyle:'#cacaca',
								dashstyle:" 0 1"
								},
								connector:[ "Bezier", { curviness: 200 }]
							});
						}
					}else {
						jsPlumb.detachAllConnections(blocBtnVideo);
					}
				}
			}
		}*/
		if($(window).width()>1024){
			if (!htmlTag.hasClass("lt-ie9")) {
				TweenMax.set(wrapperBlocs, {marginTop:"-90px"});
			}else{
				TweenMax.set(wrapperBlocs, {marginTop:"-50px"});
			}
		}else{
			TweenMax.set(wrapperBlocs, {marginTop:"0px"});
		}
	});

	//if (!htmlTag.hasClass("lt-ie9")){
		/*jsPlumb.ready(function() {
			isSafari();
			if (!htmlTag.hasClass("lt-ie9")){
				if(body.hasClass("has-bloc-small")){
					var nbBlocSmall = $(".bloc-small").length;
					$(".bloc-small").each(function(index){
						if (index<(nbBlocSmall-1)) {

							jsPlumbBlocSmall.connect({
								source: $(this),
								target: $(this).nextAll(".bloc-small").eq(0),
								anchors: anchors[index],
								endpoint:"Blank",
								paintStyle:{
								lineWidth:2,
								strokeStyle:'#cacaca',
								dashstyle:" 0 1"
								},
								connector:[ "Bezier", { curviness: 50 }]
							});
						}
					});
					// Relier le bloc actu avec le premier bloc small (RSE)

					jsPlumbFirstBloc.connect({
						source: blocActus,
						target: $(".bloc-small").first(),
						anchors: [[0.2, 1, -1, 0], [0.4, 0.1, 0, 0]],
						endpoint:"Blank",
						paintStyle:{
						lineWidth:2,
						strokeStyle:'#cacaca',
						dashstyle:" 0 1"
						},
						connector:[ "Bezier", { curviness: 50 }]
					});
				}
				if (!htmlTag.hasClass("isSafari") && !htmlTag.hasClass("lt-ie9")) {
					if(body.hasClass("has-video") && (!etiquette.length)){
						if ($(window).width()>=1250) {
							if(body.hasClass("accueil")){
								// Relier le menu avec le lien video
								var jsPlumbVisu = jsPlumb.getInstance();
								jsPlumb.setContainer(wrapperContent);
								jsPlumb.connect({
									source: menuWrapper,
									target: blocBtnVideo,
									anchors: [[0.97, 0.5, 1, 0], [0, 0.5, -1, 0]],
									endpoint:"Blank",
									paintStyle:{
									lineWidth:2,
									strokeStyle:'#cacaca',
									dashstyle:" 0 1"
									},
									connector:[ "Flowchart", {stub:400, cornerRadius: 40, gap: 40}]
								});
							}else{
								// Relier le menu avec le lien video
								var jsPlumbVisu = jsPlumb.getInstance();
								jsPlumb.setContainer(wrapperContent);
								jsPlumb.connect({
									source: blocActus,
									target: blocBtnVideo,
									//[x, y, dx, dy]
									anchors: [[0.97, 0.35, 1, 0], [0, 0.5, -0.5, 0]],
									endpoint:"Blank",
									paintStyle:{
									lineWidth:2,
									strokeStyle:'#cacaca',
									dashstyle:" 0 1"
									},
									connector:[ "Bezier", { curviness: 200 }]
								});
							}
						}
					}
				}
				if(body.hasClass("contact")){
					if ($(window).width()>=979) {
						// Relier le contact avec le pin
						jsPlumb.setContainer($("#container-bg-map"));
						jsPlumb.connect({
							source: blocAdress,
							target: $("#pin-map"),
							//[x, y, dx, dy]
							anchors: [[0.5, 0, 1, 0], [1, 0.5, -0.5, 0]],
							endpoint:"Blank",
							paintStyle:{
							lineWidth:2,
							strokeStyle:'#cacaca',
							dashstyle:" 0 1"
							},
							connector:[ "Bezier", { curviness: 200 }]
						});
					}
				}
			}
		});*/
	//}
	/*$(document).scroll(function() {
		if (!htmlTag.hasClass("lt-ie9")){
			if(body.hasClass("has-video") && (!etiquette.length)){
				//bloc-btn-video
				if ($(window).width()>=1250) {
					jsPlumb.repaint(blocBtnVideo, { left:blocBtnVideo.offset().left, top:(blocBtnVideo.offset().top)});
					if(!body.hasClass("accueil")){
						jsPlumb.repaint(blocActus);
					}
				}
			}
		}
	});*/

	////////////////////// Fonction pour deployer / retracter le contenu au clic du bouton "Lire la suite" ////////////////////////
	/*function clicLireLaSuite(){
		$("#zone-actus a.btn-bloc").click(function(e){
			if(!$(this).hasClass("btn-actu") && !$(this).hasClass("ext-link")){
				e.preventDefault();

				if(!$(this).hasClass("open")){
					$(this).addClass("open");
					TweenMax.to($(this).closest(".bloc-penche"), 0.3, {rotation: 0});
					TweenMax.set($(".btn-icon-plus", this), {display: "none"});
					TweenMax.set($(".btn-icon-moins", this), {display: "block"});
				}else{
					$(this).removeClass("open");
					TweenMax.set($(".btn-icon-plus", this), {display: "block"});
					TweenMax.set($(".btn-icon-moins", this), {display: "none"});
				}
				$(".suite-bloc").slideToggle({
					duration: 300,
					step: function(){
						if(body.hasClass("has-bloc-small")){
							if (!htmlTag.hasClass("lt-ie9")){
								jsPlumbFirstBloc.repaint(blocActus);
								jsPlumbFirstBloc.repaint($(".bloc-small").first());
							}
						}
					},
					complete: function(){
						var heightBlocPenche = $(this).closest(".bloc-penche").height();
						if(heightBlocPenche>300){
							TweenMax.to($(this).closest(".bloc-penche"), 0.2, {rotation: 0});
						}else if (heightBlocPenche>200){
							TweenMax.to($(this).closest(".bloc-penche"), 0.2, {rotation: -3, x:0, y:0, z:0});
						}else{
							TweenMax.to($(this).closest(".bloc-penche"), 0.2, {rotation: -4, x:0, y:0, z:0});
						}
					}
				});
			}
		});
	}*/
});
