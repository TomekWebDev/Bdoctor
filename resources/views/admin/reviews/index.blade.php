@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <h3>Recensioni e voti</h3>

                    <div class="dropdown mr-3 d-flex flex-row-reverse">
                        <button class="btn btn-secondary dropdown-toggle" style="background-color: #076dbb" type="button"
                            data-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-right">
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
                </div>
            </div>
        </div>
        

        {{-- RECENSIONI --}}

        <div class="card mt-4">
            <div class="card-body text-center">
                <button id="buttonReview" class="btn btn-primary my-2 p-2" onclick="toggleReviews() "
                    style="background-color: #076dbb">Mostra recensioni</button>
                <div id="reviews" style="display: none;">

                    <h3 class="text-left mt-3">Recensioni</h3>

                    @if (count($reviews) > 0)
                    @foreach ($reviews as $rev)
                    <div class="card my-2">
                        <div class="card-body text-left">
                          <h5 class="card-title">{{ $rev->name }}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">{{ $rev->created_at->format('d M Y') }}</h6>
                          <p class="card-text">{{ $rev->review }}</p>
                        </div>
                      </div>
                    @endforeach

                    @else
                        <h2 class="text-center">Non hai ancora nessuna recensione</h2>
                    @endif
                </div>
            </div>
        </div>

        {{-- VOTI --}}
        <div class="card mt-4 text-center">
            <div class="card-body">
                <button id="buttonVote" class="btn btn-primary mb-3 p-2" style="background-color: #076dbb">Mostra
                    voti</button>
                <div id="ratings" class="row justify-content-center mt-2"
                    style="display: none;">
                    <div class="col-6">
                        <h4>Voto</h4>
                    </div>
                    <div class="col-6">
                        <h4>Data</h4>
                    </div>
                    @foreach ($ratings as $rating)
                    <div class="col-6 my-2">
                        <span>
                            @for ($i = 0; $i < 5; $i++)
                                <i class="
                                @if ($rating->rating_id - 1 == 5) fa-solid 
                                @elseif ($rating->rating_id - 1 == 4 & $i < 4) fa-solid 
                                @elseif ($rating->rating_id - 1 == 3 & $i < 3) fa-solid 
                                @elseif ($rating->rating_id - 1 == 2 & $i < 2) fa-solid 
                                @elseif ($rating->rating_id - 1 == 1 & $i < 1) fa-solid 
                                @elseif ($rating->rating_id - 1 == 0 & $i == 0) fa-solid 
                                @endif 
                                fa-regular fa-star" style="color: orange"></i>
                            @endfor
                            {{-- <i class="fa-regular fa-star" style="color: orange"></i>
                            <i class="fa-solid fa-star" style="color: orange"></i> --}}
                        </span>
                    </div>
                    <div class="col-6 my-2">
                        {{ date('d/m/Y ', strtotime($rating->created_at))}}
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
