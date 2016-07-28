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

$previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

//$start_week = date("Y-m-d",$start_week);
//$end_week = date("Y-m-d",$end_week);

//echo $start_week.' '.$end_week ;

$FromDateOffers = date("Y-m-d H:i:s", $start_week); //'-1w'; // 
$ToDateOffers = date("Y-m-d H:i:s", $end_week); //'1w';  //

//echo "<br/> FromDateOffers:$FromDateOffers";
//echo "<br/> ToDateOffers:$ToDateOffers<br/>";

//offers per campaign
 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');
Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171541', 'fb539c77f25842a8b0317482b69ec2a9');
	
$idd;
$cant=0;

$opt="";

$tabla="<table width=70%>
 <tr>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>Total</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>Adult</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>Students</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>Children</strong></td>
  
  </tr>
  ";
  
$valores="";  $totales=""; $sumTotal2=0;$sumTotal3=0;$sumTotal4=0;$sumTotal5=0;
$campaign = PodioItem::filter(8900539, array( 'sort_by' => 'title',
												'sort_desc' => false));  // Get items from app with app_id=123
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
	
  $tabla=$tabla."<tr>
   <td style=width: 20%; font-size: 7pt;  valign=top>"
  .$item->title."</td>";
  
   $valores=$valores."|".$item->title;
   
   $app_reference_field_id = 116781926; 
   $attendancetype = 116781927;
   $date = 	116781925;
   $attendance =116781929;
   $adult = 9;
   $fourSeven = 10;
   $Fusion = 6;
   $Forge = 7;
  
   $Nursery = 5;
   $Preschool = 4;
   $Elementary = 8;
   
 //$date_lead_created=101404311;
 $filter_target_item_id = $item->item_id;
 
/********************** BUSCO ATTENDANCE POR CAMPUS ****************************/	 


// TOTAL
	$attendance = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => $FromDateOffers, 'to' => $ToDateOffers
						)
	  ),
	));
	$sum =0;
	foreach($attendance as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$sumTotal1=$sum + $sumTotal1;
//	$totales = $totales.",".$attendance->filtered;
	$totales = $totales.",".$sum;
	
	//echo "<br/>RESULTADO:: ".$attendance->filtered;
// TYPE ADULT
	$TotalAdult = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						   'from' => $FromDateOffers, 'to' => $ToDateOffers
						),
		$attendancetype => $adult
	  ),
	));
	//echo "<br/>RESULTADO ADULT:: ".$TotalAdult->filtered;
	
	$sum =0;
	foreach($TotalAdult as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$sumTotal2=$sum + $sumTotal2;
	// TYPE FOUR SEVEN
	$TotalAdult = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  //'from' => "0mr", 'to' => "0mr"
						  'from' => $FromDateOffers, 'to' => $ToDateOffers
						),
		$attendancetype => $fourSeven
	  ),
	));
	//echo "<br/>RESULTADO FOUR SEVEN:: ".$TotalAdult->filtered;
	$sum2 =0;
	foreach($TotalAdult as $item){
		
			$sum2 = $sum2 + $item->fields["total-attendance"]->values;	
			//echo "<br/>valor:".$item2->fields["total-attendance"]->values."<br/>";
	}
		
	// TYPE FUSION
	$TotalAdult = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => $FromDateOffers, 'to' => $ToDateOffers
						),
		$attendancetype => $Fusion
	  ),
	));
	//echo "<br/>RESULTADO FUSION:: ".$TotalAdult->filtered;
	$sum =0;
	foreach($TotalAdult as $item){
		
			$sum2 = $sum2 + $item->fields["total-attendance"]->values;		
	}
		
	// TYPE FORGE
	$TotalAdult = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => $FromDateOffers, 'to' => $ToDateOffers
						),
		$attendancetype => $Forge
	  ),
	));
	//echo "<br/>RESULTADO FORGE:: ".$TotalAdult->filtered;
	$sum =0;
	foreach($TotalAdult as $item){
		
			$sum2 = $sum2 + $item->fields["total-attendance"]->values;		
	}
	
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum2."</td>";
	$sumTotal3 =$sum2 + $sumTotal3;

		// TYPE NURSERY
	$TotalAdult = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => $FromDateOffers, 'to' => $ToDateOffers
						),
		$attendancetype => $Nursery
	  ),
	));
	//echo "<br/>RESULTADO NURSERY:: ".$TotalAdult->filtered;
	$sum3 =0;
	foreach($TotalAdult as $item){
		
			$sum3 = $sum3 + $item->fields["total-attendance"]->values;		
	}
		
			// TYPE PRESCHOOL
	$TotalAdult = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => $FromDateOffers, 'to' => $ToDateOffers
						),
		$attendancetype => $Preschool
	  ),
	));
	//echo "<br/>RESULTADO PRESCHOOL:: ".$TotalAdult->filtered;
	$sum =0;
	foreach($TotalAdult as $item){
		
			$sum3 = $sum3 + $item->fields["total-attendance"]->values;		
	}
	
	
			// TYPE Elementary
	$TotalAdult = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$app_reference_field_id => array($filter_target_item_id),
		$date  => array(
						  'from' => $FromDateOffers, 'to' => $ToDateOffers
						),
		$attendancetype => $Elementary
	  ),
	));
	//echo "<br/>RESULTADO Elementary:: ".$TotalAdult->filtered;
	$sum =0;
	foreach($TotalAdult as $item){
		
			$sum3 = $sum3 + $item->fields["total-attendance"]->values;		
	}
	
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum3."</td>  </tr>";
	$sumTotal4=$sum3 + $sumTotal4;
	
	}
}

  $tabla=$tabla."<tr>
   <td style=width: 20%; font-size: 7pt;  valign=top>TOTAL</td>";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sumTotal1."</td>  ";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sumTotal2."</td>  ";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sumTotal3."</td>  ";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sumTotal4."</td> </tr> ";
$tabla=$tabla."</table>";
echo $tabla;
$valores = substr($valores,1,strlen($valores)-1);
$valores = str_replace(" ","%20",$valores);
//echo $valores."<br/>";
$totales = substr($totales,1,strlen($totales)-1);
//echo $totales."<br/>";

$totales2 = str_replace(",","|",$totales);
$totaless="";
//$totales ="213,0,776,234,109,0,698,2194,371,700,181";
$varr = explode(",",$totales);
foreach($varr as $tt){
	//echo "<br/>valor::".$tt;
	$v1= $tt*100;
	$v2= $v1/$sumTotal1;
	$totaless = $totaless.",".$v2;
}
$totaless = substr($totaless,1,strlen($totaless)-1);
$url = "https://chart.googleapis.com/chart?cht=p3&chs=300x150&chd=t:$totaless&chl=$totales2&chdl=$valores&chco=FFFF10,FF0000,0072c6|ef3886|ff9900";
//$url = "https://chart.googleapis.com/chart?cht=p3&chs=250x100&chd=t:60,40&chl=Hello|World";mod
//echo $url;

if(@copy($url, 'uno.png')){
//echo "image-saved";
//echo "http://aparicio.website/uno.png";
}else{
//echo "failed"; 
}


}

 

catch (PodioError $e) {
 echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}

?>