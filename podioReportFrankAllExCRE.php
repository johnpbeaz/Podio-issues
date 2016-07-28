<?php

require_once 'podio/PodioAPI.php';
include_once("xlsxwriter.class.php");
include 'PHPExcel.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('max_execution_time', 0);

 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');
Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

switch ($_POST['type']) {
    case 'hook.verify' :
       
       PodioHook::validate($_POST['hook_id'], array('code' => $_POST['code']));
      
    case 'item.create' :
	
	$item = PodioItem::get_basic(intval($_POST['item_id']));
	$itemid= intval($_POST['item_id']);
		$actionstr="";  $typestr="";
			foreach($item->fields as $i => $value) {
			 
				if($value->field_id == '123760236'){
					foreach($value->values as $i){
						$actionstr=$i['text'];						
					}					
				}
				if($value->field_id == '122821471'){ //action
					foreach($value->values as $i){
						$typestr=$i['text'];						
					}					
				}					
			}
		if($actionstr == 'EXCEL'){ // report
			if($typestr == 'Generate Report'){
			
$writer = new XLSXWriter();
$writer->writeSheetHeader('Report Attendance All', array('Campus'=>'string','Date'=>'string','Service'=>'string','# in Attendance'=>'string', 'Attendee Type'=>'string') );//optional
  
  //$itemid= $_GET["itemid"];
  $objPHPExcel = new PHPExcel();
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Campus');
  $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date');
  $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Service');
  $objPHPExcel->getActiveSheet()->SetCellValue('D1', '# in Attendance');
  $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Attendee Type');
  
 


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
//offers per campaign
 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');
Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171541', 'fb539c77f25842a8b0317482b69ec2a9');
	
$idd;
$cant=0;

$opt="";

$tabla="<table width=70%>
 <tr>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>Campus</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>Date</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>Service</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong># in Attendance</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>Attendee Type</strong></td>
  
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
$row=1;
foreach ($campaign as $item) {

 $filter_target_item_id = $item->item_id;
 //echo "<br/>valor::".$item->item_id."<br/>";
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
			
			$tabla=$tabla."<tr><td style=width: 10%; font-size: 7pt;  valign=top>".$campus."</td>";
			$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$date1."</td>";
			$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$service."</td>";
			$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$attendance."</td>";
			$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$type."</td></tr>";
			
			//$writer->writeSheetRow('Report Attendance All', array($campus,$date1,$email,$service,$attendance) );
			$row=$row+1;
			  $objPHPExcel->getActiveSheet()->SetCellValue("A$row", $campus);
			  $objPHPExcel->getActiveSheet()->SetCellValue("B$row", $date1);
			  $objPHPExcel->getActiveSheet()->SetCellValue("C$row", $service);
			  $objPHPExcel->getActiveSheet()->SetCellValue("D$row", $attendance);
			  $objPHPExcel->getActiveSheet()->SetCellValue("E$row", $type);
  
		
	}}
	}
$tabla=$tabla."</table>";
echo $tabla;
$row=$row+1;
$row=$row+1;
$row=$row+1;

$sumTotal=0;
$tabla2="<table width=70%>
 <tr>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
  
  </tr>
  ";
  
$valores="";  $totales="";
$campaign = PodioItem::filter(8900539, array( 'sort_by' => 'title',
												'sort_desc' => false)); // Get items from app with app_id=123
foreach ($campaign as $item) {

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
  $tabla2=$tabla2."<tr>
   <td style=width: 20%; font-size: 7pt;  valign=top> Total - "
  .$item->title.":</td>";
  $name = $item->title;
  
   
 //$date_lead_created=101404311;
 $filter_target_item_id = $item->item_id;
  


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
	$tabla2=$tabla2."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td></tr>";
	$sumTotal=$sumTotal+$sum;
	
	//$writer->writeSheetRow('Report Attendance All', array("","","Total - ".$name,$sum,"") );
	
	$row=$row+1;
			  $objPHPExcel->getActiveSheet()->SetCellValue("A$row", "");
			  $objPHPExcel->getActiveSheet()->SetCellValue("B$row", "");
			  $objPHPExcel->getActiveSheet()->SetCellValue("C$row", "Total - ".$name);
			  $objPHPExcel->getActiveSheet()->SetCellValue("D$row", $sum);
			  $objPHPExcel->getActiveSheet()->SetCellValue("E$row", "");
			  
	}}

	$tabla2=$tabla2."<tr><td style=width: 10%; font-size: 7pt;  valign=top> TOTAL - ALL:</td>";
	$tabla2=$tabla2."<td style=width: 10%; font-size: 7pt;  valign=top>".$sumTotal."</td></tr>";
	
	//$writer->writeSheetRow('Report Attendance All', array("","","TOTAL - ALL:",$sumTotal,"") );
	$row=$row+1;
			  $objPHPExcel->getActiveSheet()->SetCellValue("A$row", "");
			  $objPHPExcel->getActiveSheet()->SetCellValue("B$row", "");
			  $objPHPExcel->getActiveSheet()->SetCellValue("C$row", "TOTAL - ALL:");
			  $objPHPExcel->getActiveSheet()->SetCellValue("D$row", $sumTotal);
			  $objPHPExcel->getActiveSheet()->SetCellValue("E$row", "");
			  
	
	$tabla2=$tabla2."</table>";
	echo $tabla2;

	//$writer->writeToFile('reportAll.xlsx');
	
}catch (PodioError $e) {
 echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}


