<template>
    <div class="container">
        <!-- navbar advanced search -->
        <nav class="navbar col-lg-12">
            <div class="">
                <div class="w-100 text-center my-3">
                    <h2>Ricerca Avanzata</h2>
                </div>
                <div class="" id="navbarNav2">
                    <div class="container">
                        <div class="row w-100">
                            <select required v-model="selectedSpecId" name="" id="" class="form-select mb-3 col-lg-12">
                                <option disabled selected placeholder="Seleziona una
                                    specializzazione">
                                    <span class="text-danger">*</span>Seleziona una
                                    specializzazione
                                </option>
                                <option v-for="spec in specs" :key="spec.id" :value="spec.id">
                                    {{ spec.name }}
                                </option>
                            </select>
                            <button
                                v-on:click="reviewFilter = '';ratingFilter = '';currentRatingFilter = '';currentReviewFilter = '';findSpecName();searchProfilesBySpec();getSponsoredWithSpecs();"
                                style="background-color: #076dbb" class="btn btn-primary mb-3">
                                Nuova ricerca per specializzazione
                            </button>
                        </div>
                        <div class="row w-100">
                            <div class="col-lg-6">
                                <label for="ratingFilterSelect">Seleziona filtro per media voti minima:</label>
                                <select id="ratingFilterSelect" v-model="ratingFilter" class="form-select mb-3">
                                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="reviewFilterSelect">Seleziona filtro per minimo numero di
                                    recensioni:</label>
                                <select id="reviewFilterSelect" v-model="reviewFilter" class="form-select mb-3">
                                    <option v-for="n in 10" :key="n" :value="n">{{ n }}</option>
                                </select>
                            </div>
                            <button class="btn btn-primary col-lg-12 mb-3" type="button" v-on:click="
                  searchProfilesBySpec();
                  currentRatingFilter = ratingFilter;
                  currentReviewFilter = reviewFilter;
                " style="background-color: #076dbb">
                                Applica filtri
                            </button>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-end">
                            <div class="dropdown p-0">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false" style="background-color: #076dbb">
                                    Ordina risultati per
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <button class="dropdown-item" v-on:click="reviewsFilterTopDown">
                                            Recensioni dal maggiore
                                        </button>
                                    </li>
                                    <div class="dropdown-divider"></div>
                                    <li>
                                        <button class="dropdown-item" v-on:click="reviewsFilterDownTop">
                                            Recensioni dal minore
                                        </button>
                                    </li>
                                    <div class="dropdown-divider"></div>
                                    <li>
                                        <button class="dropdown-item" v-on:click="ratingFilterTopDown">
                                            Voto medio dal maggiore
                                        </button>
                                    </li>
                                    <div class="dropdown-divider"></div>
                                    <li>
                                        <button class="dropdown-item" v-on:click="ratingFilterDownTop">
                                            Voto medio dal minore
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end navbar -->

        <!-- resume of the search results, filters and orders -->
        <div class="container">
            <div v-if="selectedSpecId != undefined" class="card mt-3 p-3">
                <div class="row d-flex justify-content-between">
                    <span>
                        <strong>{{ profiles.length + sponsoredProfiles.length }}</strong>
                        risultati trovati per
                        <strong class="badge bg-primary m-1">{{ selectedSpecName }}</strong>
                    </span>
                    <span v-if="currentRatingFilter != ''">Filtro voto minimo:
                        <strong>{{ currentRatingFilter }}</strong>
                    </span>
                    <span v-if="currentReviewFilter != ''">Filtro recensioni minime:
                        <strong>{{ currentReviewFilter }}</strong>
                    </span>
                </div>
            </div>
        </div>

        <!-- sponsored profiles -->
        <div class="container">
            <div v-for="sponsored in sponsoredProfiles" :key="sponsored.id" class="card mt-3">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                            <div v-if="!sponsored.image" class="col-5">
                                <img class="img-fluid rounded-circle border border-5 border-warning"
                                    src="../../../public/img/userDoctor.jpeg" alt="" />
                                <div class="d-block text-warning text-center">
                                    Sponsorizzato
                                </div>
                            </div>
                            <div v-else class="col-5">
                                <img style="aspect-ratio: 1/1; object-fit: cover"
                                    class="img-fluid rounded-circle border border-5 border-warning"
                                    :src="`storage/${sponsored.image}`" alt="" />
                                <div class="d-block text-warning text-center">
                                    Sponsorizzato
                                </div>
                            </div>
                            <div>
                                <h4>
                                    Dr. {{ sponsored.user.name }} {{ sponsored.user.surname }}
                                </h4>

                                <small v-for="spec in sponsored.specs" :key="spec.id" class="text-muted">
                                    {{ spec.name }}
                                </small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="my-4 text-center">
                                <div v-if="sponsored.ratings.length" class="col-sm-12">
                                    Voto
                                    <strong> {{ getVoteAverage(sponsored.ratings) }}</strong> in
                                    base a <strong>{{ sponsored.ratings.length }}</strong> voti
                                </div>
                                <div v-else class="col-sm-12">
                                    Questo medico non ha ancora voti
                                </div>
                                <div v-if="sponsored.reviews.length" class="col-sm-12">
                                    <strong>{{ sponsored.reviews.length }}</strong> recensioni
                                </div>
                                <div v-else class="col-sm-12">
                                    Questo medico non ha ancora recensioni
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <router-link class="btn btn-outline-primary w-100" :to="`/profile/${sponsored.id}`">
                                Vedi medico
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end sponsored -->

            <!-- If there are no sponsored AND normal profiles -->
            <div class="card mt-3" v-if="profiles == 0 && sponsoredProfiles == 0">
                <div class="card-body">Non ci sono specialisti</div>
            </div>

            <!-- normal profiles -->

            <div v-else v-for="profile in profiles" :key="profile.id" class="card mt-3">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <!-- image -->
                        <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                            <div v-if="!profile.image" class="col-5">
                                <img class="img-fluid rounded-circle" src="../../../public/img/userDoctor.jpeg"
                                    alt="" />
                            </div>
                            <div v-else class="col-5">
                                <img style="aspect-ratio: 1/1; object-fit: cover" class="img-fluid rounded-circle"
                                    :src="`storage/${profile.image}`" alt="" />
                            </div>
                            <!-- name and specs -->
                            <div>
                                <h4>Dr. {{ profile.user.name }} {{ profile.user.surname }}</h4>

                                <small v-for="spec in profile.specs" :key="spec.id" class="text-muted">
                                    {{ spec.name }}
                                </small>
                            </div>
                        </div>
                        <!-- votes review columns -->
                        <div class="col-lg-4 col-sm-12">
                            <div class="my-4 text-center">
                                <div v-if="profile.ratings.length" class="col-sm-12">
                                    Voto
                                    <strong> {{ getVoteAverage(profile.ratings) }}</strong> in
                                    base a <strong>{{ profile.ratings.length }}</strong> voti
                                </div>
                                <div v-else class="col-sm-12">
                                    Questo medico non ha ancora voti
                                </div>
                                <div v-if="profile.reviews.length" class="col-sm-12">
                                    <strong>{{ profile.reviews.length }}</strong> recensioni
                                </div>
                                <div v-else class="col-sm-12">
                                    Questo medico non ha ancora recensioni
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <router-link class="btn btn-outline-primary w-100" :to="`/profile/${profile.id}`">
                                Vedi medico
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end normal profiles -->

        <Footercomp />
    </div>
