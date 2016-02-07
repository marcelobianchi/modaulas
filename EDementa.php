<?php
include("funcoes.php");
if (!authme()) logmein();

$tbementa       = isset($_POST['tbementa']) ? $_POST['tbementa'] : "";
$tbbibliografia = isset($_POST['tbbibliografia']) ? $_POST['tbbibliografia'] : "";

$tbementa       = str_replace(array("\'",'\"'),array("'",'"'),$tbementa);
$tbbibliografia = str_replace(array("\'",'\"'),array("'",'"'),$tbbibliografia);

$tbementa       = htmlentities($tbementa, ENT_QUOTES);
$tbbibliografia = htmlentities($tbbibliografia, ENT_QUOTES);

$tbementa       = nl2br($tbementa);

$bibitems = explode("\n",$tbbibliografia);
$bibitems = array_filter($bibitems);

if (is_file($ementafile))
	unlink($ementafile);

if ($tbementa) {
	$fh = fopen($ementafile,"w");
	if ($fh == NULL)
		erro("Não posso gravar no diretório $datadir", 3);
	
	fwrite($fh,"<P CLASS=SECTION>Ementa do curso: $nomedadisciplina [$sigladadisciplina]</P>\n");
	fwrite($fh,"$tbementa\n");

	if (count($bibitems) > 0) {
		fwrite($fh,"<P CLASS=SECTION>Bibliografia</P>\n");
		fwrite($fh,"<UL>\n");
		foreach($bibitems as $line)
			if (strcmp(rtrim($line),"") != 0)
				fwrite($fh," <LI>$line\n");
		fwrite($fh,"</UL>\n");
	}
	
	fclose($fh);
	aviso("Ementa Modificada",3);
}

aviso("Ementa removida", 3);
?>
