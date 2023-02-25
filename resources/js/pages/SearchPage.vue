<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-1">
                            <button class="btn btn-outline-primary" v-on:click="reviewsFilterTopDown">
                                Filtra per recensioni + -
                            </button>
                        </li>
                        <li class="nav-item mx-1">
                            <button class="btn btn-outline-primary" v-on:click="reviewsFilterDownTop">
                                Filtra per recensioni - +
                            </button>
                        </li>
                        <li class="nav-item mx-1">
                            <button class="btn btn-outline-primary" v-on:click="ratingFilterTopDown">
                                Filtra per rating + -
                            </button>
                        </li>
                        <li class="nav-item mx-1">
                            <button class="btn btn-outline-primary" v-on:click="ratingFilterDownTop">
                                Filtra per rating - +
                            </button>
                        </li>
                        <li class="nav-item mx-1">
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                Nuova ricerca
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- sposnorizzati -->

        <div v-for="sponsored in sponsoredProfiles" :key="sponsored.id" class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 d-flex">
                        <div v-if="!sponsored.image" class="col-5">
                            <img class="img-fluid" src="../../../public/img/userDoctor.jpeg" alt="" />
                            <div class="d-block text-warning">
                                This is a sponsored profile
                            </div>
                        </div>
                        <div v-else class="col-5">
                            <img class="img-fluid rounded-circle" :src="`storage/${sponsored.image}`" alt="" />
                            <div class="d-block text-warning">
                                This is a sponsored profile
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h5>
                            <router-link :to="`/profile/${sponsored.id}`">
                                Dr. {{ sponsored.user.name }} {{ sponsored.user.surname }}
                            </router-link>
                        </h5>
                        <h5>{{ sponsored.reviews.length }} recensioni</h5>
                        <h5>specializzazioni:
                            <ul>
                                <li v-for="spec in sponsored.specs" :key="spec.id">
                                    {{spec.name}}
                                </li>
                            </ul>
                        </h5>
                        <h5>{{ sponsored.address }},{{ sponsored.city }}</h5>
                        <h5>Tu chiamami sul trap phone: {{ sponsored.phone }}</h5>
                        <router-link class="btn btn-outline-primary" :to="`/profile/${sponsored.id}`">
                            Vedi medico
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- end sponsorizzati -->


        <!-- Se non ci sono specialisti -->
        <div class="card mt-3" v-if="profiles.length <= 0">
            <div class="card-body">Non ci sono specialisti</div>
        </div>

        <!-- Se ci sono specialisti -->

        <div v-else v-for="profile in profiles" :key="profile.id" class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 d-flex">
                        <div v-if="!profile.image" class="col-5">
                            <img class="img-fluid" src="../../../public/img/userDoctor.jpeg" alt="" />
                        </div>
                        <div v-else class="col-5">
                            <img class="img-fluid rounded-circle" :src="`storage/${profile.image}`" alt="" />
                        </div>
                    </div>
                    <div class="col-6">
                        <h5>
                            <router-link :to="`/profile/${profile.id}`">
                                Dr. {{ profile.user.name }} {{ profile.user.surname }}
                            </router-link>
                        </h5>
                        <h5>specializzazioni:
                            <ul>
                                <li v-for="spec in profile.specs" :key="spec.id">
                                    {{spec.name}}
                                </li>
                            </ul>
                        </h5>
                        <h5>{{ profile.reviews.length }} recensioni</h5>
                        <h5>Voto medio {{ getVoteAverage(profile.ratings) }}</h5>
                        <h5>{{ profile.address }},{{ profile.city }}</h5>
                        <h5>Tu chiamami sul trap phone: {{ profile.phone }}</h5>
                        <router-link class="btn btn-outline-primary" :to="`/profile/${profile.id}`">
                            Vedi medico
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- <ul v-else v-for="profile in profiles" :key="profile.id">
      <li>Profile id: {{ profile.id }}</li>
      <li v-for="spec in profile.specs" :key="spec.id">
        Nome della spec: {{ spec.name }}
      </li>
      <li>Media voti: {{ profile.ratings }}</li>
      <li>
        <router-link :to="`/profile/${profile.id}`">
          {{ profile.user.name }}
        </router-link>
      </li>
    </ul> -->

        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <select v-model="selectedSpecId" name="" id="">
                        <option v-for="spec in specs" :key="spec.id" :value="spec.id">
                            {{ spec.name }}
                        </option>
                    </select>

                    <button class="btn btn-primary" data-bs-dismiss="offcanvas" aria-label="Close"
                        v-on:click="searchProfilesSpecs">
                        cambia specializzazione (nuova chiamata axios)
                    </button>
                </div>
            </div>
        </div>
        <!-- end offcanvas -->
    </div>
</template>

<script>
    export default {
        name: "SearchPage",
        components: {},
        data() {
            return {
                profiles: [],
                sponsoredProfiles: [],
                specs: [],
                isLoading: false,
                pagination: {},
                // Step 4
                // Associamo il dato passato nel router link a un nuovo data di vue.
                // $route è l'oggetto che arriva tramite router .params per entrare nell'oggetto parametro
                selectedSpecId: this.$route.params.spec,
                reviewFilter: 0,
                ratingFilter: 0,

            };
        },

        mounted() {
            this.getSpecs();
            this.searchFilteredProfiles();
            this.getSponsoredWithSpecs();
        },

        methods: {
            getSpecs() {
                axios
                    .get("http://localhost:8000/api/profiles/specs")
                    .then((res) => {
                        this.specs = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                    .then(() => {
                        this.isLoading = false;
                    });
            },

            searchFilteredProfiles() {
                axios
                    .post("http://localhost:8000/api/profiles", {
                        spec: this.selectedSpecId,
                        reviewFilter: this.reviewFilter,
                        ratingFilter: this.ratingFilter,
                    })
                    .then((res) => {
                        this.profiles = res.data.profiles;
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                    .then(() => {
                        this.isLoading = false;
                    });
                //   this.selectedSpecId = "";
            },

            // Step 5
            // In questa chiamata axios (post) mandiamo il nuovo data che abbiamo salvato
            // vai alla store di profile controller guest per step 6

            getSponsoredWithSpecs() {
                this.isLoading = true;
                axios
                    .post("http://localhost:8000/api/profiles/sponsored", { spec: this.selectedSpecId, })
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
                let voteAverage = voteSum / parametro.length;
                return Math.round(voteAverage);
            },

        },
    };
</script>

<style lang="scss" scoped>
</style>
