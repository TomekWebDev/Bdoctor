@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card ">
            <div class="card-body d-flex justify-content-between">
                <h1>Statistiche</h1>
                <div class="dropdown mr-3 d-flex flex-row-reverse ">
                    <button class="btn btn-secondary dropdown-toggle align-self-center" type="button" data-toggle="dropdown"
                        aria-expanded="false" style="background-color: #076dbb">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.index', $profile->id) }}">Dashboard</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit', $profile->id) }}">Modifica
                                Profilo</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.reviews.index', $profile->id) }}">Le mie
                                Recensioni</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.sponsors.index', $profile->id) }}">Aggiungi
                                Sponsor</a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('admin.statistics.index', $profile->id) }}">Statistiche</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="py-3">Messaggi e Recensioni ricevute</h2>

                    <div>
                        <div>
                            <div style="width: 10px; height: 10px;" class="bg-danger d-inline-block"></div>
                            <span>Review</span>
                        </div>
                        <div>
                            <div style="width: 10px; height: 10px;" class="bg-primary d-inline-block"></div>
                            <span>Messaggi</span>
                        </div>

                    </div>
                </div>

                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">

                    <h2 class="py-3">Rating ricevuti per il mese di </h2>
                    <div class="align-self-center dropdown mr-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Month
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 1) }}">Gennaio</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 2) }}">Febbraio</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 3) }}">Marzo</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 4) }}">Aprile</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 5) }}">Maggio</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 6) }}">Giugno</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 7) }}">Luglio</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 8) }}">Agosto</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 9) }}">Settembre</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 10) }}">Ottobre</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 11) }}">Novembre</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.statistics.setMonth', $selectedMonth = 12) }}">Dicembre</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <canvas id="myRating"></canvas>
            </div>
        </div>

        {{-- {{ dd($results) }} --}}

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


        let xValues = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre',
            'Ottobre', 'Novembre', 'Dicembre',
        ];

        let reviewValues = [gennaioR, febbraioR, marzoR, aprileR, maggioR, giugnoR, luglioR, agostoR, settembreR, ottobreR,
            novembreR, dicembreR
        ];
        let messValues = [gennaio, febbraio, marzo, aprile, maggio, giugno, luglio, agosto, settembre, ottobre, novembre,
            dicembre
        ];


        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: reviewValues,
                    borderColor: "red",
                    fill: false
                }, {
                    data: messValues,
                    borderColor: "blue",
                    fill: false
                }, ]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 16
                        }
                    }],
                }
            }
        });


        let voti = @json($voti);
        console.log(voti);

        let vote0count = 0;
        let vote1count = 0;
        let vote2count = 0;
        let vote3count = 0;
        let vote4count = 0;
        let vote5count = 0;

        voti.forEach(element => {
            switch (element.vote) {
                case 0:
                    vote0count = element.count;
                    break;
                case 1:
                    vote1count = element.count;
                    break;
                case 2:
                    vote2count = element.count;
                    break;
                case 3:
                    vote3count = element.count;
                    break;
                case 4:
                    vote4count = element.count;
                    break;
                case 5:
                    vote5count = element.count;
                    break;
            }
        });

        console.log(vote0count);
        console.log(vote1count);
        console.log(vote2count);
        console.log(vote3count);
        console.log(vote4count);
        console.log(vote5count);


        // let votesMonth = [gennaioV, febbraioV, marzoV, aprileV, maggioV, giugnoV, luglioV, agostoV, settembreV, ottobreV,
        //     novembreV, dicembreV
        // ];
        let barColors = ["#ffce54", "#a0d468", "#4fc1e9", "#ac92ec", "#ed5565", "#000000"];


        new Chart("myRating", {
            type: "bar",
            data: {
                labels: [0, 1, 2, 3, 4, 5],
                datasets: [{
                    label: 'Total votes',
                    backgroundColor: barColors,
                    data: [vote0count, vote1count, vote2count, vote3count, vote4count, vote5count]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 15,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Total votes"
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: "Votes"
                        }
                    }]
                }
            }
        });
    </script>
@endpush
