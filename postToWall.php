<?php 

		$config = array();
		$config['appId'] = '179155015544329';
		$config['canvas_page'] = "http://apps.facebook.com/vejagol";

        $message = "VejaGol! &Eacute; click, click e gol!";

        $feed_url = "https://www.facebook.com/dialog/feed?app_id=" 
               . $config['appId'] . "&redirect_uri=" . urlencode($config['canvas_page'])
               . "&message=" . $message;

        if (empty($_REQUEST["post_id"])) {
           echo("<script> top.location.href='" . $feed_url . "'</script>");
        } else {
           echo ("Feed Post Id: " . $_REQUEST["post_id"]);
        }
?>