/***************************REPORTE DOS**********************************/

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
  $objPHPExcel->getActiveSheet()->setTitle('Sheet2');
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', '');
  $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'Total');
  $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'Adult');
  $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Students');
  $objPHPExcel->getActiveSheet()->SetCellValue('E2', 'Children');
  $row=3;
try {



$previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

//$start_week = date("Y-m-d",$start_week);
//$end_week = date("Y-m-d",$end_week);

//echo $start_week.' '.$end_week ;

$FromDateOffers = date("Y-m-d H:i:s", $start_week); //'-1w'; // 
$ToDateOffers = date("Y-m-d H:i:s", $end_week); //'1w';  //


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
  
$valores="";  $totales=""; $sumTotal2=0;$sumTotal3=0;$sumTotal4=0;$sumTotal5=0; $sumTotal1=0;
$campaign = PodioItem::filter(8900539, array( 'sort_by' => 'title',
												'sort_desc' => false)); // Get items from app with app_id=123
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
  $name= $item->title;
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
	$row=$row+1;
			  $objPHPExcel->getActiveSheet()->SetCellValue("A$row", $name);
			  $objPHPExcel->getActiveSheet()->SetCellValue("B$row", $sum);
//	$totales = $totales.",".$attendance->filtered;
	$sumTotal1=$sum + $sumTotal1;
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
	$objPHPExcel->getActiveSheet()->SetCellValue("C$row", $sum);
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
	$objPHPExcel->getActiveSheet()->SetCellValue("D$row", $sum2);

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
	
			  $objPHPExcel->getActiveSheet()->SetCellValue("E$row", $sum3);
			  $sumTotal4=$sum3 + $sumTotal4;
	
}}

$row=$row+1;
	$objPHPExcel->getActiveSheet()->SetCellValue("B$row", $sumTotal1);
	$objPHPExcel->getActiveSheet()->SetCellValue("C$row", $sumTotal2);
	$objPHPExcel->getActiveSheet()->SetCellValue("D$row", $sumTotal3);
	$objPHPExcel->getActiveSheet()->SetCellValue("E$row", $sumTotal4);
$row=$row+1;
$row=$row+1;
$row=$row+1;

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
$url = "https://chart.googleapis.com/chart?cht=p3&chs=700x300&chd=t:$totaless&chl=$totales2&chdl=$valores&chco=FFFF10,FF0000,0072c6|ef3886|ff9900";
//$url = "https://chart.googleapis.com/chart?cht=p3&chs=250x100&chd=t:60,40&chl=Hello|World";mod
//echo $url;

if(@copy($url, 'uno.png')){
//echo "image-saved";
//echo "http://ec2-52-87-246-61.compute-1.amazonaws.com/uno.png";
}else{
//echo "failed"; 
}
$gdImage =		imagecreatefromstring(file_get_contents('http://ec2-52-87-246-61.compute-1.amazonaws.com/uno.png'));
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(250);
$objDrawing->setCoordinates("A$row");
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
}

catch (PodioError $e) {
 echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}


