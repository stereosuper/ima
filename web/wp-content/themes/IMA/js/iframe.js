function init(){function a(){l.attr("style",p),n.length?(n.attr("style",u),o.css("style","height:84%;background:"+m)):(l.wrapInner('<div id="boxIma" style="'+u+'"><div id="fdBoxIma" style="height:84%;background:'+m+';"></div></div>'),n=k("#boxIma"),o=k("#fdBoxIma")),n.animate({left:z,height:"84%",width:y,top:"40px"},{step:function(){k(this).css({"-webkit-transform":w,"-moz-transform":w,"ms-transform":w,transform:w})},complete:function(){n.after('<img src="'+params.s+j+'layoutImg/loader.gif" id="loadIma" alt="Loading" style="position:absolute;top:50%;margin-top:-32px;left:34%;"/><iframe id="iframeIma" style="width:100%;height:100%;position:absolute;opacity:0;border:0;" src="'+url+'"></iframe>'),F=k("#iframeIma"),G=k("#loadIma"),F.load(function(){G.fadeOut(),F.fadeTo(300,1).after('<div id="btnRetourIma" style="width:'+y+";height:84%;position:fixed;overflow:hidden;left:"+z+';top:40px;cursor:pointer;z-index:10000;"></div>'),window.addEventListener=window.addEventListener||function(a,b){window.attachEvent("on"+a,b)},window.addEventListener("message",function(a){var b=a.data;"#"===b?e("-1"):"close"===b?e("10000"):window.location.href=b})})}},"easeInOut"),D.css({width:"0",height:"0"}),deg.fadeOut(),k(this).fadeOut(),l.on("click","#btnRetourIma",function(){F.fadeTo(300,0,function(){F.remove(),G.remove(),n.animate({left:"0",height:"100%",width:"100%",top:"0"},{duration:500,step:function(a,b){k(this).css({"-webkit-transform":x,"-moz-transform":x,"ms-transform":x,transform:x}),"top"===b.prop&&0===b.now&&k(this).attr("style"," ")},complete:function(){l.attr("style","height:100%;"),n.attr("style","height:100%;"),o.attr("style","height:100%;"),C.fadeIn(),D.animate({width:"56px",height:"56px"},300,function(){deg.fadeIn()})}},"easeInOut")}),k(this).remove()})}function b(a,d,e,f,h){if(8!=g()){var i,j=0,l=120;E.animate({width:a,height:d,bottom:e,left:f},{duration:500,step:function(a,b){j++,l--,i=j/7,h&&(i=l/6),k(this).css({"-webkit-transform":"rotate("+i+"deg)","-moz-transform":"rotate("+i+"deg)","ms-transform":"rotate("+i+"deg)",transform:"rotate("+i+"deg)"}),C.off("mouseenter",c)},complete:function(){setTimeout(function(){h||b("0","0","39px","46px",!0),C.on("mouseenter",c)},1e3)}},"easeInOut")}else C.off("mouseenter",c),E.css("left",f),setTimeout(function(){E.css("left","-300px"),C.on("mouseenter",c)},2e3)}function c(){b("256px","141px","14px","70px",!1),8==g()&&b("0","0","0","59px",!1)}function d(a){A-=360,D.css({"-webkit-transform":"rotate("+A+"deg)","-moz-transform":"rotate("+A+"deg)","ms-transform":"rotate("+A+"deg)",transform:"rotate("+A+"deg)"}),setTimeout(function(){d(!1)},15e3),a&&setTimeout(c,1e3)}function e(a){k("#btnRetourIma").css("z-index",a)}function f(a){var c,b=[],d=a.split("&");for(i in d)c=d[i].split("="),b[c[0]]=c[1];return b}function g(){var a=navigator.userAgent.toLowerCase();return a.indexOf("msie")!=-1&&parseInt(a.split("msie")[1])}var h=document.getElementById("imaScript").getAttribute("src"),j="wp-content/themes/IMA/";if(params=f(h.substring(h.indexOf("?")+1)),url=params.p+"?embed-ima=true",jqueryUrl=params.s+j+"js/libs/jquery-1.11.1.min.js","undefined"==typeof jQuery)jqueryAdded||(jqueryAdded=!0,document.write('<script type="text/javascript" src="'+jqueryUrl+'"></script>')),setTimeout(init,50);else{var C,D,E,F,G,k=jqueryAdded?jQuery.noConflict():jQuery,l=k("body"),m=l.css("background"),n=k("#boxIma"),o=k("#fdBoxIma"),p="overflow:hidden;background:#f3f3f3;height:100%;",q="position:fixed;left:15px;bottom:15px;height:0;width:0;background:url("+params.s+j+"layoutImg/btnIma.png) no-repeat;background-size:100%;-webkit-transition:.8s ease-in-out;-moz-transition:.8s ease-in-out;-ms-transition:.8s ease-in-out;-o-transition:.8s ease-in-out;transition:.8s ease-in-out;",r="height:0;width:0;background:url("+params.s+j+"layoutImg/etiquette.png) no-repeat;position:fixed;bottom:42px;left:25px;background-size:100%;",s="height:141px;width:256px;background:url("+params.s+j+"layoutImg/etiquette.png) no-repeat;position:fixed;bottom:68px;left:-300px;",t="position:fixed;bottom:0;border-style:solid;border-width:0 0 0 0;border-color:transparent transparent #05344c transparent;z-index:10000;cursor:pointer;",u="background:#fff;width:100%;height:100%;position:absolute;overflow:hidden;left:0;top:0;border-radius:30px;",v="background:url("+params.s+j+"layoutImg/degrade.png) no-repeat;width:127px;height:127px;position:fixed;bottom:0;z-index:9999;display:none;",w="perspective( 1300px ) rotateY( -20deg ) translateZ(-100px)",x="perspective( 1300px ) rotateY( 0deg ) translateZ(0px)",y="800px",z="72%",A=0,B=k(window).width();k(window).load(function(){8==g()&&(r=s),l.append('<div id="degIma" style="'+v+'"></div><div id="btnIma" style="'+t+'"><div id="circleIma" style="'+q+'"></div><div id="etiquette" style="'+r+'"></div></div>'),C=k("#btnIma"),D=C.find("#circleIma"),E=C.find("#etiquette"),deg=k("#degIma"),B>768&&8!=g()?(B>1151&&(y="1200px",z="55%"),C.animate({"border-width":"0 85px 85px 0"},500,function(){deg.fadeIn()}).on("mouseenter",c),D.animate({width:"56px",height:"56px"},300,function(){8!=g()?d(!0):c()}),C.on("click",a)):(C.animate({"border-width":"0 55px 55px 0"},500),D.css({left:"2px",bottom:"2px"}).animate({width:"50px",height:"50px"},300,function(){8!=g()&&(d(!1),deg.css({height:"97px",width:"97px"}).fadeIn())}),C.on("click",function(){window.open(params.p,"IMA")}))})}}var jqueryAdded=!1;init();
