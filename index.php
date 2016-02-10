<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">                 
<!-- Corrigido problema com o get_mime_type -->
<HTML>
<?php
	include('funcoes.php');
?>
<HEAD>
	<title><?php echo strtoupper($sigladadisciplina)." - ".ucwords($nomedadisciplina) ?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<LINK rel="StyleSheet" href="style.css" type="text/css">
</HEAD>

<BODY CLASS="ADM">

<!-- header -->
<TABLE WIDTH="100%" CLASS=TABELA CELLPADDING=15>
<TR>
	<TD WIDTH=200>&nbsp;</TD>
	<TD><P ALIGN="CENTER">Site da disciplina</P>
		<P CLASS=TOP> <?php echo $nomedadisciplina ?></P>
		<P CLASS=SECTION><?php echo $sigladadisciplina ?></P>
	</TD>
	<TD VALIGN="BOTTOM" ALIGN="RIGHT" WIDTH=200><A HREF="adm.php">
		<FONT SIZE=-1><I>Administração</I></FONT></A>
	</TD>
</TR>
</TABLE>
<HR NOSHADE>

<TABLE BORDER="1" WIDTH="100%" CELLPADDING=10 CELLSPACING=0>
<TR>
	<TD>
	<P CLASS="SECTION">Professores &amp; Monitores</P>

	<TABLE CELLSPACING=2 CELLPADDING=5 WIDTH="100%">
	<TR ALIGN="LEFT" VALIGN="TOP" CLASS=tabelareversa>
	<?php
		$professores = explode(',',$professores);
		$p_telefones = explode(',',$p_telefones); 
		$p_emails    = explode(',',$p_email);
		$p_sala      = explode(',',$p_sala);

		$monitores   = explode(',',$monitores);
		$m_telefones = explode(',',$m_telefones);
		$m_emails    = explode(',',$m_email);
		$m_sala      = explode(',',$m_sala);

		$m_horario=explode(',',$m_horario);

		$each  = max(count(array_filter($professores)),1) + max(count(array_filter($monitores)),1);
		$each  = 100 / $each;
	?>
	<?php
	$n = 0;
	for($i=0; $i < count($professores); $i++) {
		if ($professores[$i] === "") continue;
		echo "  <TD WIDTH='$each%'><FONT SIZE=\"-1\">Prof. Dr. $professores[$i]<BR>"
			.(($p_emails[$i]!='')?"[<A HREF=\"mailto:$p_emails[$i]\">EMAIL</A>] ":'')
			.(($p_telefones[$i]!='')?"Tel: $p_telefones[$i]":'')."<BR>"
			.(($p_sala[$i]!='')?"Sala $p_sala[$i]":'')."</FONT></TD>";
		$n++;
	}
	if ($n == 0) 
		echo "<TD ALIGN='CENTER' WIDTH='$each%'><FONT SIZE=\"-1\"><BR>&dash;&nbsp;Sem Professor Cadastrado&nbsp;&dash;<BR><BR></TD>";

	$n = 0;
	for($i=0; $i < count($monitores); $i++) {
		if ($monitores[$i] === "") continue;
		echo "  <TD WIDTH='$each%'><FONT SIZE=\"-1\">Monitor: $monitores[$i]<BR>"
			.(($m_emails[$i]!='')?"[<A HREF=\"mailto:$m_emails[$i]\">EMAIL</A>] ":'')
			.(($m_telefones[$i]!='')?"Tel: $m_telefones[$i]":'')."<BR>"
			.(($m_sala[$i]!='')?"Sala $m_sala[$i]":'')."</FONT></TD>"; 
		$n ++;
	}
	if ($n == 0)
		echo "<TD ALIGN='CENTER' WIDTH='$each%'><FONT SIZE=\"-1\"><BR>&dash;&nbsp;Disciplina sem Monitor&nbsp;&dash;<BR><BR></TD>";
	
	?>
	</TR>
	</TABLE>

	<TABLE WIDTH="100%">
		<TR><TD ALIGN="CENTER">
		<P CLASS="SUBSECTION">Horário da Monitoria</P>
		<?php
			if (count(array_filter($m_horario)) > 0) {
				foreach($m_horario as $i)
					echo rtrim($i)."<BR>\n";
			} else {
				echo "<P>&dash;&nbsp;<I>Nenhum horário de monitoria cadastrado</I>&nbsp;&dash;</P>";
			}
		?>
		</TD></TR>
	</TABLE>

	<?php if (is_file($ementafile)) {?>
		<P ALIGN="CENTER"><A HREF="GETementa.php" TARGET="_NEW">Ementa da disciplina</A></P>
	<?php } ?>
	</TD></TR>
