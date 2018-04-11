<?php

include("pages/bd.php");
include("pages/functions.php");


$prob_query = mys("SELECT * FROM `probniki`");

$save = "";

$save .= '

window.onload = function () {
          var chart = new CanvasJS.Chart("chartContainer", {
              theme: "theme1",//theme1
              title:{
                  text: "Средние результаты"              
             },
			 
			 axisX:{
   labelAngle: -30,
   labelFontColor: "green",
 },
 
 axisY:{
   maximum: 125,
 },
			 
              data: [ 
              {
// Change type to "bar", "splineArea", "area", "spline", "pie",etc.
                  type: "spline",
';


$save .= 'dataPoints: [';

$k = 0;

while($probs = mysar($prob_query)){
	
    $save .= '  { label: "';
	$save .= $probs['desc'];
	
	$myid = $probs['id'];
	
	$ave_query = mys("SELECT * FROM `results` WHERE `probnik_id`='$myid' ");
	$total = 0;
	$num=0;
	while($ave = mysar($ave_query)){
		if($ave['total']!=0){
			$total += $ave['total'];
			$num++;
		}
	}
	
	$average = ($total / $num);
	
	$save .= '", y:';
	$save .= $average;
	$save .= ' }';
	$k++;  
	if($k != mysql_num_rows($prob_query))$save .= ",";
}

$save .= ']
 }
              ]
          });

          chart.render();
      }

';

$fp = fopen('ave.js', 'w');
fwrite($fp, $save);
fclose($fp);

?>