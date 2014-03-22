<?php
  include('funcoes.php');
  if (!authme()) logmein();
  $op=(isset($_GET['op']))?$_GET['op']:0;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">                 
<HTML>
<HEAD>
 <title>ModAulas ADM &gt;www.foo4fun.net&lt;</title>
 <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
 <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
 <LINK rel="StyleSheet" href="style.css" type="text/css">
</HEAD>

<BODY CLASS="ADM">

<!-- TITULO -->
<TABLE WIDTH="100%" ALIGN="CENTER" CELLPADDING=0 CELLSPACING=0>
<TR>
 <TD WIDTH=100>&nbsp;</TD>
 <TD ALIGN="CENTER"><P CLASS="TOP">ModAulas ADM</P></TD>
 <TD WIDTH=100 ALIGN="RIGHT" VALIGN="BOTTOM">
   <FONT SIZE=1><I>[<A HREF="adm.php">home</A>]</I></FONT><BR>
   <FONT SIZE=1><I>[<A HREF="index.php">Site da disciplina</A>]</I></FONT>
   <FONT SIZE=1><I>[<A HREF="logout.php">LogOut</A>]</I></FONT>
 </TD>
</TR>
</TABLE>

<!-- MENU -->
<CENTER>
<HR NOSHADE>
<CENTER>
<TABLE CLASS="mastertable" CELLPADDING=0 CELLSPACING=0 WIDTH="97%">
<TR ALIGN="CENTER">
 <TD WIDTH="15%" <?php if($op==1) echo "CLASS=set" ?>><A HREF="adm.php?op=1">NOME, SIGLA &amp;
 INFORMAÇÕES GERAIS </A></TD>
 <TD WIDTH="15%" <?php if($op==2) echo "CLASS=set" ?>><A HREF="adm.php?op=2">HORÁRIO</A></TD>
 <TD WIDTH="15%" <?php if($op==3) echo "CLASS=set" ?>><A HREF="adm.php?op=3">EMENTA</A></TD>
 <TD WIDTH="15%" <?php if($op==4) echo "CLASS=set" ?>><A HREF="adm.php?op=4">CALENDÁRIO</A></TD>
 <TD WIDTH="15%" <?php if($op==5) echo "CLASS=set" ?>><A HREF="adm.php?op=5">QUADRO DE AVISOS</A></TD>
 <TD WIDTH="15%" <?php if($op==6) echo "CLASS=set" ?>><A HREF="adm.php?op=6">PASTAS E ARQUIVOS</A></TD>
</TR>
<TR>
</TR>
</TABLE>
</CENTER>
<HR NOSHADE>
</CENTER>

