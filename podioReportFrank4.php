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

/*echo "<br/>IntervaloIni12::$IntervaloIni12";
echo "<br/>IntervaloFin12::$IntervaloFin12";
echo "<br/>IntervaloIni22::$IntervaloIni22";
echo "<br/>IntervaloFin22::$IntervaloFin22";
echo "<br/>IntervaloIni32::$IntervaloIni32";
echo "<br/>IntervaloFin32::$IntervaloFin32";
echo "<br/>IntervaloIni42::$IntervaloIni42";
echo "<br/>IntervaloFin42::$IntervaloFin42";
echo "<br/>IntervaloIni52::$IntervaloIni52";
echo "<br/>IntervaloFin52::$IntervaloFin52";
echo "<br/>IntervaloIni62::$IntervaloIni62";
echo "<br/>IntervaloFin62::$IntervaloFin62";*/

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
/*
echo "<br/>IntervaloIni12::$IntervaloIni12";
echo "<br/>IntervaloFin12::$IntervaloFin12";
echo "<br/>IntervaloIni22::$IntervaloIni22";
echo "<br/>IntervaloFin22::$IntervaloFin22";
echo "<br/>IntervaloIni32::$IntervaloIni32";
echo "<br/>IntervaloFin32::$IntervaloFin32";
echo "<br/>IntervaloIni42::$IntervaloIni42";
echo "<br/>IntervaloFin42::$IntervaloFin42";
echo "<br/>IntervaloIni52::$IntervaloIni52";
echo "<br/>IntervaloFin52::$IntervaloFin52";
echo "<br/>IntervaloIni62::$IntervaloIni62";
echo "<br/>IntervaloFin62::$IntervaloFin62";
*/
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
$tabla="<table width=100%>
 <tr>
   <td style= font-size: 5pt;  valign=top><strong></strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$uno</strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$dos</strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$tres</strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$cuatro</strong></td>
   <td style= font-size: 5pt;  valign=top><strong>$cinco</strong></td>
  </tr>
  ";
  
  

$valores="";  $totalesLast1=""; $totalesLast2=""; $totalesLast3=""; $totalesActual="";
//$campaign = PodioItem::filter(15745917); // Get items from app with app_id=123

   
  $tabla=$tabla."<tr><td style=width: 20%; font-size: 7pt;  valign=top>"
  .$yearLast."</td>";
  
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
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td></tr>";*/
	
	/***************************** AÑO ACTUAL *********************************/
	  $tabla=$tabla."<tr><td style=width: 20%; font-size: 7pt;  valign=top>"
  .$year."</td>";
    
   //$valores=$valores."|".$item->title;
      
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
	
	//echo "<br/> fecha ini 2::$IntervaloIni2 <br/>";
	//echo "<br/> fecha fin 2::$IntervaloFin2 <br/>";
	
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
				//echo "valor".$item->fields["total-attendance"]->values."<br/>";
	}
	$totalesLast1 = $totalesLast1.$sum.",";
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td>";
	
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
	$tabla=$tabla."<td style=width: 10%; font-size: 7pt;  valign=top>".$sum."</td></tr>";*/
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

//$url1 = "https://chart.googleapis.com/chart?cht=bvg&chts=000000,18,c&chd=t:$totalesLast1&chs=600x450&chbh=41,2,1&chco=4C9900,9ABADF,3333FF,999900,CC00CC,FFFF00,FF0000,FF99CC,006633&chds=0,7000&chdl=$valores&chxt=x,y,x&chxl=0:|$uno|$dos|$tres|$cuatro|$cinco|$seis|7|8|9|10|11|12|13|1:|0|1000|2000|3000|4000|5000|6000|7000|2:|";
//echo "<br/>".$url1;

if(@copy($url1, 'cuatro.png')){
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