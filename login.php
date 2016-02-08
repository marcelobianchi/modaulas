<?php
	include ('funcoes.php');
	$tbpassword = $_POST ['tbpassword'];
	authme ( $tbpassword );
?>
<HTML>
	<HEAD>
		<title>ModAulas ADM</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
		<LINK rel="StyleSheet" href="style.css" type="text/css">
		<meta http-equiv="refresh" content="1; URL=adm.php">
	</HEAD>
	<BODY></BODY>
</HTML>
