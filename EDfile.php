<?php
include("funcoes.php");
if (!authme()) logmein();
$action=$_POST['action'];

if (!is_writeable($datadir))
  erro("Não posso escrever no diretório $datadir");

switch($action)
{
 case 'criarpasta':
   $tbpasta=$_POST['tbpasta'];
   if ($tbpasta==NULL) erro('Parâmetros inválidos', 6);
   if (is_dir("$datadir/$tbpasta")) erro('Pasta já existe', 6);
   if ($tbpasta[0]=='.') erro('Parâmetros inválidos', 6);
   mkdir("$datadir/$tbpasta",0777);
 break;

 case 'apagarpasta':
   $tbpasta=$_POST['tbpasta'];
   $tbcheck=$_POST['tbcheck'];
   
   if ($tbpasta==NULL) erro('Parâmetros inválidos', 6);
   if (is_dir("$datadir/$tbpasta")) 
     if ($tbcheck!='on')
      erro('Voce não confirmou !', 6);
     else
      apagadir("$datadir/$tbpasta");
   else 
     erro('Pasta não existe', 6);
 break; 

 case 'addarquivo':
   $tbpasta=$_POST['tbpasta'];
   if ($tbpasta==NULL) erro('Parâmetros inválidos');
   if (!is_dir("$datadir/$tbpasta")) erro('Pasta não existe', 6);

   $nomeoriginal=$_FILES['tbarquivo']['name'];
   if (empty($nomeoriginal)) erro('Nome ("'.$nomeoriginal.'") inválido !', 6);
   if (is_file("$datadir/$tbpasta/$nomeoriginal")) erro('Arquivo já existe !', 6);

   $a=move_uploaded_file($_FILES['tbarquivo']['tmp_name'],"$datadir/$tbpasta/$nomeoriginal");
   if (!$a)
     erro("Arquivo não pode ser armazenado, provável erro de mal-configuração do servidor, ou limite de upload ultrapassado !!", 6);
 break; 

 case 'delarquivo':
   $tbpasta=$_POST['tbpasta'];
   $tbarquivo=$_POST['tbarquivo'];
   $tbcheck=$_POST['tbcheck'];

   if ($tbcheck!='on') erro('Voce não confirmou !', 6);
   if ($tbpasta==NULL) erro('Parâmetros inválidos', 6);
   if ($tbarquivo==NULL) erro('Parâmetros inválidos', 6);
   
   if (is_file("$datadir/$tbpasta/$tbarquivo"))
   {
     unlink("$datadir/$tbpasta/$tbarquivo");
     if (is_file("$datadir/$tbpasta/$tbarquivo"."_comentario")) unlink("$datadir/$tbpasta/$tbarquivo"."_comentario"); 
   }    
   else
      erro('Arquivo não existe', 6);
   
 break; 

 case 'comentario':
   $tbpasta=$_POST['tbpasta'];
   $tbarquivo=$_POST['tbarquivo'];
   $tbcomentario=$_POST['tbcomentario'];
   if ($tbpasta==NULL) erro('Parâmetros inválidos', 6);
   if ($tbarquivo==NULL) erro('Parâmetros inválidos', 6);
   if (!is_file("$datadir/$tbpasta/$tbarquivo")) erro('Arquivo não existe', 6);
 
   if($tbcomentario!=="")
   {
    $fh=fopen("$datadir/$tbpasta/$tbarquivo"."_comentario","w");
    fwrite($fh,"$tbcomentario\n");
    fclose($fh);
   } else 
      if (is_file("$datadir/$tbpasta/$tbarquivo"."_comentario")) unlink("$datadir/$tbpasta/$tbarquivo"."_comentario");
 break;

 default:
   erro('Entrada inválida !', 6);
 break;
}

aviso("Mudanças realizadas com sucesso !",6);
?>
