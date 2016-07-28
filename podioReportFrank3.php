<?php

require_once 'podio/PodioAPI.php';

function codigo_fuente($url){
    $url = file($url);
    $codigo = '';
    foreach ($url as $numero => $linea) { 
        $codigo .= '#<strong>' . $numero . '</strong> : ' . htmlspecialchars($linea) . '<br />';
    }
    return $codigo;
}
 
try {

function get_weeks($year, $month){

    $days_in_month = date("t", mktime(0, 0, 0, $month, 1, $year));
    $weeks_in_month = 1;
    $weeks = array();

    //loop through month
    for ($day=1; $day<=$days_in_month; $day++) {

        $week_day = date("w", mktime(0, 0, 0, $month, $day, $year));//0..6 starting sunday
	
		if($week_day==0){
			$week_day=7;
		}
        $weeks[$weeks_in_month][$week_day] = $day;

		if($week_day==7){
			$week_day=0;
		}
        if ($week_day == 0) {
            $weeks_in_month++;
        }

    }

    return $weeks;

}

/***************************************************************************/
$month1 = date("F"); 
//$diaFinal = date("d", strtotime('last Day of '.$month1, strtotime('04/20/2015')));
$diaFinal = date("d", strtotime('last Day of '.$month1, date("Y-m-d"))); 
$month2 = date("F");
$yearActual = date("Y");
//$mesActual = date("m", strtotime("04/01/2015")); 
$mesActual = date("m"); 
$yearLast = date("Y", strtotime('last Year'));
$fechaIni = "$mesActual/01/$yearActual";
$fechaFin = "$mesActual/$diaFinal/$yearActual";
	
$now = strtotime($fechaIni);
$end_date = strtotime($fechaFin);
$arrayFechas = array();
while (date("Y-m-d", $now) <= date("Y-m-d", $end_date)) {
    $day_index = date("w", $now);
	$day = date("d", $now);
    if ($day_index == 0 || $day_index == 6) {
        // Print or store the weekends here
		$arrayFechas[]="$day_index-$day";
    }
    $now = strtotime(date("Y-m-d", $now) . "+1 day");
}
//echo "<br/>";
//print_r($arrayFechas);
$intervaloIni11;
$intervaloFin11;
$intervaloIni21;
$intervaloFin21;
$intervaloIni31;
$intervaloFin31;
$intervaloIni41;
$intervaloFin41;
$intervaloIni51;
$intervaloFin51;

$i=0;
	$item = $arrayFechas[$i];
	$valor1 = explode("-",$item);
	if($valor1[0]=="6"){
		$intervaloIni11=$valor1[1];
		$i=$i+1;
		$item = $arrayFechas[$i];
		$valor1 = explode("-",$item);
		$intervaloFin11=$valor1[1];
		$i=$i+1;
	}else{
		$intervaloIni11=$valor1[1];
		$intervaloFin11=$valor1[1];
		$i=$i+1;
	}
	
	$item = $arrayFechas[$i];
	$valor1 = explode("-",$item);
	if($valor1[0]=="6"){
		$intervaloIni21=$valor1[1];
		$i=$i+1;
		$item = $arrayFechas[$i];
		$valor1 = explode("-",$item);
		$intervaloFin21=$valor1[1];
		$i=$i+1;
	}else{
		$intervaloIni21=$valor1[1];
		$intervaloFin21=$valor1[1];
		$i=$i+1;
	}
	
	$item = $arrayFechas[$i];
	$valor1 = explode("-",$item);
	if($valor1[0]=="6"){
		$intervaloIni31=$valor1[1];
		$i=$i+1;
		$item = $arrayFechas[$i];
		$valor1 = explode("-",$item);
		$intervaloFin31=$valor1[1];
		$i=$i+1;
	}else{
		$intervaloIni31=$valor1[1];
		$intervaloFin31=$valor1[1];
		$i=$i+1;
	}

	$item = $arrayFechas[$i];
	$valor1 = explode("-",$item);
	if($valor1[0]=="6"){
		$intervaloIni41=$valor1[1];
		$i=$i+1;
		if($i<count($arrayFechas)){
			$item = $arrayFechas[$i];
			$valor1 = explode("-",$item);
			$intervaloFin41=$valor1[1];
			$i=$i+1;
		}else{
			$intervaloIni41=$valor1[1];
			$intervaloFin41=$valor1[1];
		}
	}else{
		$intervaloIni41=$valor1[1];
		$intervaloFin41=$valor1[1];
		$i=$i+1;
	}
	
	
	$item = $arrayFechas[$i];
	$valor1 = explode("-",$item);
	if($valor1[0]=="6"){
		$intervaloIni51=$valor1[1];
		$i=$i+1;
		if($i<count($arrayFechas)){
			$item = $arrayFechas[$i];
			$valor1 = explode("-",$item);
			$intervaloFin51=$valor1[1];
			$i=$i+1;
		}else{
			$intervaloIni51=$valor1[1];
			$intervaloFin51=$valor1[1];
		}
	}else{
		$intervaloIni51=$valor1[1];
		$intervaloFin51=$valor1[1];
		$i=$i+1;
	}
/***************************************************************************/
$year = date("Y");
$yearActual = date("Y");
$month = date("m");
$month2 = date("F");
$yearLast = $year-1;
$res = get_weeks($year, $month);
$res2 = get_weeks($year-1, $month);
//print_r($res);
$long = count($res);
$valor1 = $res[1];
$valor2 = $res[2];
$valor3 = $res[3];
$valor4 = $res[4];

if($long<=6){
$valor5 = $res[5];

$long5 = count($valor5);
$intervaloIni5 = $valor5[1];
$intervaloFin5 = $valor5[$long5];

}

if($long<7){
$valor6 = $res[6];

$long6 = count($valor6);
$intervaloIni6 = $valor6[1];
$intervaloFin6 = $valor6[$long6];
}

$long1 = count($valor1);
//echo "<br/>long1::$long1";
if($long1==7){
	$intervaloIni1 = $valor1[1];
	$intervaloFin1 = $valor1[$long1];
}else{
	$intervaloIni1 = $valor1[8-$long1];
	$intervaloFin1 = $valor1[7];
}


$long2 = count($valor2);
$intervaloIni2 = $valor2[1];
$intervaloFin2 = $valor2[$long2];

$long3 = count($valor3);
$intervaloIni3 = $valor3[1];
$intervaloFin3 = $valor3[$long3];

$long4 = count($valor4);
$intervaloIni4 = $valor4[1];
$intervaloFin4 = $valor4[$long4];


$columna1 = "$month2 $intervaloIni11/$intervaloFin11, $yearActual";
$columna2 = "$month2 $intervaloIni21/$intervaloFin21, $yearActual";
$columna3 = "$month2 $intervaloIni31/$intervaloFin31, $yearActual";
$columna4 = "$month2 $intervaloIni41/$intervaloFin41, $yearActual";
$columna5 = "$month2 $intervaloIni51/$intervaloFin51, $yearActual";

/*
echo "<br/>intervaloIni1::$intervaloIni11";
echo "<br/>intervaloFin1::$intervaloFin11";
echo "<br/>intervaloIni2::$intervaloIni21";
echo "<br/>intervaloFin2::$intervaloFin21";
echo "<br/>intervaloIni3::$intervaloIni31";
echo "<br/>intervaloFin3::$intervaloFin31";
echo "<br/>intervaloIni4::$intervaloIni41";
echo "<br/>intervaloFin4::$intervaloFin41";
echo "<br/>intervaloIni5::$intervaloIni51";
echo "<br/>intervaloFin5::$intervaloFin51";
echo "<br/>intervaloIni6::$intervaloIni61";
echo "<br/>intervaloFin6::$intervaloFin61";*/


$intervaloIni1 = "$month/$intervaloIni1/$year";
$intervaloFin1 = "$month/$intervaloFin1/$year";
$intervaloIni2 = "$month/$intervaloIni2/$year";
$intervaloFin2 = "$month/$intervaloFin2/$year";
$intervaloIni3 = "$month/$intervaloIni3/$year";
$intervaloFin3 = "$month/$intervaloFin3/$year";
$intervaloIni4 = "$month/$intervaloIni4/$year";
$intervaloFin4 = "$month/$intervaloFin4/$year";
$intervaloIni5 = "$month/$intervaloIni5/$year";
$intervaloFin5 = "$month/$intervaloFin5/$year";
$intervaloIni6 = "$month/$intervaloIni6/$year";
$intervaloFin6 = "$month/$intervaloFin6/$year";

 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');
Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171541', '3174d8f443054fac9e3f665e657bd0a5');

$array1 = array();
$array2 = array();
$opt="";
$tabla="<table width=100%>
 <tr>
 <td style=width: 10%; font-size: 5pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 5pt;  valign=top><strong></strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$columna1</strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$columna2</strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$columna3</strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$columna4</strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$columna5</strong></td>
   
  </tr>
  ";
  
  

$valores="";  $totalesLast1=""; $totalesLast2=""; $totalesLast3=""; $totalesActual="";
$campaign = PodioItem::filter(8900539, array( 'sort_by' => 'title',
												'sort_desc' => false));  // Get items from app with app_id=123
$cant=0;
foreach ($campaign as $item) {
	//echo "<br/>*************************************************<br/>";
 // echo "<br/>title::".$item->title;
  //echo "<br/>ID::".$item->item_id;
  
  $se=false;$se1=false; $se2=false;
    if($item->title=="Other"){
	  $se=true;
	}
	if($item->title=="Offsite"){
		$se1=true;
	}
	
	if($item->title=="Central"){
		$se2=true;
	}
	
	if($se==false && $se1==false && $se2==false){ 
  $cant = $cant +1;
    $tabla=$tabla."<tr>

   <td style=width: 20%; font-size: 7pt;  valign=top>"
  .$cant."</td>";

  
  
  $tabla=$tabla."<td style=width: 20%; font-size: 7pt;  valign=top>"
  .$item->title."</td>";
  
   $valores=$valores."|".$item->title;
   
    $app_reference_field_id = 116781926; 
   $attendancetype = 116781927;
   $date = 	116781925;
   $adult = 9;
   $fourSeven = 10;
   $Fusion = 6;
   $Forge = 7;
   $WideOpen = 2;
   $Nursery = 5;
   $Preschool = 4;
   $Elementary = 8;
   
 //$date_lead_created=101404311;
 $filter_target_item_id = $item->item_id;
 
$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($intervaloIni1)), 'to' => date("Y-m-d H:i:s", strtotime($intervaloFin1))
						  
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($intervaloIni2)), 'to' => date("Y-m-d H:i:s", strtotime($intervaloFin2))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$totalesLast1 = $totalesLast1.$sum."|";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($intervaloIni3)), 'to' => date("Y-m-d H:i:s", strtotime($intervaloFin3))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$totalesLast2 = $totalesLast2.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($intervaloIni4)), 'to' => date("Y-m-d H:i:s", strtotime($intervaloFin4))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$totalesLast2 = $totalesLast2.$sum."|";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($intervaloIni5)), 'to' => date("Y-m-d H:i:s", strtotime($intervaloFin5))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$totalesLast3 = $totalesLast3.$sum."|";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	}
}

