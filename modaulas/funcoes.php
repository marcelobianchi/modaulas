<?php
function authme($passwd = '')
{ 
    session_start();
    global $mysetedpassword, $instanceID;
    $check = ! empty( $passwd );
    $authdata=$_SESSION['authdata'];

    if (is_array($authdata))
    {
     $agora=time();
     if( $agora > ($authdata['ddt']+(60*60))) 
     {
      unset($_SESSION['authdata']);
      session_destroy();
      return false;
     }
     if( $authdata['ddi'] != md5($_SERVER['REMOTE_ADDR']))
     {
      unset($_SESSION['authdata']);
      session_destroy();
      return false;
     }
     if( $authdata['ddid'] != $instanceID)
     {
      unset($_SESSION['authdata']);
      session_destroy();
      return false;
     }
     return true;
    } elseif ( $check ) 
      { 
       if ($mysetedpassword == md5($passwd))
       {
         $authdata = array("ddt"=>time(),"ddi"=>md5($_SERVER['REMOTE_ADDR']),"ddid"=>$instanceID);
         $_SESSION["authdata"]=$authdata;
	 return true;
       }
       return false;
      } else 
	 return false;
}

function logmein(){
echo '<HTML> 
   <HEAD>
     <TITLE>ModAulas Login Page</TITLE>
     <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
     <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
     <LINK rel="StyleSheet" href="style.css" type="text/css">
   </HEAD> 
   <BODY> 
    <CENTER>
    <P CLASS="SECTION">Acesso Restrito<BR>Entrar senha de autentica��o</P>
    <FORM ACTION="login.php" METHOD=POST>
     Senha: <INPUT TYPE="password" NAME="tbpassword">
     <INPUT TYPE="submit" VALUE="Entrar"> 
    </FORM> 
   </CENTER>
   </BODY> 
   </HTML>';
exit();
}

function verificatudo(){
 global $datadir; 
 
 setlocale(LC_ALL,'pt_BR');
 if (!is_dir($datadir))
  erro("Diret�rio &quot;$datadir&quot; n�o existe");
 if (!is_writable($datadir))
  erro("N�o posso escrever em &quot;$datadir&quot;");
}

function changevariavel ($who, $value){
 global $varfile; 

 if (is_file($varfile)) 
   $lines=file($varfile);
 else
   $lines=array();

 $found=0;

 $fh=fopen($varfile,"w");
 if($fh==NULL) erro("Problema de permiss�es com o arquivo $varfile");
 fwrite($fh,"<?php\n");

 foreach($lines as $line)
 {
  $line=rtrim($line);
  if (strncmp('$'.$who,$line,strlen($who)+1) == 0)
  {
   $found=1;
   fwrite($fh,'$'.$who.'="'.$value.'"'.";\n");
  } else 
    {
     if ((strncmp($line,"<?",2)!=0)
       &&(strncmp($line,"?>",2)!=0)) fwrite($fh,"$line\n");
    }
 }

 if ($found==0) 
   fwrite($fh,'$'.$who.'="'.$value.'"'.";\n");

 fwrite($fh,"?>\n");
 fclose($fh);
}


function erro($message){

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
 <title>ModAulas ADM</title>
 <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
 <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
 <LINK rel="StyleSheet" href="style.css" type="text/css">
</HEAD>

<BODY>';
echo "
<P CLASS=ERRO> $message </P>
</BODY>
</HTML>";
exit();
}

function aviso($message,$pos){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">                 
<HTML>
<HEAD>
 <title>ModAulas ADM</title>
 <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
 <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
 <LINK rel="StyleSheet" href="style.css" type="text/css">
 <meta http-equiv="refresh" content="4; URL=adm.php?op=<?echo $pos?>">
</HEAD>

<BODY>

<?php
echo "\n<P CLASS=\"MESSAGE\">$message</P>\n";
echo "<HR NOSHADE>\n";
if($pos==0)
  echo "<P ALIGN=\"RIGHT\"><A HREF=\"adm.php\">Voltar</A></P>\n";
else
  echo "<P ALIGN=\"RIGHT\">Voce ser� redirecionado de volta em 4 segundos ! <BR> [<A HREF=\"adm.php?op=$pos\">Voltar</A>]</P>\n";

echo "
</BODY>
</HTML>";

exit();
}

function apagadir($pathname){
# Da para confiar ? Recursiva !
 if (is_dir($pathname)) 
 {
   if ($dh = opendir($pathname)) 
   {
    while (($file = readdir($dh)) !== false) 
    {
     if (($file!='.')&&($file!='..'))
     {
      if (is_file("$pathname/$file")) unlink("$pathname/$file");
      if (is_dir("$pathname/$file"))  apagadir("$pathname/$file");
     }
    }
    closedir($dh);
   }
 }
 rmdir("$pathname");
}

function size_translate($filesize)
{
   $array = array(
       'YB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
       'ZB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
       'EB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
       'PB' => 1024 * 1024 * 1024 * 1024 * 1024,
       'TB' => 1024 * 1024 * 1024 * 1024,
       'GB' => 1024 * 1024 * 1024,
       'MB' => 1024 * 1024,
       'KB' => 1024,
   );
   if($filesize <= 1024)
   {
       $filesize = $filesize . ' Bytes';
   }
   foreach($array AS $name => $size)
   {
       if($filesize > $size || $filesize == $size)
       {
           $filesize = round((round($filesize / $size * 100) / 100), 2) . ' ' . $name;
       }
   }
   return $filesize;
}


################## Come�o Verdadeiro ########################################################

$tablehorario=array("08:00 - 10:00","10:00 - 12:00","14:00 - 16:00","16:00 - 18:00", "19:00 - 21:00","21:00 - 23:00");
$datadir="moddata/";
$varfile="$datadir/variaveis.php";
$calfile="$datadir/calendario.txt"; 
$avisofile="$datadir/avisos.html";
$ementafile="$datadir/ementa.html";

verificatudo();

if(is_file($varfile)) 
  include($varfile);

if(empty($instanceID))
{
  changevariavel(instanceID,md5(time()));
}

if(empty($mysetedpassword))
{
  changevariavel(mysetedpassword,md5('modaulas'));  
}

if (isset($tabeladehorario))
{
  $tabeladehorario=explode(',',$tabeladehorario);
}

?>
