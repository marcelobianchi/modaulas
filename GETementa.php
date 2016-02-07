<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">                 
<HTML>
<?php
	include('funcoes.php');
?>
<HEAD>
	<title>ModAulas</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<LINK rel="StyleSheet" href="style.css" type="text/css">
</HEAD>

<BODY CLASS="ADM">
<?php
	if (is_file($ementafile)) {
		readfile($ementafile);
	} else {
		echo "<p align='center'>Ementa não está disponível para disciplina !!</center>";
	}
?>
</BODY>
</HTML>
