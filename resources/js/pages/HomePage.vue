<template>
    <div class="container-fluid">

        <div class="container-fluid img-background">
            <h1 class="text-center bg-col">Ricerca medico per sponsorizzazione</h1>
                <div class="card trasparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-center m-auto">
                            <select class="w-75 p-2 mx-2" v-model="selectedSpecId" name="" id="">
                                <option v-for="spec in specs" :key="spec.id" :value="spec.id">
                                    {{ spec.name }}
                                </option>
                            </select>
                            <router-link class="btn bg mx-2 text-white" :to="{
                                name: 'search',
                                params: { spec: selectedSpecId },
                            }">Cerca</router-link>
                            <router-link class="btn bg align-self-center text-white" :to="{
                            name: 'search',
                            }">Vai a ricerca avanzata</router-link>
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
        <div class="container">
            <h1 class="bg-col text-center">I nostri medici sponsorizzati :</h1>
            <div v-for="sponsored in sponsoredProfiles" :key="sponsored.id" class="card mt-3 mb-3">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <!-- image -->
                        <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                            <div v-if="!sponsored.image" class="col-5">
                                <img class="img-fluid rounded-circle" src="../../../public/img/userDoctor.jpeg"
                                    alt="" />
                            </div>
                            <div v-else class="col-5">
                                <img style="aspect-ratio: 1/1; object-fit: cover" class="img-fluid rounded-circle"
                                    :src="`storage/${sponsored.image}`" alt="" />
                            </div>
                            <div>
                                <h4>Dr. {{ sponsored.user.name }} {{ sponsored.user.surname }}</h4>

                                <small v-for="spec in sponsored.specs" :key="spec.id" class="text-muted">
                                    {{ spec.name }}
                                </small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="my-4 text-left">
                                <h5>
                                    <router-link :to="`/profile/${sponsored.id}`" class="text-decoration-none text-dark">
                                        Dr. {{ sponsored.user.name }} {{ sponsored.user.surname }}
                                    </router-link>
                                </h5>
                                <h5>{{ sponsored.reviews.length }} recensioni</h5>
                                <h5>
                                    specializzazioni:
                                    <ul class="list-unstyled">
                                        <li v-for="spec in sponsored.specs" :key="spec.id">
                                            {{ spec.name }}
                                        </li>
                                    </ul>
                                </h5>
                                <h5>{{ sponsored.address }},{{ sponsored.city }}</h5>
                                <h5>N. di telefono: {{ sponsored.phone }}</h5>
                                <router-link class="btn btn-outline-primary" :to="`/profile/${sponsored.id}`">
                                    Vedi medico
                                </router-link>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Footercomp/>
    </div>
</template>

<script>
import Footercomp from "../components/Footercomp.vue";

    export default {
        name: "HomePage",
        components: {
            Footercomp
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

    .bg{
        background-color: #076DBB;
    }

    .bg-col{
      color: #076DBB;
    }
</style>