/******************************************REPORTE TRES******************************************/

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);
  $objPHPExcel->getActiveSheet()->setTitle('Sheet3');
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', '');
  $objPHPExcel->getActiveSheet()->SetCellValue('A2', '');
  $row=3;
  
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

$day = date("d");
$month = date("m");
$year = date("Y");
$year = $year - 1;

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
  
  
  $objPHPExcel->getActiveSheet()->SetCellValue('C2', $name1);
  $objPHPExcel->getActiveSheet()->SetCellValue('D2', $name2);
  
$valores="";  $totalesLast=""; $totalesActual="";
$campaign = PodioItem::filter(8900539, array( 'sort_by' => 'title',
												'sort_desc' => false)); // Get items from app with app_id=123
$cant=0;
foreach ($campaign as $item) {
	
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
  $row=$row+1;
  $objPHPExcel->getActiveSheet()->SetCellValue("A$row", $cant);
  $objPHPExcel->getActiveSheet()->SetCellValue("B$row", $item->title);
  
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

	$totalesLast = $totalesLast.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("C$row", $sum);
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
	$objPHPExcel->getActiveSheet()->SetCellValue("D$row", $sum);
	$array2[]= $sum;
	$totalesActual = $totalesActual.$sum.",";
}}

$tabla=$tabla."</table>";

$totalesLast = substr($totalesLast,0,strlen($totalesLast)-1);
$totalesActual = substr($totalesActual,0,strlen($totalesActual)-1);

$totalesLast = $totalesLast ."|".$totalesActual;
echo $tabla;

//echo "<br/>totales::::$totalesLast";
sort($array1);
sort($array2);

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
$url = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast&chs=600x450&chbh=13,2,1&chco=4C9900,9ABADF&chds=0,3000&chdl=$name1|$name2&chxt=x,y,x&chxl=0:|1|2|3|4|5|6|7|8|9|10|11|12|13|1:|0|250|500|750|1000|1250|1500|1750|2000|2250|2500|2750|3000|2:|Campuses";
//echo $url;

if(@copy($url, 'dos.png')){

}else{
//echo "failed"; 
}
$row=$row+1;
$row=$row+1;
$row=$row+1;

$gdImage =		imagecreatefromstring(file_get_contents('http://ec2-52-87-246-61.compute-1.amazonaws.com/dos.png'));
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(450);
$objDrawing->setCoordinates("A$row");
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	
	

}

 

catch (PodioError $e) {
 //echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}

/*******************************REPORTE TRES*************************************/

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3);
  $objPHPExcel->getActiveSheet()->setTitle('Sheet4');
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', '');
  $objPHPExcel->getActiveSheet()->SetCellValue('A2', '');
  $row=3;

try {

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


$columna1 = "$month2 $intervaloIni1/$intervaloFin1, $yearActual";
$columna2 = "$month2 $intervaloIni2/$intervaloFin2, $yearActual";
$columna3 = "$month2 $intervaloIni3/$intervaloFin3, $yearActual";
$columna4 = "$month2 $intervaloIni4/$intervaloFin4, $yearActual";
$columna5 = "$month2 $intervaloIni5/$intervaloFin5, $yearActual";


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



$array1 = array();
$array2 = array();
$opt="";
$name1="$month1 $FromDayLast/$ToDayLast, $yearLast";
$name2="$month2 $FromDayActual/$ToDayActual, $yearActual";
$tabla="<table width=70%>
 <tr>
 <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna1</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna2</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna3</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna4</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna5</strong></td>
   
  </tr>
  ";
  
  $objPHPExcel->getActiveSheet()->SetCellValue('C2', $columna1);
  $objPHPExcel->getActiveSheet()->SetCellValue('D2', $columna2);
  $objPHPExcel->getActiveSheet()->SetCellValue('E2', $columna3);
  $objPHPExcel->getActiveSheet()->SetCellValue('F2', $columna4);
  $objPHPExcel->getActiveSheet()->SetCellValue('G2', $columna5);

$valores="";  $totalesLast1=""; $totalesLast2=""; $totalesLast3=""; $totalesActual="";
$campaign = PodioItem::filter(8900539, array( 'sort_by' => 'title',
												'sort_desc' => false)); // Get items from app with app_id=123
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
  $row=$row+1;
  $objPHPExcel->getActiveSheet()->SetCellValue("A$row", $cant);
  $objPHPExcel->getActiveSheet()->SetCellValue("B$row", $item->title);
  
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
	$objPHPExcel->getActiveSheet()->SetCellValue("C$row", $sum);
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
	$objPHPExcel->getActiveSheet()->SetCellValue("D$row", $sum);
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
	$objPHPExcel->getActiveSheet()->SetCellValue("E$row", $sum);
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
	$objPHPExcel->getActiveSheet()->SetCellValue("F$row", $sum);
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
	$objPHPExcel->getActiveSheet()->SetCellValue("G$row", $sum);
}}

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
//echo "http://ec2-52-87-246-61.compute-1.amazonaws.com/uno.png";
}else{
echo "failed"; 
}

