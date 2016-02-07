<?php
	include "funcoes.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>

<HEAD>
	<title><?php echo "$nomedadisciplina - $sigladadisciplina" ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<LINK rel="StyleSheet" href="style.css" type="text/css">
</HEAD>

<BODY>

<H1>Calendário para a disciplina <?php echo "$nomedadisciplina - $sigladadisciplina" ?></H1>
<h3>Gerado em <?php echo strftime("%d/%m/%Y às %H hs %M min",time()) ?></H3>
<HR NOSHADE>
<PRE>
<?php
	if (is_file($calfile)) {
		$in = file($calfile);
		if ($in) {
			sort($in);
			foreach($in as $i => $a) {
				list($dia,$cmp)=split("\|",rtrim($a),2);
				echo strftime("[%a: %d - %b]",$dia)," $cmp\n";
			}
		}
	}
?>
</PRE>
<HR NOSHADE>
</BODY>
</HTML>
