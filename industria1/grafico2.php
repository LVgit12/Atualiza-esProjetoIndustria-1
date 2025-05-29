<div id="chart_div" style="width:100%; min-width:320px; max-width:550px; height:202px; margin:auto; background:#28294d; border-radius:8px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
      ['A', 3],
      ['AA', 1],
      ['AAA', 1],
      ['AAAA', 1],
      ['AAAAA', 2]
    ]);

    var options = {
      title: 'testes',
      legend: { position: 'right', textStyle: {color: '#000000', fontSize: 13}},
      backgroundColor: '#fff',
      chartArea: {width: '80%', height: '80%', backgroundColor: { fill: '#28294d' }},
      colors: ['#ffeba7', '#ffd700', '#e74c3c', '#4f8cff', '#23243a'],
      width: '100%',
      height: 202,
      titleTextStyle: { color: '#ffeba7', fontSize: 18, bold: true }
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>