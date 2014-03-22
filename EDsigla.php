<?php
include("funcoes.php");
if (!authme()) logmein();
$action=$_POST['action'];

switch($action)
{
 case "senha":
   $tbsenha=$_POST['tbsenha'];
   if ($tbsenha=='') erro('A senha não pode ser nula');
   changevariavel(mysetedpassword,md5($tbsenha));
 break;
 
 case "sigla":
   $tbdisciplina=$_POST['tbdisciplina'];
   $tbsigla=$_POST['tbsigla'];

   if (!strcmp($tbdisciplina,"")) 
     erro("Voce deve entrar o nome da Disciplina");

   if (!strcmp($tbsigla,""))
     erro("Voce deve entrar a sigla da Disciplina");

   changevariavel(nomedadisciplina,$tbdisciplina);
   changevariavel(sigladadisciplina,$tbsigla);
 break;

 case "professor":
  $tbprofessores=$_POST['tbprofessores'];
  $tbtelefones=$_POST['tbtelefones'];
  $tbemail=$_POST['tbemail'];
  $tbsala=$_POST['tbsala'];

  changevariavel('professores',$tbprofessores);
  changevariavel('p_telefones',$tbtelefones);
  changevariavel('p_email',$tbemail);
  changevariavel('p_sala',$tbsala);
 break;

 case "monitor":
  $tbprofessores=$_POST['tbmonitores'];
  $tbtelefones=$_POST['tbtelefones'];
  $tbemail=$_POST['tbemail'];
  $tbsala=$_POST['tbsala'];

  changevariavel('monitores',$tbprofessores);
  changevariavel('m_telefones',$tbtelefones);
  changevariavel('m_email',$tbemail);
  changevariavel('m_sala',$tbsala);
 break;


 case "horario_monitor":
  $tbhorario=$_POST['tbhorario'];
  changevariavel('m_horario',$tbhorario); 
 break;
 
 default:
   erro('Entrada inválida !');
 break;
}
 
aviso("Informações alteradas com sucesso !",1);
?>
