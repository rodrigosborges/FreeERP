@extends('protocolos::template')

@section('body')
<canvas id="myChart" width="50" height="50"></canvas>
@endsection

@section('js')
<script>
var ctx = document.getElementById('myChart');
var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        datasets: [{
            label: '# of Votes',
            data: [0, 1],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
});
</script>
@endsection