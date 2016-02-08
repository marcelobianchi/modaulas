<?php
if (! function_exists ( 'mime_content_type' )) {
	function mime_content_type($f) {
		$f = escapeshellarg ( $f );
		return trim ( `file -bi $f` );
	}
}

function filecmp($a, $b) {
	if ($a ['cmt'] == $b ['cmt']) {
		return 0;
	}
	return ($a ['cmt'] < $b ['cmt']) ? - 1 : 1;
}

function authme($passwd = '') {
	session_start ();
	global $mysetedpassword, $instanceID;
	$check = ! empty ( $passwd );
	$authdata = (isset ( $_SESSION ['authdata'] )) ? $_SESSION ['authdata'] : "";
	
	if (is_array ( $authdata )) {
		$agora = time ();
		if ($agora > ($authdata ['ddt'] + (60 * 60))) {
			unset ( $_SESSION ['authdata'] );
			session_destroy ();
			return false;
		}
		if ($authdata ['ddi'] != md5 ( $_SERVER ['REMOTE_ADDR'] )) {
			unset ( $_SESSION ['authdata'] );
			session_destroy ();
			return false;
		}
		if ($authdata ['ddid'] != $instanceID) {
			unset ( $_SESSION ['authdata'] );
			session_destroy ();
			return false;
		}
		return true;
	} elseif ($check) {
		if ($mysetedpassword == md5 ( $passwd )) {
			$authdata = array (
					"ddt" => time (),
					"ddi" => md5 ( $_SERVER ['REMOTE_ADDR'] ),
					"ddid" => $instanceID 
			);
			$_SESSION ["authdata"] = $authdata;
			return true;
		}
		return false;
	} else
		return false;
}

function logmein() {
?>
<HTML> 
	<HEAD>
		<TITLE>ModAulas Login Page</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
		<LINK rel="StyleSheet" href="style.css" type="text/css">
	</HEAD>
	<BODY>
		<CENTER>
			<P CLASS="SECTION">Acesso Restrito<BR>Entrar senha de autenticação</P>
			<FORM ACTION="login.php" METHOD=POST>
				Senha: <INPUT TYPE="password" NAME="tbpassword">
				<INPUT TYPE="submit" VALUE="Entrar"> 
			</FORM> 
		</CENTER>
	</BODY> 
</HTML>
<?php
	exit ();
}

function verificatudo() {
	global $datadir;
	
	if (! setlocale ( LC_TIME, 'pt_BR.UTF8' )) {
		if (! setlocale ( LC_TIME, 'pt_BR.ISO_8859_1' )) {
			if (! setlocale ( LC_TIME, 'pt_BR' )) {
				if (! setlocale ( LC_TIME, 'ptb' )) {
					error_log ( "Data vao ficar em ingles LOCALE=pt_BR nao pode ser configurado no sistema. Habilite este locale para ver as datas em portugues." );
				}
			}
		}
	}
	if (! is_dir ( $datadir ))
		erro ( "Diretório &quot;$datadir&quot; não existe" );
	if (! is_writable ( $datadir ))
		erro ( "Não posso escrever em &quot;$datadir&quot;" );
}
function changevariavel($who, $value) {
	global $varfile;
	
	if (is_file ( $varfile ))
		$lines = file ( $varfile );
	else
		$lines = array ();
	
	$found = 0;
	
	$fh = fopen ( $varfile, "w" );
	if ($fh == NULL)
		erro ( "Problema de permissões com o arquivo $varfile" );
	fwrite ( $fh, "<?php\n" );
	
	foreach ( $lines as $line ) {
		$line = rtrim ( $line );
		if (strncmp ( '$' . $who, $line, strlen ( $who ) + 1 ) == 0) {
			$found = 1;
			fwrite ( $fh, '$' . $who . '="' . $value . '"' . ";\n" );
		} else {
			if ((strncmp ( $line, "<?", 2 ) != 0) && (strncmp ( $line, "?>", 2 ) != 0))
				fwrite ( $fh, "$line\n" );
		}
	}
	
	if ($found == 0)
		fwrite ( $fh, '$' . $who . '="' . $value . '"' . ";\n" );
	
	fwrite ( $fh, "?>\n" );
	fclose ( $fh );
}
function erro($message, $pos = 0) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<title>ModAulas ADM</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<LINK rel="StyleSheet" href="style.css" type="text/css">
</HEAD>

<BODY>
	<P CLASS=ERRO><?php echo $message ?></P>
	<P ALIGN='CENTER'><a href='adm.php<?php echo (isset($pos) && $pos > 0) ? '?op='.$pos: "" ?>'>Go Back</A></P>
</BODY>
</HTML>
<?php
	exit ();
}

function aviso($message, $pos = 0) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<title>ModAulas ADM</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<LINK rel="StyleSheet" href="style.css" type="text/css">
	<meta http-equiv="refresh" content="0; URL=adm.php<?php echo (isset($pos) && $pos > 0) ? '?op='.$pos: "" ?>">
</HEAD>

