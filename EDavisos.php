<?php
include("funcoes.php");
if (!authme()) logmein();

$action=$_POST['action'];

switch($action)
{
 case "addaviso":
 $tbavisotitulo=(isset($_POST['tbavisotitulo']))?$_POST['tbavisotitulo']:erro('Requisição incompleta !');
 $tbaviso=(isset($_POST['tbaviso']))?$_POST['tbaviso']:erro('Requisição incompleta !');
 if (strcmp($tbaviso,"")==0) erro('Requisição incompleta !');

 if (is_file($avisofile))
   $avisos=file($avisofile);
 else
   $avisos=array();

 $fh=fopen($avisofile,"w");
 if ($fh==NULL) 
   erro("Não posso gravar $avisofile");


 $tbaviso=str_replace(array("\'",'\"'),array("'",'"'),$tbaviso);
 $tbavisotitulo=str_replace(array("\'",'\"'),array("'",'"'),$tbavisotitulo);

 $tbaviso=htmlentities($tbaviso, ENT_QUOTES);
 $tbaviso=nl2br($tbaviso);

 if (!empty($tbavisotitulo)) fwrite($fh,"<P CLASS=\"subsection_l\"><B>$tbavisotitulo</B></P>\n\n");
 fwrite($fh,"<P>$tbaviso</P>\n\n");
 fwrite($fh,"<P align=\"right\"><I>Aviso de ". date('d/m/Y - H:i')."</I></P><HR NOSHADE>\n\n");
 fwrite($fh,implode("\n",$avisos));

 fclose($fh);
 break;

 case 'apagaavisos':
   $tbconfirma=$_POST['tbconfirma'];
   if (strncmp($tbconfirma,'on',2)==0)
     unlink($avisofile);
   else
     erro('Voce deve confirmar ação com o CHECKBOX !');
 break; 

 default:
   erro('Entrada inválida !');
 break;
}

 aviso("Quadro de aviso modificado !",5);
?>
