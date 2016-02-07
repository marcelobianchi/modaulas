<?php
include ("funcoes.php");
if (! authme ())
	logmein ();
$action = $_POST ['action'];

if (! is_writeable ( $datadir ))
	erro ( "Não posso escrever no diretório $datadir" );

$tbpasta      = isset($_POST ['tbpasta'])      ? $_POST ['tbpasta']      : NULL;
$tbarquivo    = isset($_POST ['tbarquivo'])    ? $_POST ['tbarquivo']    : NULL;
$tbcheck      = isset($_POST ['tbcheck'])      ? $_POST ['tbcheck']      : NULL;
$tbcomentario = isset($_POST ['tbcomentario']) ? $_POST ['tbcomentario'] : NULL;

switch (strtolower($action)) {
	case 'criarpasta' :
		if ($tbpasta == NULL)
			erro ( 'Parâmetros inválidos', 6 );
		if (is_dir ( "$datadir/$tbpasta" ))
			erro ( 'Pasta já existe', 6 );
		if ($tbpasta [0] == '.')
			erro ( 'Parâmetros inválidos', 6 );
		mkdir ( "$datadir/$tbpasta", 0777 );
	break;
	
	case 'apagarpasta' :
		if ($tbpasta == NULL)
			erro ( 'Parâmetros inválidos', 6 );
		if (is_dir ( "$datadir/$tbpasta" ))
			if ($tbcheck != 'on')
				erro ( 'Voce não confirmou !', 6 );
			else
				apagadir ( "$datadir/$tbpasta" );
		else
			erro ( 'Pasta não existe', 6 );
	break;
	
	case 'addarquivo' :
		if ($tbpasta == NULL)
			erro ( 'Parâmetros inválidos' );
		if (! is_dir ( "$datadir/$tbpasta" ))
			erro ( 'Pasta não existe', 6 );
		
		$nomeoriginal = $_FILES ['tbarquivo'] ['name'];
		if (empty ( $nomeoriginal ))
			erro ( 'Nome ("' . $nomeoriginal . '") inválido !', 6 );
		if (is_file ( "$datadir/$tbpasta/$nomeoriginal" ))
			erro ( 'Arquivo já existe !', 6 );
		
		$a = move_uploaded_file ( $_FILES ['tbarquivo'] ['tmp_name'], "$datadir/$tbpasta/$nomeoriginal" );
		if (! $a)
			erro ( "Arquivo não pode ser armazenado, provável erro de mal-configuração do servidor, ou limite de upload ultrapassado !!", 6 );
	break;
	
	case 'mostrar tudo':
		if ($tbpasta == NULL)
			erro ('Parâmetros inválidos - pasta não encontrada', 6 );
		
		$path =  "$datadir/$tbpasta";
		if (!is_dir($path))
			erro ('Pasta é inválida', 6);
		
		$dh = opendir($path);
		while (($file = readdir($dh)) !== false) {
			if ($file == ".") continue;
			if ($file == "..") continue;
			if (strrpos($file, "_comentario") !== False) continue;
			if (strrpos($file, "_hidden_") === False) continue;
			
			$oldname = "$path/$file";
			$newname = "$path/".(substr($file, 0, strrpos($file, "_hidden_")));
			
			rename( $oldname, $newname);
		}
		closedir($dh);
		break;
	
	case 'esconder tudo':
		if ($tbpasta == NULL)
			erro ('Parâmetros inválidos - pasta não encontrada', 6 );
		
		$path =  "$datadir/$tbpasta";
		if (!is_dir($path))
			erro ('Pasta é inválida', 6);
		
		$dh = opendir($path);
		while (($file = readdir($dh)) !== false) {
			if ($file == ".") continue;
			if ($file == "..") continue;
			if (strrpos($file, "_comentario") !== False) continue;
			if (strrpos($file, "_hidden_") !== False) continue;
			
			$oldname = "$path/$file";
			$newname = "$path/$file"."_hidden_".md5(time());
			rename( $oldname, $newname);
		}
		closedir($dh);
		break;
	
	case 'mostrar' :
		if ($tbpasta == NULL)
			erro ( 'Parâmetros inválidos - pasta não encontrada', 6 );
		if ($tbarquivo == NULL)
			erro ( 'Parâmetros inválidos - arquivo não encontrada', 6 );
		if (! is_file ( "$datadir/$tbpasta/$tbarquivo" ))
			erro ( 'Arquivo não existe', 6 );
		if ( strrpos($tbarquivo, "_hidden_") === False )
			erro ( 'Arquivo não está oculto', 6);
		
		$oldname = "$datadir/$tbpasta/$tbarquivo";
		$newname = "$datadir/$tbpasta/".(substr($tbarquivo, 0, strrpos($tbarquivo, "_hidden_")));
		
		rename($oldname, $newname);
	break;

	case 'esconder' :
		if ($tbpasta == NULL)
			erro ( 'Parâmetros inválidos - pasta não encontrada', 6 );
		if ($tbarquivo == NULL)
			erro ( 'Parâmetros inválidos - arquivo não encontrada', 6 );
		if (! is_file ( "$datadir/$tbpasta/$tbarquivo" ))
			erro ( 'Arquivo não existe', 6 );
		if ( strrpos($tbarquivo, "_hidden_") !== False )
			erro ( 'Arquivo já está oculto', 6);
		
		$oldname = "$datadir/$tbpasta/$tbarquivo";
		$newname = "$datadir/$tbpasta/$tbarquivo"."_hidden_".md5(time());
		
		rename($oldname, $newname);
	break;

	case 'apagar' :
		if ($tbcheck != 'on')
			erro ( 'Voce não confirmou !', 6 );
		if ($tbpasta == NULL)
			erro ( 'Parâmetros inválidos', 6 );
		if ($tbarquivo == NULL)
			erro ( 'Parâmetros inválidos', 6 );
		
		if (is_file ( "$datadir/$tbpasta/$tbarquivo" )) {
			unlink ( "$datadir/$tbpasta/$tbarquivo" );
			if (is_file ( "$datadir/$tbpasta/$tbarquivo" . "_comentario" ))
				unlink ( "$datadir/$tbpasta/$tbarquivo" . "_comentario" );
		} else
			erro ( 'Arquivo não existe', 6 );
	break;
	
	case 'comentario' :
		if ($tbpasta == NULL)
			erro ( 'Parâmetros inválidos', 6 );
		if ($tbarquivo == NULL)
			erro ( 'Parâmetros inválidos', 6 );
		if (! is_file ( "$datadir/$tbpasta/$tbarquivo" ))
			erro ( 'Arquivo não existe', 6 );
		
		if (strrpos($tbarquivo, "_hidden_") !== False) {
			$tbarquivo = (substr($tbarquivo, 0, strrpos($tbarquivo, "_hidden_")));
		}
		
		if ($tbcomentario !== "") {
			$fh = fopen ( "$datadir/$tbpasta/$tbarquivo" . "_comentario", "w" );
			fwrite ( $fh, "$tbcomentario\n" );
			fclose ( $fh );
		} else if (is_file ( "$datadir/$tbpasta/$tbarquivo" . "_comentario" ))
			unlink ( "$datadir/$tbpasta/$tbarquivo" . "_comentario" );
	break;
	
	default :
		erro ( 'Entrada inválida !', 6 );
	break;
}

aviso ( "Mudanças realizadas com sucesso !", 6 );
?>
