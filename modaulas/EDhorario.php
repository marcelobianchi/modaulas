<?
include("funcoes.php");
if (!authme()) logmein();

$maxtb=count($tablehorario)*7;

for($i=1;$i<=$maxtb;$i++)
   $novohorario[$i-1]=(strncmp($_POST['tb'.$i],'on',2)==0)?1:0;

changevariavel(tabeladehorario,implode($novohorario,","));
aviso("Horário modificado !",2);
?>