if(@copy($url2, 'tres2.png')){
//echo "image-saved";
//echo "http://ec2-52-87-246-61.compute-1.amazonaws.com/uno.png";
}else{
echo "failed"; 
}

if(@copy($url3, 'tres3.png')){
//echo "image-saved";
//echo "http://ec2-52-87-246-61.compute-1.amazonaws.com/uno.png";
}else{
echo "failed"; 
}


$row=$row+1;
$row=$row+1;
$row=$row+1;

$gdImage =		imagecreatefromstring(file_get_contents('http://ec2-52-87-246-61.compute-1.amazonaws.com/tres1.png'));
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(450);
$objDrawing->setCoordinates("A$row");
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$row=$row+30;
$gdImage =		imagecreatefromstring(file_get_contents('http://ec2-52-87-246-61.compute-1.amazonaws.com/tres2.png'));
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(450);
$objDrawing->setCoordinates("A$row");
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$row=$row+30;
$gdImage =		imagecreatefromstring(file_get_contents('http://ec2-52-87-246-61.compute-1.amazonaws.com/tres3.png'));
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(450);
$objDrawing->setCoordinates("A$row");
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	
	
	
	
	
}

 

catch (PodioError $e) {
 //echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}

/*************************REPORTE CUATRO*******************************/

$year = date("Y");
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
$IntervaloIni5 = $valor5[1];
$IntervaloFin5 = $valor5[$long5];

}

if($long<7){
$valor6 = $res[6];

$long6 = count($valor6);
$IntervaloIni6 = $valor6[1];
$IntervaloFin6 = $valor6[$long6];
}

$long1 = count($valor1);
//echo "<br/>long1::$long1";
if($long1==7){
	$IntervaloIni1 = $valor1[1];
	$IntervaloFin1 = $valor1[$long1];
}else{
	$IntervaloIni1 = $valor1[8-$long1];
	$IntervaloFin1 = $valor1[7];
}


$long2 = count($valor2);
$IntervaloIni2 = $valor2[1];
$IntervaloFin2 = $valor2[$long2];

$long3 = count($valor3);
$IntervaloIni3 = $valor3[1];
$IntervaloFin3 = $valor3[$long3];

$long4 = count($valor4);
$IntervaloIni4 = $valor4[1];
$IntervaloFin4 = $valor4[$long4];
/*
echo "<br/>IntervaloIni1::$IntervaloIni1";
echo "<br/>IntervaloFin1::$IntervaloFin1";
echo "<br/>IntervaloIni2::$IntervaloIni2";
echo "<br/>IntervaloFin2::$IntervaloFin2";
echo "<br/>IntervaloIni3::$IntervaloIni3";
echo "<br/>IntervaloFin3::$IntervaloFin3";
echo "<br/>IntervaloIni4::$IntervaloIni4";
echo "<br/>IntervaloFin4::$IntervaloFin4";
echo "<br/>IntervaloIni5::$IntervaloIni5";
echo "<br/>IntervaloFin5::$IntervaloFin5";
echo "<br/>IntervaloIni6::$IntervaloIni6";
echo "<br/>IntervaloFin6::$IntervaloFin6";
*/
$IntervaloIni1 = "$month/$IntervaloIni1/$year";
$IntervaloFin1 = "$month/$IntervaloFin1/$year";
$IntervaloIni2 = "$month/$IntervaloIni2/$year";
$IntervaloFin2 = "$month/$IntervaloFin2/$year";
$IntervaloIni3 = "$month/$IntervaloIni3/$year";
$IntervaloFin3 = "$month/$IntervaloFin3/$year";
$IntervaloIni4 = "$month/$IntervaloIni4/$year";
$IntervaloFin4 = "$month/$IntervaloFin4/$year";
$IntervaloIni5 = "$month/$IntervaloIni5/$year";
$IntervaloFin5 = "$month/$IntervaloFin5/$year";
$IntervaloIni6 = "$month/$IntervaloIni6/$year";
$IntervaloFin6 = "$month/$IntervaloFin6/$year";



