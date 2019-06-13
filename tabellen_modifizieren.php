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

      
echo "<button type='submit' name='start' value='starten' style=' height: 60px; width: 500px; background-color: red; color: #FFFFFF'><font style=' font-size: 42px'>START</font></button>" ;     
      
if ($_POST['start'] == 'starten' ) {
    
   
// phpinfo();




/* $farbe=mysqli_query($link,"select id, farbe from table_game_2 ");
while ( $result =  mysqli_fetch_array( $farbe , MYSQLI_BOTH ) ) {


mysqli_query($link,"insert into table_game_3 (id,generation) values ('$result[id]', '$result[farbe]') ");
 // mysqli_query($link," update table_game_2 set farbe = '1' where id = '$result[new_id]' ");
 
}  
echo mysqli_error(); */
/* 
 
$raster_2=array();
$aktuelle_zahl = 150;
$zeilenumbruch = 10;
$az=$aktuelle_zahl;

$az=" aktuelle Zahl";
$w=$aktuelle_zahl - 1;
$nw=$aktuelle_zahl - ($zeilenumbruch+1);
$n=$aktuelle_zahl - $zeilenumbruch;
$no=$aktuelle_zahl - ($zeilenumbruch-1);
$o=$aktuelle_zahl  + 1;
$so=$aktuelle_zahl + ($zeilenumbruch+1);
$s=$aktuelle_zahl + $zeilenumbruch;
$sw=$aktuelle_zahl + ($zeilenumbruch-1); 

$raster_2=array($aktuelle_zahl => $az, 'w' => $w, 'nw' => $nw, 'n' => $n, 'no' => $no, 'o' => $o, 'so' => $so, 's' => $s, 'sw' => $sw); 

$raster=array();
$aktuelle_zahl = 100;
$zeilenumbruch = 10;
$az=$aktuelle_zahl;

$az=" aktuelle Zahl";
$w=$aktuelle_zahl - 1;
$nw=$aktuelle_zahl - ($zeilenumbruch+1);
$n=$aktuelle_zahl - $zeilenumbruch;
$no=$aktuelle_zahl - ($zeilenumbruch-1);
$o=$aktuelle_zahl  + 1;
$so=$aktuelle_zahl + ($zeilenumbruch+1);
$s=$aktuelle_zahl + $zeilenumbruch;
$sw=$aktuelle_zahl + ($zeilenumbruch-1); 




      
$raster=array($aktuelle_zahl => $az, 'w' => $w, 'nw' => $nw, 'n' => $n, 'no' => $no, 'o' => $o, 'so' => $so, 's' => $s, 'sw' => $sw);   


$raster_3=array_fill_keys($raster,$raster_2);   
      

foreach ( $raster_2 as $key => $verb ) { 
$test=print_r($key." - ".$verb."<br>");}     
   */
      
      
      
/*$select=mysqli_query($link, "select sa_id from table_game where farbe = '1' ");
      while ( $result=mysqli_fetch_array($select, MYSQLI_BOTH) ) {
            
          $sa_id=$result['sa_id'];
          echo $sa_id=$sa_id+817;
          
          mysqli_query($link, "update table_game_2 set farbe = '1' where sa_id = '$sa_id' " );
     
      }*/
      
      
      $select=mysqli_query($link, "select id from table_game_2 where farbe = '1' ");
      while ( $result=mysqli_fetch_array($select, MYSQLI_BOTH) ) {
            
 
          
          mysqli_query($link, "insert into table_game_3
          (
          id,
          generation
          )
          values
          (
          '$result[id]',
          '1'
          )
          ");
     
      }
          
} // ende start