<?php  if ($op==1) {?>
<!-- NOME E SIGLA -->

<P CLASS="SECTION">Nome, Sigla &amp; Informações Gerais </P>


<TABLE WIDTH="700" ALIGN="CENTER">
<TR ALIGN="CENTER"><TD COLSPAN=2>

<FORM METHOD="POST" ACTION="EDsigla.php">
 <TABLE  CLASS="tabela" WIDTH="700" ALIGN="CENTER">
  <TR><TD COLSPAN=2 CLASS=SECTION>Nome e Sigla da Disciplina</TD></TR>
  <TR><TD>Nome da disciplina:</TD><TD><INPUT NAME="tbdisciplina" SIZE=65 VALUE="<?php echo $nomedadisciplina;?>"></TD></TR>
  <TR><TD>Código da disciplina:</TD><TD><INPUT NAME="tbsigla" SIZE=7 MAXLENGTH=7 VALUE="<?php echo $sigladadisciplina;?>"></TD></TR>
  <TR><TD COLSPAN=2 ALIGN=RIGHT><INPUT TYPE="SUBMIT" VALUE="Alterar"></TD></TR>
 </TABLE>
 <input type="hidden" name="action" value="sigla">
</FORM>
</TD></TR>

<TR ALIGN="CENTER"><TD>
 <FORM METHOD="POST" ACTION="EDsigla.php">
  <TABLE  CLASS="tabela" WIDTH="100%">
   <TR><TD COLSPAN=2 CLASS=SECTION>Informação dos Professores</TD></TR>
   <TR><TD COLSPAN=2 ALIGN="CENTER">+ de 1 nome separados por vírgula</TD></TR>
   <TR>
     <TD>Nome(s)</TD>
     <TD><INPUT NAME="tbprofessores" value="<?php echo $professores?>"></TD>
   </TR>
   <TR>
     <TD>Telefone(s)</TD>
     <TD><INPUT NAME="tbtelefones" value="<?php echo $p_telefones?>"></TD>
   </TR>
   <TR>
     <TD>Email(s)</TD>
     <TD><INPUT NAME="tbemail" value="<?php echo $p_email?>"></TD>
   </TR>
   <TR>
     <TD>Sala(s)</TD>
     <TD><INPUT NAME="tbsala" value="<?php echo $p_sala?>"></TD>
   </TR>
   <TR>
     <TD COLSPAN=2 ALIGN="RIGHT"><input type="Submit" value="Alterar"></TD>
   </TR>
  </TABLE>
 <input type="hidden" name="action" value="professor">
 </FORM>

</TD><TD>

 <FORM METHOD="POST" ACTION="EDsigla.php">
  <TABLE  CLASS="tabela" WIDTH="100%">
   <TR>
     <TD COLSPAN=2 CLASS=SECTION>Informação dos Monitores</TD>
   </TR>
   <TR>
     <TD COLSPAN=2 ALIGN="CENTER">+ de 1 nome separados por vírgula</TD>
   </TR>
   <TR>
     <TD>Nome(s)</TD>
     <TD><INPUT NAME="tbmonitores" value="<?php echo $monitores?>"></TD>
   </TR>
   <TR>
     <TD>Telefone(s)</TD>
     <TD><INPUT NAME="tbtelefones" value="<?php echo $m_telefones ?>"></TD>
   </TR>
   <TR>
     <TD>Email(s)</TD><TD><INPUT NAME="tbemail" value="<?php echo $m_email ?>"></TD>
   </TR>
   <TR>
     <TD>Sala(s)</TD>
     <TD><INPUT NAME="tbsala" value="<?php echo $m_sala ?>"></TD>
   </TR>
   <TR>
     <TD COLSPAN=2 ALIGN="RIGHT"><input type="Submit" value="Alterar"></TD>
   </TR>
  </TABLE>
 <input type="hidden" name="action" value="monitor">
 </FORM>

</TD></TR>
<TR><TD COLSPAN=2 ALIGN="CENTER">

  <FORM METHOD="POST" ACTION="EDsigla.php">
  <TABLE CLASS=TABELA WIDTH="100%"> 
  <TR>
   <TD CLASS="SECTION" ALIGN="CENTER">Horário para monitoria</TD>
  </TR>
  <TR>
   <TD ALIGN="CENTER">+ de 1 horário separados por vírgula</TD>
  </TR>
  <TR>
   <TD ALIGN="CENTER" >
     <INPUT SIZE="72" NAME="tbhorario" value="<?php echo $m_horario ?>">
     <input type="Submit" value="Alterar">
     <INPUT type="hidden" name="action" value="horario_monitor">
   </TD>
  </TR>
  </TABLE>
   </FORM>

</TD></TR>
<TR><TD COLSPAN=2 ALIGN="CENTER">
  <FORM METHOD="POST" ACTION="EDsigla.php">
  <TABLE CLASS=TABELA WIDTH="100%"> 
  <TR>
   <TD CLASS="SECTION" ALIGN="CENTER">Senha para acessar a ferramenta de administração</TD>
  </TR>
<?php
 if($mysetedpassword==md5('modaulas'))
 {?>
  <TR>
   <TD CLASS="SUBSECTION" ALIGN="CENTER"><FONT color="#ffffff">Senha padrão ativa, Mude a sua senha</FONT></TD>
  </TR>
 <?php } ?>
  <TR>
   <TD ALIGN="CENTER" >
     <INPUT TYPE="password" SIZE="72" NAME="tbsenha" value="">
     <input type="Submit" value="Alterar">
     <INPUT type="hidden" name="action" value="senha">
   </TD>
  </TR>
  </TABLE>
   </FORM>

</TD></TR>
</TABLE>

<?php } ?>

