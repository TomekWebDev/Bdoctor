@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h1>Statistiche</h1>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
      
<script>
  var xValues = ['Gennaio', 'Febbraio', 'Marzo', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre',];
var yValues = [7,8,8,9,9,9,10,11,14,14,15,2];
let gennaio = 12;
let febbraio = 10;
var messValues = [gennaio,febbraio,3,4,5,6,7,3,5,7,4,5];


new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      data: yValues,
      borderColor: "red",
      fill: false
    },{
      data: messValues,
      borderColor: "blue",
      fill: false
    },
    ]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 0, max:16}}],
    }
  }
});
</script>
@endpush
