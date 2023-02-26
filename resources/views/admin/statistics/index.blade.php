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
            <div id="my-data" data-array="{{ json_encode($results) }}"></div>
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
let gennaio = 0;
let febbraio = 0;
let marzo = 0;
let aprile = 0;
let maggio = 0;
let giugno = 0;
let luglio = 0;
let agosto = 0;
let settembre = 0;
let ottobre = 0;
let novembre = 0;
let dicembre = 0;

let messageData = JSON.parse(document.getElementById('my-data').getAttribute('data-array'));
  console.log(messageData);

Object.keys(messageData).forEach(function(key, index) {

  switch (messageData[index].month) {
  case 1:
    gennaio = messageData[index].total;
    break;
  case 2:
    febbraio = messageData[index].total;
    break;
  case 3:
    marzo = messageData[index].total;
    break;
  case 4:
    aprile = messageData[index].total;
    break;
  case 5:
    maggio = messageData[index].total;
    break;
  case 6:
    giugno = messageData[index].total;
    break;
  case 7:
    luglio = messageData[index].total;
    break;
  case 8:
    agosto = messageData[index].total;
    break;
  case 9:
    settembre = messageData[index].total;
    break;
  case 10:
    ottobre = messageData[index].total;
    break;
  case 11:
    novembre = messageData[index].total;
    break;
  case 12:
    dicembre = messageData[index].total;
    break;
}

});

console.log(gennaio);
console.log(febbraio);
console.log(marzo);



let xValues = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre',];
let review = [7,8,8,9,9,9,10,11,14,14,15,2];

let messValues = [gennaio,febbraio,marzo,aprile,maggio,giugno,luglio,agosto,settembre,ottobre,novembre,dicembre];


new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      data: review,
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
