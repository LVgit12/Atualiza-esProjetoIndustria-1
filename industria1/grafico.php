<div id="columnchart_material" style="width: 100%; min-width:900px; max-width:900px; height: 500px; margin:auto;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Ano', 'Fabricados', 'Retrabalho', 'Perda'],
      ['2014', 1000, 400, 200],
      ['2015', 1170, 460, 250],
      ['2016', 660, 1120, 300],
      ['2017', 1030, 540, 350]
    ]);

    var options = {
      title: 'Gráfico de Acompanhamento',
      subtitle: 'Fabricados, Retrabalho, Perda: 2014-2017',
      legend: { position: 'top', textStyle: {color: '#000000', fontSize: 13}},
      chartArea: {width: '30%', height: '50%'},
      colors: ['#23243a', '#ffd700', '#e74c3c'],
      backgroundColor: '#fff',
      hAxis: {
        title: 'Ano',
        textStyle: {color: '#000000'}
      },
      vAxis: {
        minValue: 0,
        textStyle: {color: '#000000'}
      },
      titleTextStyle: { color: '#000000', fontSize: 18, bold: true }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
    chart.draw(data, options);
  }
</script>
