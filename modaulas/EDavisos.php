<?
include("funcoes.php");
if (!authme()) logmein();

$action=$_POST['action'];

switch($action)
{
 case "addaviso":
 $tbaviso=(isset($_POST['tbaviso']))?$_POST['tbaviso']:erro('Requisi��o incompleta !');
 if (strcmp($tbaviso,"")==0) erro('Requisi��o incompleta !');

 if (is_file($avisofile))
   $avisos=file($avisofile);
 else
   $avisos=array();

 $fh=fopen($avisofile,"w");
 if ($fh==NULL) 
   erro("N�o posso gravar $avisofile");

 fwrite($fh,"<P><B>Aviso de ". date('d/m/Y H:i')."</B></P>\n");

 $tbaviso=str_replace(array("\'",'\"'),array("'",'"'),$tbaviso);

 $tbaviso=htmlentities($tbaviso, ENT_QUOTES);
 $tbaviso=nl2br($tbaviso);

 fwrite($fh,"<P>$tbaviso</P>\n\n");
 fwrite($fh,implode("\n",$avisos));

 fclose($fh);
 break;

 case 'apagaavisos':
   $tbconfirma=$_POST['tbconfirma'];
   if (strncmp($tbconfirma,'on',2)==0)
     unlink($avisofile);
   else
     erro('Voce deve confirmar a��o com o CHECKBOX !');
 break; 

 default:
   erro('Entrada inv�lida !');
 break;
}

 aviso("Quadro de aviso modificado !",5);
?>
