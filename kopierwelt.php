
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
  <head>
    <title>Game Of Life</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  </head>
  <body>
<?php 
echo "<form action=\"\" method=\"POST\">"; 
// eine zuvor definierte Datenbankverbindunf wird includiert
include("mysql_connect.php"); 
include("links.html");
?>

<table>
  <tr>
    <td style="font-size: 22px;">Anzahl Felder</td>
    <td style="font-size: 22px;">Zeilenumbruch</td>
    <td style="font-size: 22px;">&nbsp;</td>
    <td style="font-size: 22px;">&nbsp;</td>
  </tr>
  
  <tr>
    <td> <input type="text" name="anzahl_felder" value="<?php echo $_POST['anzahl_felder']; ?>" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;"> </td>
    <td> <input type="text" name="zeilenumbruch" size="36" value="<?php echo $_POST['zeilenumbruch']; ?>" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;" > </td>
    <td>&nbsp;</td>
    <td> 
    
    <button name="ausfuehren" value="ausfuehren" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #00cc00; border-radius: 5px 5px 5px 5px;">Ausf&uuml;hren</button><br>

</td>
  </tr>
  
  <!-- in den Textfeldern werden mittels der Funktion POST die Daten f&uuml;r
  den PHP-Parser zur verf&uuml;gung gestellt  //-->  
  
  <tr>
    <td colspan="3">&nbsp;</td>
    <td><br> <button type="submit" name="raster_zeigen" value="raster_zeigen" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #00cc00; border-radius: 5px 5px 5px 5px;">Raster zeigen Tabelle 1</button> </td>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
    <td> <br><button type="submit" name="raster_zeigen_2" value="raster_zeigen_2" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #00cc00; border-radius: 5px 5px 5px 5px;">Raster zeigen Tabelle 2</button> </td>
  </tr>
  

  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="middle" > <input type="text" name="generationen" size="36" value="<?php echo $_POST['generationen']; ?>" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;"> <br></td>
     <td><br><button type="submit" name="generation" value="generation" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #00cc00; border-radius: 5px 5px 5px 5px;">Generationen starten</button><br><font style=" font-size: 22px;"></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td> <br></td>
    <td> <br><button type="submit" name="loeschen" value="loeschen" style=" width: 250px; height: 40px; font-color: #FFFFFF; font-size: 18px; background-color: red; border-radius: 5px 5px 5px 5px;">Tabelle 1 auf NULL stellen</button></td>
  </tr>
  
  <?php 
  
   /* Kleine Hilfe um nicht fuer jeden Versuch neue Tabellen erzeugen zu m&uuml;ssen (Zeit) */
    if ( $_POST['loeschen'] == "loeschen" ) { mysqli_query($link," update table_game set farbe = '0' ");}
  ?>
   
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td> <br><input type="text" name="update" size="36" value="" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;"></td>
    <td> <br><button type="submit" name="updaten_2" value="updaten_2" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #00cc00; border-radius: 5px 5px 5px 5px;">Feld belegen</button><font style=" font-size: 22px;">&nbsp;&nbsp; Tabelle 1 und Tabelle 3!</td>
  </tr>
  
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td> <br><input type="text" name="update_0" size="36" value="" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;"></td>
    <td> <br><button type="submit" name="updaten_0" value="updaten_0" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: orange; border-radius: 5px 5px 5px 5px;">Feld l&ouml;schen</button><font style=" font-size: 22px;">&nbsp;&nbsp; Tabelle 1 und Tabelle 3!</td>
  </tr>  
</table>  

