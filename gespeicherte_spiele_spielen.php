
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
  <head>
    <title>Gespeicherte Spiele spielen</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  </head>
  <body>
<?php 


echo "<form action=\"gespeicherte_spiele_spielen.php?gen=$_POST[generationen]\" method=\"POST\">"; 


// eine zuvor definierte Datenbankverbindung wird includiert
include("mysql_connect.php"); 


?>

  
<!-- HTML-Code zur Gestaltung der Tabelle  //-->  

<table>
<tr>
<td valign="top">
<?php include("links.html");?>
<table> 
  <tr>
    <td style="font-size: 22px;">Anzahl Felder</td>
  </tr>
  <tr>
        <td> <input tabindex="1" type="text" name="anzahl_felder" value="<?php echo $_POST['anzahl_felder']; ?>" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;"> </td>
</tr>
<tr>
<td style="font-size: 22px;">Zeilenumbruch</td></tr>
<tr></tr>
      <td> <input tabindex="2" type="text" name="zeilenumbruch" size="36" value="<?php echo $_POST['zeilenumbruch']; ?>" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;" > </td>
</tr>
  
<tr>
<td valign="middle" align="right" ><font style=" font-size: 22px;">ab Generation &nbsp; <input tabindex="3" type="text" name="ab_generation"  value="<?php echo $_POST['ab_generation']+1; ?>" style=" width: 50px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;">&nbsp;&nbsp;<br>
aus Tabelle&nbsp;<input type="text" name="play_table"  value="3" style=" width: 50px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;">&nbsp;&nbsp;<br>
Generationen &nbsp; <input tabindex="4" type="text" name="generationen"  value="<?php echo $_POST['generationen']+1; ?>" style=" width: 50px; height: 40px; font-color: #000000; font-size: 22px; background-color: #FFFFFF; border-radius: 5px 5px 5px 5px;">&nbsp;&nbsp;<br>
<br><button type="submit" tabindex="5" name="generation" value="generation" style=" width: 250px; height: 40px; font-color: #000000; font-size: 22px; background-color: #00cc00; border-radius: 5px 5px 5px 5px;">Spiel starten</button><br><font style=" font-size: 22px;"><br></td>
  </tr> 
 
</table>  



<!-- $_POST ... steht fuer die entsprechenden Textfelder bzw. SUBMIT-Buttons //-->

<?php 

$tabelle_auswahl=array();


if ( $_POST['generation'] == "generation" ) {


for ( $gen=$_POST['ab_generation']; $gen <= $_POST['generationen']; $gen++ ) {


$spielfeld=array();
for($xy=1;$xy <= $_POST['anzahl_felder']; $xy++ ) {
array_push($spielfeld,$xy);
}

$ii=0;
// mysqli_query($link," update table_game set farbe = '0' ");
$raster=array();
$select_generation=mysqli_query($link," select id  from table_game_$_POST[play_table] where generation = '$gen' ");
while ( $result_generation=mysqli_fetch_array ( $select_generation , MYSQLI_BOTH ) ) {
array_push($raster,$result_generation[id]);
// $raster[]=$ii;$result_generation['generation']; 
}



$tabelle.="<table align='center' bgcolor='#000000'> <tr><td>";

 $umbruch_zaehler=1;
 foreach($spielfeld as $spiel ) {
 
 
 $umbruch="";
 $punkt="<font style=' background-color: black'>&nbsp;&nbsp;&nbsp;&nbsp;</font> ";
 
 if ( $umbruch_zaehler == $_POST['zeilenumbruch'] ) { $umbruch = "<br>"; $umbruch_zaehler="";}
 
 $aktuelle_situation=next($spielfeld);

 
 if ( in_array($aktuelle_situation,$raster) ) {
 
 $punkt="<font style=' background-color: green'>&nbsp;&nbsp;&nbsp;&nbsp;</font> ";
 }


$tabelle.=$punkt.$umbruch;

 $umbruch_zaehler++;
 $punkt="";
 $umbruch="";
 }

/* $tabelle.="</td></tr></table>";
$tabelle.="<br><br><br>"; */




} // ende for  
} // ende if generation

?>

</td>

<td valign="top"> <?php echo $tabelle;?></td>
</tr>


</table>



    </form>
  </body>
</html>

            