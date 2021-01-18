@extends('layouts.app')

@section('content')
        <h1>Welcome to Larablog home</h1>
        <div id="pie_chart" style="width: 900px; height: 500px;">
        </div>
@endsection
@section('js')
    <script>
        var analytics = <?php echo $title; ?> ;
        console.log(typeof analytics)
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart(){
                var data = google.visualization.arrayToDataTable(analytics);
                var options = {
                        title: 'Percentage of engagement share of blogs',
                        is3D: false
                };
                var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
                chart.draw(data, options);

        }
        

    </script>
    @endsection