<?php
	if ( $_POST[ 'updaten_2' ] == "updaten_2" ) {
		mysqli_query($link, "update table_game 
set farbe = '1' where id = '$_POST[update]' " );

mysqli_query($link," insert into table_game_3 (id, generation) values ('$_POST[update]', '1') ");
	}

	if ( $_POST['updaten_0'] == "updaten_0" ) {
		mysqli_query($link, "update table_game 
set farbe = '0' where id = '$_POST[update_0]' " );

mysqli_query($link," delete from table_game_3 where id = '$_POST[update_0]' ");

	}

	?>

<?php  

if ( ( $_POST['raster_zeigen'] == "raster_zeigen" )  || ( $_POST['updaten_2'] == "updaten_2" ) ) {

$zaehler_raster=1;
$neue_zeile=$_POST['zeilenumbruch'];

echo "<table border='0' bgcolor='#FFFFFF'><tr>";

$raster=mysqli_query($link," select id, farbe from table_game ");
while ( $result_raster = mysqli_fetch_array( $raster , MYSQLI_BOTH ) ) {

if ( $zaehler_raster == $neue_zeile ) { $tr="</tr><tr>"; $zaehler_raster=0; }
$color="#FFFFFF";
if ( $result_raster['farbe'] == 1 ) { $color="yellow"; }

echo "<td align='right' bgcolor='$color'>".$result_raster['id']."</td>".$tr;
$tr="";
$zaehler_raster++;

} // if while
echo "</table>";
} // if if raster_zeigen


if ( $_POST['raster_zeigen_2'] == "raster_zeigen_2" ) {

$zaehler_raster=1;
$neue_zeile=$_POST['zeilenumbruch'];

echo "<table border='0' bgcolor='#FFFFFF'><tr>";

$raster=mysqli_query($link," select id, farbe from table_game_2 ");
while ( $result_raster = mysqli_fetch_array( $raster , MYSQLI_BOTH ) ) {

if ( $zaehler_raster == $neue_zeile ) { $tr="</tr><tr>"; $zaehler_raster=0; }
$color="#FFFFFF";
if ( $result_raster['farbe'] == 1 ) { $color="yellow"; }

echo "<td align='right' bgcolor='$color'>".$result_raster['id']."</td>".$tr;
$tr="";
$zaehler_raster++;

} // if while

echo "</table>";

} // if raster_zeigen

?>



<!-- $_POST ... steht fuer die entsprechenden Textfelder bzw. SUBMIT-Buttons //-->

<?php 

if ( $_POST['generation'] == "generation" ) {


for ( $i=1; $i <= $_POST['generationen']; $i++ ) {

$select_gen=mysqli_query($link," select max(generation) as last_generation, max(generation)+1 as new_generation from table_game_3 ");
while ( $result_gen = mysqli_fetch_array($select_gen, MYSQLI_BOTH ) ) {
$last_generation=$result_gen['last_generation'];
$new_generation=$result_gen['new_generation'];
}


$color_istrue=array();
$color_isnottrue=array();
$spielfeld=array();
$spielfeld_1=array();
$ergebnis=array();



$einlesen=mysqli_query($link," select id from table_game_3 where generation = '$last_generation' "); //and id > '$min_feld' and id < '$max_feld' 
while ( $einlesen_id = mysqli_fetch_array( $einlesen , MYSQLI_BOTH ) ) {
$color_istrue[]=$einlesen_id['id'];
$id=$einlesen_id['id'];
}



$zaehler=0;

foreach ( $color_istrue as $id ) {


$so = $id + ($_POST['zeilenumbruch'] + 1 ) ;
if ( $so > $_POST['anzahl_felder'] ) { $so=$so - $_POST['anzahl_felder'];}
if (in_array( $so , $color_istrue)) { $zaehler++ ; }

$s  = $id +  $_POST['zeilenumbruch'] ;
if ( $s > $_POST['anzahl_felder'] ) { $s=$s - $_POST['anzahl_felder'];}
if (in_array( $s , $color_istrue)) { $zaehler++ ; }

$sw = $id + ($_POST['zeilenumbruch'] -1 ) ;
if ( $sw > $_POST['anzahl_felder'] ) { $sw=$sw - $_POST['anzahl_felder'];}
if (in_array( $sw , $color_istrue)) { $zaehler++ ; }

$w  = $id - 1 ;
if (in_array( $w , $color_istrue)) { $zaehler++ ; }

$nw = $id - ($_POST['zeilenumbruch'] + 1 ) ;
if ( $nw < 1 ) { $nw=$nw + $_POST['anzahl_felder'];}
if (in_array( $nw , $color_istrue)) { $zaehler++ ; }

$n  = $id -  $_POST['zeilenumbruch'] ;
if ( $n < 1 ) { $n=$n + $_POST['anzahl_felder'];}
if (in_array( $n , $color_istrue)) { $zaehler++ ; }

$no = $id - ($_POST['zeilenumbruch'] - 1 ) ;
if ( $no < 1 ) { $no=$no + $_POST['anzahl_felder'];}
if (in_array( $no , $color_istrue)) {  $zaehler++ ; }

$o  = $id + 1 ; 
if (in_array( $o , $color_istrue)) { $zaehler++ ;}

array_push($spielfeld_1, $so, $s, $sw, $w, $nw, $n, $no, $o );

if ( $zaehler % 2 == 1 ) {
array_push($ergebnis,$id);
}

$zaehler=0;
 
} // ende foreach


// doppelte Eintr&auml;ge l&ouml;schen
$spielfeld = array_unique($spielfeld_1);


$zaehler_2 = 0;
 
foreach ( $spielfeld as $id_2 ) {

$so_2 = $id_2 + ($_POST['zeilenumbruch'] + 1 ) ;
if ( $so_2 > $_POST['anzahl_felder'] ) { $so_2=$so_2 - $_POST['anzahl_felder'];}
if (in_array( $so_2 , $color_istrue)) { $zaehler_2++ ; }

$s_2  = $id_2 +  $_POST['zeilenumbruch'] ;
if ( $s_2 > $_POST['anzahl_felder'] ) { $s_2=$s_2 - $_POST['anzahl_felder'];}
if (in_array( $s_2 , $color_istrue)) { $zaehler_2++ ; }

$sw_2 = $id_2 + ($_POST['zeilenumbruch'] -1 ) ;
if ( $sw_2 > $_POST['anzahl_felder'] ) { $sw_2=$sw_2 - $_POST['anzahl_felder'];}
if (in_array( $sw_2 , $color_istrue)) { $zaehler_2++ ; }

$w_2  = $id_2 - 1 ;
if (in_array( $w_2 , $color_istrue)) { $zaehler_2++ ; }


$nw_2 = $id_2 - ($_POST['zeilenumbruch'] + 1 ) ;
if ( $nw_2 < 1 ) { $nw_2=$nw_2 + $_POST['anzahl_felder'];}
if (in_array( $nw_2 , $color_istrue)) { $zaehler_2++ ; }

$n_2  = $id_2 -  $_POST['zeilenumbruch'] ;
if ( $n_2 < 1 ) { $n_2=$n_2 + $_POST['anzahl_felder'];}
if (in_array( $n_2 , $color_istrue)) { $zaehler_2++ ; }

$no_2 = $id_2 - ($_POST['zeilenumbruch'] - 1 ) ;
if ( $no_2 < 1 ) { $no_2=$no_2 + $_POST['anzahl_felder'];}
if (in_array( $no_2 , $color_istrue)) {  $zaehler_2++ ; }

$o_2  = $id_2 + 1 ;
if (in_array( $o_2 , $color_istrue)) { $zaehler_2++ ; ;}

if ( $zaehler_2 % 2 == 1 ) {
array_push($ergebnis,$id_2);
}    // ende if

$zaehler_2=0;

} // ende foreach

natsort($ergebnis); 

foreach ( $ergebnis as $gen ) {
mysqli_query($link," insert into table_game_3 (id, generation) values ( '$gen', '$new_generation' ) ");
}       

/* $xx = $_POST['zeilenumbruch'];
$yy = round($_POST['anzahl_felder'] / $_POST['zeilenumbruch']);

$gd = imagecreatetruecolor($xx, $yy);
$white = imagecolorallocate($gd, 255, 255, 255);
imagefill($gd, 0, 0, $white);
$black = imagecolorallocate($gd, 0, 0, 0); 

 
foreach ( $ergebnis as $pixel_id ) {
$x = $pixel_id % $_POST['zeilenumbruch'];
$y=($pixel_id-$x)/$_POST['zeilenumbruch'];

imagesetpixel($gd, $x,$y, $black);

if(!is_dir("generationen_im_bild"))
{mkdir("generationen_im_bild");}

imagejpeg($gd, 'generationen_im_bild/conway_'.$new_generation.'.jpg');
}  */


} // ende for

} // ende if generation



  ?>
    </form>
  </body>
</html>