<BODY>
	<P CLASS="MESSAGE"><?php echo $message ?></P>
	<HR NOSHADE>
	<P ALIGN="RIGHT">Voce será redirecionado de volta em 2 segundos ! <BR>
		[<A HREF="adm.php<?php echo (isset($pos) && $pos > 0) ? '?op='.$pos: "" ?>">Voltar</A>]
	</P>
</BODY>
</HTML>

<?php 
	exit ();
}

function apagadir($pathname) {
	// Da para confiar ? Recursiva !
	if (is_dir ( $pathname )) {
		if ($dh = opendir ( $pathname )) {
			while ( ($file = readdir ( $dh )) !== false ) {
				if (($file != '.') && ($file != '..')) {
					if (is_file ( "$pathname/$file" ))
						unlink ( "$pathname/$file" );
					if (is_dir ( "$pathname/$file" ))
						apagadir ( "$pathname/$file" );
				}
			}
			closedir ( $dh );
		}
	}
	rmdir ( "$pathname" );
}
function size_translate($filesize) {
	$array = array (
			'YB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
			'ZB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
			'EB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
			'PB' => 1024 * 1024 * 1024 * 1024 * 1024,
			'TB' => 1024 * 1024 * 1024 * 1024,
			'GB' => 1024 * 1024 * 1024,
			'MB' => 1024 * 1024,
			'KB' => 1024 
	);
	if ($filesize <= 1024) {
		$filesize = $filesize . ' Bytes';
	}
	foreach ( $array as $name => $size ) {
		if ($filesize > $size || $filesize == $size) {
			$filesize = round ( (round ( $filesize / $size * 100 ) / 100), 2 ) . ' ' . $name;
		}
	}
	return $filesize;
}
function collect($datadir) {
	$folders = array ();
	if (is_dir ( $datadir ) && ($dh = opendir ( $datadir ))) {
		while ( ($folder = readdir ( $dh )) !== false ) {
			if ($folder == '.')
				continue;
			if ($folder == '..')
				continue;
			if (! is_dir ( "$datadir/$folder" ))
				continue;
			
			$files = array ();
			if ($dhf = opendir ( "$datadir/$folder" )) {
				while ( ($file = readdir ( $dhf )) !== false ) {
					if ($file == ".")
						continue;
					if ($file == "..")
						continue;
					if (strrpos ( $file, "_comentario" ) !== False)
						continue;
					
					$fsize = filesize ( "$datadir/$folder/$file" );
					$fsize = size_translate ( $fsize );
					list ( $lixo, $mime ) = split ( "/", mime_content_type ( "$datadir/$folder/$file" ), 2 );
					$mime = strtoupper ( $mime );
					
					$comentario = "";
					
					$hidden = False;
					$realfile = $file;
					if (strrpos ( $file, "_hidden_" ) !== False) {
						$hidden = True;
						$realfile = $file;
						$file = substr ( $file, 0, strrpos ( $file, "_hidden_" ) );
					}
					
					$comentario = $file;
					if (is_file ( "$datadir/$folder/$file" . "_comentario" )) {
						$comentario = file ( "$datadir/$folder/$file" . "_comentario" );
						$comentario = rtrim ( $comentario [0] );
					}
					
					array_push ( $files, array (
							'cmt' => $comentario,
							'path' => "$datadir/$folder/$realfile",
							'mime' => $mime,
							'hidden' => $hidden,
							'name' => $file,
							'realname' => $realfile,
							'fs' => $fsize 
					) );
				}
				uasort ( $files, 'filecmp' );
				
				$hidden = True;
				foreach ( $files as $file )
					if (! $file ['hidden'])
						$hidden = False;
				
				$folders [$folder] = array (
						'files' => $files,
						'hidden' => $hidden 
				);
			}
			closedir ( $dhf );
		}
	}
	ksort ( $folders );
	return $folders;
}

// ################ Começo Verdadeiro ########################################################

$tablehorario = array (
		"08:00 - 10:00",
		"10:00 - 12:00",
		"14:00 - 16:00",
		"16:00 - 18:00",
		"19:00 - 21:00",
		"21:00 - 23:00" 
);
$datadir = "moddata/";
$varfile = $datadir . "variaveis.php";
$calfile = $datadir . "calendario.txt";
$avisofile = $datadir . "avisos.html";
$ementafile = $datadir . "ementa.html";
$linkfile = $datadir . "links.dat";

/*
 * Variables used in main code, initialized as ""
 */

$sigladadisciplina = "";
$nomedadisciplina = "";
$professores = "";
$p_telefones = "";
$p_email = "";
$p_sala = "";
$monitores = "";
$m_telefones = "";
$m_email = "";
$m_sala = "";
$m_horario = "";
$tabeladehorario = "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0";

verificatudo ();

if (is_file ( $varfile ))
	include ($varfile);

if (! isset ( $instanceID ) || empty ( $instanceID )) {
	changevariavel ( "instanceID", md5 ( time () ) );
}

if (! isset ( $mysetedpassword ) || empty ( $mysetedpassword )) {
	changevariavel ( "mysetedpassword", md5 ( 'modaulas' ) );
}

if (isset ( $tabeladehorario )) {
	$tabeladehorario = explode ( ',', $tabeladehorario );
}

?>
