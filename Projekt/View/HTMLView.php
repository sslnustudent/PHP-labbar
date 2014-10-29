<?php

class HTMLView {

	public function echoHTML($body){

		echo "
			<!DOCTYPE html>
		     <html>
		     <head>
		     	<title>LogIn</title>
		     	<meta charset='utf-8'>
		     </head>
		     <body>
		     	$body
		     </body>
		     </html>";
	}
}