</template>

<script>
import Footercomp from "../components/Footercomp.vue";

    export default {
        name: "SearchPage",
        components: {
            Footercomp,
        },
        data() {
            return {
                profiles: [],
                sponsoredProfiles: [],
                specs: [],
                isLoading: false,
                // Step 4
                // Associamo il dato passato nel router link a un nuovo data di vue.
                // $route è l'oggetto che arriva tramite router .params per entrare nell'oggetto parametro
                selectedSpecId: this.$route.params.spec,
                selectedSpecName: "",
                reviewFilter: "",
                ratingFilter: "",
                currentRatingFilter: "",
                currentReviewFilter: "",
            };
        },

        mounted() {
            this.getSpecs();
            if (this.selectedSpecId) {
                this.searchProfilesBySpec();
            }
            this.getSponsoredWithSpecs();
        },

        methods: {
            getSpecs() {
                axios
                    .get("/api/profiles/specs")
                    .then((res) => {
                        this.specs = res.data;
                        this.findSpecName();
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                    .then(() => {
                        this.isLoading = false;
                    });
            },

            searchProfilesBySpec() {
                let params = {};
                if (this.selectedSpecId) {
                    params.selectedSpecId = this.selectedSpecId;
                }
                if (this.reviewFilter) {
                    params.reviewFilter = this.reviewFilter;
                }
                if (this.ratingFilter) {
                    params.ratingFilter = this.ratingFilter;
                }
                let queryParams = new URLSearchParams(params);
                history.replaceState(null, "", "?" + queryParams.toString());
                console.log(params);
                axios
                    .get("/api/profiles", {
                        params,
                    })
                    .then((res) => {
                        console.log(res);
                        this.profiles = res.data;
                        params = {};
                        // this.reviewFilter = "";
                        // this.ratingFilter = "";
                    })
                    .catch((err) => {
                        //   console.log(err);
                    });
            },

            // Step 5
            // In questa chiamata axios (post) mandiamo il nuovo data che abbiamo salvato
            // vai alla store di profile controller guest per step 6

            getSponsoredWithSpecs() {
                this.isLoading = true;
                axios
                    .post("/api/profiles/sponsored", { spec: this.selectedSpecId })
                    .then((res) => {
                        this.sponsoredProfiles = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                    .then(() => {
                        this.isLoading = false;
                    });
            },

            reviewsFilterTopDown() {
                this.profiles.sort((a, b) => {
                    // sort prende gli oggetti a coppie e li paragona
                    // in questo caso gli diciamo di confrontare quanto sono lunghe le array delle recensioni.
                    return b.reviews.length - a.reviews.length;
                });

                // display the sorted array of objects
                console.log(this.profiles);
            },
            reviewsFilterDownTop() {
                this.profiles.sort((a, b) => {
                    return a.reviews.length - b.reviews.length;
                });

                // display the sorted array of objects
                console.log(this.profiles);
            },
            ratingFilterTopDown() {
                this.profiles.sort(function (a, b) {
                    // salviamo variabili che rappresentano le array di singoli rating (che sono oggetti) per il profilo a e b che verranno confrontati.
                    let ratingA = a.ratings;
                    let ratingB = b.ratings;
                    // inizzializzo var per le somme
                    let sumA = 0;
                    let sumB = 0;
                    ratingA.forEach(function (element, index) {
                        // nel foreach vado a prendere ad ogni giro di ciclo il voto numerico all'interno dell'oggetto rating
                        sumA += element.vote;
                    });
                    // calcolo media dei voti numerici facendo (Somma voti numerici di A) diviso (la lunghezza dell'array di oggetti dei singoli rating di A)
                    let avgA = sumA / ratingA.length;

                    ratingB.forEach(function (element, index) {
                        sumB += element.vote;
                    });
                    let avgB = sumB / ratingB.length;

                    // con questa condizione diciamo alla funzione sort quali sono i termini che deve prendere in considerazione per ordinare gli oggetti.
                    // se non glie lo indichiamo, sort esegue in automatico la comparazione tra i parametri di partenza (a, b)
                    if (avgB < avgA) {
                        return -1;
                    } else if (avgB > avgA) {
                        return 1;
                    } else {
                        return 0;
                    }
                });
                console.log(this.profiles);
            },
            ratingFilterDownTop() {
                this.profiles.sort(function (a, b) {
                    let ratingA = a.ratings;
                    let ratingB = b.ratings;
                    let sumA = 0;
                    let sumB = 0;
                    ratingA.forEach(function (element, index) {
                        sumA += element.vote;
                    });
                    let avgA = sumA / ratingA.length;

                    ratingB.forEach(function (element, index) {
                        sumB += element.vote;
                    });
                    let avgB = sumB / ratingB.length;
                    if (avgA < avgB) {
                        return -1;
                    } else if (avgA > avgB) {
                        return 1;
                    } else {
                        return 0;
                    }
                });
                console.log(this.profiles);
            },
            getVoteAverage(parametro) {
                let voteSum = 0;
                parametro.forEach((rating) => {
                    voteSum += rating.vote;
                });
                let voteAverage = Math.round(voteSum / parametro.length);
                return voteAverage;
            },
            findSpecName() {
                this.selectedSpecName = this.specs.find(
                    (obj) => obj.id === this.selectedSpecId
                ).name;
            },
        },
    };
</script>

<style lang="scss" scoped></style>
