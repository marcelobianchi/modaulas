<?php
include("funcoes.php");
if (!authme()) logmein();

$maxtb=count($tablehorario)*7;

for($i=1;$i<=$maxtb;$i++) {
	$value = 0;
	if ( isset($_POST['tb'.$i]) && (strncmp($_POST['tb'.$i],'on',2) == 0) ) 
		$value = 1;
	$novohorario[$i-1] = $value;
}

changevariavel("tabeladehorario",implode($novohorario,","));
aviso("Horário modificado !",2);
?>
