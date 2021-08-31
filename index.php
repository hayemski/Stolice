<?php
    require_once 'login/loginProvera.php';
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <title>Početna</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://www.google.com/jsapi"></script>
    <script>
        google.load('visualization', '1.0', {'packages':['corechart']});      
        google.setOnLoadCallback(drawChart);
        
        function drawChart() {
            var jsonData = $.ajax({
                url: 'http://localhost/Faris/vizuelizacija.json',
                dataType: 'json',
                async: false
            }).responseText;  

            var type1 = $.ajax({
                url: 'http://localhost/Faris/vizuelizacija.json?tip=1',
                dataType: 'json',
                async: false
            }).responseText;  

            var type2 = $.ajax({
                url: 'http://localhost/Faris/vizuelizacija.json?tip=2',
                dataType: 'json',
                async: false
            }).responseText;  

            var data = new google.visualization.DataTable(jsonData);
            var data1 = new google.visualization.DataTable(type1);
            var data2 = new google.visualization.DataTable(type2);

            var options = {
                'title': 'CENE',
                'width': 600,
                'height': 400
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart'));
            
            function event() {
                var selectedItem = chart.getSelection()[0];
                if(selectedItem) {
                    var product = data.getValue(selectedItem.row, 0);
                    var price = data.getValue(selectedItem.row, 1);
                    alert('Proizvod ' + product + ' ima cenu: ' + price + ' RSD ');
                }
            }
            
            var listenerHandle = google.visualization.events.addListener(chart, 'select', event);
            chart.draw(data, options);
            var showChart = document.getElementById('showChart');
            
            showChart.onclick = function() {
                var typeChoice = document.forma.tip.selectedIndex;
                var chosenType = document.forma.tip.options[typeChoice].value;
                if(chosenType === '') {
                    chart.draw(data, options);
                    listenerHandle = google.visualization.events.addListener(chart, 'select', event);
                }
                if(chosenType === '1') {
                    chart.draw(data1, options);
                    google.visualization.events.removeListener(listenerHandle);
                }
                if(chosenType === '2') {
                    chart.draw(data2, options);
                    google.visualization.events.removeListener(listenerHandle);
                }
            }
        }
    </script>
</head>
<body>    
    <div class="container">  
        <div class="top-bar">
            <?php                    
                require_once 'login/logovanje.php';
                logovanje();

                if($_SESSION['tipKorisnika'] == '1') {
                    echo '<a href="admin.php">Administratorski deo</a>';
                }

                if($_SESSION['tipKorisnika'] == '1' || $_SESSION['tipKorisnika'] == '2') {
                    echo '<a class="logout" href="login/logout.php">Odjavi se</a>';
                } else {
                    echo '<a href="registracija.php">Registracija</a>';
                }
            ?>
        </div>
        
        <?php require_once 'template.php';?>
        
        <section>
            <?php
                $url = 'http://localhost/Faris/tipovi.json';
                $curlRequest = curl_init($url);
                curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curlRequest, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                curl_setopt($curlRequest, CURLOPT_HTTPGET, true);
                $type = curl_exec($curlRequest);
                curl_close($curlRequest);
                $json_types = json_decode($type);
            ?>
            <div class="search-wrapper">
                <form name="forma" method="GET">
                    <label for="tip">Prikaz vizuelizacije za tip:</label>
                    <select name="tip" id="tip">
                        <option value="" selected="selected"></option>
                        <?php
                        foreach($json_types->tipovi as $type) {
                            echo "<option value='$type->idtip'>$type->tip</option>";
                        }
                        ?>
                    </select>
                </form>
                <button name="showChart" id="showChart" class="button-success">Prikaži</button>
            </div>

            <div class="chart" id="chart"></div>
        </section>
    </div>
</body>
</html>