</TABLE>

<!-- horário -->
<?php 
$stop = True;
foreach($tabeladehorario as $i) 
	if ($i) $stop = False;
if (!$stop) {
?>
<TABLE BORDER="1" WIDTH="100%" CELLPADDING=10 CELLSPACING=0>
	<TR><TD>
	<P CLASS="SECTION">Horário das aulas</P>
	<?php
		$today=getdate();
		$day=$today["mday"];
		$sday=$today["wday"];
	?>
	<TABLE  CLASS=TABELA WIDTH="830"  ALIGN="CENTER" CELLPADDING=5 CELLSPACING=2>
	<TR ALIGN="CENTER">
		<TD WIDTH="130"><B>Horário</B></TD>
		<TD WIDTH="100"><B>Domingo</B></TD>
		<TD WIDTH="100"><B>Segunda</B></TD>
		<TD WIDTH="100"><B>Terça</B></TD>
		<TD WIDTH="100"><B>Quarta</B></TD>
		<TD WIDTH="100"><B>Quinta</B></TD>
		<TD WIDTH="100"><B>Sexta</B></TD>
		<TD WIDTH="100"><B>Sábado</B></TD>
	</TR>
	<TR ALIGN="CENTER">
		<TD WIDTH="130"><B>Esta semana</B></TD>
		<?php for($i=0;$i<7;$i++)  {  ?>
			<TD WIDTH="100">
				<?php
					if ($sday==$i)
						echo '<FONT COLOR="#ffffff"><B>';
					echo date("d/M",time()-($sday-$i)*(24*3660));
					if ($sday==$i) 
						echo '</B></FONT>';
				?>
			</TD>
		<?php } ?>
	</TR>

	<?php
	for($horario=0;$horario<count($tablehorario);$horario++) {
		echo "<TR ALIGN=\"CENTER\">\n";
		echo " <TD>$tablehorario[$horario]</TD>\n";
		for($day=0; $day<7;$day++)
		echo " <TD BGCOLOR=\"#ffffff\">".(($tabeladehorario[(($horario*7)+$day)]==1)?$sigladadisciplina:'&nbsp;')."</TD>\n";
		echo "</TR>\n\n";
	}
	?>
	</TABLE>
	</TD></TR>
</TABLE>
<?php } ?>

<!-- calendário -->
<?php if (is_file($calfile)) { ?>
<TABLE BORDER="1" WIDTH="100%" CELLPADDING=10 CELLSPACING=0>
	<TR><TD>
	<P CLASS=SECTION>Calendário</P>
	<I><?php echo "Hoje é".(strftime(" %A, %d de %B de %Y\n",time())); ?></I>
	<PRE>
<?php
	$maxday = strtotime("+1 month");
	$minday = strtotime("-1 day");
	$in     = file($calfile);

	foreach($in as $i => $a) { 
		list($dia,$cmp)=split("\|",rtrim($a),2);
		if(($dia<$maxday)&&($dia>$minday))
			echo strftime("    [%a: %d/%b]",$dia)," $cmp\n";
	}
?>
	</PRE>
	</TD></TR>
	<TR><TD ALIGN="RIGHT"><A HREF="GETcalendario.php" TARGET="_NEW">ver todo o calendário</A></TD></TR>
</TABLE>
<?php  } ?>

