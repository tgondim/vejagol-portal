<?php 

		$config = array();
		$config['appId'] = '179155015544329';
		$config['canvas_page'] = "http://apps.facebook.com/vejagol";

         $message = "Se liga no VejaGol! Você n&atilde;o quer conhecer? &Eacute; click, click e gol!";

         $requests_url = "https://www.facebook.com/dialog/apprequests?app_id=" 
                . $config['appId'] . "&redirect_uri=" . urlencode($config['canvas_page'])
                . "&message=" . $message;

         if (empty($_REQUEST["request_ids"])) {
            echo("<script> top.location.href='" . $requests_url . "'</script>");
         } else {
            echo "Request Ids: ";
            print_r($_REQUEST["request_ids"]);
         }
?>