<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">                 
<HTML>
<?php
  include('funcoes.php');
  $op=(isset($_GET['op']))?$_GET['op']:0;
?>
<HEAD>
 <title>ModAulas ADM</title>
 <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
 <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
 <LINK rel="StyleSheet" href="style.css" type="text/css">
</HEAD>

<BODY CLASS="ADM">
<?php
  if (is_file($ementafile)) 
    readfile($ementafile);
  else 
    echo "&nbsp;";
?>
</BODY>
</HTML>
