<?php

require_once 'podio/PodioAPI.php';
include_once("xlsxwriter.class.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('max_execution_time', 0);
$writer = new XLSXWriter();
//$writer->writeSheetHeader('Sheet1', array('First Name'=>'string','Last Name'=>'string','Email'=>'string','Phone'=>'string', 'Campus'=>'string', 'Group Leader (Male)'=>'string', 'Group Leader (Female)'=>'string', 'Co-Leader (Male)'=>'string', 'Co-Leader (Female)'=>'string') );//optional
 $writer->writeSheetHeader('Sheet1', array('First Name'=>'string','Last Name'=>'string', 'Membership Status'=>'string', 'Group Leader (Male)'=>'string', 'Group Leader (Female)'=>'string') );//optional
 
try {

	  //$itemid =$_GET["itemid"];

 Podio::setup('countablehomes', 'kXNQ8PsY2WoUivuuCChzlhjSQgt7Z1P0VFng9RN1mT5zlIRax3UEDHz0CpDG3qXh');

Podio::authenticate_with_password('fcondon@devobal.com', 'AbCDTI@1');
//Podio::authenticate_with_app('15171838', '1ed766381fff42f0a406172688e48606');


switch ($_POST['type']) {
    case 'hook.verify' :
       
       PodioHook::validate($_POST['hook_id'], array('code' => $_POST['code']));
      
    case 'item.update' :
       
		$itemid =intval($_POST['item_id']); //425997436; //428167884; // 428167884; // 
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
			
			
		if($actionstr == 'Members in a Community Group'){ // report
			if($typestr == 'Excel'){
			mail("victoria.vad@gmail.com","entro","entro al todos los ifs");
				$offset = 0;$cant=0;
				$app_reference_field_id = 118427239;
				$app_reference_children = 114464240;
				$app_reference_campuses = 116100336;
				
				if($sw1==true){
					$cgs = PodioItem::filter(15009629,
					  array('limit' => 200, 'offset' => $offset,  'filters' => array(
						//$app_reference_field_id => array(397907062)
					  ),)); // Get items from app with app_id=123
				}else{
					$cgs = PodioItem::filter(15009629,
					  array('limit' => 200, 'offset' => $offset,  'filters' => array(
						//$app_reference_field_id => array(397907062),
						$app_reference_campuses => $valores
					  ),)); // Get items from app with app_id=123
				}

	
	//echo "<br/>total filtered::".$covenant->filtered."<br/>";
	//print_r($covenant);
foreach ($cgs as $item) {
	
	$participants = $item->fields["participants"]->values;
	foreach($participants as $it){
		echo "<br/> contact:::".$it->title."<br/>";
		$val = PodioItem::get( $it->item_id );
				$firstName = $val->fields["title"]->values;
				$lastName = $val->fields["last-name"]->values;
				$phoneNumber1 = $val->fields["home-phone"]->values;
				$email1 = $val->fields["email"]->values;
				$homeCampus1 = $val->fields["home-campus-2"]->values;
				
				$glm1 = $item->fields["relationship"]->values;
				$glf1 = $item->fields["group-leaders"]->values;
				$clm1 = $item->fields["co-leader-male"]->values;
				$clf1 = $item->fields["co-leader-female"]->values;
				$member1 = $val->fields["membership-status-2"]->values;
				$sw2=false; $phoneNumber=""; $email =""; $memberStatus =""; $homeCampus=""; $glm=""; $glf=""; $clm=""; $clf=""; $member="";
				foreach($member1 as $v1){
					$member = $member.",".$v1->title;
					$aux=$v1->title;
					if($aux == "Member"){$sw2=true;}	
					if($aux == "Covenant Member"){$sw2=true;}
					if($aux == "Attendee"){$sw2=true;}	
					if($aux == "Attendee Plus"){$sw2=true;}	
					$aux="";
				}
				
				foreach($glm1 as $v1){
					$glm = $glm.",".$v1->title;					
				}
				
				foreach($glf1 as $v1){
					$glf = $glf.",".$v1->title;					
				}
				
				foreach($clm1 as $v1){
					$clm = $clm.",".$v1->title;					
				}
				
				foreach($clf1 as $v1){
					$clf = $clf.",".$v1->title;					
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
				
				if($sw2==true){
				$memberStatus = substr($memberStatus,1,strlen($memberStatus)-1);
				//$homeCampus = substr($homeCampus,1,strlen($homeCampus)-1);
				//$email = substr($email,1,strlen($email)-1);
				//$phoneNumber = substr($phoneNumber,1,strlen($phoneNumber)-1);
				$glm = substr($glm,1,strlen($glm)-1);
				$glf = substr($glf,1,strlen($glf)-1);
				$clm = substr($clm,1,strlen($clm)-1);
				$clf = substr($clf,1,strlen($clf)-1);			
				$member = substr($member,1,strlen($member)-1);		
				
				 $writer->writeSheetRow('Sheet1', array($firstName,$lastName,$member,$glm,$glf) );
				 $sw=false; $phoneNumber=""; $email =""; $memberStatus =""; $homeCampus=""; $glm=""; $glf=""; $clm=""; $clf=""; $member="";
				 }
				 $sw2=false;
	}
	
	
	}
	
	



$cant = $covenant->total;
 $offset = 200; $offset2;
 while($offset < $cant){
	
		$app_reference_field_id = 118427239;
				$app_reference_children = 114464240;
				$app_reference_campuses = 116100336;
				
				if($sw1==true){
					$cgs = PodioItem::filter(15009629,
					  array('limit' => 200, 'offset' => $offset,  'filters' => array(
						//$app_reference_field_id => array(397907062)
					  ),)); // Get items from app with app_id=123
				}else{
					$cgs = PodioItem::filter(15009629,
					  array('limit' => 200, 'offset' => $offset,  'filters' => array(
						//$app_reference_field_id => array(397907062),
						$app_reference_campuses => $valores
					  ),)); // Get items from app with app_id=123
				}

	
	//echo "<br/>total filtered::".$covenant->filtered."<br/>";
	//print_r($covenant);
foreach ($cgs as $item) {
	
	$participants = $item->fields["participants"]->values;
	foreach($participants as $it){
		echo "<br/> contact:::".$it->title."<br/>";
		$val = PodioItem::get( $it->item_id );
				$firstName = $val->fields["title"]->values;
				$lastName = $val->fields["last-name"]->values;
				$phoneNumber1 = $val->fields["home-phone"]->values;
				$email1 = $val->fields["email"]->values;
				$homeCampus1 = $val->fields["home-campus-2"]->values;
				
				$glm1 = $item->fields["relationship"]->values;
				$glf1 = $item->fields["group-leaders"]->values;
				$clm1 = $item->fields["co-leader-male"]->values;
				$clf1 = $item->fields["co-leader-female"]->values;
				$member1 = $val->fields["membership-status-2"]->values;
				$sw2=false; $phoneNumber=""; $email =""; $memberStatus =""; $homeCampus=""; $glm=""; $glf=""; $clm=""; $clf=""; $member="";
				foreach($member1 as $v1){
					$member = $member.",".$v1->title;
					$aux=$v1->title;
					if($aux == "Member"){$sw2=true;}	
					if($aux == "Covenant Member"){$sw2=true;}
					if($aux == "Attendee"){$sw2=true;}	
					if($aux == "Attendee Plus"){$sw2=true;}	
					$aux="";
				}
				
				foreach($glm1 as $v1){
					$glm = $glm.",".$v1->title;					
				}
				
				foreach($glf1 as $v1){
					$glf = $glf.",".$v1->title;					
				}
				
				foreach($clm1 as $v1){
					$clm = $clm.",".$v1->title;					
				}
				
				foreach($clf1 as $v1){
					$clf = $clf.",".$v1->title;					
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
				
				if($sw2==true){
				$memberStatus = substr($memberStatus,1,strlen($memberStatus)-1);
				//$homeCampus = substr($homeCampus,1,strlen($homeCampus)-1);
				//$email = substr($email,1,strlen($email)-1);
				//$phoneNumber = substr($phoneNumber,1,strlen($phoneNumber)-1);
				$glm = substr($glm,1,strlen($glm)-1);
				$glf = substr($glf,1,strlen($glf)-1);
				$clm = substr($clm,1,strlen($clm)-1);
				$clf = substr($clf,1,strlen($clf)-1);			
				$member = substr($member,1,strlen($member)-1);		
				
				 $writer->writeSheetRow('Sheet1', array($firstName,$lastName,$member,$glm,$glf) );
				 $sw=false; $phoneNumber=""; $email =""; $memberStatus =""; $homeCampus=""; $glm=""; $glf=""; $clm=""; $clf=""; $member="";
				 }
				 $sw2=false;
	}
	
	
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
 
 $writer->writeToFile('CommunityGroup.xlsx');
 $file=PodioFile::upload('CommunityGroup.xlsx', 'CommunityGroup.xlsx');
  PodioFile::attach($file->id, array( 'ref_type'=> 'item','ref_id'=>$itemid));
 	
}}


 }	
}
catch (PodioError $e) {

 echo "error $e"; // Something went wrong. Examine $e->body['error_description'] for a description of the error.
}
catch (Exception $ex) {

    echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
}

?>