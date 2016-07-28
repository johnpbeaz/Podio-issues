<?php
date_default_timezone_set('US/Central');
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

$previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

$FromDateOffersActual = date("Y-m-d H:i:s", $start_week); //'-1w'; // 
$ToDateOffersActual = date("Y-m-d H:i:s", $end_week); //'1w';  //


$FromDayActual = date("d", $start_week);
$ToDayActual = date("d", $end_week);


$previous_week = strtotime("-1 week +1 day last year");
$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

$FromDateOffersLast = date("Y-m-d H:i:s", $start_week); //'-1w'; // 
$ToDateOffersLast = date("Y-m-d H:i:s", $end_week); //'1w';  //

$FromDayLast = date("d", $start_week);
$ToDayLast = date("d", $end_week);

/*
$FromDateOffersActual = date("Y-m-d H:i:s", strtotime('last Saturday', strtotime(date("Y-m-d H:i:s"))));
$ToDateOffersActual = date("Y-m-d H:i:s", strtotime('last Sunday', strtotime(date("Y-m-d H:i:s"))));
*/
//$FromDateOffersActual = date("m", strtotime('last Saturday', strtotime(date("Y-m-d H:i:s"))));

$day = date("d");
$month = date("m");
$year = date("Y");
$year = $year - 1;


/*
$FromDayActual = date("d", strtotime('last Saturday', strtotime(date("Y-m-d H:i:s"))));
$ToDayActual = date("d", strtotime('last Sunday', strtotime(date("Y-m-d H:i:s"))));

$sunday = (date('N', strtotime("$month/$day/$year")) >= 6);
if($sunday ==false){
$FromDayLast = date("d", strtotime('last Saturday', strtotime("$month/$day/$year")));
$ToDayLast = date("d", strtotime('last Sunday', strtotime("$month/$day/$year")));

$FromDateOffersLast = date("Y-m-d H:i:s", strtotime('last Saturday', strtotime("$month/$day/$year")));
$ToDateOffersLast = date("Y-m-d H:i:s", strtotime('last Sunday', strtotime("$month/$day/$year")));

$month = date("m", strtotime('last Sunday', strtotime("$month/$day/$year")));
}else{
	$day = $day -1;
	$FromDayLast = date("d", strtotime('last Saturday', strtotime("$month/$day/$year")));
	$ToDayLast = date("d", strtotime('last Sunday', strtotime("$month/$day/$year")));
	
	$FromDateOffersLast = date("Y-m-d H:i:s", strtotime('last Saturday', strtotime("$month/$day/$year")));
	$ToDateOffersLast = date("Y-m-d H:i:s", strtotime('last Sunday', strtotime("$month/$day/$year")));
	
	$month = date("m", strtotime('last Sunday', strtotime("$month/$day/$year")));
}*/

$FromDayActual = date("d", strtotime('last Saturday', strtotime(date("Y-m-d H:i:s"))));
$sunday = (date('N', strtotime("$month/$day/$year")) >= 6);
if($sunday ==false){
$FromDayLast = date("d", strtotime('last Saturday', strtotime("$month/$day/$year")));

}else{
	$day = $day -1;
	$FromDayLast = date("d", strtotime('last Saturday', strtotime("$month/$day/$year")));
	
}

$month1 = date("F",strtotime("$month/$day/$year"));
$month2 = date("F");
$yearActual = date("Y");
$yearLast = date("Y", strtotime('last Year'));



 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');
Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171541', '3174d8f443054fac9e3f665e657bd0a5');

$array1 = array();
$array2 = array();
$opt="";
$name1="$month1 $FromDayLast/$ToDayLast, $yearLast";
$name2="$month2 $FromDayActual/$ToDayActual, $yearActual";
$tabla="<table width=70%>
 <tr>
 <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$name1</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$name2</strong></td>
  </tr>
  ";
  
  
  
$valores="";  $totalesLast=""; $totalesActual="";
$campaign = PodioItem::filter(8900539, array( 'sort_by' => 'title',
												'sort_desc' => false)); // Get items from app with app_id=123
$cant=0; $sumTotal1=0;$sumTotal2=0;$sumTotal3=0;$sumTotal4=0;$sumTotal5=0;

foreach ($campaign as $item) {
	//echo "<br/>*************************************************<br/>";
 // echo "<br/>title::".$item->title;
  //echo "<br/>ID::".$item->item_id;
  
  $se=false;$se1=false;$se2=false;
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
 
/********************** BUSCO ATTENDANCE POR CAMPUS ****************************/	 


// TOTAL
		
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => $FromDateOffersLast, 'to' => $ToDateOffersLast
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	/*
	echo "<br/>from:$FromDateOffersLast";
	echo "<br/>to:$ToDateOffersLast";
	echo "<br/> filtro::".$attendance1->filtered."<br/>";
	echo "<br/>FromDateOffersActual:$FromDateOffersActual";
	echo "<br/>ToDateOffersActual:$ToDateOffersActual";*/
	//$totalesLast = $totalesLast.$attendance1->filtered.",";
	$totalesLast = $totalesLast.$sum.",";
	$sumTotal1=$sum + $sumTotal1;
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$array1[]= $sum;
	$attendance2 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => $FromDateOffersActual, 'to' => $ToDateOffersActual
						)
	  ),
	));
	$sum =0;
	foreach($attendance2 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td> </tr>";
	$array2[]= $sum;
	$totalesActual = $totalesActual.$sum.",";
	$sumTotal2=$sum + $sumTotal2;
	}
}

$tabla=$tabla."</table>";

$totalesLast = substr($totalesLast,0,strlen($totalesLast)-1);
$totalesActual = substr($totalesActual,0,strlen($totalesActual)-1);

$totalesLast = $totalesLast ."|".$totalesActual;
echo $tabla;

//echo "<br/>totales::::$totalesLast";
sort($array1);
sort($array2);

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
$c = array_merge($array1,$array2);

$d = array_unique($c, SORT_REGULAR);
$valores2="";

foreach($d as $item){
	$valores2 = $valores2 ."|".$item;
}

$valores2 = substr($valores2,1,strlen($valores2)-1);
//echo "<br/>";
//print_r($d);
//echo "<br/>";
//$url = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast&chs=525x250&chbh=35,15,20&chco=4C9900,9ABADF&chds=0,$mayor&chdl=$name1|$name2&chxt=x,y,x&chxl=0:|$valores|1:|0|$valores2|2:|Year";
$url = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast&chs=600x450&chbh=13,2,1&chco=4C9900,9ABADF&chds=0,3000&chdl=$name1|$name2&chxt=x,y,x&chxl=0:|1|2|3|4|5|6|7|8|9|10|11|12|13|1:|0|250|500|750|1000|1250|1500|1750|2000|2250|2500|2750|3000|2:|Campuses";
//echo $url;

if(@copy($url, 'dos.png')){
//echo "image-saved";
//echo "http://aparicio.website/uno.png";
}else{
//echo "failed"; 
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