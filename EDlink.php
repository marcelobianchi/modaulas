<?php

include ("funcoes.php");
if (! authme ()) logmein ();
if (! is_writeable ( $datadir ))
	erro ( "Não posso escrever no diretório $datadir" );

$action = isset($_POST ['action']) ? $_POST ['action'] : NULL;
switch ($action) {
	case 'Adicionar' :
		$nome     = isset($_POST['nome']) ? $_POST['nome'] : NULL;
		$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : NULL;
		
		if ($nome === NULL || empty ( $nome ))
			erro ( "Erro, nome do link não pode ser vazio", 7 );
		if ($endereco === NULL || empty ( $endereco ))
			erro ( "Erro, link não pode ser vazio", 7 );
		if ($endereco == "http://")
			erro ( "Endereço inválido !", 7 );
		
		$fh = fopen ( $linkfile, "a" );
		fwrite ( $fh, md5 ( time () ) . "\t" . $nome . "\t" . $endereco . "\n" );
		fclose ( $fh );
		break;
	
	case 'Apagar' :
		$id = isset($_POST ['id']) ? $_POST ['id'] : NULL;
		if ($id === NULL)
			erro ("Não sei quem apagar", 7);
		if (!is_file($linkfile))
			erro ("Não existem entradas para apagar", 7);
		
		$lists = file ( $linkfile );
		if ($lists === False)
			erro ("Impossível ler arquivo !", 7);
		
		$fh = fopen ( $linkfile, "w" );
		$n = 0;
		foreach ( $lists as $item ) {
			list ( $getid, $getnome, $getendereco ) = split ( "\t", $item, 3 );
			if ($getid == $id) continue;
			fwrite ( $fh, $item );
			$n ++;
		}
		fclose ( $fh );

		if ($n === 0)
			unlink($linkfile);

		break;
	
	default :
		erro ( 'Entrada inválida !', 7 );
		break;
}

aviso ( "Mudanças realizadas com sucesso !", 7 );
?>