/***************************************/

//print_r($res2);
$long = count($res2);
$valor1 = $res2[1];
$valor2 = $res2[2];
$valor3 = $res2[3];
$valor4 = $res2[4];
//echo "<br/>long:::$long";
if($long<=6){
$valor5 = $res2[5];

$long5 = count($valor5);
$IntervaloIni52 = $valor5[1];
$IntervaloFin52 = $valor5[$long5];

}

if($long<7){
$valor6 = $res[6];

$long6 = count($valor6);
$IntervaloIni62 = $valor6[1];
$IntervaloFin62 = $valor6[$long6];
}

$long1 = count($valor1);
//echo "<br/>long1::$long1";
if($long1==7){
	$IntervaloIni12 = $valor1[1];
	$IntervaloFin12 = $valor1[$long1];
}else{
	$IntervaloIni12 = $valor1[8-$long1];
	$IntervaloFin12 = $valor1[7];
}


$long2 = count($valor2);
$IntervaloIni22 = $valor2[1];
$IntervaloFin22 = $valor2[$long2];

$long3 = count($valor3);
$IntervaloIni32 = $valor3[1];
$IntervaloFin32 = $valor3[$long3];

$long4 = count($valor4);
$IntervaloIni42 = $valor4[1];
$IntervaloFin42 = $valor4[$long4];



$IntervaloIni12 = "$month/$IntervaloIni12/$yearLast";
$IntervaloFin12 = "$month/$IntervaloFin12/$yearLast";
$IntervaloIni22 = "$month/$IntervaloIni22/$yearLast";
$IntervaloFin22 = "$month/$IntervaloFin22/$yearLast";
$IntervaloIni32 = "$month/$IntervaloIni32/$yearLast";
$IntervaloFin32 = "$month/$IntervaloFin32/$yearLast";
$IntervaloIni42 = "$month/$IntervaloIni42/$yearLast";
$IntervaloFin42 = "$month/$IntervaloFin42/$yearLast";
$IntervaloIni52 = "$month/$IntervaloIni52/$yearLast";
$IntervaloFin52 = "$month/$IntervaloFin52/$yearLast";
$IntervaloIni62 = "$month/$IntervaloIni62/$yearLast";
$IntervaloFin62 = "$month/$IntervaloFin62/$yearLast";


$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(4);
  $objPHPExcel->getActiveSheet()->setTitle('Sheet5');
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', '');
  //$objPHPExcel->getActiveSheet()->SetCellValue('A2', '');
  $row=3;
  
