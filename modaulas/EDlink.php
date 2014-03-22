<?php
include("funcoes.php");
if (!authme()) logmein();
$action=$_POST['action'];

if (!is_writeable($datadir))
  erro("Não posso escrever no diretório $datadir");

switch($action)
{
 case 'Adicionar':
  $nome=$_POST[nome];
  $endereco=$_POST[endereco];

  if(empty($nome)) aviso("Erro, entradas inválidas",7);
  if(empty($endereco)) aviso("Erro, entradas inválidas",7);
  if($endereco=="http://") aviso("Endereço inválido !",7);

  $fh=fopen($linkfile,"a");
  fwrite($fh,md5(time())."\t".$nome."\t".$endereco."\n");
  fclose($fh);
 break;

 case 'Apagar':
  $id=$_POST[id];
  $links=file($linkfile);
  if (is_file($linkfile))
  {
   $lists=file($linkfile);
   $fh=fopen($linkfile,"w");
  } else 
     $lists=array();
      
  foreach($lists as $item)
  {
   list($getid,$getnome,$getendereco)=split("\t",$item,3);
   if ($getid!=$id) fwrite($fh,$item);
  }

  fclose($fh);
 break; 

 default:
   erro('Entrada inválida !');
 break;
}

aviso("Mudanças realizadas com sucesso !",7);
?>