<?php  if ($op==2) {?>
<!-- HORARIO -->

<?php
 $today=getdate();
 $day=$today["mday"];
 $sday=$today["wday"];
?>

<P CLASS="SECTION">Horário</P>
<P CLASS="SUBSECTION"><?php echo "[".date("M d Y H:i:s")."]" ?></P>

<FORM METHOD="POST" ACTION="EDhorario.php">
<TABLE  CLASS="tabela" WIDTH="830"  ALIGN="CENTER" CELLPADDING=0 CELLSPACING=0>
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
     <TD WIDTH="100"><?php if ($sday==$i) echo '<B>' ?><?php echo date("d/M",time()-($sday-$i)*(24*3660))?><?php if ($sday==$i) echo '</B>' ?></TD>
  <?php } ?>
 </TR>

<?php
for($horario=0;$horario<count($tablehorario);$horario++)
{
 echo "<TR ALIGN=\"CENTER\">\n";
 echo " <TD>$tablehorario[$horario]</TD>\n";
 for($day=0; $day<7;$day++)
   echo " <TD BGCOLOR=\"#ffffff\"><INPUT ".(($tabeladehorario[(($horario*7)+$day)]==1)?'CHECKED':' ')." TYPE=\"checkbox\" NAME=\"tb".(($horario*7)+$day+1)."\"></TD>\n";
 echo "</TR>\n\n";
 if (($horario%2==1) && ($horario!=count($tablehorario)-1)) 
     echo "<TR><TD BGCOLOR=\"#ffffff\" COLSPAN=8>&nbsp;</TD></TR>";
}
?>
<TR><TD COLSPAN=8 ALIGN=RIGHT><INPUT TYPE="SUBMIT" VALUE="Alterar"></TD></TR>
</TABLE> 
</FORM>
<?php } ?>


<?php  if ($op==3) {?>
<!-- EMENTA -->
<P CLASS="SECTION">Ementa do Curso</P>

<TABLE BORDER CELLPADDING=0 CELSPACING=0 WIDTH="925" ALIGN="CENTER" CLASS="tabela">
<TR>
 <TD VALIGN="TOP">
   <IFRAME SRC="GETementa.php" WIDTH="400" HEIGHT="535"></IFRAME> 
 </TD>
 <TD VALIGN="TOP">
 <FORM METHOD="POST" ACTION="EDementa.php">
 <TABLE CLASS="tabela" WIDTH="525" >
  <TR><TD ALIGN="RIGHT"><B>Ementa do Curso</B> (não coloque título)</TD></TR>
  <TR><TD ALIGN="RIGHT"><TEXTAREA NAME="tbementa" rows=15 cols=55></TEXTAREA></TD></TR>
  <TR><TD ALIGN="RIGHT"><B>Bibliografia do Curso</B> (1 bibliografia por
linha não quebre a linha no meio de uma mesma referência)</TD></TR>
  <TR><TD ALIGN="RIGHT"><TEXTAREA NAME="tbbibliografia" rows=10 cols=55></TEXTAREA></TD></TR>
  <TR><TD ALIGN="RIGHT"><INPUT TYPE="SUBMIT" VALUE="Alterar"></TD></TR>
 </TABLE>
 </FORM>
 </TD>
</TR>
</TABLE>
<?php } ?>