try {


 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');
Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171541', '3174d8f443054fac9e3f665e657bd0a5');

$uno ="1st Week of $month2";
$dos ="2nd Week of $month2";
$tres ="3rd Week of $month2";
$cuatro ="4th Week of $month2";
$cinco ="5th Week of $month2";
$seis ="6th Week of $month2";

$array1 = array();
$array2 = array();
$opt="";$date = 	116781925;
$name1="$month1 $FromDayLast/$ToDayLast, $yearLast";
$name2="$month2 $FromDayActual/$ToDayActual, $yearActual";
$tabla="<table width=70%>
 <tr>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$uno</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$dos</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$tres</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$cuatro</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$cinco</strong></td>
   
  </tr>
  ";
  
    
  $objPHPExcel->getActiveSheet()->SetCellValue('A2', '');
  $objPHPExcel->getActiveSheet()->SetCellValue('B2', $uno);
  $objPHPExcel->getActiveSheet()->SetCellValue('C2', $dos);
  $objPHPExcel->getActiveSheet()->SetCellValue('D2', $tres);
  $objPHPExcel->getActiveSheet()->SetCellValue('E2', $cuatro);
  $objPHPExcel->getActiveSheet()->SetCellValue('F2', $cinco);
  //$objPHPExcel->getActiveSheet()->SetCellValue('G2', $seis);

$valores="";  $totalesLast1=""; $totalesLast2=""; $totalesLast3=""; $totalesActual="";
//$campaign = PodioItem::filter(15745917); // Get items from app with app_id=123

   //$row=$row+1;
  $tabla=$tabla."<tr><td style=width: 20%; font-size: 7pt;  valign=top>"
  .$yearLast."</td>";
  $objPHPExcel->getActiveSheet()->SetCellValue("A$row", $yearLast);
   $valores="$yearLast|$year";
       
$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni12)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin12))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("B$row", $sum);
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni22)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin22))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("C$row", $sum);
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni32)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin32))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("D$row", $sum);
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni42)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin42))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("E$row", $sum);
	
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni52)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin52))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$totalesLast1 = $totalesLast1.$sum."|";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td> </tr>";
	$objPHPExcel->getActiveSheet()->SetCellValue("F$row", $sum);
	/*
	$attendance1 = PodioItem::filter(15171541, array(
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni62)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin62))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$totalesLast1 = $totalesLast1.$sum."|";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td></tr>";
	$objPHPExcel->getActiveSheet()->SetCellValue("G$row", $sum);*/
	/***************************** AÑO ACTUAL *********************************/
	  $tabla=$tabla."<tr><td style=width: 20%; font-size: 7pt;  valign=top>"
  .$year."</td>";
    $row=$row+1;
   //$valores=$valores."|".$item->title;
      $objPHPExcel->getActiveSheet()->SetCellValue("A$row", $year);
 $filter_target_item_id = $item->item_id;
 
$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni1)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin1))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("B$row", $sum);
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni2)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin2))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("C$row", $sum);
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni3)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin3))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("D$row", $sum);
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni4)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin4))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("E$row", $sum);
	
	$attendance1 = PodioItem::filter(15171541, array( 'limit' => 400, 'offset' => 0, 
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni5)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin5))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$totalesLast1 = $totalesLast1.$sum;
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td> </tr>";
	$objPHPExcel->getActiveSheet()->SetCellValue("F$row", $sum);
	/*
	$attendance1 = PodioItem::filter(15171541, array(
	  'filters' => array(
		$date  => array(
						  'from' => date("Y-m-d H:i:s", strtotime($IntervaloIni6)), 'to' => date("Y-m-d H:i:s", strtotime($IntervaloFin6))
						)
	  ),
	));
	
	$sum =0;
	foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
	}
	$totalesLast1 = $totalesLast1.$sum;
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td></tr>";
	$objPHPExcel->getActiveSheet()->SetCellValue("G$row", $sum);
	*/
//}

$tabla=$tabla."</table>";
echo $tabla;

$uno ="1st";
$dos ="2nd";
$tres ="3rd";
$cuatro ="4th";
$cinco ="5th";
$seis ="6th";

$uno = str_replace(" ","%20",$uno);
$dos = str_replace(" ","%20",$dos);
$tres = str_replace(" ","%20",$tres);
$cuatro = str_replace(" ","%20",$cuatro);
$cinco = str_replace(" ","%20",$cinco);
$seis = str_replace(" ","%20",$seis);

$url1 = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast1&chs=600x450&chbh=41,2,1&chco=4C9900,9ABADF,3333FF,999900,CC00CC,FFFF00,FF0000,FF99CC,006633&chds=0,7000&chdl=$valores&chxt=x,y,x&chxl=0:|$uno|$dos|$tres|$cuatro|$cinco|$seis|7|8|9|10|11|12|13|1:|0|1000|2000|3000|4000|5000|6000|7000|2:|";
//echo "<br/>".$url1;

if(@copy($url1, 'cuatro.png')){
//echo "image-saved";
//echo "http://ec2-52-87-246-61.compute-1.amazonaws.com/uno.png";
}else{
//echo "failed"; 
}


$row=$row+1;
$row=$row+1;
$row=$row+1;

