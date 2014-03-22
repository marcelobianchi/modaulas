<?
include("funcoes.php");
if (!authme()) logmein();

$tbementa=$_POST['tbementa'];
$tbbibliografia=$_POST['tbbibliografia'];

$fh=fopen($ementafile,"w");
if ($fh==NULL) erro("Não posso gravar no diretório $datadir");
fwrite($fh,"<P CLASS=SECTION>Ementa do curso: $nomedadisciplina [$sigladadisciplina]</P>\n");

$tbementa=str_replace(array("\'",'\"'),array("'",'"'),$tbementa);
$tbbibliografia=str_replace(array("\'",'\"'),array("'",'"'),$tbbibliografia);

$tbementa=htmlentities($tbementa, ENT_QUOTES);
$tbbibliografia==htmlentities($tbbibliografia, ENT_QUOTES);
$tbementa=nl2br($tbementa);

fwrite($fh,"$tbementa\n");

fwrite($fh,"<P CLASS=SECTION>Bibliografia</P>\n");
fwrite($fh,"<UL>\n");
foreach(explode("\n",$tbbibliografia) as $line)
  if (strcmp(rtrim($line),"")!=0)
    fwrite($fh," <LI>$line\n");

fwrite($fh,"</UL>\n");
fclose($fh);
aviso("Ementa Modificada",3);
?>
