<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title>Game Of Live</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
</head>

<body>
	<?php 
echo "<form action=\"\" method=\"POST\">"; 
// eine zuvor definierte Datenbankverbindunf wird includiert
include("mysql_connect.php"); 
include("links.html");
?>


	<!-- HTML-Code zur Gestaltung der Tabelle  //-->
	<table>
		<tr>
			<td style="font-size: 22px;">Anzahl Felder</td>
			<td style="font-size: 22px;">Zeilenumbruch</td>
			<td style="font-size: 22px;">Generationen</td>
			<td style="font-size: 22px;">Ausf&uuml;hren</td>
		</tr>

		<tr>
			<td> <input type="text" name="anzahl_felder" value="<?php echo $_POST['anzahl_felder']; ?>" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;"> </td>
			<td> <input type="text" name="zeilenumbruch" size="36" value="<?php echo $_POST['zeilenumbruch']; ?>" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;"> </td>
			<td>&nbsp;</td>
			<td>

				<button name="ausfuehren" value="ausfuehren" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #00cc00; border-radius: 5px 5px 5px 5px;">Ausf&uuml;hren</button><br><br>

				<button name="re_ausfuehren" value="re_ausfuehren" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #grey; border-radius: 5px 5px 5px 5px;">rec. Ausf&uuml;hren</button><br>

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
			<td valign="middle"> <input type="text" name="generationen" size="36" value="<?php echo $_POST['generationen']; ?>" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;"> <br>
			</td>
			<td><br><button type="submit" name="generation" value="generation" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #00cc00; border-radius: 5px 5px 5px 5px;">Generationen starten</button><br>
				<font style=" font-size: 22px;">Um viele Generationen in Etappen laufen zu lassen, ungerade Generationen-Anzahl eingeben.</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td> <br>
			</td>
			<td> <br><button type="submit" name="loeschen" value="loeschen" style=" width: 250px; height: 40px; font-color: #FFFFFF; font-size: 18px; background-color: red; border-radius: 5px 5px 5px 5px;">Tabellen auf NULL stellen</button>
			</td>
		</tr>

		<?php 
  
   /* Kleine Hilfe um nicht fuer jeden Versuch neue Tabellen erzeugen zu m&uuml;ssen (Zeit) */
    if ( $_POST['loeschen'] == "loeschen" ) { mysqli_query($link," update table_game set farbe = '0' "); mysqli_query($link," update table_game_2 set farbe = '0' ");}
  ?>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td> <br><input type="text" name="update" size="36" value="" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;">
			</td>
			<td> <br><button type="submit" name="updaten_2" value="updaten_2" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #00cc00; border-radius: 5px 5px 5px 5px;">Feld belegen</button>
				<font style=" font-size: 22px;">&nbsp;&nbsp;nur Tabelle 1 !</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td> <br><input type="text" name="update_0" size="36" value="" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;">
			</td>
			<td> <br><button type="submit" name="updaten_0" value="updaten_0" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: orange; border-radius: 5px 5px 5px 5px;">Feld l&ouml;schen</button>
				<font style=" font-size: 22px;">&nbsp;&nbsp;(auf NULL stellen) nur Tabelle 1 !</td>
		</tr>



	</table>
	<br>
	<br><br><br><br>
	<!--  hier werden Zellen (haendisch) auf "lebend", sprich "1", gesetzt. //-->


	<?php
	if ( $_POST[ 'updaten_2' ] == "updaten_2" ) {
		mysqli_query($link, "update table_game 
set farbe = '1' where id = '$_POST[update]' " );
	}

	if ( $_POST[ 'updaten_0' ] == "updaten_0" ) {
		mysqli_query($link, "update table_game 
set farbe = '0' where id = '$_POST[update_0]' " );
	}

	?>

	<!-- Ausfuehren heisst: eine Tabelle mit der entsprechenden Anzahl von Zellen zu erzeugen //-->

	<?php  

 if ( $_POST['ausfuehren'] == "ausfuehren" ) {


// mysqli_query($link,"drop TABLE IF EXISTS table_game");


mysqli_query($link,"create TABLE IF NOT EXISTS table_game
(
sa_id int(8) NOT NULL auto_increment primary key,
id int(16),
farbe int(2)
)
"); 


for($i=1; $i <= $_POST['anzahl_felder']; $i++ ) {
mysqli_query($link," insert into table_game 
(
id,
farbe
)
values
(
'$i',
'0'
)
");

} // ende for
  // ende Tabelle fuellen
?>



	<!-- hier wird die gleiche Tabelle als Wechselspeicher erzeugt.//-->

	<?php

	// mysqli_query($link,"drop TABLE IF EXISTS table_game_2");


	mysqli_query($link, "create TABLE IF NOT EXISTS table_game_2
(
sa_id int(8) NOT NULL auto_increment primary key,
id int(16),
farbe int(2)
)
" );

	for ( $i = 1; $i <= $_POST[ 'anzahl_felder' ]; $i++ ) {

		mysqli_query($link, " insert into table_game_2 
(
id,
farbe
)
values
(
'$i',
'0'
)
" );

	} // ende for



	?>

	<?php

	// mysqli_query($link,"drop TABLE IF EXISTS table_game_3");


	mysqli_query($link, "create TABLE IF NOT EXISTS table_game_3
(
sa_id int(8) NOT NULL auto_increment primary key,
id int(16),
farbe int(2),
generation int(6)
)
" );


	} // ende Tabelle_2 fuellen

	?>


	<!-- Ausfuehren heisst: eine Tabelle mit der entsprechenden Anzahl von Zellen zu erzeugen //-->
	<!-- ///////////////////////////////////////////////////////////////////////////////////////////// //-->
	<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// //-->

	<?php  

if ( $_POST['re_ausfuehren'] == "re_ausfuehren" ) {


// mysqli_query($link,"drop TABLE IF EXISTS table_game");


mysqli_query($link,"create TABLE IF NOT EXISTS table_game
(
sa_id int(8) NOT NULL auto_increment primary key,
id int(16),
farbe int(2)
)
"); 
echo mysqli_error();

for($ii=$_POST['anzahl_felder']; $ii >= 1; $ii-- ) {

mysqli_query($link," insert into table_game 
(
id,
farbe
)
values
(
'$ii',
'0'
)
");
echo mysqli_error();

} // ende for 2
 
  // ende Tabelle fuellen
?>



	<!-- hier wird die gleiche Tabelle als Wechselspeicher erzeugt.//-->

	<?php

	// mysqli_query($link,"drop TABLE IF EXISTS table_game_2");


	mysqli_query($link, "create TABLE IF NOT EXISTS table_game_2
(
sa_id int(8) NOT NULL auto_increment primary key,
id int(16),
farbe int(2)
)
" );
	echo mysqli_error();

	for ( $iii = $_POST[ 'anzahl_felder' ]; $iii >= 1; $iii-- ) {
		mysqli_query($link, " insert into table_game_2 
(
id,
farbe
)
values
(
'$iii',
'0'
)
" );
		echo mysqli_error();

	} // ende for


	} // ende Tabelle_2 fuellen

	?>

	<?php

	// mysqli_query($link,"drop TABLE IF EXISTS table_game_3");


	mysqli_query($link, "create TABLE IF NOT EXISTS table_game_3
(
sa_id int(8) NOT NULL auto_increment primary key,
id int(16),
farbe int(2),
generation int(6)
)
" );
	echo mysqli_error();

	?>


	<!-- hier werden die Tabellen mit dem haendisch definierten Zeilenfall angezeigt  //-->
	<!-- der Zeilenfall ist fundamental fuer die Definition der Zellen, //-->
	<!-- die die im Moment bearbeitete Zelle umgeben (8 Zellen) //-->

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

$maxgen=mysqli_query($link," select max(generation) as maxgen from table_game_3 ");
while ( $result_max_gen = mysqli_fetch_array ( $maxgen , MYSQLI_BOTH ) ) {
$max_gen=$result_max_gen['maxgen'];
}

for ( $i=0; $i <= $_POST['generationen']; $i++ ) {
$table_game="table_game";
$table_game_2="table_game_2";

if ( $i % 2 == 1 ) {
$table_game="table_game_2";
$table_game_2="table_game";
}

$min_max=mysqli_query($link,"select min(id) as minid, max(id) as maxid from $table_game where farbe = '1' ");
while ( $result_min_max = mysqli_fetch_array($min_max, MYSQLI_BOTH ) ) {
$min_feld=$result_min_max['minid'] - ($_POST['zeilenumbruch']+1);
$max_feld=$result_min_max['maxid'] + ($_POST['zeilenumbruch']+1);
}

$evaluieren=mysqli_query($link,"select id, farbe from $table_game where id >= '$min_feld' and id <= '$max_feld' ");
while ( $result_evaluieren = mysqli_fetch_array( $evaluieren , MYSQLI_BOTH ) ) { // while 1
$aktuelles_feld=$result_evaluieren['id'];
$aktuelle_farbe=$result_evaluieren['farbe'];



/* hier werden die Umgebenden der aktuellen Zellen defininiert */
/* abhaengig vom jeweiligen "zeilenumbruch" */

$feld_1=$aktuelles_feld - ($_POST['zeilenumbruch']-1);
if ( $feld_1 < 1 ) { $feld_1=$feld_1 + $_POST['anzahl_felder'];}
$feld_2=$aktuelles_feld - $_POST['zeilenumbruch'];
if ( $feld_2 < 1 ) { $feld_2=$feld_2 + $_POST['anzahl_felder'];}
$feld_3=$aktuelles_feld - ($_POST['zeilenumbruch']+ 1);
if ( $feld_3 < 1 ) { $feld_3=$feld_3 + $_POST['anzahl_felder'];}
$feld_4=$aktuelles_feld - 1;
$feld_5=$aktuelles_feld;
$feld_6=$aktuelles_feld + 1;
$feld_7=$aktuelles_feld + ($_POST['zeilenumbruch']-1);
if ( $feld_7 > $_POST['anzahl_felder'] ) { $feld_7=$feld_7 - $_POST['anzahl_felder'];}
$feld_8=$aktuelles_feld + $_POST['zeilenumbruch'];
if ( $feld_8 > $_POST['anzahl_felder'] ) { $feld_8=$feld_8 - $_POST['anzahl_felder'];}
$feld_9=$aktuelles_feld + ($_POST['zeilenumbruch']+1);
if ( $feld_9 > $_POST['anzahl_felder'] ) { $feld_9=$feld_9 - $_POST['anzahl_felder'];}

$count=mysqli_query($link," select id, count(farbe) as nachbarn from $table_game where 
id = '$feld_1' and farbe = '1' or
id = '$feld_2' and farbe = '1' or
id = '$feld_3' and farbe = '1' or
id = '$feld_4' and farbe = '1' or
id = '$feld_5' and farbe = '1' or
id = '$feld_6' and farbe = '1' or
id = '$feld_7' and farbe = '1' or
id = '$feld_8' and farbe = '1' or 
id = '$feld_9' and farbe = '1' 
");
while ( $result_count = mysqli_fetch_array ( $count , MYSQLI_BOTH ) ) { // while 2
$neue_farbe=$result_count['nachbarn'];
if (
   ( ( $aktuelle_farbe == 0 ) && ( $neue_farbe == 3 ) ) ||
   ( ( $aktuelle_farbe == 1 ) && ( $neue_farbe == 3 ) ) ||
   ( ( $aktuelle_farbe == 1 ) && ( $neue_farbe == 4 ) )
   )
{
mysqli_query($link,"update $table_game_2 set farbe = '1' where id = '$aktuelles_feld'");

// Generationen hochzaehlen
$generation=$i+1;

// evtl. vorhandene Generationen hinzurechnen
$generation=$generation+$max_gen;


mysqli_query($link," insert into table_game_3 (id, farbe, generation) values ( '$aktuelles_feld', '1', '$generation') ");
echo mysqli_error();



} // ende if

} // ende while 2
} // ende while 1

/* Ende Ausgabe Generationen */


/* Alle Felder der soeben abgearbeiteten Generation (Tabelle*) werden auf NULL gesetzt */
/* $tabelle_game(_2*) *abhaenging vom MODULO */
mysqli_query($link,"update $table_game set farbe = 0 where farbe = '1' ");

} // ende for
} // ende if generation

?>

	</form>
</body>
</html>