<?php
include("funcoes.php");
if (!authme()) logmein();
$action=$_POST['action'];

if (!is_writeable($datadir))
  erro("N�o posso escrever no diret�rio $datadir");

switch($action)
{
 case 'criarpasta':
   $tbpasta=$_POST['tbpasta'];
   if ($tbpasta==NULL) erro('Par�metros inv�lidos');
   if (is_dir("$datadir/$tbpasta")) erro('Pasta j� existe');
   if ($tbpasta[0]=='.') erro('Par�metros inv�lidos');
   mkdir("$datadir/$tbpasta",0777);
 break;

 case 'apagarpasta':
   $tbpasta=$_POST['tbpasta'];
   $tbcheck=$_POST['tbcheck'];
   
   if ($tbpasta==NULL) erro('Par�metros inv�lidos');
   if (is_dir("$datadir/$tbpasta")) 
     if ($tbcheck!='on')
      erro('Voce n�o confirmou !');
     else
      apagadir("$datadir/$tbpasta");
   else 
     erro('Pasta n�o existe');
 break; 

 case 'addarquivo':
   $tbpasta=$_POST['tbpasta'];
   if ($tbpasta==NULL) erro('Par�metros inv�lidos');
   if (!is_dir("$datadir/$tbpasta")) erro('Pasta n�o existe');

   $nomeoriginal=$HTTP_POST_FILES['tbarquivo']['name'];
   if (is_file("$datadir/$tbpasta/$nomeoriginal")) erro('Arquivo j� existe !');

   $a=move_uploaded_file($HTTP_POST_FILES['tbarquivo']['tmp_name'],"$datadir/$tbpasta/$nomeoriginal");
 break; 

 case 'delarquivo':
   $tbpasta=$_POST['tbpasta'];
   $tbarquivo=$_POST['tbarquivo'];
   $tbcheck=$_POST['tbcheck'];

   if ($tbcheck!='on') erro('Voce n�o confirmou !');
   if ($tbpasta==NULL) erro('Par�metros inv�lidos');
   if ($tbarquivo==NULL) erro('Par�metros inv�lidos');
   
   if (is_file("$datadir/$tbpasta/$tbarquivo"))
   {
     unlink("$datadir/$tbpasta/$tbarquivo");
     if (is_file("$datadir/$tbpasta/$tbarquivo"."_comentario")) unlink("$datadir/$tbpasta/$tbarquivo"."_comentario"); 
   }    
   else
      erro('Arquivo n�o existe');
   
 break; 

 case 'comentario':
   $tbpasta=$_POST['tbpasta'];
   $tbarquivo=$_POST['tbarquivo'];
   $tbcomentario=$_POST['tbcomentario'];
   if ($tbpasta==NULL) erro('Par�metros inv�lidos');
   if ($tbarquivo==NULL) erro('Par�metros inv�lidos');
   if (!is_file("$datadir/$tbpasta/$tbarquivo")) erro('Arquivo n�o existe');
 
   if($tbcomentario!=="")
   {
    $fh=fopen("$datadir/$tbpasta/$tbarquivo"."_comentario","w");
    fwrite($fh,"$tbcomentario\n");
    fclose($fh);
   } else 
      if (is_file("$datadir/$tbpasta/$tbarquivo"."_comentario")) unlink("$datadir/$tbpasta/$tbarquivo"."_comentario");
 break;

 default:
   erro('Entrada inv�lida !');
 break;
}

aviso("Mudan�as realizadas com sucesso !",6);
?>
