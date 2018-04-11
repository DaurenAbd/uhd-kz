

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
dataPoints: [  { label: "УХД-11 20.09.13", y:81 },  { label: "УХД-12 28.09.13", y:86.428571428571 },  { label: "УХД-13", y:81.1 },  { label: "УХД-14 24.10.13 (Katev 1)", y:81.619047619048 },  { label: "УХД-15 25.10.13", y:83.190476190476 },  { label: "УХД-16 03.11.13", y:82 }]
 }
              ]
          });

          chart.render();
      }