$gdImage =		imagecreatefromstring(file_get_contents('http://ec2-52-87-246-61.compute-1.amazonaws.com/cuatro.png'));
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(450);
$objDrawing->setCoordinates("A$row");
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

}

 

catch (PodioError $e) {
 echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}


/*******************************REPORTE CINCO*********************************/

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(5);
  $objPHPExcel->getActiveSheet()->setTitle('Sheet6');
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', '');
  $row=2;
  
  
try {



 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');
Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171541', '3174d8f443054fac9e3f665e657bd0a5');
$year = date("Y");
$array1 = array();
$array2 = array();
$opt="";
$name1="$month1 $FromDayLast/$ToDayLast, $yearLast";
$name2="$month2 $FromDayActual/$ToDayActual, $yearActual";
$tabla="<table width=70%>
 <tr>
 <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong></strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna1</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna2</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna3</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna4</strong></td>
   <td style=width: 10%; font-size: 7pt;  valign=top><strong>$columna5</strong></td>
   
  </tr>
  ";
  
  
$valores="";$totales="";  $totalesLast1=""; $totalesLast2=""; $totalesLast3=""; $totalesActual="";
$campaign = PodioItem::filter(8900539, array( 'sort_by' => 'title',
												'sort_desc' => false)); // Get items from app with app_id=123
$cant=0; $tot=0;
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
   $row=$row+1;
    $tabla=$tabla."<tr>

   <td style=width: 20%; font-size: 7pt;  valign=top>"
  .$cant."</td>";

   $objPHPExcel->getActiveSheet()->SetCellValue("A$row", $cant);
  
  $tabla=$tabla."<td style=width: 20%; font-size: 7pt;  valign=top>"
  .$item->title."</td>";
    $objPHPExcel->getActiveSheet()->SetCellValue("B$row", $item->title);
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
						  'from' => date("Y-m-d H:i:s", strtotime("01/01/$year")), 'to' => date("Y-m-d H:i:s")
						)
	  ),
	  'limit' => 200, 'offset' => $offset
	));
	$valor = 0;
	
	if($attendance1->filtered>0){
		$sum =0;
		foreach($attendance1 as $item){
		
			$sum = $sum + $item->fields["total-attendance"]->values;		
		}
		
		$weekNumber = date("W"); 
		$weekNumber = $weekNumber -1 ;
		$valor = round(($sum/$weekNumber));
	}else{
		$valor = 0;
	}
	$totales = $totales.",".$valor;
	 $tot= $tot + $valor;
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$valor."</td>";
	$objPHPExcel->getActiveSheet()->SetCellValue("C$row", $valor);
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

$valores = substr($valores,0,strlen($valores));
$valores = str_replace(" ","%20",$valores);
//echo $valores."<br/>";
$totales = substr($totales,1,strlen($totales)-1);
//echo $totales."<br/>";

$totales2 = str_replace(",","|",$totales);

$totaless="";
$varr = explode(",",$totales);
foreach($varr as $tt){
	//echo "<br/>valor::".$tt;
	$v1= $tt*100;
	$v2= $v1/$tot;
	$totaless = $totaless.",".$v2;
}
$totaless = substr($totaless,1,strlen($totaless)-1);

$url = "https://chart.googleapis.com/chart?cht=p3&chs=700x300&chd=t:$totaless&chl=$totales2&chdl=$valores&chco=FFFF10,FF0000,0072c6|ef3886|ff9900";
//$url = "https://chart.googleapis.com/chart?cht=p3&chs=250x100&chd=t:60,40&chl=Hello|World";
echo $url;

if(@copy($url, 'cinco.png')){
//echo "image-saved";
//echo "http://aparicio.website/uno.png";
}else{
//echo "failed"; 
}

$row=$row+1;
$row=$row+1;
$row=$row+1;

$gdImage =		imagecreatefromstring(file_get_contents('http://ec2-52-87-246-61.compute-1.amazonaws.com/cinco.png'));
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(250);
$objDrawing->setCoordinates("A$row");
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx',"reportAll.xlsx"));

	 $file=PodioFile::upload('reportAll.xlsx', 'reportAll.xlsx');
  PodioFile::attach($file->id, array( 'ref_type'=> 'item','ref_id'=>intval($itemid)));
		
		
}

 

catch (PodioError $e) {
 //echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}

}
}}

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

?>