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
//echo codigo_fuente("http://www.kluniversity.in");
try {
         $weekday=25;
    foreach($_GET as $key => $value){
  //echo $key . " : " . $value . "<br />\r\n";
        $weekday=$key;
        $weekday-=1;
     }

    $previous_week = strtotime("01-01-2016"."+$weekday week");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday ",$start_week);

// echo "<br>start week is ".$start_week;
 //echo "<br>end week is ".$end_week;
//echo "The actual week is ".date("Y-m-d H:i:s", $previous_week)."<br>";
$FromDateOffersActual = date("Y-m-d H:i:s", $start_week); //'-1w'; // 
$ToDateOffersActual = date("Y-m-d H:i:s", $end_week); //'1w';  //

//echo "<br>From Date Offers Actual".$FromDateOffersActual;
//echo "<br>To Date Offers A".$ToDateOffersActual;
$FromDayActual = date("d", $start_week);
$ToDayActual = date("d", $end_week);
$FromDayActual=$ToDayActual-1;
$month=date("m",$end_week);
$yearActual=date("Y",$start_week);

//echo "<br>From DayActual".$FromDayActual;
//echo "<br>To Day Actual".$ToDayActual;
 $day = $ToDayActual;
 $month2=date("F",strtotime("$month/$day/$yearActual"));

$previous_week = strtotime("01-01-2015"."+$weekday week +1 day");
$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);
// echo "<br>start week is ".$start_week;
 //echo "<br>end week is ".$end_week."<br>";
$FromDateOffersLast = date("Y-m-d H:i:s", $start_week); //'-1w'; // 
$ToDateOffersLast = date("Y-m-d H:i:s", $end_week); //'1w';  //
//echo "<br>From Date Offers last".$FromDateOffersLast;
//echo "<br>To Date Offers last".$ToDateOffersLast;
$FromDayLast = date("d", $start_week);
$ToDayLast = date("d", $end_week);
$FromDayLast=$ToDayLast-1;
$month=date("m",$end_week);
$yearLast=date("Y",$start_week);
//echo "<br>From Day Last".$FromDayLast;
//echo "<br>To Day Last".$ToDayLast;
$day = $ToDayLast;
//$month = date("m");
//$year = date("Y");
//$year = $year - 1;
//echo "<br> The day is ".$day;
//echo "<br>The month is ".$month;
//echo "<br>The year is ".$yearLast."<br>";
$month1=date("F",strtotime("$month/$day/$yearLast"));
//echo "<br> The month is ".$month1;
 //$name1="$month1 $FromDayLast/$ToDayLast,$yearLast";
// $name2="$month2 $FromDayActual/$ToDayActual,$yearActual";
 //$name1="$month1 $FromDayLast/$ToDayLast, $yearLast";
//$name2="$month2 $FromDayActual/$ToDayActual, $yearActual";
// echo "<br>$name1</br>";
// echo "<br>$name2</br>";
Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');
Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171541', '3174d8f443054fac9e3f665e657bd0a5');

$array1 = array();
$array2 = array();
$opt="";
$name1="$month1 $FromDayLast/$ToDayLast, $yearLast";
$name2="$month2 $FromDayActual/$ToDayActual, $yearActual";
//echo "<br>".$name1."<br>";
//echo "<br>".$name2."<br>";
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

 
 //echo "<br>".$FromDateOffersLast;
  //  echo "<br>".$ToDateOffersLast;
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
//echo "<br>".$name1."<br>";
//echo "<br>".$name2."<br>";
$url = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast&chs=600x450&chbh=13,2,1&chco=4C9900,9ABADF&chds=0,3000&chdl=$name1|$name2&chxt=x,y,x&chxl=0:|1|2|3|4|5|6|7|8|9|10|11|12|13|1:|0|250|500|750|1000|1250|1500|1750|2000|2250|2500|2750|3000|2:|Campuses";
//echo $url;

if(@copy($url, 'dos.png')){
//echo "image-saved";
//echo "http://aparicio.website/uno.png";
 // echo  "http://aparicio.website/dos.png";
}else{
//echo "failed"; 
}
}
catch(PodioError $pe)
{
   // echo $pe;
}

?>