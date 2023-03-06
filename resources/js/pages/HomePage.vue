<template>
    <div class="">
        <!-- background image, title and search tools container -->
        <div class="container-fluid img-background mb-4">
            <div class="container title-search-container">
                <h1 class="text-center bg-col mb-5">
                    Ricerca medici per specializzazione
                </h1>
                <div class="row d-flex justify-content-around">
                    <div class="col-lg-6 col-md-12 mb-md-3 mb-3">
                        <select class="form-select p-2" v-model="selectedSpecId" name="" id="">
                            <option v-for="spec in specs" :key="spec.id" :value="spec.id">
                                {{ spec.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <router-link class="btn bg text-white w-100"
                            :to="{ name: 'search', params: { spec: selectedSpecId } }">
                            Cerca
                        </router-link>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <router-link class="btn bg align-self-center text-white w-100" :to="{ name: 'search' }">
                            Vai a ricerca avanzata
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2
            Chiamata axios per avere elenco specs, le cicliamo e con v-model associamo la spec a selectedSpecId.

        Step 3
            In questo router link passiamo il nome della rotta della pagina di ricerca
            e possiamo associargli un oggetto params (oggetto predefinito del routing)
            come se fosse un props. In questo caso gli abbiamo passato solo spec.
            Vai a SearchPage.vue per step 4
        -->

        <div class="container my-5">
            <h3 class="bg-col text-center">Medici in evidenza</h3>
            <LoaderComp v-if="isLoading" />
            <div v-for="sponsored in sponsoredProfiles" :key="sponsored.id" class="card mt-5">
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
                                    <i v-for="n in 5" :key="n" :class="getVoteAverage(sponsored.ratings) < n ? 'fa-regular fa-star' : 'fa-solid fa-star'" style="color: orange;"></i> in base a <strong>{{ sponsored.ratings.length }}</strong> voti
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
        </div>

        <FooterComp />
    </div>
</template>

<script>
    import FooterComp from "../components/FooterComp.vue";
    import LoaderComp from "../components/LoaderComp.vue";

    export default {
        name: "HomePage",
        components: {
            FooterComp,
            LoaderComp,
        },
        data() {
            return {
                selectedSpecId: "",
                specs: [],
                isLoading: false,
                sponsoredProfiles: [],
            };
        },

        mounted() {
            this.getSpecs();
            this.getAllSponsored();
        },

        methods: {
            getSpecs() {
                axios
                    .get("http://localhost:8000/api/profiles/specs")
                    .then((res) => {
                        //   console.log(res.data);
                        this.specs = res.data;
                        //   this.specs = res.data.specs;
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                    .then(() => {
                        this.isLoading = false;
                    });
                //   this.selectedSpecId = "";
            },
            getAllSponsored() {
                this.isLoading = true;
                axios
                    .get("http://localhost:8000/api/profiles/sponsored")
                    .then((res) => {
                        //   console.log(res.data);
                        this.sponsoredProfiles = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                    .then(() => {
                        this.isLoading = false;
                    });
            },
            getVoteAverage(parametro) {
                let voteSum = 0;
                parametro.forEach((rating) => {
                    voteSum += rating.vote;
                });
                let voteAverage = Math.round(voteSum / parametro.length);
                return voteAverage;
            },
        },
    };
</script>

<style lang="scss" scoped>
    .img-background {
        background-image: url(../../img/pexels-cedric-fauntleroy-4266939.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 500px;
        padding: 200px 0px;
    }

    .trasparent {
        background-color: transparent;
    }

    .bg {
        background-color: #076dbb;
    }

    .bg-col {
        color: #076dbb;
    }

    .spec-search-bar {
        background-color: rgb(7, 109, 187, 0.3);
        padding: 0.2rem;
    }

    .title-search-container {
        background-color: rgb(255, 255, 255, 0.1);
        border-radius: 0.5rem;
        padding: 2rem;
        padding-left: 4rem;
        padding-right: 4rem;
    }
</style>
