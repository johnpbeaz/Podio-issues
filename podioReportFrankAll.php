<?php
//mod
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

//set_time_limit(0);
$previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

//$start_week = date("Y-m-d",$start_week);
//$end_week = date("Y-m-d",$end_week);

//echo $start_week.' '.$end_week ;

$FromDateOffers = date("Y-m-d H:i:s", $start_week); //'-1w'; // 
$ToDateOffers = date("Y-m-d H:i:s", $end_week); //'1w';  //

/*
$FromDateOffers = date("Y-m-d H:i:s", strtotime('last Monday', strtotime(date("Y-m-d H:i:s"))));
$ToDateOffers = date("Y-m-d H:i:s", strtotime('last Sunday', strtotime(date("Y-m-d H:i:s"))));
*/

/*echo "<br/>FromDateOffers:$FromDateOffers";
echo "<br/>ToDateOffers:$ToDateOffers";*/


//offers per campaign
 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');
Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171541', 'fb539c77f25842a8b0317482b69ec2a9');
	
$idd;
$cant=0;

$opt="";

$tabla="<table width=100%>
 <tr>
   <td style=width: 10%; font-size: 5pt;  valign=top><strong>Campus</strong></td>
   <td style=width: 10%; font-size: 5pt;  valign=top><strong>Date</strong></td>
   <td style=width: 10%; font-size: 5pt;  valign=top><strong>Service</strong></td>
   <td style=width: 10%; font-size: 5pt;  valign=top><strong># in Attendance</strong></td>
   <td style=width: 10%; font-size: 5pt;  valign=top><strong>Attendee Type</strong></td>
  
  </tr>
  ";
  
$valores="";  $totales="";

 
   $valores=$valores."|".$item->title;
   
   $app_reference_field_id = 116781926; 
   $attendancetype = 116781927;
   $date = 	116781925;
   $attendance =116781929;
   $adult = 9;
   $fourSeven = 10;
   $Fusion = 6;
   $Forge = 7;
   $WideOpen = 2;
   $Nursery = 5;
   $Preschool = 4;
   $Elementary = 8;
   
 //$date_lead_created=101404311;
 
 $campaign = PodioItem::filter(8900539, array( 'sort_by' => 'title',
												'sort_desc' => false)); // Get items from app with app_id=123
foreach ($campaign as $item) {

 $filter_target_item_id = $item->item_id;
 //echo "<br/>valor::".$item->item_id."<br/>";
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
	
	if($se==false && $se1==false && $se2== false){

	$TotalAdult = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
				$app_reference_field_id => array($filter_target_item_id),
				$date  => array(
						   'from' => $FromDateOffers, 'to' => $ToDateOffers
						)
	  ),
	));
	//echo "<br/>RESULTADO ADULT:: ".$TotalAdult->filtered;
	
	$sum =0;
	foreach($TotalAdult as $item){
		
			$campus1 = $item->fields["campus"]->values;
			foreach($campus1 as $it){
				$campus = $it->title;
			}			
			$date1 = $item->fields["date"]->humanized_value();	
			$service1 = $item->fields["service"]->values;
			foreach($service1 as $it){
				$service = $it->title;
			}
			$attendance = number_format($item->fields["total-attendance"]->values);	
			$type1 = $item->fields["attendee-type"]->values;	
			foreach($type1 as $it){
				$type = $it['text'];
			}
			
			$tabla=$tabla."<tr><td style=width: 10%; font-size: 5pt;  valign=top>".$campus."</td>";
			$tabla=$tabla."<td style=width: 10%; font-size: 5pt;  valign=top>".$date1."</td>";
			$tabla=$tabla."<td style=width: 10%; font-size: 5pt;  valign=top>".$service."</td>";
			$tabla=$tabla."<td style=width: 10%; font-size: 5pt;  valign=top>".$attendance."</td>";
			$tabla=$tabla."<td style=width: 10%; font-size: 5pt;  valign=top>".$type."</td></tr>";
			/*echo "<br/>";			
			echo "Date:$date<br/>";
			echo "service:$service<br/>";
			echo "attendance:$attendance<br/>";
			echo "type:$type<br/>";*/
	}
	}}
$tabla=$tabla."</table>";
echo $tabla;


$sumTotal=0;
$tabla2="<table width=70%>
 <tr>
   <td style=width: 10%; font-size: 5pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 5pt;  valign=top><strong></strong></td>
  
  </tr>
  ";
  
$valores="";  $totales="";
$campaign = PodioItem::filter(8900539,   array( 'sort_by' => 'title',
												'sort_desc' => false)); // Get items from app with app_id=123
foreach ($campaign as $item) {

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
  $tabla2=$tabla2."<tr>
   <td style=width: 20%; font-size: 5pt;  valign=top> Total - "
  .$item->title.":</td>";
  
  
   
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
	$tabla2=$tabla2."<td style=width: 10%; font-size: 5pt;  valign=top>".$sum."</td></tr>";
	$sumTotal=$sumTotal+$sum;
	}
	}

	$tabla2=$tabla2."<tr><td style=width: 10%; font-size: 5pt;  valign=top> TOTAL - ALL:</td>";
	$tabla2=$tabla2."<td style=width: 10%; font-size: 5pt;  valign=top>".$sumTotal."</td></tr>";
	
	$tabla2=$tabla2."</table>";
	//echo "oo";
	echo $tabla2;

}catch (PodioError $e) {
 echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}

?>