<?php  if ($op==4) {?>
<!-- CALENDARIO -->
<?php
 $today=getdate();
 $day=$today["mday"];
 $month=$today["mon"];
 $year=$today["year"];
 $today=getdate(strtotime("$month/01/$year"));
 $wday=$today["wday"];
 
 if ($month!=2)
 {
   if (checkdate($month,31,$year))
     $maxday=31;
   else 
     $maxday=30;
 } else
   {
   if (checkdate(($month-1),29,$year))
     $maxday=29;
   else 
     $maxday=28;
   }
    
?>

<P CLASS="SECTION">Calendário</P>

<TABLE WIDTH="100%" CELLPADDING=0 CELLSPACING=0>
<TR>
<TD VALIGN="TOP">

<!-- Adicionar data ao calendario -->
<P><TABLE CLASS="tabelareversa">
<form action="EDcalendario.php" method="POST">
 <TR><TD COLSPAN="4"><B>Adicionar data ao calendário</B></TD></TR>
 <TR><TD>Dia</TD><TD>Mês</TD><TD>Ano</TD><TD>Descrição</TD></TR>
 <TR><TD>
  <SELECT name="tbdia">
<?php
  for($i=1;$i<=31;$i++)
    if ($i==$day)
      echo "     <option  SELECTED name=\"$i\">$i</option>\n";
    else
      echo "     <option name=\"$i\">$i</option>\n";
?>
  </select></TD><TD>
  <SELECT name="tbmes">
<?php
  for($i=1;$i<=12;$i++)
    if ($i==$month)
      echo "     <option  SELECTED name=\"$i\">$i</option>\n";
    else
      echo "     <option name=\"$i\">$i</option>\n";
    
?>
  </SELECT></TD><TD>
  <input name="tbano" size=4 maxlength=4 value="<?php echo $year;?>"></TD><TD>
  <input name="tbcmt" size=30>
  <INPUT TYPE="hidden" name="action" value="adddata">
  <input type="submit" value="Adicionar"></TD></TR>
  </form>
</TABLE></P>

<!-- Mostrar o calendario -->
<?php
if (is_file($calfile))
  $in=file($calfile);
else 
  $in="";
  
echo "<P><TABLE BORDER=0 CLASS=TABELA>
  <TR>
    <TD ALIGN=\"CENTER\" COLSPAN=4 CLASS=SECTION> Datas cadastradas no calendário</TD></TR>
  </TR>
  <TR BGCOLOR=\"#ffffff\">
   <TD WIDTH=\"150\" ALIGN=\"CENTER\"><B>Dia da Semana</B></TD>
   <TD WIDTH=\"150\" ALIGN=\"CENTER\"><B>Dia/Mês/Ano</B></TD>
   <TD WIDTH=\"350\"><B>Descrição</B></TD>
   <TD>&nbsp;</TD>
  </TR>\n";
if ($in != "")
 foreach($in as $i => $a)
 { 
   list($dia,$cmp)=split("\|",rtrim($a),2);
   $tbdia=date("d",$dia);
   $tbmes=date("m",$dia);
   $tbano=date("y",$dia);
   $wdia=ucfirst(strftime("%A",$dia));
   $ww=date("w",$dia);
   if ($ww!=6 && $ww!=0)
   {
     $wdia=$wdia."-feira";
   }
   ?>
    <TR BGCOLOR="#ffffff"><TD ALIGN="CENTER"><?php echo $wdia?></TD><TD ALIGN="CENTER"><?php echo "$tbdia/$tbmes/$tbano" ?></TD><TD><?php echo $cmp ?></TD>
    <TD>
      <FORM ACTION="EDcalendario.php" METHOD="POST">
 	<INPUT TYPE="submit" value="Apagar data">
 	<INPUT TYPE="hidden" name="tbdata" value="<?php echo $dia?>">
 	<INPUT TYPE="hidden" name="action" value="deldata">
      </FORM>
     </TD>
     </TR>
   <?php
 }
echo "</TABLE></P>\n";
?>


</TD>
<TD ALIGN="CENTER" VALIGN="TOP">

<!-- O calendario do mes -->
<TABLE BORDER CELLPADDING=0 CELLSPACING=0>
<?php echo "<TR ALIGN=\"CENTER\"><TD CLASS=tabelareversa COLSPAN=7>".ucfirst(strftime("%B",strtotime("$month/01/$year")))."/$year</TD></TR>\n"; ?>
<TR ALIGN="CENTER">
  <TD>D</TD>
  <TD>S</TD>
  <TD>T</TD>
  <TD>Q</TD>
  <TD>Q</TD>
  <TD>S</TD>
  <TD>S</TD>
</TR>

<?php
 $wd=0;

 echo "<TR ALIGN=\"CENTER\">\n";
 
 for($i=0;$i<$wday;$i++,$wd++)
   echo "  <TD>&nbsp;</TD>\n";
 
 for($i=0;$i<$maxday;$i++,$wd++)
 {
   echo "  <TD>".($j*7+$i+1)."</TD>\n";
   if ($wd==6)
   {
     echo "</TR>\n";
     $wd=-1;
     echo "<TR ALIGN=\"CENTER\">\n";
   }  
 }

 for($i=$wd;$i<7;$i++,$wd++)
   echo "  <TD>&nbsp;</TD>\n";

 echo "</TR>\n"
?>
</TABLE>

</TD>
</TR></TABLE>
<?php } ?>