<!-- Quadro de avisos -->
<?php if(is_file($avisofile)) { ?>
	<TABLE BORDER="1" WIDTH="100%" CELLPADDING=10 CELLSPACING=0>
		<TR><TD>
			<P CLASS=SECTION>Quadro de Avisos</P>
			<CENTER>
				<IFRAME FRAMEBORDER=1 WIDTH="80%" ALIGN=middle scrolling=auto height=200 src="GETavisos.php">
				O seu browser não suporta IFRAMES visualize os <A HREF="GETavisos.php">avisos aqui</A>.
				</IFRAME>
			</CENTER>
		</TD></TR>
	</TABLE>
<?php } ?>

<!-- Links -->
<?php if(is_file($linkfile)) { ?>
<TABLE BORDER="1" WIDTH="100%" CELLPADDING=10 CELLSPACING=0>
	<TR><TD>
	<P CLASS=SECTION>Links Úteis</P>
		<?php
		echo "<UL>\n";
		$lists=file($linkfile);
		foreach($lists as $item) {
			list($getid,$getnome,$getendereco)=split("\t",trim($item),3);
			echo "<LI><A HREF=\"$getendereco\" TARGET=\"_NEW\" TITLE=\"$getnome\">$getnome</A>";
		}
		echo "</UL>\n";
		?>
	</TD></TR>
</TABLE>
<?php } ?>

<!-- Apostilas -->
<?php 
	$folders = collect($datadir);
	$n = 0;
	foreach($folders as $folder)
		$n += ! $folder['hidden'];
?>

<?php if ($n > 0) { ?>
<TABLE BORDER="1" WIDTH="100%" CELLPADDING=10 CELLSPACING=0>
	<TR><TD>
	<P CLASS=SECTION>Apostilas</P>
	<?php
	foreach($folders as $fpath => $folder) {
		if ($folder['hidden']) continue;
	?>
		<TABLE WIDTH="100%" CELLPADDING=2>
		<TR>
			<TD WIDTH="50"><B>Pasta</B>:</TD>
			<TD CLASS=tabelareversa COLSPAN=4><?php echo $fpath ?></TD>
		</TR>
		<?php
		foreach($folder['files'] as $file) {
			if ($file['hidden']) continue;
		?>
			<TR>
				<TD WIDTH="50">&nbsp;</TD>
				<TD WIDTH=""><FONT SIZE="-1">(<a title="<?php echo $file['mime']?>"><?php echo $file['ext'] ?></a>)</FONT></TD>
				<TD WIDTH="" CLASS=TABELA><?php echo $file['cmt'] ?></TD>
				<TD WIDTH="80" ALIGN="RIGHT"><?php echo $file['fs'] ?></TD>
				<TD WIDTH="50">[<A HREF="<?php echo $file['path'] ?>">Baixar</A>]</TD>
			</TR>
		<?php
		}
		?>
	</TABLE>
	<?php } ?>

</TD></TR>
</TABLE>
<?php } # Fim da apostila ?>

<HR NOSHADE>

<TABLE WIDTH="100%">
	<TR>
		<TD WIDTH="200" VALIGN="TOP"><font size=-1>Desenvolvido por <A HREF="mailto:mbianchi@iag.usp.br">Marcelo Bianchi</A> @2005 para o programa PAE</FONT></TD>
		<TD ALIGN="CENTER">Este programa é <B>GPL</B><BR> Desenvolvido com apoio da <A HREF="http://www.capes.gov.br/capes/portal/">CAPES</A> </TD>
		<TD ALIGN="RIGHT" WIDTH="200" VALIGN="TOP"><FONT SIZE="-1"><I><A HREF="about.html">Sobre</A> ModAulas</I></FONT></TD></TR>
</TABLE>

</BODY>
</HTML>
