@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="dropdown mr-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                Action
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile.edit', $profile->id) }}">Modifica Profilo</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile.show', $profile->id) }}">Il mio profilo</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.messages.index', $profile->id) }}">I miei messaggi</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.sponsors.index', $profile->id) }}">Aggiungi Sponsor</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.statistics.index', $profile->id) }}">Statistiche</a>
                </li>
            </ul>
        </div>

        {{-- RECENSIONI --}}

        <div class="card mt-4 text-center">
            <div class="card-body">
                <button id="buttonReview" class="btn btn-primary mb-3 p-2" onclick="toggleReviews()">Mostra recensioni</button>
                <div id="reviews" style="display: none;">
                    {{-- Qua sotto va fatto foreach --}}
                    @if (count($reviews) > 0)
                        <div class="list-group">
                            @foreach ($reviews as $rev)
                                <div class="list-group-item d-md-flex flex-md-row justify-content-between align-items-center">
                                    <div class="col-md-3">
                                        <h5><strong>Recensione di {{ $rev->name }}:</strong></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <span>{{ $rev->review }} </span>
                                    </div>
                                    <div class="col-md-3">
                                        <span><i>Scritto il: {{ $rev->created_at->format('d M Y') }}</i></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h2 class="text-center">Non hai ancora nessuna recensione</h2>
                    @endif
                </div>
            </div>
        </div>

        {{-- VOTI --}}
        <div class="card mt-4 text-center">
            <div class="card-body">
                <button id="buttonVote" class="btn btn-primary mb-3 p-2">Mostra voti</button>
                <div id="ratings" class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 justify-content-center mt-2"
                    style="display: none;">
                    @foreach ($ratings as $rating)
                        <div class="col">
                            <div class="my-element card @if ($rating->rating_id - 1 <= 1) bg-danger @elseif ($rating->rating_id - 1 >= 2 && $rating->rating_id - 1 <= 3) bg-warning @elseif ($rating->rating_id - 1 >= 4) bg-success @endif"
                                style="aspect-ratio: 1/1;">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <h5 class="text-center">{{ $rating->rating_id - 1 }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        let button = document.getElementById("buttonVote");
        let ratings = document.getElementById("ratings");
        button.addEventListener("click", function() {
            if (ratings.style.display === "none") {
                ratings.style.display = "flex";
                button.innerText = "Nascondi voti";
            } else {
                ratings.style.display = "none";
                button.innerText = "Mostra voti";
            }
        });

        function toggleReviews() {
            let reviews = document.getElementById("reviews");
            let button = document.getElementById("buttonReview");
            if (reviews.style.display === "none") {
                reviews.style.display = "block";
                button.textContent = "Nascondi recensioni";
            } else {
                reviews.style.display = "none";
                button.textContent = "Mostra recensioni";
            }
        }
    </script>
@endpush