<?php  if ($op==5) {?>
<!-- QUADRO DE AVISOS -->
<P CLASS="SECTION">Quadro de avisos</P>

<TABLE BORDER CLASS="tabela" WIDTH="935" ALIGN="CENTER">  
 <TR>
  <TD VALIGN="TOP">
   <IFRAME SRC="GETavisos.php" WIDTH="450" HEIGHT="320"></IFRAME>
  </TD>
  <TD VALIGN="TOP">

   <TABLE CLASS="tabela" width="485">
   <FORM METHOD="POST" ACTION="EDavisos.php">
    <TR>
     <TD COLSPAN=2 ALIGN="RIGHT">
       <TEXTAREA NAME="tbaviso" rows=15 cols=50></TEXTAREA>
     </TD>
    </TR>
    <TR>
     <TD>
       &nbsp;
     </TD>
     <TD VALIGN="TOP" ALIGN="RIGHT">
       <INPUT TYPE="SUBMIT" VALUE="publicar">
     </TD>
    </TR>
   <INPUT TYPE="hidden" NAME="action" VALUE="addaviso">
   </FORM>

   <FORM METHOD="POST" ACTION="EDavisos.php">
    <TR>
      <TD VALIGN="TOP" ALIGN="RIGHT">
         Apagar todos os avisos do quadro de avisos <INPUT TYPE="CHECKBOX" NAME="tbconfirma"> ?
      </TD>
      <TD VALIGN="TOP" ALIGN="RIGHT">
         <INPUT TYPE="SUBMIT" VALUE="apagar">
      </TD>
    </TR>
    <INPUT TYPE="hidden" NAME="action" VALUE="apagaavisos">
   </FORM>
   </TABLE> 

  </TD>
 </TR>
</TABLE>
<?php } ?>