$tabla=$tabla."</table>";

$totalesLast1 = substr($totalesLast1,0,strlen($totalesLast1)-1);
$totalesLast2 = substr($totalesLast2,0,strlen($totalesLast2)-1);
$totalesLast3 = substr($totalesLast3,0,strlen($totalesLast3)-1);
//$totalesActual = substr($totalesActual,0,strlen($totalesActual)-1);

//$totalesLast = $totalesLast ."|".$totalesActual;
echo $tabla;

//echo "<br/>totales::::$totalesLast";

//print_r($array1);
//print_r($array2);

$mayor1 = $array1[12];
$mayor2 = $array2[12];
$mayor="";
if($mayor1>$mayor2){
	$mayor=$mayor1;
}else{
	$mayor=$mayor2;
}

$valores = substr($valores,1,strlen($valores)-1);
$valores = str_replace(" ","%20",$valores);
$name1 = str_replace(" ","%20",$name1);
$name2 = str_replace(" ","%20",$name2);

$columna1 = str_replace(" ","%20",$columna1);
$columna2 = str_replace(" ","%20",$columna2);
$columna3 = str_replace(" ","%20",$columna3);
$columna4 = str_replace(" ","%20",$columna4);
$columna5 = str_replace(" ","%20",$columna5);

//echo "<br/>";
//print_r($d);
//echo "<br/>";
//$url = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast&chs=525x250&chbh=35,15,20&chco=4C9900,9ABADF&chds=0,$mayor&chdl=$name1|$name2&chxt=x,y,x&chxl=0:|$valores|1:|0|$valores2|2:|Year";
$url1 = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast1&chs=600x450&chbh=13,2,1&chco=4C9900,9ABADF,3333FF,999900,CC00CC,FFFF00,FF0000,FF99CC,006633&chds=0,3000&chdl=$valores&chxt=x,y,x&chxl=0:|$columna1|$columna2|3|4|5|6|7|8|9|10|11|12|13|1:|0|250|500|750|1000|1250|1500|1750|2000|2250|2500|2750|3000|2:|%20";
$url2 = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast2&chs=600x450&chbh=13,2,1&chco=4C9900,9ABADF,3333FF,999900,CC00CC,FFFF00,FF0000,FF99CC,006633&chds=0,3000&chdl=$valores&chxt=x,y,x&chxl=0:|$columna3|$columna4|3|4|5|6|7|8|9|10|11|12|13|1:|0|250|500|750|1000|1250|1500|1750|2000|2250|2500|2750|3000|2:|%20";
$url3 = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast3&chs=600x450&chbh=13,2,1&chco=4C9900,9ABADF,3333FF,999900,CC00CC,FFFF00,FF0000,FF99CC,006633&chds=0,3000&chdl=$valores&chxt=x,y,x&chxl=0:|$columna5|2|3|4|5|6|7|8|9|10|11|12|13|1:|0|250|500|750|1000|1250|1500|1750|2000|2250|2500|2750|3000|2:|%20";
/*echo "<br/>".$url1;
echo "<br/>".$url2;
echo "<br/>".$url3;*/

if(@copy($url1, 'tres1.png')){
//echo "image-saved";
//echo "http://aparicio.website/uno.png";
}else{
echo "failed"; 
}

if(@copy($url2, 'tres2.png')){
//echo "image-saved";
//echo "http://aparicio.website/uno.png";
}else{
echo "failed"; 
}

if(@copy($url3, 'tres3.png')){
//echo "image-saved";
//echo "http://aparicio.website/uno.png";
}else{
echo "failed"; 
}



/*
$start_date = date("Y-m-d H:i:s", strtotime('last Saturday'));
echo "<br/>fecha::::".$start_date;

$start_date = date("Y-m-d H:i:s", strtotime('last Sunday', strtotime('05/21/2015')));
echo "<br/>fecha::::".$start_date;
*/




}

 

catch (PodioError $e) {
 echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}

?>