<?php
  include "funcoes.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">                 
<HTML>

<HEAD>
 <title><?php echo "$disciplina" ?></title>
 <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
 <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
 <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
 <LINK rel="StyleSheet" href="style.css" type="text/css">
</HEAD>

<BODY>

<H1>Calend�rio para a disciplina <?php echo "$nomedadisciplina - $sigladadisciplina" ?></H1>
<h3>Gerado em <?php echo strftime("%d/%m/%Y �s %H hs %M min",time()) ?></H3>
<HR NOSHADE>
<PRE>
<?php
$in=file($calfile);
sort($in);
foreach($in as $i => $a)
{ 
  list($dia,$cmp)=split("\|",rtrim($a),2);
   echo strftime("[%a: %d - %b]",$dia)," $cmp\n";
}
?>
</PRE>
<HR NOSHADE>
</BODY>
</HTML>
