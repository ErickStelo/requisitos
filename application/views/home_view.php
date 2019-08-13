<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script>
      google.charts.load("current", {packages:["map"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Lat', 'Long', 'Name'],
          
          <?php 
          if(count($gps) >0){
            foreach ($gps as $value) { ?>
            [<?php  echo $value['gps_pos_latitude_ini'] ?>,
             <?php echo $value['gps_pos_longitude_ini'] ?>,
             '<?php echo $this->funcoes->funcionario($value['apa_id']) ?> <br> Inicio: <?php   if(isset($value['gps_pos_datahoracoleta_ini'])){ echo $this->funcoes->formataDataeHora($value['gps_pos_datahoracoleta_ini']); } ?> <br> Fim: <?php if(isset($value['gps_pos_datahoracoleta_fim'])){ echo $this->funcoes->formataDataeHora($value['gps_pos_datahoracoleta_fim']); } ?>'],
            <?php }
            }else { ?>
              ['','',''],
            <?php } ?>
        ]);

        var map = new google.visualization.Map(document.getElementById('map_div'));
        map.draw(data, {showTip: true});
      }
  </script>
  <?php
//  echo date('Y-m-d') ."/";
//  echo $gps[0]['gps_pos_datahoracoleta_ini'];
  ?>
 <div id="map_div" style="width: 100%; height: 500px"></div>

