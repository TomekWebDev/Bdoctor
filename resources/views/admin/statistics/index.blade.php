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
                <h2 class="py-3">Messaggi e Recensioni ricevute</h2>
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div class="card mt-3">
          <div class="card-body">
              <h2 class="py-3">Ratings ricevuto</h2>
              <canvas id="myRating"></canvas>
          </div>
      </div>
    </div>

@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
      
<script>
  // Variabili message
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

//Variabili review
let gennaioR = 0;
let febbraioR = 0;
let marzoR = 0;
let aprileR = 0;
let maggioR = 0;
let giugnoR = 0;
let luglioR = 0;
let agostoR = 0;
let settembreR = 0;
let ottobreR = 0;
let novembreR = 0;
let dicembreR = 0;

// associo alla variabile messageData l'oggetto passato dal controller Statistic contentente mese anno e totale di messaggi
let messageData = @json($results);

// associo alla variabile reviewData l'oggetto passato dal controller Statistic contentente mese anno e totale di reviews
let reviewData = @json($reviews);

// Associamo ai mesi il numero di messaggi
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

// Associamo ai mesi il numero di reviews
Object.keys(reviewData).forEach(function(key, index) {

switch (reviewData[index].month) {
case 1:
  gennaioR = reviewData[index].total;
  break;
case 2:
  febbraioR = reviewData[index].total;
  break;
case 3:
  marzoR = reviewData[index].total;
  break;
case 4:
  aprileR = reviewData[index].total;
  break;
case 5:
  maggioR = reviewData[index].total;
  break;
case 6:
  giugnoR = reviewData[index].total;
  break;
case 7:
  luglioR = reviewData[index].total;
  break;
case 8:
  agostoR = reviewData[index].total;
  break;
case 9:
  settembreR = reviewData[index].total;
  break;
case 10:
  ottobreR = reviewData[index].total;
  break;
case 11:
  novembreR = reviewData[index].total;
  break;
case 12:
  dicembreR = reviewData[index].total;
  break;
}

});


let xValues = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre',];

let reviewValues = [gennaioR,febbraioR,marzoR,aprileR,maggioR,giugnoR,luglioR,agostoR,settembreR,ottobreR,novembreR,dicembreR];
let messValues = [gennaio,febbraio,marzo,aprile,maggio,giugno,luglio,agosto,settembre,ottobre,novembre,dicembre];


new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      data: reviewValues,
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

// Rating grafico

let votes = @json($votes);
console.log(votes);

//Variabili mesi votes
let gennaioV = 0;
let febbraioV = 0;
let marzoV = 0;
let aprileV = 0;
let maggioV = 0;
let giugnoV = 0;
let luglioV = 0;
let agostoV = 0;
let settembreV = 0;
let ottobreV = 0;
let novembreV = 0;
let dicembreV = 0;

// Associamo ai mesi il numero di voti
Object.keys(votes).forEach(function(key, index) {

switch (votes[index].month) {
case 1:
  gennaioV = votes[index].total;
  break;
case 2:
  febbraioV = votes[index].total;
  break;
case 3:
  marzoV = votes[index].total;
  break;
case 4:
  aprileV = votes[index].total;
  break;
case 5:
  maggioV = votes[index].total;
  break;
case 6:
  giugnoV = votes[index].total;
  break;
case 7:
  luglioV = votes[index].total;
  break;
case 8:
  agostoV = votes[index].total;
  break;
case 9:
  settembreV = votes[index].total;
  break;
case 10:
  ottobreV = votes[index].total;
  break;
case 11:
  novembreV = votes[index].total;
  break;
case 12:
  dicembreV = votes[index].total;
  break;
}

});

let votesMonth = [gennaioV,febbraioV,marzoV,aprileV,maggioV,giugnoV,luglioV,agostoV,settembreV,ottobreV,novembreV,dicembreV];
let barColors = ["#ffce54", "#a0d468", "#4fc1e9", "#ac92ec", "#ed5565"];


new Chart("myRating", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      label: 'Vote',
      backgroundColor: '#ffce54',
      data: votesMonth
  }]
  },
  options: {
    scales: {
      yAxes: [{
        scaleLabel: {
          display: true,
          labelString: "Total votes"
        }
      }],
      xAxes: [{
        scaleLabel: {
          display: true,
          labelString: "Month"
        }
      }]
    }
  }
});
</script>
@endpush
