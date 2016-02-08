<?php
	include ('funcoes.php');
	session_start ();
	unset ( $SESSION ['authdata'] );
	session_destroy ();
?>

<HTML>
	<HEAD>
		<title>ModAulas ADM</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
		<LINK rel="StyleSheet" href="style.css" type="text/css">
		<meta http-equiv="refresh" content="1; URL=index.php">
	</HEAD>
	<BODY></BODY>
</HTML>
