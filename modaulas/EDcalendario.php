<?php
include("funcoes.php");
if (!authme()) logmein();

$action=$_POST['action'];

switch($action)
{
 case "adddata":
    $tbdia=(!isset($_POST['tbdia']))?erro("Dia inválido"):$_POST['tbdia'];
    $tbmes=(!isset($_POST['tbmes']))?erro("Mes inválido"):$_POST['tbmes'];
    $tbano=(!isset($_POST['tbano']))?erro("Ano inválido"):$_POST['tbano'];

    $cmp=$_POST['tbcmt'];
    if (strcmp($cmp,"")==0) 
         erro('Voce deve entrar uma descrissão');
    
    $dia=strtotime("$tbmes/$tbdia/$tbano");
    $fh=fopen($calfile,"a");
    fwrite($fh,"$dia|$cmp\n");
    fclose($fh);

    $datas=file($calfile);
    $fh=fopen($calfile,"w");
    sort($datas);
    foreach($datas as $data)
     fwrite($fh,$data);
    fclose($fh);
 break;

 case 'deldata':
  $d=array();
  $pos=0;
  foreach($_POST as $i=>$p)
    if (strncmp($i,"apaga_",6)==0) 
    {
     $d[$pos]=$p;
     $pos++;
    }
  
  if (is_file($calfile))
  {
      $in=file($calfile);
      $fh=fopen($calfile,"w");
  }
  else 
      erro("Não achei o arquivo $calfile");
   
   foreach($in as $i)
   {
    list($dia,$cmp)=split("\|",rtrim($i),2);
    $go=1;
    foreach($d as $data)
     if ($dia==$data) $go=0;   
    if ($go==1)
       fwrite($fh,"$i");
   }

  fclose($fh);
 break;

 default:
   erro('Entrada inválida !');
 break;
}

aviso('Edição de datas realizadas com sucesso !',4);
?>
