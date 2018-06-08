		var jqueryAdded = false;

			function init(){

				function appendAndAnimateElements(){
					body.attr('style', styleBody);

					if(box.length){
						box.attr('style', styleBox);
						fdBox.css('style', 'height:84%;background:'+fdBody);
					}else{
						body.wrapInner('<div id="boxIma" style="'+ styleBox +'"><div id="fdBoxIma" style="height:84%;background:'+fdBody+';"></div></div>');
						box = j('#boxIma');
						fdBox = j('#fdBoxIma');
					}

					box.animate({ left: leftVal, height: '84%', width: widthVal, top: '40px'}, {
						step: function() {
							j(this).css({'-webkit-transform':anim, '-moz-transform':anim, 'ms-transform':anim, 'transform':anim});
						},
						complete: function(){
							box.after('<img src="'+ params['s'] + theme +'layoutImg/loader.gif" id="loadIma" alt="Loading" style="position:absolute;top:50%;margin-top:-32px;left:34%;"/><iframe id="iframeIma" style="width:100%;height:100%;position:absolute;opacity:0;border:0;" src="'+ url +'"></iframe>');
							iframe = j('#iframeIma');
							loader = j('#loadIma');
							iframe.load(function(){
								loader.fadeOut();
								iframe.fadeTo(300, 1).after('<div id="btnRetourIma" style="width:'+ widthVal +';height:84%;position:fixed;overflow:hidden;left:'+ leftVal +';top:40px;cursor:pointer;z-index:10000;"></div>');
								window.addEventListener = window.addEventListener || function (e, f) { window.attachEvent('on' + e, f); };
								window.addEventListener('message', function(e) {
									var adress = e.data;
									if(adress === '#'){
										changeBtnZindex('-1');
									}else if(adress === 'close'){
										changeBtnZindex('10000');
									}else{
										window.location.href = adress;
									}
								});
							});
						}
					}, 'easeInOut');

					circle.css({'width': '0', 'height': '0'});
					deg.fadeOut();
					j(this).fadeOut();

					body.on('click', '#btnRetourIma', function(){
						iframe.fadeTo(300, 0, function(){
							iframe.remove();
							loader.remove();
							box.animate({left: '0', height: '100%', width: '100%', top: '0'}, {
								duration: 500,
								step: function(now, fx) {
									j(this).css({'-webkit-transform':animBack, '-moz-transform':animBack, 'ms-transform':animBack, 'transform':animBack});
									if(fx.prop === 'top' && fx.now === 0){ j(this).attr('style', ' '); }
								},
								complete: function(){
									body.attr('style', 'height:100%;');
									box.attr('style', 'height:100%;');
									fdBox.attr('style', 'height:100%;');
									btn.fadeIn();
									circle.animate({width: '56px', height: '56px'}, 300, function(){ deg.fadeIn(); });
								}
							}, 'easeInOut');
						});
						j(this).remove();
					});
				}

				function animBtn(w, h, b, l, t){
					if(isIE() != 8){
						var deg, rGo = 0, rBack = 120;
						etiquette.animate({width: w, height: h, bottom: b, left: l}, {
							duration: 500,
							step: function(now, fx){
								rGo ++;
								rBack --;
								deg = rGo/7;
								if(t) deg = rBack/6;
								j(this).css({'-webkit-transform':'rotate('+deg+'deg)', '-moz-transform':'rotate('+deg+'deg)', 'ms-transform':'rotate('+deg+'deg)', 'transform':'rotate('+deg+'deg)'});
								btn.off('mouseenter', setAnimBtn);
							},
							complete: function(){
								setTimeout(function(){ if(!t){ animBtn('0', '0', '39px', '46px', true);} btn.on('mouseenter', setAnimBtn); }, 1000);
							}
						}, 'easeInOut');
					}else{
						btn.off('mouseenter', setAnimBtn);
						etiquette.css('left', l);
						setTimeout(function(){ etiquette.css('left', '-300px'); btn.on('mouseenter', setAnimBtn); }, 2000);
					}
				}

				function setAnimBtn(){
					animBtn('256px', '141px', '14px', '70px', false);
					if(isIE() == 8) animBtn('0', '0', '0', '59px', false);
				}

				function rotateBtn(first){
					r -= 360;
					circle.css({'-webkit-transform':'rotate('+r+'deg)', '-moz-transform':'rotate('+r+'deg)', 'ms-transform':'rotate('+r+'deg)', 'transform':'rotate('+r+'deg)'});
					setTimeout(function(){ rotateBtn(false); }, 15000);

					if(first) setTimeout(setAnimBtn, 1000);
				}

				function changeBtnZindex(val){
					j('#btnRetourIma').css('z-index', val);
				}

				function getUrlVars(src){
					var varsIma = [],  hashIma, hashesIma = src.split('&');
					for(i in hashesIma){
						hashIma = hashesIma[i].split('=');
						varsIma[hashIma[0]] = hashIma[1];
					}
					return varsIma;
				}

				function isIE(){
					var myNav = navigator.userAgent.toLowerCase();
					return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
				}


				var src = document.getElementById('imaScript').getAttribute('src'),
					theme = 'wp-content/themes/IMA/';
					params = getUrlVars(src.substring(src.indexOf("?") + 1)),
					url = params['p'] + '?embed-ima=true',
					jqueryUrl = params['s'] + theme + 'js/libs/jquery-1.11.1.min.js';

				if(typeof jQuery == 'undefined'){
					if (!jqueryAdded) {
						jqueryAdded = true;
						document.write('<scr'+'ipt type="text/javascript" src="'+ jqueryUrl +'"></scr'+'ipt>');
					}
					setTimeout(init, 50);
				}else{
					var j = jqueryAdded ? jQuery.noConflict() : jQuery,
						body = j('body'), fdBody = body.css('background'),
						box = j('#boxIma'), fdBox = j('#fdBoxIma'),
						styleBody = 'overflow:hidden;background:#f3f3f3;height:100%;',
						styleCircle = 'position:fixed;left:15px;bottom:15px;height:0;width:0;background:url('+ params['s'] + theme +'layoutImg/btnIma.png) no-repeat;background-size:100%;-webkit-transition:.8s ease-in-out;-moz-transition:.8s ease-in-out;-ms-transition:.8s ease-in-out;-o-transition:.8s ease-in-out;transition:.8s ease-in-out;',
						styleEtiquette = 'height:0;width:0;background:url('+ params['s'] + theme +'layoutImg/etiquette.png) no-repeat;position:fixed;bottom:42px;left:25px;background-size:100%;',
						styleEtiquetteIe = 'height:141px;width:256px;background:url('+ params['s'] + theme +'layoutImg/etiquette.png) no-repeat;position:fixed;bottom:68px;left:-300px;',
						styleBtn = 'position:fixed;bottom:0;border-style:solid;border-width:0 0 0 0;border-color:transparent transparent #05344c transparent;z-index:10000;cursor:pointer;',
						styleBox = 'background:#fff;width:100%;height:100%;position:absolute;overflow:hidden;left:0;top:0;border-radius:30px;',
						styleDeg = 'background:url('+ params['s'] + theme +'layoutImg/degrade.png) no-repeat;width:127px;height:127px;position:fixed;bottom:0;z-index:9999;display:none;',
						anim = 'perspective( 1300px ) rotateY( -20deg ) translateZ(-100px)', animBack = 'perspective( 1300px ) rotateY( 0deg ) translateZ(0px)',
						widthVal = '800px', leftVal = '72%',
						r = 0,
						windowWidth = j(window).width(),
						btn, circle, etiquette, iframe, loader;

					j(window).load(function(){

						if(isIE() == 8) styleEtiquette = styleEtiquetteIe;

						body.append('<div id="degIma" style="'+ styleDeg +'"></div><div id="btnIma" style="'+ styleBtn +'"><div id="circleIma" style="'+ styleCircle +'"></div><div id="etiquette" style="'+ styleEtiquette +'"></div></div>');
						btn = j('#btnIma');
						circle = btn.find('#circleIma');
						etiquette = btn.find('#etiquette');
						deg = j('#degIma');

						if (windowWidth > 768 && isIE() != 8){
							if (windowWidth > 1151){
								widthVal = '1200px';
								leftVal = '55%';
							}
							btn.animate({'border-width': '0 85px 85px 0'}, 500, function(){ deg.fadeIn(); }).on('mouseenter', setAnimBtn);
							circle.animate({width: '56px', height: '56px'}, 300, function(){ isIE() != 8 ? rotateBtn(true) : setAnimBtn(); });
							btn.on('click', appendAndAnimateElements);
						}else{
							btn.animate({'border-width': '0 55px 55px 0'}, 500);
							circle.css({'left': '2px', 'bottom': '2px'}).animate({width: '50px', height: '50px'}, 300, function(){
								if(isIE() != 8){ rotateBtn(false); deg.css({'height': '97px', 'width': '97px'}).fadeIn();}
							});
							btn.on('click', function(){ window.open(params['p'], 'IMA'); });
						}

					});
				}
			}

			init();
