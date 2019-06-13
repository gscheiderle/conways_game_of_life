<?php



$tabelle_auswahl=array();





$gen=$_POST['generationen'];


$spielfeld=array();
for($xy=1;$xy <= $_POST['anzahl_felder']; $xy++ ) {
array_push($spielfeld,$xy);
}

$ii=0;
// mysqli_query($link," update table_game set farbe = '0' ");
$raster=array();
$select_generation=mysqli_query($link," select id  from table_game_3 where generation = '$gen' ");
while ( $result_generation=mysqli_fetch_array ( $select_generation , MYSQLI_BOTH ) ) {
array_push($raster,$result_generation['id']);
// $raster[]=$ii;$result_generation['generation']; 
}



$tabelle.="<table align='center' bgcolor='#FFFFFF'> <tr>";

 $umbruch_zaehler=1;
 foreach($spielfeld as $spiel ) {
 
 
 $umbruch="";
 $punkt="<td>".$spiel."</td>";
 
 if ( $umbruch_zaehler == $_POST['zeilenumbruch'] ) { $umbruch = "</tr>"; $umbruch_zaehler="";}
 
 $aktuelle_situation=next($spielfeld);

 
 if ( in_array($aktuelle_situation,$raster) ) {
 
 $punkt="<td style=' background-color: yellow'>".$spiel."</font></td>";
 }


$tabelle.=$punkt.$umbruch;

 $umbruch_zaehler++;
 $punkt="";
 $umbruch="";
 }

/* $tabelle.="</td></tr></table>";
$tabelle.="<br><br><br>"; */







?>

</td>

<td valign="top"> <?php echo $tabelle;?></td>
</tr>


</table>
