<?php

require_once 'podio/PodioAPI.php';
include_once("xlsxwriter.class.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('max_execution_time', 0);
$writer = new XLSXWriter();
$writer->writeSheetHeader('Sheet1', array('First Name'=>'string','Last Name'=>'string','Email'=>'string','Phone'=>'string', 'Campus'=>'string', 'Member Status'=>'string') );//optional
 
 
try {

	  //$itemid =$_GET["itemid"];

 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');

Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171838', '1ed766381fff42f0a406172688e48606');


switch ($_POST['type']) {
    case 'hook.verify' :
       
       PodioHook::validate($_POST['hook_id'], array('code' => $_POST['code']));
      
    case 'item.update' :
       
		$itemid = intval($_POST['item_id']); //425997436; //428167884; // 428167884; // 
		$item = PodioItem::get_basic(intval($_POST['item_id']));  //(427613476); // (428167884);  // (428167884);//
		$actionstr="";  $typestr=""; $campuses="";
			foreach($item->fields as $i => $value) {
			 
				if($value->field_id == '122989821'){
					foreach($value->values as $i){
						$actionstr=$i['text'];						
					}					
				}
				if($value->field_id == '122989682'){
					foreach($value->values as $i){
						$typestr=$i['text'];						
					}					
				}
				if($value->field_id == '123057923'){
					foreach($value->values as $i){
						$campuses= $campuses .",".$i['text'];						
						//$campuses= $campuses .",".$i['text'];						
					}					
				}	
			}
			$campuses = substr($campuses,1,strlen($campuses)-1);
			//echo "<br/>campuses:::$campuses<br/>";
			$valores = array(); $sw1=false;
			$arrayCampuses = explode(",",$campuses);
			foreach($arrayCampuses as $tt){
				if($tt=="All Campuses"){
					$valores = array();
					$sw1=true;
				}
				if($tt=="Pelham Road"){
					$valores[]=181008462;
				}
				if($tt=="Spartanburg"){
					$valores[]=181391564;
				}
				if($tt=="Downtown"){
					$valores[]=181009502;
				}
				if($tt=="Powdersville"){
					$valores[]=181391410;
				}
				if($tt=="Anderson"){
					$valores[]=181391509;
				}
				if($tt=="Harrison Bridge"){
					$valores[]=181391630;
				}
				if($tt=="Espanol"){
					$valores[]=316946102;
				}
				if($tt=="Greer"){
					$valores[]=381759609;
				}
				if($tt=="Pelham Road (Saturday)"){
					$valores[]=402058425;
				}
				if($tt=="Downtown (Evening)"){
					$valores[]=402060303;
				}
			}
			
			
		if($actionstr == 'Covenant Member - Not in Community Group (CGs)'){ // report
			if($typestr == 'Excel'){
			mail("victoria.vad@gmail.com","entro","entro al todos los ifs");
				$offset = 0;$cant=0;
				$app_reference_field_id = 118427239;
				$app_reference_children = 114464240;
				$app_reference_campuses = 118427240;
				
				if($sw1==true){
					$covenant = PodioItem::filter(14846542,
					  array('limit' => 200, 'offset' => $offset,  'filters' => array(
						$app_reference_field_id => array(397907062)
					  ),)); // Get items from app with app_id=123
				}else{
					$covenant = PodioItem::filter(14846542,
					  array('limit' => 200, 'offset' => $offset,  'filters' => array(
						$app_reference_field_id => array(397907062),
						$app_reference_campuses => $valores
					  ),)); // Get items from app with app_id=123
				}

	
	//echo "<br/>total filtered::".$covenant->filtered."<br/>";
	//print_r($covenant);
foreach ($covenant as $item) {
	/*echo "<br/>*************************************************<br/>";
    echo "<br/>title:".$item->title."<br/>";
	echo "<br/><br/><br/>";*/
	
	$collection2 = $item->fields["children"]->values;
	$relation = $item->fields["membership-status-2"]->values;
	$nameRelation="";
	$val = PodioItem::get( $item->item_id );
	$str = print_r($val,true);
	$pos = strpos($str,"15009629");
	if($pos>0){
		//print_r($val); // si tiene
	}else{
		// no tiene
		/*echo "<br/>*************************************************<br/>";
				echo "<br/>Referenced item: ".$val->title;
				echo "<br/>Referenced item: ".$val->item_id;*/
				$firstName = $val->fields["title"]->values;
				$lastName = $val->fields["last-name"]->values;
				$phoneNumber1 = $val->fields["home-phone"]->values;
				$email1 = $val->fields["email"]->values;
				$memberStatus1 = $val->fields["membership-status-2"]->values;
				$homeCampus1 = $val->fields["home-campus-2"]->values;
				
				foreach($memberStatus1 as $v1){
					$memberStatus = $memberStatus.",".$v1->title;
					
				}
				
				foreach($homeCampus1 as $v1){
					$homeCampus = $homeCampus.",".$v1->title;
					
				}
				
				foreach($phoneNumber1 as $v1){
					$phoneNumber = $phoneNumber.",".$v1["value"];
					
				}
				
				foreach($email1 as $v1){
					$email = $email.",".$v1["value"];
					
				}
				
				$memberStatus = substr($memberStatus,1,strlen($memberStatus)-1);
				$homeCampus = substr($homeCampus,1,strlen($homeCampus)-1);
				$email = substr($email,1,strlen($email)-1);
				$phoneNumber = substr($phoneNumber,1,strlen($phoneNumber)-1);
				
			
				
				 $writer->writeSheetRow('Sheet1', array($firstName,$lastName,$email,$phoneNumber,$homeCampus,$memberStatus) );
		
	}
	$sw=false; $phoneNumber=""; $email =""; $memberStatus =""; $homeCampus="";
	
	}
	
	



$cant = $covenant->total;
 $offset = 200; $offset2;
 while($offset < $cant){
	
		$app_reference_field_id = 118427239;
				$app_reference_children = 114464240;
				$app_reference_campuses = 118427240;
				
				if($sw1==true){
					$covenant = PodioItem::filter(14846542,
					  array('limit' => 200, 'offset' => $offset,  'filters' => array(
						$app_reference_field_id => array(397907062)
					  ),)); // Get items from app with app_id=123
				}else{
					$covenant = PodioItem::filter(14846542,
					  array('limit' => 200, 'offset' => $offset,  'filters' => array(
						$app_reference_field_id => array(397907062),
						$app_reference_campuses => $valores
					  ),)); // Get items from app with app_id=123
				}

	
	//echo "<br/>total filtered::".$covenant->filtered."<br/>";
	//print_r($covenant);
foreach ($covenant as $item) {
	/*echo "<br/>*************************************************<br/>";
    echo "<br/>title:".$item->title."<br/>";
	echo "<br/><br/><br/>";*/
	
	$collection2 = $item->fields["children"]->values;
	$relation = $item->fields["membership-status-2"]->values;
	$nameRelation="";
	$val = PodioItem::get( $item->item_id );
	$str = print_r($val,true);
	$pos = strpos($str,"15009629");
	if($pos>0){
		//print_r($val); // si tiene
	}else{
		// no tiene
		/*echo "<br/>*************************************************<br/>";
				echo "<br/>Referenced item: ".$val->title;
				echo "<br/>Referenced item: ".$val->item_id;*/
				$firstName = $val->fields["title"]->values;
				$lastName = $val->fields["last-name"]->values;
				$phoneNumber1 = $val->fields["home-phone"]->values;
				$email1 = $val->fields["email"]->values;
				$memberStatus1 = $val->fields["membership-status-2"]->values;
				$homeCampus1 = $val->fields["home-campus-2"]->values;
				
				foreach($memberStatus1 as $v1){
					$memberStatus = $memberStatus.",".$v1->title;
					
				}
				
				foreach($homeCampus1 as $v1){
					$homeCampus = $homeCampus.",".$v1->title;
					
				}
				
				foreach($phoneNumber1 as $v1){
					$phoneNumber = $phoneNumber.",".$v1["value"];
					
				}
				
				foreach($email1 as $v1){
					$email = $email.",".$v1["value"];
					
				}
				
				$memberStatus = substr($memberStatus,1,strlen($memberStatus)-1);
				$homeCampus = substr($homeCampus,1,strlen($homeCampus)-1);
				$email = substr($email,1,strlen($email)-1);
				$phoneNumber = substr($phoneNumber,1,strlen($phoneNumber)-1);
				
			
				
				 $writer->writeSheetRow('Sheet1', array($firstName,$lastName,$email,$phoneNumber,$homeCampus,$memberStatus) );
		
	}
	$sw=false; $phoneNumber=""; $email =""; $memberStatus =""; $homeCampus="";
	
	}
/***************************************/
	$offset2 = $offset + 200;
	if($offset2>$cant){
		//$offset = $offset + 200;
		$valor = $cant-$offset;
		if($valor>0){
			$offset = $offset + $valor;
		}else{
			$offset = $cant + 50;
		}
		
	}else{
		$offset = $offset + 200;
	}
	
	echo "<br/>Offset2::$offset";

 }
 
 $writer->writeToFile('notCGS.xlsx');
//echo '#'.floor((memory_get_peak_usage())/1024/1024)."MB"."\n";
 $file=PodioFile::upload('notCGS.xlsx', 'notCGS.xlsx');
  PodioFile::attach($file->id, array( 'ref_type'=> 'item','ref_id'=>$itemid));
 
 		
}}

 }	
}
catch (PodioError $e) {
mail("victoria.vad@gmail.com","error","entro al todos los ifs  $e");
 echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}
catch (Exception $ex) {
mail("victoria.vad@gmail.com","error","entro al todos los ifs  $ex llllll".$ex->getMessage());
    echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
}

?>