<?php  if ($op==6) {?>
<?php
$post=array();
if (is_dir($datadir)) {
   if ($dh = opendir($datadir)) 
   {
       $i=0;
       while (($file = readdir($dh)) !== false) {
        if (($file!='.')&&($file!='..')&&(is_dir("$datadir/$file")))
	{
	  $post[$i]=$file;
	  $i++;
	}
      }
       closedir($dh);
   }
}
?>
<!-- Pastas e Arquivos -->
<P CLASS="SECTION">Pastas e Arquivos</P>

<P><TABLE CLASS="tabelareversa">
 <FORM ACTION="EDfile.php" METHOD="POST">
 <input type="hidden" name="action" value="criarpasta">
  <TR><TD COLSPAN=3 CLASS=SUBSECTION>Criar uma nova pasta</TD></TR>
  <TR><TD COLSPAN=2>Nome da pasta: <INPUT NAME="tbpasta"></TD>
      <TD ALIGN="RIGHT"><input type="submit" value="Criar Pasta"></TD></TR>
 </FORM>
</TABLE></P>

<P CLASS="SECTION">
   <?php 
    if(count($post)>0) 
      echo "Editar arquivos e pastas atuais ";
    else
      echo "Nenhuma pasta criada";
   ?>
</P>

<?php
foreach($post as $i => $p)
{ ?>
<P><TABLE class=tabela>
 <TR>
   <TD><FONT COLOR="#284d49"><B>Pasta</B>: <?php echo $p ?></FONT></TD>
   <TD COLSPAN=2 BGCOLOR="#ffffff" ALIGN="RIGHT">
    <FORM ACTION="EDfile.php" METHOD="POST">
     <input type="hidden" name="action" value="apagarpasta">
     <input type="hidden" name="tbpasta" value="<?php echo $p ?>">
     apagar &quot;<?php echo $p ?>&quot; e todo seu conteúdo ?&nbsp;&nbsp;&nbsp;
     <input type="checkbox" name="tbcheck">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="submit" value="apaga">
    </FORM>
   </TD>
 </TR>
 <TR>
   <TD COLSPAN=3 VALIGN="CENTER">
    <FORM ACTION="EDfile.php" METHOD="POST" ENCTYPE="multipart/form-data">
      <input type="hidden" name="action" value="addarquivo">
      <input type="hidden" name="tbpasta" value="<?php echo $p ?>">
      <INPUT type="file" size=24 NAME="tbarquivo" title="marcelo">
      <input type="submit" value="Adicionar arquivo para pasta: <?php echo $p ?>">
   </TD>
    </FORM>
   </TD>
 </TR>
 
 <?php
 if ($dh = opendir("$datadir/$p")) 
 {
  while (($f = readdir($dh)) !== false) 
  {
   if (($f!='.')&&
       ($f!='..')&&
       (substr($f,strlen($f)-11,11)!=='_comentario')
      )
   {
    if (is_file("$datadir/$p/$f"."_comentario"))
    {
       $comentario=file("$datadir/$p/$f"."_comentario");
       $comentario=rtrim($comentario[0]);
    } else 
       $comentario="";
    ?>
     <TR BGCOLOR="#ffffff">
      <TD ALIGN="CENTER"><?php echo $f ?></TD>
      <TD BGCOLOR="#ffffff" ALIGN="LEFT">
       <FORM ACTION="EDfile.php" METHOD="POST">
        <input type="hidden" name="action" value="comentario">
        <input type="hidden" name="tbpasta" value="<?php echo $p?>">
        <input type="hidden" name="tbarquivo" value="<?php echo $f?>">
        <input name="tbcomentario" size=33 value="<?php echo $comentario ?>">
        <input type="submit" value="alterar">
       </FORM>
      </TD>
      <TD ALIGN="RIGHT">
       <FORM ACTION="EDfile.php" METHOD="POST">
        <input type="hidden" name="action" value="delarquivo">
        <input type="hidden" name="tbpasta" value="<?php echo $p?>">
        <input type="hidden" name="tbarquivo" value="<?php echo $f?>">
        Apagar ?<input type="checkbox" name="tbcheck">
        <input type="submit" value="apaga">
       </FORM>
      </TD>
     </TR>
    <?php
   }
  }
 }
echo "</TABLE></P>";
} 
?>

<?php } # FIM DO OP==6 ?>

<?php  if ($op==0) {?>
 <P CLASS=SECTION> Bem vindo ao site de administração da página da disciplina <I><?php echo $nomedadisciplina ?></I></P>
 <P CLASS=SECTION> Sigla: <I><?php echo $sigladadisciplina ?></I> </P>
<?php } ?>

<HR NOSHADE>
<TABLE WIDTH="100%">
 <TR>
   <TD WIDTH="200" VALIGN="TOP"><font size=-1>Desenvolvido por <A HREF="mailto:mbianchi@iag.usp.br">Marcelo Bianchi</A> @2005 para o programa PAE</FONT></TD>
   <TD ALIGN="CENTER">Este programa é <B>GPL</B><BR> Desenvolvido com apoio da <A HREF="http://www.capes.gov.br/capes/portal/">CAPES</A> </TD>
   <TD ALIGN="RIGHT" WIDTH="200" VALIGN="TOP"><FONT SIZE="-1"><I><A HREF="about.html">Sobre</A> ModAulas</I></FONT></TD></TR>
</TABLE>
</BODY>
</HTML>
