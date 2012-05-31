<?php
	require_once("facebook.php");

	$config = array();
	$config['appId'] = '179155015544329';
	$config['secret'] = '0fc03c78b79d74750c3b4f56c44a7a38';
	$config['fileUpload'] = false; // optional
	$config['canvas_page'] = "http://apps.facebook.com/vejagol";
	
	$facebook = new Facebook($config);
 
    //$auth_url = "https://www.facebook.com/dialog/oauth?client_id=" 
    //       . $config['appId'] . "&redirect_uri=" . urlencode($config['canvas_page']);

    //$signed_request = $_REQUEST["signed_request"];

    //list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

    //$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

    //if (empty($data["user_id"])) {
    //       echo("<script> top.location.href='" . $auth_url . "'</script>");
    //} else {
    //       echo ("Welcome User: " . $data["user_id"]);
    //} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
	<link type="text/css" href="stylesheets/dark-hive/jquery-ui-1.8.15.custom.css" rel="stylesheet" />
	<link type="text/css" href="stylesheets/vejagolfb.css" rel="stylesheet" />
	<script type="text/javascript" src="javascript/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="javascript/jquery-ui-1.8.15.custom.min.js"></script>
	<script type="text/javascript" src="javascript/json2.js"></script>
	<script type="text/javascript" src="javascript/index.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
	
	<link rel="stylesheet" href="stylesheets/screen.css" media="Screen" type="text/css" />
	<link rel="stylesheet" href="stylesheets/mobile.css" media="handheld, only screen and (max-width: 480px), only screen and (max-device-width: 480px)" type="text/css" />
	
	<!--[if IEMobile]>
	<link rel="stylesheet" href="mobile.css" media="screen" type="text/css"  />
	<![endif]-->
	
	<!-- These are Open Graph tags.  They add meta data to your  -->
	<!-- site that facebook uses when your content is shared     -->
	<!-- over facebook.  You should fill these tags in with      -->
	<!-- your data.  To learn more about Open Graph, visit       -->
	<!-- 'https://developers.facebook.com/docs/opengraph/'       -->
	<meta property="og:title" content="VejaGol" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="//apps.vejagol.com/portal" />
	<meta property="og:image" content="//apps.vejagol.com/portal/images/logo.png" />
	<meta property="og:site_name" content="VejaGol" />
	<meta property="og:description" content="VejaGol" />
	<meta property="fb:app_id" content="179155015544329" />
	
	<title>VejaGol. Clique e veja.</title>
</head>
<body class="pagina" onload="onLoad()" style="margin:0; padding:0; border:0; background-color:#FFFFFF; background-image: url('images/background.png');">
	<div id="fb-root"></div>
	<script type="text/javascript">
		var mainDe = 0;
		var mainAte = 10;
		var mainFiltros = "";
		var mainAscending = "false";
		var mainOrdem = "data";
		var videoLink = "";
		
		//inicializo o sdk do facebook
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=179155015544329";
		  fjs.parentNode.insertBefore(js, fjs);
		}
		(document, 'script', 'facebook-jssdk'));
		
		//inicializo o sdk do twitter
		!function(d,s,id) {
			var js,fjs=d.getElementsByTagName(s)[0];
			if (!d.getElementById(id)) {
				js=d.createElement(s);
				js.id=id;
				js.src="//platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js,fjs);
			}
		}
		(document,"script","twitter-wjs");
		
		$(function() {
			$('.ui-accordion').bind('accordionchangestart', function(event, ui) {
				$( "#divPlayer" ).hide( 'scale', {percent: 0}, 1000, callback );
				videoLink = ui.newContent[0].lastElementChild.innerHTML;	
			});
		
			$('#ant').click(function() { onAnteriorClick(); });
			$('#prox').click(function() { onProximoClick(); });
			$('#ant').button();
			$('#prox').button();

			// callback function to bring a hidden box back
			function callback() {
				$( "#videoIFrame" ).attr("src", videoLink);
				$( "#divPlayer" ).show( 'scale', {percent: 100}, 0, function() {} );								
			}			
		});
			
		function getVideoLink() {			
			return videoLink;
		}
		
		function onAnteriorClick() {
			listarJogos(mainDe - 11, mainAte - 11, mainOrdem, mainFiltros, mainAscending);
			return true;	
		}
		
		function onProximoClick() {			
			listarJogos(mainDe + 11, mainAte + 11, mainOrdem, mainFiltros, mainAscending);
			return true;	
		}
		
		function onLoad() {	
			listarJogos(0, 10, "data", "", "false");
		}
	</script>
	<div class="tudo" style="width: 950px; margin: 0 auto;" align="center">
		<div><img src="images/topbar.png" class="ui-corner-all"/></div>		
		<div class="menu" style="width: 100px; float">
			<div id="divMarcadores" style="width: 450px; font-size: 10pt; font-family: Tahoma;" align="center"></div>
			<div>
				<div class="menu">
					<button id="ant">Anteriores</button>
				</div>
				<div class="conteudo">
					<button id="prox">Próximos</button>								
				</div>
			</div>
			<div>
				<a href="http://market.android.com/details?id=com.vejagol.android"><img class="ui-corner-all" src="images/vejagolAndroid.jpg"/></a>						
			</div>			
		</div>		
		<div class="conteudo">
			<div id="effect" class="video-overlay ui-corner-all" >
				<h3 class="ui-widget-header ui-corner-all">Video</h3>
				<div id="divPlayer">
					<!-- aqui está o video player -->
				</div>			
			</div>
			<br>
			<div class="tudo">
				<a href="https://twitter.com/vejagol" class="twitter-follow-button tweet" data-show-count="false" data-lang="pt" data-show-screen-name="false">Seguir @vejagol</a>			
				<div class="fb-like like" data-href="http://apps.facebook.com/vejagol" data-send="false" data-width="450" data-show-faces="false"></div>				
			</div>
			<div class="fb-comments" data-href="http://apps.facebook.com/vejagol" data-num-posts="5" data-width="470"></div>
		</div>
		<div class="clear"></div>
		<br>
	</div>
</body>
</html>